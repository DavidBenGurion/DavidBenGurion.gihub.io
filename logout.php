<?php 
    session_start();

    unset($_SESSION['user_email']);
    unset($_SESSION['user_level']);

    session_destroy();

    header('location:index.php');
?>