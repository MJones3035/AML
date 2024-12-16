<!DOCTYPE html>
<html>

<?php include("header.php"); ?>

    
<body>


	<section id="page-header">
		<h2>Media Details</h2>
        <form action="media.php" method="POST">
        	<input type="search" name="query" placeholder="Search Media...." required>
			<button type="submit" name="search"><i class="fa fa-search"></i></button>
        </form>
	</section>


	<?php
		include("database.php");
		$id=$_GET['id'];
		$item=mysqli_query($db_conn,"SELECT * FROM media WHERE media_id=$id");
		$row=mysqli_fetch_assoc($item);
	?> 
	
	<section class="section-p1">
		<div id="detail-container">
			<div id="dimg">
				<img src="images/<?php echo $row['cover_img']?>"> 
			</div>
			
			<div id="detail-content">
				<p id="title"><?php echo $row['title']?></p>
				<p id="author">by <?php echo $row['author']?></p>
				<p id="published_year"><?php echo $row['published_year']?></p>
				<p id="description"><?php echo $row['description']?></p>

                <?php if ($row['stock'] < 2):?>
                            <h3>Unavailable</h3>
                        <?php else: ?>
                            <h3>Available</h3>
                <?php endif;?>
			</div>


		</div>
	</section>


	<?php include("footer.php"); ?>

</body>
</html>