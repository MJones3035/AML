<?php
require_once("session.php");
include("database.php");
$query = "SELECT * FROM media WHERE favourite = 'fav'";
$fav_result = mysqli_query($db_conn, $query);

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
				<li><a href="user_index.php" >Home</a></li>
				<li><a href="current_loan.php">Current Loans</a></li>
                <li><a href="admin/index.php">Reservation</a></li>
                <li><a href="favourite.php" class="active">Favourite</a></li>
                <li><a href="user_profile.php"><i class="fa-solid fa-circle-user fs-2"></i></a></li>
                <li><a href="index.php?logged_out=1"><i class="fa-solid fa-right-from-bracket fs-2"></i></a></li>
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
                                        <input type="hidden" name="id" value="<?php echo $row['media_id']; ?>">
                                        <button type="submit">Reserve</button>
                                    </form>
                                <?php else: ?>
                                    <form action="borrow.php" method="post">
                                        <input type="hidden" name="id" value="<?php echo $row['media_id']; ?>">
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

        <?php include("footer.php"); ?>

</body>
</html>