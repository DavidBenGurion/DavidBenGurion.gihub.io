<?php session_start(); ?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <title>Toko Online</title>
  <link rel="stylesheet" href="header.css">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      min-height: 75rem;
      padding-top: 4.5rem;
    }
  </style>

  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="js/jquery-3.6.0.js"></script>
</head>

<body>

  <nav class="navbar navbar-expand-md navbar-dark fixed-top ">
    <div class="container-fluid">
      <a class="navbar-brand" style="color:#464747;font-family:angel;font-size:40px" href="./">Vape Store</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav me-auto mb-2 mb-md-0">
          <li class="nav-item">
            <a class="nav-link" style="color:white" href="./">Home</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" style="color:white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Kategori Produk
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <?php
              include('config/koneksi.php');

              $query1 = mysqli_query($conn, "SELECT * FROM kategori ORDER BY nama_kategori ASC");
              while ($data1 = mysqli_fetch_array($query1)) {
                echo "<li><a class='dropdown-item' href='index.php?kategori=" . $data1['kode_kategori'] . "'>" . $data1['nama_kategori'] . "</a></li>";
              }
              ?>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="./">Semua Kategori</a></li>
            </ul>
          </li>
          <li class="nav-item" id="nav-keranjang">
            <a class="nav-link" style="color:white" href="keranjang.php">Keranjang Belanja
              <span class="badge rounded-pill bg-dark" id="item-cart">0</span>
            </a>
          </li>
          <li class="nav-item" id="nav-keranjang">
            <a class="nav-link" style="color:white" href="daftarTransaksi.php">Daftar Transaksi
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" style="color:white" href="AboutUs.php">About US
            </a>
          </li>
        </ul>
        <?php if (!isset($_SESSION['username'])) { ?>
          <button type="button" class="btn btn-light" id="LoginBtn" style="margin-right:5px;" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Login
          </button>
        <?php } else {
          echo "<p id='txt-username' style='padding-top:10px;margin-right:15px;font-family:rounded;font-weight:900'>" . $_SESSION['username'] . "</p>";
        } ?>

        <!-- (petunjuk soal nomor a-1) lakukan modifikasi pada koding di bawah ini -->
        <form class="d-flex" action="index.php" method="get">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="cari">
          <button class="btn" type="submit" style="background-color:#87431D;color:white;">Search</button>
        </form>
        <?php if (isset($_SESSION['username'])) { ?>
          <a href="Logout.php" type=" button" class="btn btn-danger" style="margin-left:5px;">
            LogOut
          </a>
        <?php } ?>
      </div>
    </div>
  </nav>