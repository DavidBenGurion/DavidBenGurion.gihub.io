<?php
include('../../config/koneksi.php');
if (isset($_POST['konf'])) {

    $nomor = $_POST['nomor'];
    $query3 = mysqli_query($conn, "UPDATE penjualan SET status_penjualan=1 WHERE nomor='$nomor'");
    header("Location: ../home.php?p=penjualan");
}
