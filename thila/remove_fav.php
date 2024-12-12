<?php
    include("config.php");
    if(isset($_GET['id'])&& isset($_GET['favourite']))
    {
        $media_id = $_GET['id'];
        $fav = $_GET['favourite'];

        $query = "UPDATE media SET favourite = $fav WHERE media_id = $media_id";
        mysqli_query($conn, $query);

        header("Location: favourite.php");
        exit;
    }

?>