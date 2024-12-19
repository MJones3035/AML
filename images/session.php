<?php
if (!isset($_SESSION)) {
    session_start();

    if (!isset($_SESSION['user_id'])) {
        session_destroy();
        header('location: index.php?logged_out=1');
    }
}
?>