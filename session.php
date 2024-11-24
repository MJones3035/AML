<?php
if (!isset($_SESSION)) {
    session_start();

    if (!isset($_SESSION['username'])) {
        session_destroy();
        header('location: index.php?loggedout=1');
    }
}
?>