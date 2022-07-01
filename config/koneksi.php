<?php
$data = 'tokoVape';
$host = 'localhost';
$user = 'root';
$pass = '';

$conn = mysqli_connect($host, $user, $pass, $data);

if (!$conn) {
    echo mysqli_error($conn);
    exit();
}
