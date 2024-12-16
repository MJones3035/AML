<?php
//require_once("database.php");
require_once("session.php");
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

           <!-- residual merge conflict, for reference
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="catalogue.php">Catalogue</a>
                            <a class="nav-link" href="add_media.php">Upload Media</a>
                            <a class="nav-link" href="delete_media.php">Delete Media</a>
                    </ul>
                </div>
          -->
            <h2 class="nv-title mb-0">Advanced Media Library</h2>

            <div class="ms-auto">
                <ul id="nav" class="navbar-nav flex-row">
                    <li class="nav-item"><a href="user_index.php" class="nav-link">Home</a></li>
                    <li class="nav-item"><a href="current_loan.php">Current Loans</a></li>
                    <li class="nav-item"><a href="">Reservation</a></li>
                    <li class="nav-item"><a href="favourite.php">Favourite</a></li>
                    <li class="nav-item"><a href="user_profile.php"><i class="fa-solid fa-circle-user fs-2"></i></a></li>
                    <li class="nav-item"><a href="index.php?logged_out=1"><i class="fa-solid fa-right-from-bracket fs-2"></i></a></li>
                </ul>
            </div>
        </div>
</header>