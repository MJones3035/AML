<html>
<?php include("header.php"); ?>
    <body>
    <?php
    session_start();
    include("database.php");

    $getData = "SELECT * FROM media_details";

    echo '<table border="0" cellspacing="2" cellpadding="2"> 
      <tr> 
          <td> <font face="Arial">Media ID</font> </td> 
          <td> <font face="Arial">Media Name</font> </td> 
          <td> <font face="Arial">Filepath</font> </td> 
          <td> <font face="Arial">Type</font> </td>  
      </tr>';

    if($result = $db_conn->query($getData)){
        
        while ($row = $result->fetch_assoc()) {
            $media_id = $row['media_id'];
            $name = $row['name'];
            $filepath = $row['filepath'];
            $type = $row['type'];

            echo '<tr> 
            <td>'.$media_id.'</td> 
            <td>'.$name.'</td> 
            <td>'.$filepath.'</td> 
            <td>'.$type.'</td> 
        </tr>';
        }
        $result->free();
    };
?>

    </body>
    <?php include("footer.php"); ?>
</html>

