<table class="table table-hover table-bordered">
    <thead>
        <tr>
            <th>Kode Produk</th>
            <th>Nama Produk</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>SubTotal</th>
        </tr>
    </thead>
    <tbody>
    <?php 
        include('../../config/koneksi.php');
        $query = mysqli_query($conn, "SELECT * FROM penjualan_detail ".
                    "JOIN produk ON penjualan_detail.kode_produk = produk.kode_produk ".
                    "WHERE nomor = '".$_GET['nomor']."'");
        while($data = mysqli_fetch_array($query)){
    ?>
        <tr>
            <td><?php echo $data['kode_produk']; ?></td>
            <td><?php echo $data['nama_produk']; ?></td>
            <td><?php echo $data['harga']; ?></td>
            <td><?php echo $data['jumlah']; ?></td>
            <td><?php echo $data['subtotal']; ?></td>
        </tr>
    <?php 
        }
    ?>
    </tbody>
</table>