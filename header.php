<?php
// require_once("database.php");

if (isset($_GET['logged_out'])) {
    session_start();
    unset($_SESSION['user_id']);
    session_destroy();
}

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advanced Media Library</title>
    <link rel="stylesheet" href="style.css">
</head>

<header>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid p-lg-2 px-lg-5 d-flex align-items-center justify-content-start">

            <img src="images/logo.png" width="60px" height="50px" class="me-3">

            <h2 class="nv-title mb-0">Advanced Media Library</h2>

            <div class="ms-auto">
                <ul id="nav" class="navbar-nav flex-row">
                    <li class="nav-item"><a href="index.php" class="nav-link active">Home</a></li>
                    <li class="nav-item"><a href="login.php" class="nav-link">Login</a></li>
                    <li class="nav-item"><a href="sign_up.php" class="nav-link">Sign Up</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>