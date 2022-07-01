<?php
session_start();

if (!isset($_SESSION['user_email'])) {
  header('location:index.php');
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.82.0">
  <title>Dashboard Admin · Toko Online</title>

  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="../css/dashboard.css" rel="stylesheet">

  <script src="../js/jquery-3.6.0.js"></script>

  <script src="../js/bootstrap.bundle.min.js"></script>
</head>

<body>

  <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Toko Online</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <ul class="navbar-nav px-3">
      <li class="nav-item text-nowrap">
        <a class="nav-link" href="logout.php">Sign out</a>
      </li>
    </ul>
  </header>

  <div class="container-fluid">
    <div class="row">
      <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
        <div class="position-sticky pt-3">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link" href="?p=dashboard">
                <span data-feather="home"></span>
                Dashboard
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="?p=kategori">
                <span data-feather="file"></span>
                Data Kategori
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="?p=produk">
                <span data-feather="shopping-cart"></span>
                Data Produk
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="?p=penjualan">
                <span data-feather="bar-chart-2"></span>
                Data Penjualan
              </a>
            </li>
          </ul>
        </div>
      </nav>

      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-3">
        <?php include('route.php'); ?>
      </main>
    </div>
  </div>
</body>

</html>