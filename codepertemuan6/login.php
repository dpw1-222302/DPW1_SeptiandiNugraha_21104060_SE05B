<?php
// Menginisialisasi session
session_start();

// Cek apakah pengguna sudah login atau belum
if(isset($_SESSION['username'])){
    // Jika sudah login, redirect ke halaman lain atau tampilkan konten yang sesuai
    header("Location: dashboard.php");
    exit;
}

// Mengecek apakah pengguna mengirimkan data melalui form login
if(isset($_POST['login'])){
    // Mendapatkan nilai yang diinputkan oleh pengguna
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Memeriksa apakah username dan password yang dimasukkan valid
    if($username === 'admin' && $password === 'password'){
        // Menyimpan data pengguna ke session
        $_SESSION['username'] = $username;

        // Redirect ke halaman dashboard atau tampilkan konten yang sesuai
        header("Location: dashboard.php");
        exit;
    } else {
        // Jika username atau password tidak valid, tampilkan pesan error
        $error = "Username atau password salah";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Form Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center">Form Login</h1>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <?php if(isset($error)): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $error; ?>
                </div>
                <?php endif; ?>
                <form method="POST">
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <p>"admin"</p>
                        <input type="text" class="form-control" name="username" id="username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <p>"password"</p>
                        <input type="password" class="form-control" name="password" id="password" required>
                    </div>
                    <button type="submit" name="login" class="btn btn-primary">Login</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>