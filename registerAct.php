<?php
include('config/koneksi.php');
$nama = $_POST['nama'];
$username = $_POST['username'];
$password = $_POST['password'];
$nohp = $_POST['nohp'];

if (($nama != "") && ($username != "") && ($password != "") && ($nohp != "")) {
    $hashPass = md5($password);
    $querySel = "SELECT * FROM konsumen WHERE username='$username'";
    $result = mysqli_query($conn, $querySel);
    if ($result->num_rows > 0) {
        header("Location:register.php?fail=exists");
    } else {
        $query = mysqli_query($conn, "INSERT INTO konsumen(nama,username,password,no_hp) VALUES ('$nama','$username','$hashPass','$nohp')");
        header("Location:register.php?fail=success");
    }
} else {
    header("Location:register.php?fail=fail");
}
