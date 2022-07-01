<h1 class="h2 mb-3">Data Produk</h1>
<button type="button" class="btn btn-outline-success mb-3" data-bs-toggle="modal" data-bs-target="#produkModal">Tambah Data</button>
<table class="table table-hover table-bordered ">
  <thead>
    <tr>
      <th>Nama Produk</th>
      <th>Kategori</th>
      <th>Harga</th>
      <th>Foto</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php
    include('../config/koneksi.php');
    $query = mysqli_query($conn, "SELECT * FROM produk JOIN kategori ON produk.kode_kategori = kategori.kode_kategori");
    while ($data = mysqli_fetch_array($query)) {
    ?>
      <tr>
        <td><?php echo $data['nama_produk']; ?></td>
        <td><?php echo $data['nama_kategori']; ?></td>
        <?php $hasil_rupiah = "Rp " . number_format($data['harga'], 2, ',', '.'); ?>
        <td><?php echo $hasil_rupiah; ?></td>
        <td><img height="100px" src="../images/<?php echo $data['foto']; ?>"></td>
        <td>
          <button type="button" class="btn btn-outline-info btn-sm" onclick="modalEdit(<?php echo $data['kode_produk']; ?>)">Edit</button>
          <button type="button" class="btn btn-outline-danger btn-sm" onclick="modalHapus(<?php echo $data['kode_produk']; ?>)">Hapus</button>
        </td>
      </tr>
      <div class="modal fade" id="editProdukModal<?php echo $data['kode_produk']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Edit Data Produk</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="#" method="POST" enctype="multipart/form-data">
              <div class="modal-body">
                <label for="nama-edit<?php echo $data['kode_produk']; ?>" class="form-label">Nama Produk</label>
                <input type="hidden" name="kode-edit" value="<?php echo $data['kode_produk']; ?>">
                <input type="text" class="form-control" id="nama-edit<?php echo $data['kode_produk']; ?>" name="nama-edit" value="<?php echo $data['nama_produk']; ?>">

                <label for="kategori-edit<?php echo $data['kode_produk']; ?>" class="form-label">Kategori</label>
                <select class="form-control" name="kategori-edit" id="kategori-edit<?php echo $data['kode_produk']; ?>">
                  <?php
                  $query2 = mysqli_query($conn, "SELECT * FROM kategori");
                  while ($row2 = mysqli_fetch_array($query2)) {
                    echo "<option value='" . $row2['kode_kategori'] . "'>" . $row2['nama_kategori'] . "</option>";
                  }
                  ?>
                </select>

                <label for="harga-edit<?php echo $data['kode_produk']; ?>" class="form-label">Harga</label>
                <input type="number" class="form-control" id="harga-edit<?php echo $data['kode_produk']; ?>" name="harga-edit" value="<?php echo $data['harga']; ?>">

                <label for="foto-edit<?php echo $data['kode_produk']; ?>" class="form-label">Foto</label>
                <input type="file" class="form-control" id="foto-edit<?php echo $data['kode_produk']; ?>" name="foto-edit">

                <label for="deskripsi-edit<?php echo $data['kode_produk']; ?>" class="form-label">Deskripsi</label>
                <textarea type="text" class="form-control" id="deskripsi-edit<?php echo $data['kode_produk']; ?>" name="deskripsi-edit"><?php echo $data['deskripsi']; ?></textarea>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="modal fade" id="hapusProdukModal<?php echo $data['kode_produk']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Hapus Data Produk</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="#" method="POST">
              <div class="modal-body">
                <label for="nama-hapus<?php echo $data['kode_produk']; ?>" class="form-label">Nama Produk</label>
                <input type="hidden" name="kode-hapus" value="<?php echo $data['kode_produk']; ?>">
                <input type="text" class="form-control" id="nama-hapus<?php echo $data['kode_produk']; ?>" name="nama-hapus" value="<?php echo $data['nama_produk']; ?>" readonly>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger">Delete Data</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    <?php
    }
    ?>
  </tbody>
</table>

<!-- Modal -->
<div class="modal fade" id="produkModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Produk</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="#" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
          <label for="nama-add" class="form-label">Nama Produk</label>
          <input type="text" class="form-control" id="nama-add" name="nama-add">

          <label for="kategori-add" class="form-label">Kategori</label>
          <select class="form-control" name="kategori-add" id="kategori-add">
            <?php
            $query = mysqli_query($conn, "SELECT * FROM kategori");
            while ($row2 = mysqli_fetch_array($query)) {
              echo "<option value='" . $row2['kode_kategori'] . "'>" . $row2['nama_kategori'] . "</option>";
            }
            ?>
          </select>

          <label for="harga-add" class="form-label">Harga</label>
          <input type="number" class="form-control" id="harga-add" name="harga-add">

          <label for="foto-add" class="form-label">Foto</label>
          <input type="file" accept="image/*" class="form-control" id="foto-add" name="foto-add">

          <label for="deskripsi-add" class="form-label">Deskripsi</label>
          <textarea type="text" class="form-control" id="deskripsi-add" name="deskripsi-add"></textarea>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  function modalEdit(id) {
    var myModal = new bootstrap.Modal(document.getElementById('editProdukModal' + id));
    myModal.show();
  }

  function modalHapus(id) {
    var myModal = new bootstrap.Modal(document.getElementById('hapusProdukModal' + id));
    myModal.show();
  }
</script>

<?php
//tambah data produk
if (isset($_POST['nama-add'])) {
  $nama = $_POST['nama-add'];
  $kategori = $_POST['kategori-add'];
  $harga = $_POST['harga-add'];
  $foto = $_FILES['foto-add']['name'];
  $file_foto = $_FILES['foto-add']['tmp_name'];
  $deskripsi = $_POST['deskripsi-add'];

  $query = mysqli_query($conn, "INSERT INTO produk(nama_produk,kode_kategori,harga,foto,deskripsi) VALUES('$nama','$kategori','$harga','$foto','$deskripsi')");

  if ($query) {
    move_uploaded_file($file_foto, "../images/" . $foto);
    echo "<script>alert('Produk berhasil ditambah'); location.href='?p=produk'; </script>";
  } else {
    echo "<script>alert('Produk gagal ditambah')</script>";
  }
}

//update data produk
if (isset($_POST['nama-edit'])) {
  $kode = $_POST['kode-edit'];
  $nama = $_POST['nama-edit'];
  $kategori = $_POST['kategori-edit'];
  $harga = $_POST['harga-edit'];
  $deskripsi = $_POST['deskripsi-edit'];

  if (!empty($_FILES['foto-edit']['name'])) {
    $foto = $_FILES['foto-edit']['name'];
    $file_foto = $_FILES['foto-edit']['tmp_name'];

    $query1 = mysqli_query($conn, "SELECT * FROM produk WHERE kode_produk='$kode'");
    $data1 = mysqli_fetch_array($query1);
    unlink("../images/" . $data1['foto']);

    move_uploaded_file($file_foto, "../images/" . $foto);

    $query = mysqli_query($conn, "UPDATE produk SET nama_produk='$nama', kode_kategori='$kategori', harga='$harga', foto='$foto', deskripsi='$deskripsi' WHERE kode_produk = '$kode'");
  } else {
    $query = mysqli_query($conn, "UPDATE produk SET nama_produk='$nama', kode_kategori='$kategori', harga='$harga', deskripsi='$deskripsi' WHERE kode_produk = '$kode'");
  }
  if ($query) {
    echo "<script>alert('Produk berhasil diedit'); location.href='?p=produk'; </script>";
  } else {
    echo "<script>alert('Produk gagal diedit')</script>";
  }
}

//hapus data produk
if (isset($_POST['nama-hapus'])) {
  $kode = $_POST['kode-hapus'];

  $query1 = mysqli_query($conn, "SELECT * FROM produk WHERE kode_produk='$kode'");
  $data1 = mysqli_fetch_array($query1);
  unlink("../images/" . $data1['foto']);

  $query = mysqli_query($conn, "DELETE FROM produk WHERE kode_produk = '$kode'");

  if ($query) {
    echo "<script>alert('Produk berhasil dihapus'); location.href='?p=produk'; </script>";
  } else {
    echo "<script>alert('Produk gagal dihapus')</script>";
  }
}
?>