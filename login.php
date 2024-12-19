<?php
include_once("user_sql.php");

session_start(); 

$error_username = $error_password = $error = "";

if (isset($_POST['submit'])) {
    // security measures
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);

    $auth_result = authorise_user($username, $password);
    $is_active = false;

    if (isset($auth_result['user_id'])) {
        $is_active = is_user_active($auth_result['user_id']);
    }

    if ($auth_result['status'] == AuthoriseStates::MATCH) {

        if (!$is_active) {
            $error = "User not active. Please activate your account";
        }
        else {
            session_regenerate_id();
            $_SESSION['user_id'] = $auth_result['user_id']; // Store user ID in session
            header("Location: user_index.php");
            exit(); 
        }

    } else if ($auth_result['status'] == AuthoriseStates::INVALID_PASSWORD) {
        $error = "Invalid password";
    }
    else {
        $error = "Invalid username and password";
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
	
	<!-- header & navigation -->
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
	<!-- -->
		
	<!-- intro section -->
	<section id="page-header">
		<h2>Advanced Media Library</h2>
		<p>Have a precious time with famous books</p>
	</section>
    <main class="container pt-5 pb-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="login-form-container border p-4 rounded shadow">
                    <h2 class="text-center mb-4">Login</h2>
                    <form method="post">
                        <div class="form-group mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username"
                                placeholder="Enter a username" value=<?php if (isset($username)) {
                                                                            echo $username;
                                                                        } ?>>
                            <span class="text-danger"><?php echo $error_username; ?></span>
                        </div>
                        <div class="form-group mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                            <span class="text-danger"><?php echo $error_password; ?></span>

                        </div>
                        <div class="pb-3">
                            <p><a class="link-opacity-75" href="forgot_password.php">Forgot password?</a></p>
                        </div>
                        <!-- <div class="form-check mb-3">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Remember me</label>
                        </div> -->
                        <div> 
                            <button type="submit" class="btn btn-primary w-100" name="submit" value="true">Login</button>
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