<?php
include 'config/app.php';

// Query hitung jumlah baris
$anggota = "SELECT COUNT(*) AS FROM anggota";
$barang = "SELECT COUNT(*) AS FROM barang";
$user = "SELECT COUNT(*) AS FROM akun";

// Eksekusi query
$data_anggota = mysqli_query($db, $anggota);
$data_barang = mysqli_query($db, $barang);
$data_user   = mysqli_query($db, $user);
