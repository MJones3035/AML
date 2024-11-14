<?php 

    $db_server = "localhost";
    $db_username = "root";
    $db_name = "aml_db";
    $db_password = "";

    try {
        $db_conn = mysqli_connect($db_server, $db_username, $db_password, $db_name);
    }
    catch (mysqli_sql_exception)
    {
        echo "Failed to connect to the db";
    }




?>