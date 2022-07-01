<?php
include('header.php');
$nomor = mb_substr($_GET['nomor'], 1, 12, 'UTF-8');;;
$query = mysqli_query($conn, "SELECT * FROM penjualan WHERE nomor='$nomor'");
$data = mysqli_fetch_assoc($query);
?>
<link rel="stylesheet" href="selesai.css">
<main class="container">
    <h2 class="mt-3 mb-5 title-selesai">Terima kasih telah Berbelanja di website kami.</h2>
    <table class="table b-5 table-selesai">
        <tbody>
            <tr>
                <th>Nomor Transaksi</th>
                <td>: <?php echo $nomor; ?></td>
            </tr>
            <tr>
                <th>Tanggal Transaksi</th>
                <td>: <?php echo $data['tanggal']; ?></td>
            </tr>
            <tr>
                <th>Nama Konsumen</th>
                <td>: <?php echo $data['nama']; ?></td>
            </tr>
            <tr>
                <th>Nomor Telepon</th>
                <td>: <?php echo $data['nohp']; ?></td>
            </tr>
            <tr>
                <th>Alamat Konsumen</th>
                <td>: <?php echo $data['alamat']; ?></td>
            </tr>
            <tr>
                <th>Total Belanja</th>
                <td>: <?php echo "Rp " . number_format($data['total'], 2, ',', '.'); ?></td>
            </tr>
            <tr>
                <th colspan="2" style="text-align:center;">Bukti Transfer</th>
            </tr>
            <tr>
                <td colspan="2">
                    <div class="col-md-4 image-block" style="width:400px;margin:auto;">
                        <img src="images/buktiTransfer/<?= $data['bukti_transfer']; ?>" class="img-fluid">
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
    <center><a class="btn btn-success" href="index.php">Kembali ke Halaman Utama</a></center>
</main>

include('footer.php');
?>