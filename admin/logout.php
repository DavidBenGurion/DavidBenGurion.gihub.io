<?php
session_start();
echo $_SESSION['user_email'];
unset($_SESSION['user_email']);
header("Location: index.php");
