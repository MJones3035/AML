<?php 
require_once("database.php");
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

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">

                <a class="navbar-brand me-3" href="user_index.php">Advanced Media Library</a>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="catalogue.php">Catalogue</a>
                    </ul>
                </div>

                <div class="d-flex ms-auto">
                    <a href="user_profile.php" class="btn btn-outline-light me-2">Profile</a>
                    <a href="index.php?logged_out=1" class="btn btn-primary">Logout</a>
                </div>
            </div>
        </nav>
    </header>

