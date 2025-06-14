<?php
session_start();
require_once 'config/app.php';

// Jika belum login tapi ada cookie remember_token
if (!isset($_SESSION['login']) && isset($_COOKIE['remember_token'])) {
    $token = mysqli_real_escape_string($db, $_COOKIE['remember_token']);
    $result = mysqli_query($db, "SELECT * FROM akun WHERE remember_token = '$token'");
    if (mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);
        $_SESSION['login'] = true;
        $_SESSION['id_akun'] = $user['id_akun'];
        $_SESSION['nama'] = $user['nama'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['level'] = $user['level'];
        header("Location: anggota.php");
        exit;
    }
}


if (isset($_POST['login'])) {
    //mengambil input dari form
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    // Cek apakah username dan password sesuai
    $result = mysqli_query($db, "SELECT * FROM akun WHERE username = '$username'");
    if (mysqli_num_rows($result) === 1) {
        $hasil = mysqli_fetch_assoc($result);
        // Verifikasi password
        if (password_verify($password, $hasil['password'])) {
            // Set session seperti biasa
            $_SESSION['login'] = true;
            $_SESSION['id_akun'] = $hasil['id_akun'];
            //set semua session yang diperlukan
            $_SESSION['username'] = $hasil['username'];
            $_SESSION['nama'] = $hasil['nama'];
            $_SESSION['email'] = $hasil['email'];
            $_SESSION['level'] = $hasil['level'];

            // dst...

            // Jika remember me dicentang
            if (isset($_POST['remember'])) {
                $token = bin2hex(random_bytes(16)); // Token acak
                setcookie('remember_token', $token, time() + 60, "/"); // 1 menit
                mysqli_query($db, "UPDATE akun SET remember_token='$token' WHERE id_akun=" . $hasil['id_akun']);
            }

            header("Location: anggota.php");
            exit;
        }
    }
    $error = true; // Jika login gagal, set error
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="
    https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">

    <style>
        /* Importing fonts from Google */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');

        /* Reseting */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: rgb(138, 135, 138);
        }

        .wrapper {
            max-width: 350px;
            min-height: 500px;
            margin: 80px auto;
            padding: 40px 30px 30px 30px;
            background-color: rgb(183, 165, 220);
            border-radius: 15px;
            box-shadow: 13px 13px 20px #cbced1, -13px -13px 20px #fff;
        }

        .logo {
            width: 80px;
            margin: auto;
        }

        .logo img {
            width: 100%;
            height: 80px;
            object-fit: cover;
            border-radius: 50%;
            box-shadow: 0px 0px 3px #5f5f5f,
                0px 0px 0px 5px #ecf0f3,
                8px 8px 15px #a7aaa7,
                -8px -8px 15px #fff;
        }

        .wrapper .name {
            font-weight: 600;
            font-size: 1.4rem;
            letter-spacing: 1.3px;
            padding-left: 10px;
            color: #555;
        }

        .wrapper .form-field input {
            width: 100%;
            display: block;
            border: none;
            outline: none;
            background: none;
            font-size: 1.2rem;
            color: #666;
            padding: 10px 15px 10px 10px;
            /* border: 1px solid red; */
        }

        .wrapper .form-field {
            padding-left: 10px;
            margin-bottom: 20px;
            border-radius: 20px;
            box-shadow: inset 8px 8px 8px #cbced1, inset -8px -8px 8px #fff;
        }

        .wrapper .form-field .fas {
            color: #555;
        }

        .wrapper .btn {
            box-shadow: none;
            width: 100%;
            height: 40px;
            background-color: #03A9F4;
            color: #fff;
            border-radius: 25px;
            box-shadow: 3px 3px 3px #b1b1b1,
                -3px -3px 3px #fff;
            letter-spacing: 1.3px;
        }

        .wrapper .btn:hover {
            background-color: #039BE5;
        }

        .wrapper a {
            text-decoration: none;
            font-size: 0.8rem;
            color: #03A9F4;
        }

        .wrapper a:hover {
            color: #039BE5;
        }

        @media(max-width: 380px) {
            .wrapper {
                margin: 30px 20px;
                padding: 40px 15px 15px 15px;
            }
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="logo">
            <img src="assets/img/tarunalogo.png" alt="">
        </div>
        <div class="text-center mt-4 name">
            Selamat Datang
        </div>

        <?php
        if (isset($error)) {
            echo "<div class='alert alert-danger text-center mt-3'>Username atau Password salah!</div>";
        }
        ?>

        <form class="p-3 mt-3" method="post" autocomplete="off">
            <div class="form-field d-flex align-items-center">
                <span class="far fa-user"></span>
                <input type="text" name="username" id="userName" placeholder="Username" required>
            </div>
            <div class="form-field d-flex align-items-center">
                <span class="fas fa-key"></span>
                <input type="password" name="password" id="pwd" placeholder="Password" required>
            </div>
            <div class="form-check mb-2 ms-1">
                <input class="form-check-input" type="checkbox" name="remember" id="rememberMe">
                <label class="form-check-label" for="rememberMe">
                    Remember me
                </label>
            </div>
            <button class="btn mt-3" name="login">Login</button>
        </form>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</body>

</html>