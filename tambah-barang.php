<?php
session_start();

if (!isset($_SESSION['login'])) {
    echo "<script>
        alert('ANDA HARUS LOGIN !!!')
        document.location.href = 'login.php';
    
    </script>";
    exit();
}

$title = "Tambah Barang";


include 'layout/header.php';

if (isset($_POST['tambah'])) {
    if (create_barang($_POST) > 0) {
        echo "<script>
        alert('Data Barang Berhasil Ditambahkan');
        document.location.href = 'index.php';       
        </script>";
    } else {
        echo "<script>
        alert('Data Barang Gagal Ditambahkan');
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
                    <h1 class="m-0">Tambah Barang</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Data Barang</a></li>
                        <li class="breadcrumb-item active">Tambah Barang</li>
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
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Barang</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Barang..." Required>
                </div>
                <div class="mb-3">
                    <label for="jumlah" class="form-label">Jumlah</label>
                    <input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="Jumlah Barang..." Required>
                </div>
                <div class="mb-3">
                    <label for="harga" class="form-label">Harga</label>
                    <input type="number" class="form-control" id="harga" name="harga" placeholder="Harga Barang..." Required>
                </div>

                <button type="submit" name="tambah" class="btn btn-primary" style="float: right;"><i class="fas fa-plus"></i> TAMBAH</button>
            </form>

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<?php include 'layout/footer.php' ?>