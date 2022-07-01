<?php
include('config/koneksi.php');
$nomor = $_GET['nomor'];
$query = mysqli_query($conn, "SELECT * FROM penjualan WHERE nomor = '" . $_GET['nomor'] . "'");
$data = mysqli_fetch_assoc($query);
if ($data['status_penjualan'] == 0) { ?>
    <h5 style="width:100%;text-align:center;color:#F32424;">Pesanan anda belum dikonfirmasi oleh pihak Vape Store</h5>
<?php } else { ?>
    <h5 style="width:100%;text-align:center;color:#1363DF;">Pesanan anda sudah dikonfirmasi oleh pihak Vape Store</h5>
<?php }
