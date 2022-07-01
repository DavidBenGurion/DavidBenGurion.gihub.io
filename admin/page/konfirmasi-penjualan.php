<?php
include('../../config/koneksi.php');
$nomor = $_GET['nomor'];
$query = mysqli_query($conn, "SELECT * FROM penjualan WHERE nomor = '" . $_GET['nomor'] . "'");
$data = mysqli_fetch_assoc($query);
if ($data['status_penjualan'] == 0) {
?>
    <form action="page/penjualanAct.php" method="post">
        <input type="hidden" name="nomor" value="<?= $nomor; ?>">
        <table style="width:100%">
            <tr>
                <td align="center">
                    <h5>Apakah anda ingin mengkonfirmasi pesanan dengan Nomor:</h5>
                </td>
            </tr>
            <tr>
                <td align="center">
                    <h5 style="color:red;">"<?= $data['nomor']; ?>"</h5>
                </td>
            </tr>
            <tr>
                <td align="center">
                    <input type="submit" name="konf" value="konfirmasi" class="btn btn-primary">
                </td>
            </tr>
        </table>

    </form>

<?php
} else { ?>
    <form action="page/batal-konfirmasi.php" method="post">
        <table style="width:100%">
            <input type="hidden" name="nomor" value="<?= $nomor; ?>">
            <table style="width:100%">
                <tr>
                    <td align="center">
                        <h5>Pesanan " <?= $data['nomor']; ?> " sudah dikonfirmasi</h5>
                    </td>
                </tr>
                <tr>
                    <td align="center">
                        <input type="submit" name="batal" value="BatalKonfirmasi" class="btn btn-danger">
                    </td>
                </tr>
            </table>
    </form>
<?php }

?>