<?php include('header.php'); ?>
<link rel="stylesheet" href="header.css">
<link rel="stylesheet" href="detail.css">
<main class="container">
    <div class="row">
        <?php
        $sql = "SELECT * FROM produk WHERE kode_produk = " . $_GET['id'];
        $query2 = mysqli_query($conn, $sql);
        $data2 = mysqli_fetch_array($query2);
        ?>
        <div class="card mb-3" style="background-color:black">
            <div class="row g-0" style="background-color:black;">
                <div class="col-md-4 image-block">
                    <img src="images/<?php echo $data2['foto']; ?>" class="img-fluid">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h2 class="card-title mb-5"><?php echo $data2['nama_produk']; ?></h2>
                        <p class="card-text mb-5"><?php echo $data2['deskripsi']; ?></p>
                        <p class="card-text">
                        <h4 class="card-title text-danger mb-5">
                            <?php echo "Rp " . number_format($data2['harga'], 2, ',', '.'); ?>
                        </h4>
                        <?php if (!isset($_SESSION['username'])) { ?>
                            <button type="button" class="btn btn-info text-white btn-block" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Add to Cart
                            </button>

                        <?php } else { ?>
                            <button type="button" class="btn btn-info text-white btn-block" onclick="addToCart(<?php echo $data2['kode_produk']; ?>)">
                                Add to Cart
                            </button>
                        <?php } ?>

                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include('footer.php'); ?>