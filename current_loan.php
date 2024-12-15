<?php
require_once("session.php");
include("database.php");
$query = "SELECT media.cover_img, media.title, media.author, media.published_year, borrow.borrowed_date, borrow.due_date, media.media_id, media.favourite FROM borrow INNER JOIN media ON borrow.media_id = media.media_id order by borrow.borrowed_date DESC; ";
$result = mysqli_query($db_conn, $query);

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
		<img src="photo/logo.png" width="60px" height="50px">

		<div>
			<ul id="nav">
				<li><a href="user_index.php" >Home</a></li>
				<li><a href="current_loan.php" class="active">Current Loans</a></li>
                <li><a href="admin/index.php">Reservation</a></li>
                <li><a href="favourite.php">Favourite</a></li>
                <li><a href="user_profile.php"><i class="fa-solid fa-circle-user fs-2"></i></a></li>
                <li><a href="index.php?logged_out=1"><i class="fa-solid fa-right-from-bracket fs-2"></i></a></li>
			</ul>
		</div>
	</section>
	<!-- -->
		
	<!-- intro section -->
	<section id="page-header">
		<h2>Borrowed media list</h2>
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
                    <th>Borrowed date</th>
                    <th>Due date</th>
                    <th>Favourite</th>
                    <th>Renew</th>
                </tr>
            </thead>
                    <?php
                        if(mysqli_num_rows($result)>0)
                        {
                            while($row = mysqli_fetch_assoc($result))
                            {
                                $cover_img = $row['cover_img'];
                                $title = $row['title'];
                                $author = $row['author'];
                                $published_year = $row['published_year'];
                                $borrowed_date = $row['borrowed_date'];
                                $due_date=$row['due_date'];
                            ?>
    
                            <tr>
                                <td><?php !is_dir("images/{$cover_img}") and file_exists("images/{$cover_img}")?>
                                <img src="images/<?php echo $cover_img;?>" alt="image" height="200px"></td>
                                <td><?php echo $title;?></td>
                                <td><?php echo $author;?></td>
                                <td><?php echo $published_year;?></td>
                                <td><?php echo $borrowed_date;?></td>
                                <td><?php echo $due_date;?></td>

                                <td> <?php if ($row['favourite']== 'fav'):?>
                                        <a href="set_fav_borrow.php?id=<?php echo $row['media_id']; ?>&favourite='unfav'"><i class="fa-solid fa-star"></i></a>
                                    <?php else: ?>
                                        <a href="set_fav_borrow.php?id=<?php echo $row['media_id']; ?>&favourite='fav'"><i class="fa-regular fa-star"></i></a>    
                                    <?php endif;?>
                                </td>
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