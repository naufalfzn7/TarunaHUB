<?php
session_start();

if (!isset($_SESSION['login'])) {
    echo "<script>
        alert('ANDA HARUS LOGIN !!!')
        document.location.href = 'login.php';
    
    </script>";
    exit();
}
$title = "Ubah Barang";

include 'layout/header.php';

$id_barang = (int)$_GET['id_barang'];
$barang =  select("SELECT * FROM barang WHERE id_barang = $id_barang")[0];

if (isset($_POST['ubah'])) {
    if (update_barang($_POST) > 0) {
        echo "<script>
        alert('Data Barang Berhasil Di Ubah');
        document.location.href = 'index.php';       
        </script>";
    } else {
        echo "<script>
        alert('Data Barang Gagal Di Ubah');
        document.location.href = 'index.php';       
        </script>";
    }
}



?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Ubah Barang</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Data Barang</a></li>
                        <li class="breadcrumb-item active">Ubah Barang</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">


            <form action="" method="post">
                <input type="hidden" name='id_barang' value="<?= $barang['id_barang'] ?>">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Barang</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="<?= $barang['nama'] ?>" placeholder="Nama Barang...">
                </div>
                <div class="mb-3">
                    <label for="jumlah" class="form-label">Jumlah</label>
                    <input type="number" class="form-control" id="jumlah" name="jumlah" value="<?= $barang['jumlah'] ?>" placeholder="Jumlah Barang...">
                </div>
                <div class="mb-3">
                    <label for="harga" class="form-label">Harga</label>
                    <input type="number" class="form-control" id="harga" name="harga" value="<?= $barang['harga'] ?>" placeholder="Harga Barang...">
                </div>

                <button type="submit" name="ubah" class="btn btn-primary" style="float: right;"> <i class="fas fa-edit"></i> UBAH</button>
            </form>

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<?php
include 'layout/footer.php';
?>