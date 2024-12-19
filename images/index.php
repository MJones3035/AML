<?php 

if (isset($_GET['logged_out'])) {
    session_start();
    unset($_SESSION['user_id']);
    session_destroy();
}

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Advanced Media Library</title>
</head>
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
		
	<!-- intro section -->
	<section id="page-header">
		<h2>Advanced Media Library</h2>
		<p>Have a precious time with famous books</p>
		<form action="media.php" method="POST">
        	<input type="search" name="query" placeholder="Search Media...." required>
			<button type="submit" name="search"><i class="fa fa-search"></i></button>
    	</form>
		
	</section>

    <?php include("footer.php"); ?>

</body>
</html>