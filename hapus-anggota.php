<?php
session_start();

if (!isset($_SESSION['login'])) {
    echo "<script>
        alert('ANDA HARUS LOGIN !!!')
        document.location.href = 'login.php';
    
    </script>";
    exit();
}

$title = "Hapus Anggota";


include 'config/app.php';

$id_anggota = (int)$_GET['id_anggota'];

if (delete_anggota($id_anggota) > 0) {
    echo "<script>
    alert('Data anggota Berhasil Dihapus');
    document.location.href = 'anggota.php';       
    </script>";
} else {
    echo "<script>
    alert('Data anggota Gagal Dihapus');
    document.location.href = 'anggota.php';       
    </script>";
}
