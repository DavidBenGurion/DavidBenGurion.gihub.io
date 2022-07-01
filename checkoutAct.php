<?php
session_start();
include('config/koneksi.php');
$status = 0;
if (isset($_POST['alamat'])) {
    $alamat = $_POST['alamat'];
    $provinsi = $_POST['provinsi'];
    $kota = $_POST['kota'];
    $kurir = $_POST['kurir'];
    $ongkir = $_POST['paket'];
    $total = $_POST['totalAct'];
    $tanggal = date('d-m-Y');
    $foto = $_FILES['foto-add']['name'];
    $file_foto = $_FILES['foto-add']['tmp_name'];

    $query = mysqli_query($conn, "SELECT RIGHT(MAX(nomor),3) as nomor FROM penjualan WHERE DATE(tanggal) = CURDATE()");
    $data = mysqli_fetch_array($query);
    if (isset($data['nomor'])) {
        $nomor = date('Ymd-') . str_repeat("0", 3 - strlen($data['nomor'] + 1)) . ($data['nomor'] + 1);
    } else {
        $nomor = date('Ymd-') . '001';
    }
    $idUser = getId($conn);
    $query2 = mysqli_query($conn, "INSERT INTO penjualan_detail(nomor,kode_produk,jumlah,harga,subtotal) " .
        "SELECT '$nomor' as nomor,kode_produk,jumlah,harga,subtotal FROM keranjang WHERE id_user = '$idUser' ");

    if ($query2) {
        $nama = getName($conn);
        $hape = getHp($conn);
        $query3 = mysqli_query($conn, "INSERT INTO penjualan(nomor,id_user,nama,nohp,alamat,provinsi,kota,kurir,ongkir,total,bukti_transfer) " .
            "VALUES('$nomor','$idUser','$nama','$hape','$alamat','$provinsi','$kota','$kurir','$ongkir','$total','$foto')");
        if ($query3) {
            $status = 1;
            mysqli_query($conn, "DELETE FROM keranjang WHERE id_user = '$idUser'");
            move_uploaded_file($file_foto, "images/buktiTransfer/" . $foto);
            header("Location:selesai.php?nomor='$nomor'");
        } else {
            mysqli_query($conn, "DELETE FROM penjualan_detail WHERE nomor = '$nomor'");
        }
    }
}
function getId($conn)
{
    $username = $_SESSION['username'];
    $sql = "SELECT * FROM konsumen WHERE username='$username'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row['id_user'];
}
function getName($conn)
{
    $username = $_SESSION['username'];
    $sql = "SELECT * FROM konsumen WHERE username='$username'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row['nama'];
}
function getHp($conn)
{
    $username = $_SESSION['username'];
    $sql = "SELECT * FROM konsumen WHERE username='$username'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row['no_hp'];
}
