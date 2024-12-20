<?php
include_once("user_sql.php");
include_once("email_sql.php");

session_start(); 

$error_username = $error_email = $error = "";

if (isset($_POST['submit'])) {
    // security measures
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

    if (does_username_exist($username)) {
        $user_id = get_user_id_by_username($username)['user_id'];

        $user_data = get_user($user_id);

        if ($user_data['email'] === $email) {
            
        }
        else {
            $error = "That username is not linked to that email";
        }

    }
    else {
        $error = "Username does not exist";
    }

}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Advanced Media Library</title>	
</head>
<body>
	
	<section id="header">
		<img src="images/logo.png" width="60px" height="50px">

		<div>
			<ul id="nav">
				<li><a href="index.php">Home</a></li>
				<li><a href="login.php" class="active">Login</a></li>
                <li><a href="sign_up.php">Register</a></li>
			</ul>
		</div>
	</section>

	<section id="page-header">
		<h2>Advanced Media Library</h2>
		<p>Have a precious time with famous books</p>
	</section>
    <main class="container pt-5 pb-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="login-form-container border p-4 rounded shadow">
                    <h2 class="text-center mb-4">Forgot Password</h2>
                    <form method="post">
                        <div class="form-group mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username"
                                placeholder="Enter your username">
                            <span class="text-danger"><?php echo $error_username; ?></span>
                        </div>
                        <div class="form-group mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="enter your email">
                            <span class="text-danger"><?php echo $error_email; ?></span>
                        </div>
                        <div> 
                            <button type="submit" class="btn btn-primary w-100" name="submit" value="true">Request Password Reset Email</button>
                            <span class="text-danger"><?php echo $error; ?></span>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </main>
    <?php include("footer.php"); ?>
</body>
</html>