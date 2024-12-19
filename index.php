<?php

if (isset($_GET['logged_out'])) {
	session_start();
	unset($_SESSION['user_id']);
	session_destroy();
}

?>


<!DOCTYPE html>
<html>
<?php include("header.php"); ?>

<body>

	<div class="d-flex pb-5">
		<section id="page-header">
			<h2>Advanced Media Library</h2>
			<form action="media.php" method="POST">
				<input type="search" name="query" placeholder="Search Media...." required>
				<button type="submit" name="search"><i class="fa fa-search"></i></button>
			</form>

		</section>
	</div>

	<?php include("footer.php"); ?>

</body>

</html>