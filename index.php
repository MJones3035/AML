<!DOCTYPE html>
<html lang="en">

<?php

// $media_dir = "media.php";

// if (isset(($_POST['query']))){
//     $media_dir = $media_dir . "?search_query=" . $_POST['search'];
// }

?>



<body>

    <?php include("header.php"); ?>

    <main>

        <div>
            <form action="media.php" method="POST">
                <input type="search" name="query" placeholder="Search Media....">
                <button type="submit" name="search"><p class="fa fa-search">Search</p></button>
            </form>
        </div>

        <div id="carouselExampleCaptions" class="carousel slide justify-centre">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">


                <div class="carousel-item active">
                    <img src="images/old-books.jpg" class="d-block w-100" alt="old books">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>First slide</h5>
                        <p>placeholder</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="images/old-books.jpg" class="d-block w-100" alt="old books">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Second slide</h5>
                        <p>placeholder</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="images/old-books.jpg" class="d-block w-100" alt="old books">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Third slide</h5>
                        <p>placeholder</p>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

    </main>

    <?php include("footer.php") ?>

</body>

</html>