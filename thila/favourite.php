<?php

include("config.php");
$query = "SELECT * FROM media WHERE favourite = 'fav'";
$fav_result = mysqli_query($conn, $query);

?>



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
				<li><a href="index.php" >Home</a></li>
				<li><a href="admin/index.php">Current Loans</a></li>
                <li><a href="admin/index.php">Reservation</a></li>
                <li><a href="favourite.php" class="active">Favourite</a></li>
                <li><a href="admin/index.php"><i class="fa-solid fa-circle-user fs-2"></i></a></li>
                <li><a href="admin/index.php"><i class="fa-solid fa-right-from-bracket fs-2"></i></a></li>
			</ul>
		</div>
	</section>
	<!-- -->
		
	<!-- intro section -->
	<section id="page-header">
		<h2>Favourite media list</h2>
		<p>Have a precious time with famous books</p>
	</section>


    <div class="table mt-3">
    <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Cover Image</th>
                    <th>Tile</th>
                    <th>Author</th>
                    <th>Published Year</th>
                    <th>Status</th>
                    <th>Remove</th>
                </tr>
            </thead>
                    <?php
                        if(mysqli_num_rows($fav_result)>0)
                        {
                            while($row = mysqli_fetch_assoc($fav_result))
                            {
                                $cover_img = $row['cover_img'];
                                $title = $row['title'];
                                $author = $row['author'];
                                $published_year = $row['published_year'];
                                $stock = $row['stock'];
                            ?>
    
                            <tr>
                                <td><?php !is_dir("images/{$cover_img}") and file_exists("images/{$cover_img}")?>
                                <img src="images/<?php echo $cover_img;?>" alt="image" height="200px"></td>
                                <td><?php echo $title;?></td>
                                <td><?php echo $author;?></td>
                                <td><?php echo $published_year;?></td>
                                <td> <?php if ($row['stock'] < 2):?>
                                    <form action="reserve.php" method="post">
                                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                        <button type="submit">Reserve</button>
                                    </form>
                                <?php else: ?>
                                    <form action="borrow.php" method="post">
                                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                        <button type="submit">Borrow</button>
                                    </form>
                                <?php endif;?>
                                </td>
                                <td> <a href="remove_fav.php?id=<?php echo $row['media_id']; ?>&favourite='unfav'"><i class="fa-solid fa-trash fa-lg"></i></a></td>
                            </tr>
    
                            <?php
                            }
                        }
                        else
                        {
                            echo"<h6 class='text-danger text-center mt-3'> NO data found </h6>";
                        }

                        
                    ?>
            <tbody>

            </tbody>

        </table>

</body>
</html>