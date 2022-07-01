<h1 class="h2 mb-3">Data Kategori</h1>
<button type="button" class="btn btn-outline-success mb-3" data-bs-toggle="modal" data-bs-target="#kategoriModal">Tambah Data</button>
<table class="table table-hover table-bordered ">
    <thead>
        <tr>
            <th>Nama Kategori</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    <?php 
        include('../config/koneksi.php');
        $query = mysqli_query($conn, "SELECT * FROM kategori");
        while($data = mysqli_fetch_array($query)){
    ?>
        <tr>
            <td><?php echo $data['nama_kategori']; ?></td>
            <td>
                <button type="button" class="btn btn-outline-info btn-sm" 
                  onclick="modalEdit(<?php echo $data['kode_kategori']; ?>)">Edit</button>
                <button type="button" class="btn btn-outline-danger btn-sm"
                onclick="modalHapus(<?php echo $data['kode_kategori']; ?>)">Hapus</button>
            </td>
        </tr>
        <div class="modal fade" id="editkategoriModal<?php echo $data['kode_kategori']; ?>" 
          tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data Kategori</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form action="#" method="POST">
              <div class="modal-body">
                <label for="nama-edit<?php echo $data['kode_kategori']; ?>" class="form-label">Nama Kategori</label>
                <input type="hidden" name="kode-edit" value="<?php echo $data['kode_kategori']; ?>">
                <input type="text" class="form-control" id="nama-edit<?php echo $data['kode_kategori']; ?>" name="nama-edit" 
                  value="<?php echo $data['nama_kategori']; ?>">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
              </div>
              </form>
            </div>
          </div>
        </div>

        <div class="modal fade" id="hapuskategoriModal<?php echo $data['kode_kategori']; ?>" 
          tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus Data Kategori</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form action="#" method="POST">
              <div class="modal-body">
                <label for="nama-hapus<?php echo $data['kode_kategori']; ?>" class="form-label">Nama Kategori</label>
                <input type="hidden" name="kode-hapus" value="<?php echo $data['kode_kategori']; ?>">
                <input type="text" class="form-control" id="nama-hapus<?php echo $data['kode_kategori']; ?>" name="nama-hapus" 
                  value="<?php echo $data['nama_kategori']; ?>" readonly>
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
<div class="modal fade" id="kategoriModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Kategori</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="#" method="POST">
      <div class="modal-body">
        <label for="nama-add" class="form-label">Nama Kategori</label>
        <input type="text" class="form-control" id="nama-add" name="nama-add">
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
    var myModal = new bootstrap.Modal(document.getElementById('editkategoriModal' + id));
    myModal.show();
  }

  function modalHapus(id) {
    var myModal = new bootstrap.Modal(document.getElementById('hapuskategoriModal' + id));
    myModal.show();
  }
</script>

<?php 
    //tambah data kategori
    if(isset($_POST['nama-add'])){
        $nama = $_POST['nama-add'];

        $query = mysqli_query($conn, "INSERT INTO kategori(nama_kategori) VALUES('$nama')");

        if($query){
            echo "<script>alert('Kategori berhasil ditambah'); location.href='?p=kategori'; </script>";
        }else{
            echo "<script>alert('Kategori gagal ditambah')</script>";
        }
    }

    //update data kategori
    if(isset($_POST['nama-edit'])){
      $kode = $_POST['kode-edit'];
      $nama = $_POST['nama-edit'];

      $query = mysqli_query($conn, "UPDATE kategori SET nama_kategori = '$nama' WHERE kode_kategori = '$kode'");

        if($query){
            echo "<script>alert('Kategori berhasil diedit'); location.href='?p=kategori'; </script>";
        }else{
            echo "<script>alert('Kategori gagal diedit')</script>";
        }
    }

    //hapus data kategori
    if(isset($_POST['nama-hapus'])){
      $kode = $_POST['kode-hapus'];

      $query = mysqli_query($conn, "DELETE FROM kategori WHERE kode_kategori = '$kode'");

        if($query){
            echo "<script>alert('Kategori berhasil dihapus'); location.href='?p=kategori'; </script>";
        }else{
            echo "<script>alert('Kategori gagal dihapus')</script>";
        }
    }
?>