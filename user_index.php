<?php
require_once("session.php");
?>

<!DOCTYPE html>
<html>
<?php include("user_header.php"); ?>

<body>

	<div class="d-flex pb-5">
		<section id="page-header">
			<h2>Advanced Media Library</h2>
			<form action="user_media.php" method="POST">
				<input type="search" name="query" placeholder="Search Media...." required>
				<button type="submit" name="search"><i class="fa fa-search"></i></button>
			</form>

		</section>
	</div>

	<?php include("footer.php"); ?>

</body>

</html>