<?php
// Menginisialisasi session
session_start();

// Menghapus data session
session_unset();
session_destroy();

// Menghapus cookie
setcookie('username', '', time()-3600, '/');

// Redirect ke halaman login atau tampilkan pesan logout berhasil
header("Location: login.php");
exit;
?>

<!DOCTYPE html>
<html>

<head>
    <title>Logout</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center">Logout</h1>
        <div class="alert alert-success" role="alert">
            Anda telah berhasil logout.
        </div>
        <p class="text-center">Klik <a href="login.php">di sini</a> untuk kembali ke halaman login.</p>
    </div>
</body>

</html>