<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Book Store</title>
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">	
</head>
<body>
	
	<!-- header & navigation -->
	<section id="header">
		<img src="photo/logo.png" width="60px" height="50px">

		<div>
			<ul id="nav">
				<li><a href="index.php" class="active">Home</a></li>
				<li><a href="admin/index.php">Current Loans</a></li>
                <li><a href="admin/index.php">Reservation</a></li>
                <li><a href="favourite.php">Favourite</a></li>
                <li><a href="admin/index.php"><i class="fa-solid fa-circle-user fs-2"></i></a></li>
                <li><a href="admin/index.php"><i class="fa-solid fa-right-from-bracket fs-2"></i></a></li>
			</ul>
		</div>
	</section>
	<!-- -->
		
	<!-- intro section -->
	<section id="page-header">
		<h2>Advanced Library</h2>
		<p>Have a precious time with famous books</p>
		<form action="media.php" method="POST">
        	<input type="search" name="query" placeholder="Search Media...." required>
			<button type="submit" name="search"><i class="fa fa-search"></i></button>
    	</form>
		
	</section>

</body>
</html>