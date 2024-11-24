<?php
include_once("accountSQL.php");

$errorUsername = $errorPassword = $error = "";

if (isset($_POST['submit'])) {


    // security measures
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);


    if (Authorise($username, $password) == AuthoriseStates::MATCH) {
        
        header('Location: userIndex.php');
    }
    else if (Authorise($username, $password) == AuthoriseStates::INVALID_PASSWORD) {
        $error = "Invalid password";
    }
    else {
        $error = "Invalid username and password";
}



    
}

?>

<!DOCTYPE html>
<html lang="en">

<body class="d-flex flex-column min-vh-100">

    <?php include("header.php"); ?>

    <main class="container pt-5 pb-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="login-form-container border p-4 rounded shadow">
                    <h2 class="text-center mb-4">Login</h2>
                    <form method="post">
                        <div class="form-group mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username"
                                placeholder="Enter a username" value=<?php if(isset($_POST['username'])){ echo $_POST['username']; } ?>>
                            <span class="text-danger"><?php echo $errorUsername; ?></span>
                        </div>
                        <div class="form-group mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                            <span class="text-danger"><?php echo $errorPassword; ?></span>
                        </div>
                        <!-- <div class="form-check mb-3">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Remember me</label>
                        </div> -->
                        <button type="submit" class="btn btn-primary w-100" name="submit" value="true">Sign Up</button>
                        <span class="text-danger"><?php echo $error; ?></span>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <?php include("footer.php"); ?>
</body>

</html>