<?php include('header.php'); ?>
<link rel="stylesheet" href="daftarTransaksi.css">
<main class="container-fluid box-content">
    <style>
        body {
            background-color: black;
        }
    </style>
    <h2>Daftar Transaksi</h2>
    <table class="table table-hover  table-df-trans">
        <thead>
            <tr>
                <th>Nomor Transaksi</th>
                <th>Tanggal</th>
                <th>Nama Konsumen</th>
                <th>No. Telp</th>
                <th>Total</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $idUser = getId($conn);
            $query = mysqli_query($conn, "SELECT * FROM penjualan WHERE id_user ='$idUser' ");
            while ($data = mysqli_fetch_array($query)) { ?>
                <tr>
                    <td><?= $data['nomor']; ?></td>
                    <td><?= $data['tanggal']; ?></td>
                    <td><?= $data['nama']; ?></td>
                    <td><?= $data['nohp']; ?></td>
                    <?php $hasil_rupiah = "Rp " . number_format($data['total'], 2, ',', '.'); ?>
                    <td><?= $hasil_rupiah; ?></td>
                    <td>
                        <button type="button" class="btn btn-outline-success btn-sm" onclick="statusView('<?php echo $data['nomor']; ?>')">Status</button>
                    </td>
                </tr>
            <?php }
            ?>
        </tbody>
    </table>
    <div class="modal fade" id="konfModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Transaksi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="statusPreview">
                </div>
            </div>
        </div>
    </div>
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
    function statusView(id) {
        $.ajax({
            url: 'daftarStatus.php',
            type: 'GET',
            data: 'nomor=' + id,
            success: function(result) {
                $('#statusPreview').html(result);
                var myModal = new bootstrap.Modal(document.getElementById('konfModal'));
                myModal.show();
            }
        })
    }
</script>