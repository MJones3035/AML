<?php
require_once("session.php");
include("database.php");
$user = $_SESSION['user_id'];

if(isset($_POST['id']))
{
    $media_id = $_POST['id'];
    $query = "INSERT INTO `borrow` (`media_id`, `user_id`, `borrowed_date`, `due_date`) VALUES ($media_id, $user , NOW() , NOW()+ INTERVAL 14 DAY);";
    mysqli_query($db_conn, $query);
}

?>


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

	<div class="borrow_type">
	<h1>Choose Your Borrow Type</h1>
	<a href="borrow_type.php?id=<?php echo $media_id; ?>&borrow_type='delivery'"><i class="fa-solid fa-circle-dot"></i>Delivery</a>
	<br>
	<a href="borrow_type.php?id=<?php echo $media_id; ?>&borrow_type='library_pickup'"><i class="fa-solid fa-circle-dot"></i>Library_pick_up</a>
	</div>
	


	<?php include("footer.php"); ?>

    </body>
</html>