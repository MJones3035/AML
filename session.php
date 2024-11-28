<?php
if (!isset($_SESSION)) {
    session_start();

    if (!isset($_SESSION['userID'])) {
        session_destroy();
        header('location: index.php?loggedOut=1');
    }
}
?>