<?php
session_start();

if (!isset($_SESSION['login'])) {
    echo "<script>
        alert('ANDA HARUS LOGIN !!!')
        document.location.href = 'login.php';
    
    </script>";
    exit();
}

$title = "Hapus Barang";


include 'config/app.php';

$id_barang = (int)$_GET['id_barang'];

if (delete_barang($id_barang) > 0) {
    echo "<script>
    alert('Data Barang Berhasil Dihapus');
    document.location.href = 'index.php';       
    </script>";
} else {
    echo "<script>
    alert('Data Barang Gagal Dihapus');
    document.location.href = 'index.php';       
    </script>";
}
