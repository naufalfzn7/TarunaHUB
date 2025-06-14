<?php
session_start();

if (!isset($_SESSION['login'])) {
    echo "<script>
        alert('ANDA HARUS LOGIN !!!')
        document.location.href = 'login.php';
    
    </script>";
    exit();
}

$title = "Tambah Anggota";


include 'layout/header.php';



if (isset($_POST['tambah'])) {
    if (create_anggota($_POST) > 0) {
        echo "<script>
        alert('Data Anggota Berhasil Ditambahkan');
        document.location.href = 'anggota.php';       
        </script>";
    } else {
        echo "<script>
        alert('Data Barang Gagal Ditambahkan');
        document.location.href = 'anggota.php';       
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
                    <h1 class="m-0">Tambah Anggota</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="anggota.php">Data Anggota</a></li>
                        <li class="breadcrumb-item active">Tambah Anggota</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">


            <form action="" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Anggota</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Anggota..." Required>
                </div>

                <div class="row">
                    <div class="mb-3 col-6">
                        <label for="divisi" class="form-label">DIVISI</label>
                        <select name="divisi" id="divisi" class="form-control" required>
                            <option value="">-- PILIH DIVISI --</option>
                            <option value="Humas">Humas</option>
                            <option value="Olahraga">Olahraga</option>
                            <option value="SDM">SDM</option>
                        </select>
                    </div>

                    <div class="mb-3 col-6">
                        <label for="jk" class="form-label">Jenis Kelamin</label>
                        <select name="jk" id="jk" class="form-control" required>
                            <option value="">-- PILIH JENIS KELAMIN --</option>
                            <option value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="telepon" class="form-label">Telepon</label>
                    <input type="number" class="form-control" id="telepon" name="telepon" placeholder="telepon Anggota..." Required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email Anggota..." Required>
                </div>

                <div class="mb-3">
                    <label for="foto" class="form-label">foto</label>
                    <input type="file" class="form-control" id="foto" name="foto" placeholder="foto Anggota..." Required onchange="previewImg()">

                    <img src="" alt="" class="img-thumbnail img-preview mt-3" width="100px">
                </div>

                <button type="submit" name="tambah" class="btn btn-primary" style="float: right;">TAMBAH</button>
            </form>

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<?php include 'layout/footer.php' ?>