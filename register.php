<?php include('header.php'); ?>
<link rel="stylesheet" href="register.css">
<div class="box-register">
    <div class="judul">
        <h4>Register</h4>
    </div>
    <?php
    if (isset($_GET['fail'])) {
        if ($_GET['fail'] == 'success') {
            echo '<div class="alert alert-success" id="failRegis" role="alert">
            Registrasi berhasil silahkan Login
        </div>';
        } else if ($_GET['fail'] == 'exists') {
            echo '<div class="alert alert-danger" id="failRegis" role="alert">
            Registrasi gagal, username sudah terdaftar
        </div>';
        } else {
            echo '<div class="alert alert-danger" id="failRegis" role="alert">
            Data registrasi tidak lengkap
        </div>';
        }
    } ?>

    <form action="registerAct.php" method="POST">
        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control" id="name">
        </div>
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" class="form-control" id="username">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1">
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">No. Hp</label>
            <input type="text" name="nohp" class="form-control" id="noHp">
        </div>
        <div class="box-button">
            <button type="submit" class="btn btn-primary" id="btn-register">Register</button>
        </div>
    </form>
</div>
<script>
    function closeAlert() {
        if ($('#failRegis').css('display') == "block") {
            $('#failRegis').css('display', 'none')
        }
    }
    setTimeout(closeAlert, 5000)
</script>
<?php include('footer.php'); ?>