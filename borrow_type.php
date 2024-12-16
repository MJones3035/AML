<?php
require_once("session.php");
include("database.php");
if(isset($_GET['id'])&& isset($_GET['borrow_type']))
{
    $borrow_type = $_GET['borrow_type'];
    $media_id = $_GET['id'];
    $query = "UPDATE borrow SET borrow_type = $borrow_type WHERE media_id = $media_id ;";
    mysqli_query($db_conn, $query);
    $query1 = "UPDATE media SET stock = stock-1 WHERE media_id = $media_id ;";
	mysqli_query($db_conn, $query1);
    header("Location: user_index.php");
    exit;
}

?>