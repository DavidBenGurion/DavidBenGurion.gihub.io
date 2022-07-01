<?php include('header.php'); ?>
<link rel="stylesheet" href="header.css">
<main class="container-fluid box-content">
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="images/banner1.jpg" class="d-block w-100" alt="Banner 1">
            </div>
            <div class="carousel-item">
                <img src="images/banner2.jpg" class="d-block w-100" alt="Banner 2">
            </div>
            <div class="carousel-item">
                <img src="images/banner4.webp" class="d-block w-100" alt="Banner 3">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <div class="row">
        <?php if (isset($_GET['cari'])) {
            $search = $_GET['cari'];
            $sql = "SELECT * FROM produk WHERE nama_produk LIKE '%$search%'";
            $query2 = mysqli_query($conn, $sql);
            while ($data2 = mysqli_fetch_array($query2)) { ?>
                <div class="col-3 mr-2 mt-2 mb-2">
                    <div class="card card-item">
                        <img src="images/<?php echo $data2['foto']; ?>" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">
                                <a class="produk-nama" style="text-decoration:none; color:white;" href="detail.php?id=<?php echo $data2['kode_produk']; ?>">
                                    <?php echo $data2['nama_produk']; ?>
                                </a>
                            </h5> <?php $hasil_rupiah = "Rp " . number_format($data2['harga'], 2, ',', '.'); ?>
                            <p class="card-text harga"><?php echo $hasil_rupiah; ?></p>
                        </div>
                        <?php if (isset($_SESSION['username'])) { ?>
                            <div class="card-footer d-grid">
                                <button type="button" class="btn btn-chart text-white btn-block" onclick="addToCart(<?php echo $data2['kode_produk']; ?>)">
                                    Add to Cart
                                </button>
                            </div>
                        <?php } else { ?>
                            <div class="card-footer d-grid">
                                <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-chart text-white btn-block">
                                    Add to Cart
                                </button>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            <?php }
        } else { ?>
            <?php
            $sql = "SELECT * FROM produk";
            if (isset($_GET['kategori'])) {
                $sql .= " WHERE kode_kategori = " . $_GET['kategori'];
            }
            $query2 = mysqli_query($conn, $sql);
            while ($data2 = mysqli_fetch_array($query2)) {
            ?>
                <div class="col-3 mr-2 mt-2 mb-2">
                    <div class="card card-item">
                        <img src="images/<?php echo $data2['foto']; ?>" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">
                                <a class="produk-nama" href="detail.php?id=<?php echo $data2['kode_produk']; ?>">
                                    <?php echo $data2['nama_produk']; ?>
                                </a>
                            </h5>
                            <?php $hasil_rupiah = "Rp " . number_format($data2['harga'], 2, ',', '.'); ?>
                            <p class="card-text harga"><?php echo $hasil_rupiah; ?></p>
                        </div>
                        <?php if (isset($_SESSION['username'])) { ?>
                            <div class="card-footer d-grid">
                                <button type="button" class="btn btn-chart text-white btn-block" onclick="addToCart(<?php echo $data2['kode_produk']; ?>)">
                                    Add to Cart
                                </button>
                            </div>
                        <?php } else { ?>
                            <div class="card-footer d-grid">
                                <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-chart text-white btn-block">
                                    Add to Cart
                                </button>
                            </div>
                        <?php } ?>
                    </div>
                </div>
        <?php
            }
        }
        ?>
    </div>
</main>

<?php include('footer.php'); ?>