<?php
session_start();


// Menghapus semua cookie
foreach ($_COOKIE as $name => $value) {
    setcookie($name, '', time() - 3600, '/');
}



// Check if the user is logged in
if (!isset($_SESSION['login'])) {
    echo "<script>
        document.location.href = 'login.php';
    </script>";
    exit();
}



//destroy the session




$_SESSION = [];
session_destroy();
header("Location: login.php");
exit();
