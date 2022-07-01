<?php include('header.php'); ?>
<link rel="stylesheet" href="keranjang.css">
<main class="container keranjang-box">
    <style>
        body {
            background-color: black;
        }
    </style>
    <h2 class="mt-3 mb-5 title-cek">Keranjang Belanja</h2>
    <table class="table table-keranjang  table-hover">
        <thead>
            <tr>
                <th>No.</th>
                <th>Foto</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Sub Total</th>
                <th>Hapus</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $nomor = 1;
            $total = 0;
            $idUser = getId($conn);

            $query = mysqli_query($conn, "SELECT * FROM keranjang JOIN produk ON keranjang.kode_produk = produk.kode_produk WHERE id_user ='$idUser' ");
            while ($data = mysqli_fetch_array($query)) {
            ?>
                <?php if ($nomor % 2 === 0) { ?>
                    <tr class="row-gl">
                    <?php } else { ?>
                    <tr class="row-gn">
                    <?php } ?>
                    <td><?php echo $nomor; ?></td>
                    <td><img width="50px" src="images/<?php echo $data['foto']; ?>"></td>
                    <td><?php echo $data['nama_produk']; ?></td>
                    <?php $hasil_rupiah = "Rp " . number_format($data['harga'], 2, ',', '.'); ?>
                    <td><?php echo $hasil_rupiah; ?></td>
                    <td>
                        <div class="input-group">
                            <button type="button" class="btn btn-outline-secondary" onclick="updateCart(<?php echo $data['kode_keranjang']; ?>,'kurang')">-</button>
                            <input type="text" class="form-control text-center" readonly size=1 id="jumlah" value="<?php echo $data['jumlah']; ?>">
                            <button type="button" class="btn btn-outline-secondary" onclick="updateCart(<?php echo $data['kode_keranjang']; ?>,'tambah')">+</button>
                        </div>
                    </td>
                    <?php $hasil_rupiahSub = "Rp " . number_format($data['subtotal'], 2, ',', '.'); ?>
                    <td><?php echo $hasil_rupiahSub; ?></td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm" onclick="hapusCart(<?php echo $data['kode_keranjang']; ?>)">Hapus</button>
                    </td>
                    </tr>
                <?php
                $nomor++;
                $total += $data['subtotal'];
            }
                ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="5" class="text-center" style="border-left:1px solid black">Total Belanja</th>
                <?php $hasil_total = "Rp " . number_format($total, 2, ',', '.'); ?>
                <th><?php echo $hasil_total; ?></th>
                <th></th>
            </tr>
        </tfoot>
    </table>
    <?php if ($nomor > 1) : ?>
        <a class="btn btn-success" href="checkout.php">Check Out</a>
    <?php endif; ?>
</main>
<?php
function getId($conn)
{
    $username = $_SESSION['username'];
    $sql = "SELECT * FROM konsumen WHERE username='$username'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row['id_user'];
}
?>
<?php include('footer.php'); ?>