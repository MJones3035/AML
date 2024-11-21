<?php 

    define("DB_SERVER", "localhost");
    define("DB_USERNAME", "root");
    define("DB_NAME", "aml_db");
    define("DB_PASSWORD", "");

    try {
        $db_conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    }
    catch (mysqli_sql_exception)
    {
        echo "Failed to connect to the db";
    }




?>