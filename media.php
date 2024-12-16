<?php
    session_start();
    include("database.php");

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

    $items = mysqli_query($db_conn, $items_query);

    $types = mysqli_query($db_conn,"SELECT * FROM media_type");

?>



<!DOCTYPE html>
<html>

<?php include("header.php"); ?>

<body>



<section id="page-header">
    <h2>Advanced Library</h2>
    <p>Have a precious time with famous books</p>


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
                    <a href="detail.php?id=<?php echo $row['media_id']?>" id="detail">Detail</a>

                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <h6 class="text-danger text-center mt-3">No data found for your search.</h6>
        <?php endif; ?>
    </div>
</section>

<!-- -->

<?php include("footer.php"); ?>

</body>
</html>