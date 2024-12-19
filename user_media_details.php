<!DOCTYPE html>
<html>

<?php include("user_header.php"); ?>

<body>


	<section id="page-header">
		<h2>Media Details</h2>
        <form action="user_media.php" method="POST">
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
                            <form action="reserve.php" method="post">
                                <input type="hidden" name="id" value="<?php echo $row['media_id']; ?>">
                                <button type="submit">Reserve</button>
                            </form>
                        <?php else: ?>
                            <form action="borrow.php" method="post">
                                <input type="hidden" name="id" value="<?php echo $row['media_id']; ?>">
                                <button type="submit">Borrow</button>
                            </form>
                <?php endif;?>
			</div>


		</div>
	</section>

	
	<?php include("footer.php"); ?>

</body>
</html>