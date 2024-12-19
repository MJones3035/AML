<?php 

    if (!defined('DB_SERVER')){
        if (PHP_OS === "WINNT" or PHP_OS === "Windows" or PHP_OS === "WIN32") {
            define("DB_SERVER", "localhost");
        }
        else if (PHP_OS === "Darwin") {
            define("DB_SERVER", "127.0.0.1");
        }

        define("DB_USERNAME", "root");
        define("DB_NAME", "library");
        define("DB_PASSWORD", "");
    }

    // echo PHP_OS;


    try {
        $db_conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    }
    catch (mysqli_sql_exception)
    {
        echo "Failed to connect to the db";
    }




?>