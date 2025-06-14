<?php
session_start();

if (!isset($_SESSION['login'])) {
    echo "<script>
        alert('ANDA HARUS LOGIN !!!')
        document.location.href = 'login.php';
    
    </script>";
    exit();
}
$title = "Detail Anggota";

include 'layout/header.php';

$id_anggota = (int)$_GET['id_anggota'];

$anggota = select("SELECT * FROM anggota WHERE id_anggota = $id_anggota")[0];
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Detail Anggota</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="anggota.php">Data Anggota </a></li>
                        <li class="breadcrumb-item active">Detail Anggota</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Data Detail Dari <?= $anggota['nama']; ?></h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table class="table table-bordered table-hover">
                                        <tr>
                                            <td>Nama</td>
                                            <td>: <?= $anggota['nama']; ?></td>
                                        </tr>

                                        <tr>
                                            <td>Divisi</td>
                                            <td>: <?= $anggota['divisi']; ?></td>
                                        </tr>

                                        <tr>
                                            <td>Jenis Kelamin</td>
                                            <td>: <?= $anggota['jk']; ?></td>
                                        </tr>

                                        <tr>
                                            <td>Telepon</td>
                                            <td>: <?= $anggota['telepon']; ?></td>
                                        </tr>

                                        <tr>
                                            <td>email</td>
                                            <td>: <?= $anggota['email']; ?></td>
                                        </tr>

                                        <tr>
                                            <td width='50%'>Foto</td>
                                            <td><a href="assets/img/<?= $anggota['foto'] ?>"><img src="assets/img/<?= $anggota['foto'] ?>" alt="foto" width='50%'></a></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<?php
include 'layout/footer.php';
?>