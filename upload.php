<html>
<?php include("header.php"); ?>
<?php
include 'database.php';
session_start();
//define upload target on server:
$targetDir = "uploads/";

//successful upload check:
if(isset($_FILES['file']) && $_FILES['file']['error'] == 0){
    $fileName = basename($_FILES['file']['name']);
    $targetPath = $targetDir.$fileName;
    $name = $_POST['name'];
    if(isset($_POST['type'])){
        $type = $_POST['type'];
    }else {
        $type = 'file';
    }
        

    //move file to target:
    If (move_uploaded_file($_FILES['file']['tmp_name'], $targetPath)){
        //on success, write to db:
        $sql="INSERT INTO media_details (name, filepath, type) VALUES ('$name', '$$targetPath', '$type')";
        if ($db_conn->query($sql) ==true){
            echo "File successfully uploaded to DB!";
        }
        else{
            echo "Error: ".$sql." Error details: ".$db_conn->error;
        }
    }
    else{
        echo "Error moving file";
    }
}
else{
    echo "File not uploaded";
}

//hanging connection closed
$db_conn->close();
?>
<?php include("footer.php"); ?>
</html>