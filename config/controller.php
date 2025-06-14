<?php
function select($query)
{
    //panggil fungsi database
    global $db;

    $result = mysqli_query($db, $query);
    $rows = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

function create_barang($post)
{
    global $db;

    $nama = $post['nama'];
    $jumlah = $post['jumlah'];
    $harga = $post['harga'] * $jumlah;

    $query = "INSERT INTO barang VALUES (null,'$nama','$jumlah','$harga', CURRENT_TIMESTAMP())";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

function update_barang($post)
{
    global $db;
    $id_barang = htmlspecialchars($post['id_barang']);
    $nama = htmlspecialchars($post['nama']);
    $jumlah = htmlspecialchars($post['jumlah']);
    $harga = htmlspecialchars($post['harga']);

    $query = "UPDATE barang SET nama = '$nama' , jumlah = '$jumlah' , harga = '$harga' WHERE id_barang = $id_barang";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

function delete_barang($id_barang)
{
    global $db;
    $query = "DELETE FROM barang where id_barang = $id_barang";
    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

function create_anggota($post)
{
    global $db;

    $nama = htmlspecialchars($post['nama']);
    $divisi = htmlspecialchars($post['divisi']);
    $jk = htmlspecialchars($post['jk']);
    $telepon = htmlspecialchars($post['telepon']);
    $email = htmlspecialchars($post['email']);
    $foto = upload_file();



    if (!$foto) {
        return false;
    }

    $query = "INSERT INTO anggota VALUES (null, '$nama' , '$divisi' , '$jk' , '$telepon', '$email' , '$foto')";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

function upload_file()
{
    $namaFile = $_FILES['foto']['name'];
    $ukuranFile = $_FILES['foto']['size'];
    $error = $_FILES['foto']['error'];
    $tmpName = $_FILES['foto']['tmp_name'];

    //cek  file yang di upload

    $ekstensiFileValid = ['jpg', 'jpeg', 'png'];
    $ekstensifile = explode('.', $namaFile);
    $ekstensifile = strtolower(end($ekstensifile));

    if (!in_array($ekstensifile, $ekstensiFileValid)) {
        echo "
        <script>
            alert('FORMAT FILE TIDAK VALID');
            document.location.href = 'tambah-anggota.php';
        </script>
        ";
        die();
    }

    if ($ukuranFile > 2048000) {
        echo "
        <script>
            alert('ukuran file max 2MB');
            document.location.href = 'tambah-anggota.php';
        </script>
        ";
        die();
    }

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensifile;

    move_uploaded_file($tmpName, 'assets/img/' . $namaFileBaru);
    return $namaFileBaru;
}

function update_anggota($post)
{
    global $db;
    $id_anggota = htmlspecialchars($post['id_anggota']);
    $nama = htmlspecialchars($post['nama']);
    $divisi = htmlspecialchars($post['divisi']);
    $jk = htmlspecialchars($post['jk']);
    $telepon = htmlspecialchars($post['telepon']);
    $email = htmlspecialchars($post['email']);
    $fotoLama = htmlspecialchars($post['fotoLama']);

    if ($_FILES['foto']['error'] == 4) {
        $foto = $fotoLama;
    } else {
        $foto = upload_file();
    }

    $query = "UPDATE anggota set nama = '$nama', divisi = '$divisi' , jk = '$jk', telepon = '$telepon', email = '$email', foto = '$foto' WHERE id_anggota = $id_anggota";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

function delete_anggota($id_anggota)
{
    global $db;

    //mengambil gambar

    $foto = select("SELECT * FROM anggota WHERE id_anggota = $id_anggota")[0];
    unlink("assets/img/" . $foto['foto']);

    $query = "DELETE FROM anggota WHERE id_anggota = $id_anggota";
    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

function create_akun($post)
{
    global $db;

    $nama = htmlspecialchars($post['nama']);
    $username = htmlspecialchars($post['username']);
    $email = htmlspecialchars($post['email']);
    $password = htmlspecialchars($post['password']);
    $level = htmlspecialchars($post['level']);
    //cek apakah username sudah ada
    $result = mysqli_query($db, "SELECT * FROM akun WHERE username = '$username'");

    //jika username sudah ada
    if (mysqli_fetch_assoc($result)) {
        echo "
        <script>
            alert('Username sudah terdaftar');
            document.location.href = 'crud-modal.php';
        </script>
        ";
        return false;
    }

    //enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);


    $query = "INSERT INTO akun VALUES (null, '$nama' , '$username' , '$email' , '$password', '$level',null)";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

function delete_akun($id_akun)
{
    global $db;


    $query = "DELETE FROM akun WHERE id_akun = $id_akun";
    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

function update_akun($post)
{
    global $db;
    $id_akun = htmlspecialchars($post['id_akun']);
    $nama = htmlspecialchars($post['nama']);
    $username = htmlspecialchars($post['username']);
    $email = htmlspecialchars($post['email']);
    $password = htmlspecialchars($post['password']);
    $level = htmlspecialchars($post['level']);
    //cek apakah username sudah ada
    $result = mysqli_query($db, "SELECT * FROM akun WHERE username = '$username'");

    //jika username sudah ada
    if (mysqli_fetch_assoc($result)) {
        echo "
        <script>
            alert('Username sudah terdaftar');
            document.location.href = 'crud-modal.php';
        </script>
        ";
        return false;
    }

    //enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);


    $query = "UPDATE akun SET nama = '$nama', username = '$username', email = '$email', password = '$password', level = '$level' WHERE id_akun = $id_akun";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}
