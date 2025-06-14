<?php
session_start();

if (!isset($_SESSION['login'])) {
    echo "<script>
        alert('ANDA HARUS LOGIN !!!')
        document.location.href = 'login.php';
    
    </script>";
    exit();
}

$title = "ubah anggota";


include 'layout/header.php';

if (isset($_POST['ubah'])) {
    if (update_anggota($_POST) > 0) {
        echo "<script>
        alert('Data anggota Berhasil Diubah');
        document.location.href = 'anggota.php';       
        </script>";
    } else {
        echo "<script>
        alert('Data anggota Gagal Diubah');
        document.location.href = 'anggota.php';       
        </script>";
    }
}

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
                    <h1 class="m-0">Ubah Anggota</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="anggota.php">Data Anggota</a></li>
                        <li class="breadcrumb-item active">Ubah Anggota</li>
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
                <input type="hidden" name="id_anggota" value="<?= $anggota['id_anggota']; ?>">
                <input type="hidden" name="fotoLama" value="<?= $anggota['foto']; ?>">

                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Anggota</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Anggota..." Required value="<?= $anggota['nama'] ?>">
                </div>

                <div class="row">
                    <div class="mb-3 col-6">
                        <label for="divisi" class="form-label">DIVISI</label>
                        <select name="divisi" id="divisi" class="form-control" required>
                            <?php $divisi = $anggota['divisi']; ?>
                            <option value="Humas" <?= $divisi == 'Humas' ? 'selected' : null ?>>Humas</option>
                            <option value="Olahraga" <?= $divisi == 'Olahraga' ? 'selected' : null ?>>Olahraga</option>
                            <option value="SDM" <?= $divisi == 'SDM' ? 'selected' : null ?>>SDM</option>
                        </select>
                    </div>

                    <div class="mb-3 col-6">
                        <label for="jk" class="form-label">Jenis Kelamin</label>
                        <select name="jk" id="jk" class="form-control" required>
                            <?php
                            $jk = $anggota['jk'];
                            ?>
                            <option value="Laki-Laki" <?= $jk == 'Laki-Laki' ? 'selected' : null ?>>Laki-Laki</option>
                            <option value="Perempuan" <?= $jk == 'Perempuan' ? 'selected' : null ?>>Perempuan</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="telepon" class="form-label">Telepon</label>
                    <input type="number" class="form-control" id="telepon" name="telepon" placeholder="telepon Anggota..." Required value="<?= $anggota['telepon'] ?>">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email Anggota..." Required value="<?= $anggota['email'] ?>">
                </div>

                <div class="mb-3">
                    <label for="foto" class="form-label">foto</label>
                    <input type="file" class="form-control" id="foto" name="foto" placeholder="foto Anggota..." onchange="previewImg()">
                    <img src="assets/img/<?= $anggota['foto'] ?>" alt="" class="img-thumbnail img-preview mt-3" width="100px">
                </div>
                <button type="submit" name="ubah" class="btn btn-primary" style="float: right;">UBAH</button>
            </form>


        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<?php
include 'layout/footer.php';
?>

<!-- preview image -->
<script>
    function previewImg() {
        const foto = document.querySelector('#foto');
        const imgPreview = document.querySelector('.img-preview');
        const fileFoto = new FileReader();
        fileFoto.readAsDataURL(foto.files[0]);
        fileFoto.onload = function(e) {
            imgPreview.src = e.target.result;
        }
    }
</script>