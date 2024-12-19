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

<?php include("user_header.php"); ?>

<body>


	<section id="page-header">
		<h2>Borrow</h2>
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