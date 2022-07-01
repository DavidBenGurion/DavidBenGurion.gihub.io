<?php
session_start();
include('config/koneksi.php');
$idUser = getId($conn);
if (isset($_GET['id'])) {
    $produk = $_GET['id'];

    if (!isset($_GET['tipe'])) {
        $query1 = mysqli_query($conn, "SELECT * FROM produk WHERE kode_produk = '$produk'");
        $data1 = mysqli_fetch_array($query1);
        $harga = $data1['harga'];

        $query2 = mysqli_query($conn, "SELECT * FROM keranjang WHERE id_user='$idUser' AND kode_produk = '$produk'");
        $data2 = mysqli_fetch_array($query2);
        if (isset($data2['jumlah'])) {
            $subtotal = $harga * ($data2['jumlah'] + 1);
            $query3 = mysqli_query($conn, "UPDATE keranjang SET jumlah=jumlah+1, subtotal='$subtotal' WHERE id_user = '$idUser' AND kode_produk = '$produk'");
        } else {

            $query3 = mysqli_query($conn, "INSERT INTO keranjang(id_user,kode_produk,jumlah,harga,subtotal) " .
                "VALUES('$idUser','$produk','1','$harga','$harga')");
        }

        if ($query3) {
            echo "1";
        } else {
            echo "0";
        }
    } else {
        switch ($_GET['tipe']) {
            case 'hapus':
                $query = mysqli_query($conn, "DELETE FROM keranjang WHERE kode_keranjang = '$produk'");
                if ($query) {
                    echo "1";
                } else {
                    echo "0";
                }
                break;
            case 'kurang':
                $query1 = mysqli_query($conn, "SELECT * FROM keranjang WHERE kode_keranjang = '$produk'");
                $data1 = mysqli_fetch_array($query1);

                $harga = $data1['harga'];
                $jumlah = $data1['jumlah'];

                if ($jumlah > 1) {
                    $jumlah--;
                    $subtotal = $harga * $jumlah;
                    $query2 = mysqli_query($conn, "UPDATE keranjang SET jumlah='$jumlah', subtotal='$subtotal' WHERE kode_keranjang = '$produk'");

                    if ($query2) {
                        echo "1";
                    } else {
                        echo "0";
                    }
                }
                break;
            case 'tambah':
                $query1 = mysqli_query($conn, "SELECT * FROM keranjang WHERE kode_keranjang = '$produk'");
                $data1 = mysqli_fetch_array($query1);

                $harga = $data1['harga'];
                $jumlah = $data1['jumlah'];

                $jumlah++;
                $subtotal = $harga * $jumlah;
                $query2 = mysqli_query($conn, "UPDATE keranjang SET jumlah='$jumlah', subtotal='$subtotal' WHERE kode_keranjang = '$produk'");

                if ($query2) {
                    echo "1";
                } else {
                    echo "0";
                }
                break;
        }
    }
} else {
    $idUser = getId($conn);
    $query = mysqli_query($conn, "SELECT COUNT(*) as jumlah FROM keranjang WHERE  id_user = '$idUser'");
    $data = mysqli_fetch_array($query);
    echo $data['jumlah'];
}
function getId($conn)
{
    $username = $_SESSION['username'];
    $sql = "SELECT * FROM konsumen WHERE username='$username'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row['id_user'];
}
