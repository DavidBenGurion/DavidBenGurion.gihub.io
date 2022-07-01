<?php
include('../../config/koneksi.php');
if (isset($_POST['batal'])) {
    $nomor = $_POST['nomor'];
    $query3 = mysqli_query($conn, "UPDATE penjualan SET status_penjualan=0 WHERE nomor='$nomor'");
    header("Location: ../home.php?p=penjualan");
}
