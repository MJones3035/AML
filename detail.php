<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Advanced Media Library</title>
    
<body>

	<!-- header & navigation -->
	<section id="header">
		<img src="images/logo.png" width="60px" height="50px">

		<div>
			<ul id="nav">
				<li><a href="index.php" class="active">Home</a></li>
				<li><a href="login.php">Login</a></li>
                <li><a href="sign_up.php">Register</a></li>
			</ul>
		</div>
	</section>
	<!-- -->

	<!-- -->
	<section id="page-header">
		<h2>Detail</h2>
		<p>Have a precious time with famous books</p>
        <form action="media.php" method="POST">
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
                            <h3>Unavailable</h3>
                        <?php else: ?>
                            <h3>Available</h3>
                <?php endif;?>
			</div>


		</div>
	</section>

	<!-- -->
	<?php include("footer.php"); ?>

</body>
</html>