<?php
    session_start();
    include("config.php");

    if(isset($_POST['search']))
    {
        $getvalue = $_POST['query'];
        $_SESSION['search_query'] = $getvalue;
    }

    $media_type_condition = '';
    if(isset($_GET['type']))
    {
        $type_id = $_GET['type'];
        $media_type_condition = "AND media_type_id = $type_id ";
    }
    
    $search_query = $_SESSION['search_query'];
    $items_query = "SELECT * FROM media WHERE (title LIKE '$search_query%' OR author LIKE '$search_query%') $media_type_condition ";

    $items = mysqli_query($conn, $items_query);

    $types = mysqli_query($conn,"SELECT * FROM media_type");

?>



<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Book Store</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">	
</head>
<body>

<!-- header & navigation -->
<section id="header">
    <img src="photo/logo.png" width="60px" height="50px">

    <div>
        <ul id="nav">
            <li><a href="index.php" class="active">Home</a></li>
            <li><a href="admin/index.php">Current Loans</a></li>
            <li><a href="admin/index.php">Reservation</a></li>
            <li><a href="favourite.php">Favourite</a></li>
            <li><a href="admin/index.php"><i class="fa-solid fa-circle-user fs-2"></i></a></li>
            <li><a href="admin/index.php"><i class="fa-solid fa-right-from-bracket fs-2"></i></a></li>
        </ul>
    </div>
</section>

<!-- intro section -->
<section id="page-header">
    <h2>Advanced Library</h2>
    <p>Have a precious time with famous books</p>

    <!-- Search form -->
    <form action="media.php" method="POST">
        	<input type="search" name="query" placeholder="Search Media...." required>
			<button type="submit" name="search"><i class="fa fa-search"></i></button>
    </form>

    <div class="cats">
        <ul>
            <?php while ($row = mysqli_fetch_assoc($types)) { ?>
                <li>
                    <a href="media.php?type=<?php echo $row['media_type_id']; ?>&search=<?php echo $_SESSION['search_query']; ?>">
                        <?php echo $row['media_type']; ?>
                    </a>
                </li>
            <?php } ?>
        </ul>
    </div>

</section>

<!-- -->

<section class="section-p1" id="books">
    <div class="book-container">
        <?php if (mysqli_num_rows($items) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($items)): ?>
                <div class="book">
                    <img src="images/<?php echo $row['cover_img']; ?>" alt="cover_image" height="300px">

                    <div class="des">
                        <h5><?php echo $row['title']; ?></h5>
                        <i>by <?php echo $row['author']; ?></i><br>
                        <h4><?php echo $row['published_year']; ?> </h4>
                    </div>

                    <div class="fav">
                        <?php if ($row['favourite']== 'fav'):?>
                            <a href="set_fav.php?id=<?php echo $row['media_id']; ?>&favourite='unfav'"><i class="fa-solid fa-star"></i></a>
                        <?php else: ?>
                            <a href="set_fav.php?id=<?php echo $row['media_id']; ?>&favourite='fav'"><i class="fa-regular fa-star"></i></a>    
                        <?php endif;?>
                    </div>

                    <a href="detail.php?id=<?php echo $row['media_id']?>" id="detail">Detail</a>

                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <h6 class="text-danger text-center mt-3">No data found for your search.</h6>
        <?php endif; ?>
    </div>
</section>

<!-- -->

<div class="footer">
    &copy;<?php echo date("Y"); ?>. All rights reserved
</div>

</body>
</html>