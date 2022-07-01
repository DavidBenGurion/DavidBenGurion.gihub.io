<?php
include('config/koneksi.php');
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $sql = "SELECT * FROM konsumen WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        session_start();
        $_SESSION['username'] = $row['username'];
        header("Location: index.php");
    } else {
        header("Location:index.php?login=fail");
    }
} else {
    header("Location:index.php?login=fail");
}
