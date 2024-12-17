<!DOCTYPE html>
<html>

<?php include("header.php"); ?>

<body>



<section id="page-header">
    <h2>Advanced Library</h2>
    <p>Have a precious time with famous books</p>


    <form action="report.php" method="POST">
			<button type="submit" name="report">Generate Report</button>
    </form>

    <!--
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

<section class="section-p1" id="books">
    <div class="book-container">
        <?php if (mysqli_num_rows($items) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($items)): ?>
                <div class="book">
                    <!--<img src="images/<?php echo $row['cover_img']; ?>" alt="cover_image" height="300px">
                    <div class="des">
                        <h5><?php echo $row['title']; ?></h5>
                        <i>by <?php echo $row['author']; ?></i><br>
                        <h4><?php echo $row['published_year']; ?> </h4>
                    </div>
                    <a href="detail.php?id=<?php echo $row['media_id']?>" id="detail">Detail</a>-

                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <h6 class="text-danger text-center mt-3">No data found for your search.</h6>
        <?php endif; ?>
    </div>
</section>-->

<!-- -->

<?php include("footer.php"); ?>

</body>
</html>