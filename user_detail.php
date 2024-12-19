<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Item Detail</title>
<body>

	<!-- header & navigation -->
	<section id="header">
		<img src="images/logo.png" width="60px" height="50px">

		<div>
			<ul id="nav">
				<li><a href="user_index.php" class="active">Home</a></li>
				<li><a href="current_loan.php">Current Loans</a></li>
                <li><a href="admin/index.php">Reservation</a></li>
                <li><a href="favourite.php">Favourite</a></li>
                <li><a href="user_profile.php"><i class="fa-solid fa-circle-user fs-2"></i></a></li>
                <li><a href="index.php?logged_out=1"><i class="fa-solid fa-right-from-bracket fs-2"></i></a></li>
			</ul>
		</div>
	</section>
	<!-- -->

	<!-- -->
	<section id="page-header">
		<h2>Detail</h2>
		<p>Have a precious time with famous books</p>
        <form action="user_media.php" method="POST">
        	<input type="search" name="query" placeholder="Search Media...." required>
			<button type="submit" name="search"><i class="fa fa-search"></i></button>
        </form>
	</section>


	<!-- -->
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

	<!-- -->
	
	<?php include("footer.php"); ?>

</body>
</html>