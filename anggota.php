<?php

session_start();
if (!isset($_SESSION['login'])) {
    echo "<script>
        alert('ANDA HARUS LOGIN !!!')
        document.location.href = 'login.php';
    
    </script>";
    exit();
}

$title = "Daftar Anggota";

include 'layout/header.php';
$data_anggota = select('SELECT * FROM anggota');
$data_barang = select('SELECT * FROM barang');
$data_akun = select('SELECT * FROM akun');
$jumlah_anggota = count($data_anggota);
$jumlah_barang = count($data_barang);
$jumlah_akun = count($data_akun);
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">DATA ANGGOTA</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="anggota.php">Home</a></li>
                        <li class="breadcrumb-item active">Data Anggota</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?= $jumlah_anggota ?></h3>
                            <p>Jumlah Anggota</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="anggota.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>

                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?= $jumlah_barang ?></h3>

                            <p>Jumlah Barang</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="index.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?= $jumlah_akun ?></h3>

                            <p>Jumlah Akun Terdaftar</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="crud-modal.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>65</h3>

                            <p>Unique Visitors</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <!-- /.row -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Table Data Anggota</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <?php if ($_SESSION['level'] != 3): ?>
                                        <a href="tambah-anggota.php" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Tambah Anggota</a>
                                    <?php endif; ?>
                                    <table id="example2" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Divisi</th>
                                                <th>Jenis Kelamin</th>
                                                <th style="text-align: center;">Telepon</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1; ?>
                                            <?php
                                            foreach ($data_anggota as $anggota) :
                                            ?>
                                                <tr>
                                                    <td><?= $no ?></td>
                                                    <td><?= $anggota['nama'] ?></td>
                                                    <td><?= $anggota['divisi'] ?></td>
                                                    <td><?= $anggota['jk'] ?></td>
                                                    <td width='15%' class="text-center"><?= $anggota['telepon'] ?></td>
                                                    <td width='25%' class="text-center">
                                                        <a href="detail-anggota.php?id_anggota=<?= $anggota['id_anggota'] ?>" class="btn btn-secondary btn-sm"><i class="fas fa-info-circle"></i> DETAIL</a>
                                                        <?php if ($_SESSION['level'] == 1 || $_SESSION['level'] == 2): ?>
                                                            <a href="ubah-anggota.php?id_anggota=<?= $anggota['id_anggota'] ?>" class="btn btn-success btn-sm"><i class="fas fa-edit"></i> UBAH</a>
                                                            <a href="hapus-anggota.php?id_anggota=<?= $anggota['id_anggota'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('YAKIN DATA AKAN DIHAPUS ?')"><i class="fas fa-trash"></i> HAPUS</a>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>



                                            <?php $no++;
                                            endforeach ?>
                                        </tbody>
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