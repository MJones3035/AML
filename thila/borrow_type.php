<?php

include("config.php");
if(isset($_POST['borrow_type']))
{
    $media_id = $_POST['id'];

    $query = "INSERT INTO `borrow` (`media_id`, `user_id`, `borrowed_date`, `due_date`) VALUES ($media_id, '28', NOW() , NOW()+ INTERVAL 14 DAY);";
    mysqli_query($conn, $query);

}

?>