<?php include('header.php'); ?>
<link rel="stylesheet" href="checkout.css">
<main class="container">
    <h2 class="mt-3 mb-5 title-cek">Check Out Keranjang Belanja</h2>
    <table class="table table-keranjang table-hover">
        <style>
            body {
                background-color: black;
            }

            .table-keranjang {
                border-color: white;
            }
        </style>
        <thead>
            <tr>
                <th>No.</th>
                <th>Foto</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Sub Total</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $idUser = getId($conn);
            $nomor = 1;
            $total = 0;
            $idUser = getId($conn);
            $query = mysqli_query($conn, "SELECT * FROM keranjang JOIN produk ON keranjang.kode_produk = produk.kode_produk WHERE id_user = '$idUser'");
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
                    <td><?php echo $data['jumlah']; ?></td>
                    <?php $hasil_rupiahSub = "Rp " . number_format($data['subtotal'], 2, ',', '.'); ?>
                    <td><?php echo $hasil_rupiahSub; ?></td>
                    </tr>
                <?php
                $nomor++;
                $total += $data['subtotal'];
            }
                ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="5" class="text-center">Total Belanja</th>
                <?php $hasil_Total = "Rp " . number_format($total, 2, ',', '.'); ?>
                <th id="total-belanja2"><?php echo $hasil_Total; ?></th>
            </tr>
            <input type="hidden" id="total-belanja" value=<?= $total; ?>>
        </tfoot>
    </table>

    <form action="checkoutAct.php" method="POST" enctype="multipart/form-data">
        <h3 class="mb-3 title-cek">Informasi Pengiriman Produk</h3>
        <div class="form-floating mb-3">
            <textarea name="alamat" class="form-control" id="alamat" placeholder="Isikan Alamat Lengkap" required></textarea>
            <label for="alamat">Alamat</label>
        </div>
        <div class="box-foto" style="margin-bottom:10px;">
            <label for="foto-add" class="form-label" style="color:white;">Foto</label>
            <input type="file" accept="image/*" class="form-control" id="foto-add" name="foto-add">
        </div>
        <div class="row">
            <div class="mb-3 col-6">
                <select name="provinsi" class="form-select form-select-lg" id="provinsi" required>
                    <option selected>Pilih Provinsi</option>
                </select>
            </div>
            <div class="mb-3 col-6">
                <select name="kota" class="form-select form-select-lg" id="kota" required>
                    <option selected>Pilih Kabupaten/Kota</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="mb-3 col-6">
                <select name="kurir" class="form-select form-select-lg" id="kurir" required>
                    <option selected>Pilih Kurir</option>
                    <option value="jne">JNE</option>
                    <option value="tiki">TIKI</option>
                    <option value="pos">POS Indonesia</option>
                </select>
            </div>
            <div class="mb-3 col-6">
                <select name="paket" class="form-select form-select-lg" id="paket" required>
                    <option selected>Pilih Paket</option>
                </select>
            </div>
        </div>
        <input type="hidden" name="totalAct" id="totalAct" value=0>
        <div class="form-floating mb-3">
            <input type="text" name="total" class="form-control" id="total" readonly value="0" placeholder="Total Belanja + Ongkir" required>
            <label for="nama">Total Belanja + Ongkir</label>
        </div>
        <a class="btn btn-success" href="keranjang.php">Kembali ke Keranjang Belanja</a>
        <button type="submit" class="btn btn-primary">Selesai Belanja</button>
    </form>
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
</main>
<script>
    $(document).ready(function() {
        $.ajax({
            url: 'rajaongkir/provinsi.php',
            type: 'GET',
            start: $('#provinsi').html('<option>Loading Provinsi...</option>'),
            success: function(result) {
                var hasil = JSON.parse(result);
                var provinsi = hasil.rajaongkir.results;
                var item = "<option selected>Pilih Provinsi</option>";
                $.each(provinsi, function(index, value) {
                    item += "<option value='" + this.province_id + "'>" + this.province + "</option>";
                });
                $('#provinsi').html(item);
                $('#nama').focus();
            }
        });
    });

    $('#provinsi').change(function() {
        var kode = $(this).val();
        $.ajax({
            url: 'rajaongkir/kota.php',
            type: 'GET',
            data: 'provinsi=' + kode,
            start: $('#kota').html('<option>Loading Kota...</option>'),
            success: function(result) {
                var hasil = JSON.parse(result);
                var kota = hasil.rajaongkir.results;
                var item = "<option selected>Pilih Kabupaten/Kota</option>";
                $.each(kota, function(index, value) {
                    item += "<option value='" + this.city_id + "'>" + this.type + " " + this.city_name + "</option>";
                });
                $('#kota').html(item);
                $('#kota').focus();
            }
        });
    });

    $('#kota').change(function() {
        $('#kurir').focus();
    });

    $('#kurir').change(function() {
        var kota = $('#kota').val();
        var kurir = $('#kurir').val();
        $.ajax({
            url: 'rajaongkir/ongkir.php',
            type: 'GET',
            data: 'kota_tujuan=' + kota + '&kurir=' + kurir,
            start: $('#paket').html('<option>Loading Paket...</option>'),
            success: function(result) {
                var hasil = JSON.parse(result);
                var paket = hasil.rajaongkir.results[0].costs;
                var item = "<option selected>Pilih Paket</option>";
                $.each(paket, function(index, value) {
                    item += "<option value='" + this.cost[0].value + "'>" +
                        this.service + " (" + this.description + "), Estimasi Sampai : " +
                        this.cost[0].etd + " hari</option>";
                });
                $('#paket').html(item);
                $('#total').focus();
            }
        });
    });

    function convertToRupiah2(angka) {
        var rupiah = "";
        var angka = angka;
        var angkarev = angka.toString().split('').reverse().join('');
        for (var i = 0; i < angkarev.length; i++)
            if (i % 3 == 0) rupiah += angkarev.substr(i, 3) + ',';
        return rupiah.split('', rupiah.length - 1).reverse().join('');
    }
    $('#paket').change(function() {
        var ongkir = parseInt($(this).val());
        var total = parseInt($('#total-belanja').val());
        var grandtotal = ongkir + total;
        $('#total').val(convertToRupiah2(grandtotal));
        $('#totalAct').val(grandtotal);
    });
</script>
<?php include('footer.php'); ?>