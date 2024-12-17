<?php

include 'database.php';

if(isset($_POST['delete_id'])){
    $id = $_POST['delete_id'];

    //$query = "DELETE FROM media_details WHERE id='$id' ";
    //$query_run = mysqli_query($db_conn, $query);

    $sql="DELETE FROM media_details WHERE media_id=$id";
    if ($db_conn->query($sql) ==true){
        echo "File successfully deleted from DB!";
    }
    else{
        echo "Error: ".$sql." Error details: ".$db_conn->error;
    }

    /*
    if($query_run){
        //$_SESSION['status'] = 'Success';
        //header('Location: delete_media.php');
        echo "Successful";
    }
    else{
        //$_SESSION['status'] = 'Failed, Data may not exist in DB.';
        //header('Location: delete_media.php');

        echo "Failed";
    }*/
}

//hanging connection closed
$db_conn->close();
?>