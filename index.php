<?php


session_start();


if (isset($_SESSION['login'])) {
    if ($_SESSION['level'] == 3) {
        // Jika level bukan admin atau user, tampilkan pesan dan redirect
        echo "<script>
            alert('Hanya Admin atau Operator yang dapat mengakses halaman ini');
            document.location.href = 'anggota.php';
        </script>";
        exit();
    }
}

//membatasi halaman
if (!isset($_SESSION['login'])) {
    echo "<script>
        document.location.href = 'login.php';
    
    </script>";
    exit();
}

$title = "Daftar Barang";

include 'layout/header.php';
$data_barang = select('SELECT * FROM barang ORDER BY id_barang DESC');
$data_anggota = select('SELECT * FROM anggota');
$total_barang = select('SELECT * FROM barang');
$data_akun = select('SELECT * FROM akun');
$jumlah_anggota = count($data_anggota);
$jumlah_barang = count($total_barang);
$jumlah_akun = count($data_akun);
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">DATA BARANG</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="Anggota.php">Home</a></li>
                        <li class="breadcrumb-item active">Data Barang</li>
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
                                    <h3 class="card-title">Table Data Barang</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <a href="tambah-barang.php" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Tambah Barang</a>
                                    <a href="download-excel-barang.php" class="btn btn-success mb-3"><i class="fas fa-file-excel"></i> Download Excel</a>

                                    <table id="example2" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Jumlah</th>
                                                <th>Harga</th>
                                                <th>Tanggal</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;

                                            foreach ($data_barang as $barang):

                                            ?>
                                                <tr>
                                                    <td><?= $no ?></td>
                                                    <td><?= $barang['nama'] ?></td>
                                                    <td><?= $barang['jumlah'] ?></td>
                                                    <td>Rp. <?= number_format($barang['harga'], 0, ',', '.') ?></td>
                                                    <td><?= date('d/m/Y | H:i:s', strtotime($barang['tanggal'])) ?></td>
                                                    <td width='20%' class="text-center">
                                                        <a href="ubah-barang.php?id_barang=<?= $barang['id_barang'] ?>" class="btn btn-success"><i class="fas fa-edit"></i> UBAH</a>
                                                        <a href="hapus-barang.php?id_barang=<?= $barang['id_barang'] ?>" class="btn btn-danger" onclick="return confirm('yakin akan Menghapus ?')"><i class="fas fa-trash"></i> HAPUS</a>
                                                    </td>
                                                </tr>
                                            <?php $no += 1;
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