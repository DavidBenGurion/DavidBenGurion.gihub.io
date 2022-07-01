<h1 class="h2 mb-3">Data Penjualan</h1>
<table class="table table-hover table-bordered ">
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
    include('../config/koneksi.php');
    $query = mysqli_query($conn, "SELECT * FROM penjualan ORDER BY tanggal DESC");
    while ($data = mysqli_fetch_array($query)) {
    ?>
      <tr>
        <td><?php echo $data['nomor']; ?></td>
        <td><?php echo $data['tanggal']; ?></td>
        <td><?php echo $data['nama']; ?></td>
        <td><?php echo $data['nohp']; ?></td>
        <?php $hasil_rupiah = "Rp " . number_format($data['total'], 2, ',', '.'); ?>
        <td><?php echo $hasil_rupiah; ?></td>
        <td>
          <button type="button" class="btn btn-outline-success btn-sm" onclick="confView('<?php echo $data['nomor']; ?>')">Konfirmasi Transaksi</button>
          <button type="button" class="btn btn-outline-info btn-sm" onclick="modalView('<?php echo $data['nomor']; ?>')">Detail Transaksi</button>
          <a href="page/buktiTransaksi.php?foto=<?php echo $data['bukti_transfer']; ?>" target="_blank" class="btn btn-outline-primary btn-sm">Bukti Transaksi</a>
        </td>
      </tr>
    <?php
    }
    ?>
  </tbody>
</table>

<div class="modal fade" id="produkModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detail Transaksi</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="preview"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="konfModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detail Transaksi</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="previewKonf">
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {

  })

  function confView(id) {
    $.ajax({
      url: 'page/konfirmasi-penjualan.php',
      type: 'GET',
      data: 'nomor=' + id,
      success: function(result) {
        $('#previewKonf').html(result);
        var konfModal = new bootstrap.Modal(document.getElementById('konfModal'));
        konfModal.show();
      }
    });
  }

  function modalView(id) {
    $.ajax({
      url: 'page/detail-penjualan.php',
      type: 'GET',
      data: 'nomor=' + id,
      success: function(result) {
        $('#preview').html(result);
        var myModal = new bootstrap.Modal(document.getElementById('produkModal'));
        myModal.show();
      }
    });
  }
</script>