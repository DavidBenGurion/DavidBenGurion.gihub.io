<link rel="stylesheet" href="page/dashboardContain.css">
<h5>Hello Admin</h5>
<?php
include('../config/koneksi.php'); ?>
<div class="box1">
    <table>
        <tr>
            <td>
                <div class="box-analisis2">
                    <table>
                        <tr>
                            <td align="center">
                                <p class="unt-text" style="font-style:underline;">Jumlah Penjualan</p>
                            </td>
                        </tr>
                        <tr>
                            <td align="right">
                                <div class="col-md- poto-box" style="margin-left:10px">
                                    <img src="../images/iconAdmin/cart128.png" class="img-fluid">
                                </div>
                            </td>
                            <td>
                                <div class="count-box">
                                    <h5><?= getCountPenjualan($conn); ?></h5>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </td>
            <td>
                <div class="box-analisis2">
                    <table>
                        <tr>
                            <td align="center">
                                <p class="unt-text" style="font-style:underline;">Jumlah Produk</p>
                            </td>
                        </tr>
                        <tr>
                            <td align="right">
                                <div class="col-md- poto-box" style="margin-left:10px">
                                    <img src="../images/iconAdmin/pages.png" class="img-fluid">
                                </div>
                            </td>
                            <td>
                                <div class="count-box">
                                    <h5><?= getCountProduk($conn); ?></h5>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </td>
            <td>
                <div class="box-analisis2">
                    <table>
                        <tr>
                            <td align="center">
                                <p class="unt-text" style="font-style:underline;">Jumlah Kategori</p>
                            </td>
                        </tr>
                        <tr>
                            <td align="right">
                                <div class="col-md- poto-box" style="margin-left:10px">
                                    <img src="../images/iconAdmin/inbox.png" class="img-fluid">
                                </div>
                            </td>
                            <td>
                                <div class="count-box">
                                    <h5><?= getCountKategori($conn); ?></h5>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
    </table>
</div>
<?php
function getCountPenjualan($conn)
{
    $query = mysqli_query($conn, "SELECT COUNT(*) AS jumlah FROM penjualan");
    $data = mysqli_fetch_array($query);
    return $data['jumlah'];
}
function getCountProduk($conn)
{
    $query = mysqli_query($conn, "SELECT COUNT(*) AS jumlah FROM produk");
    $data = mysqli_fetch_array($query);
    return $data['jumlah'];
}
function getCountKategori($conn)
{
    $query = mysqli_query($conn, "SELECT COUNT(*) AS jumlah FROM kategori");
    $data = mysqli_fetch_array($query);
    return $data['jumlah'];
}

?>
<!--
<div class="box2">
    <div class="box-photo">
        <div class="col-md-4 poto-box2">
            <img src="../images/woman.png" class="img-fluid">
        </div>
    </div>
    <div class="box-table">
        <table>
            <tr>
                <td>
                    <h4 style="color:#686968;">Biodata</h4>
                </td>
            </tr>
            <tr>
                <td>
                    <h5 class="item-table">Nama</h5>
                </td>
                <td>
                    <h5 class="item-table">:Antonia Adella</h5>
                </td>
            </tr>
            <tr>
                <td>
                    <h5 class="item-table">Npm:</h5>
                </td>
                <td>
                    <h5 class="item-table">:194211228</h5>
                </td>
            </tr>
            <tr>
                <td>
                    <h5 class="item-table">Kelas</h5>
                </td>
                <td>
                    <h5 class="item-table">:TI 6 P</h5>
                </td>
            </tr>
        </table>
    </div>-->
</div>