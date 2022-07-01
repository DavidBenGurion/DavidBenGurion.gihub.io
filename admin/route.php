<?php 
    $page = $_GET['p'];

    switch($page){
        case 'dashboard': include('page/dashboard.php'); break;
        case 'kategori': include('page/kategori.php'); break;
        case 'produk': include('page/produk.php'); break;
        case 'penjualan': include('page/penjualan.php'); break;
    }
?>