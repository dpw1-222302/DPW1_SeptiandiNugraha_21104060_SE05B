<?php
// Menginisialisasi session
session_start();

// Mengecek apakah pengguna belum login
if (!isset($_SESSION['username'])) {
    // Jika belum login, redirect ke halaman login atau tampilkan pesan peringatan
    header("Location: login.php");
    exit;
}

// Mengambil data pengguna dari session
$username = $_SESSION['username'];

// Mengambil data pengguna dari cookie
$cookieUsername = isset($_COOKIE['username']) ? $_COOKIE['username'] : '';

// Fungsi untuk menyimpan file
function saveFile($file)
{
    // Mendapatkan informasi file yang diunggah
    $fileName = $file['name'];
    $fileTmp = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];

    // Memeriksa apakah tidak ada error saat mengunggah file
    if ($fileError === 0) {
        // Tentukan direktori penyimpanan file
        $uploadDir = 'uploads/';

        // Generate nama unik untuk file yang diunggah
        $uniqueName = uniqid() . '_' . $fileName;

        // Pindahkan file yang diunggah ke direktori penyimpanan
        if (move_uploaded_file($fileTmp, $uploadDir . $uniqueName)) {
            return "File berhasil diunggah!";
        } else {
            return "Gagal mengunggah file.";
        }
    } else {
        return "Terjadi kesalahan saat mengunggah file.";
    }
}

// Cek apakah ada file yang diunggah
if (isset($_FILES['file'])) {
    $file = $_FILES['file'];
    $uploadResult = saveFile($file);
    echo $uploadResult;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Dashboard</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <h1 class="text-center">Selamat datang, <?php echo $username; ?></h1>
        <?php if ($cookieUsername): ?>
        <div class="alert alert-info" role="alert">
            Anda login menggunakan cookie dengan username: <?php echo $cookieUsername; ?>
        </div>
        <?php endif; ?>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Konten Dashboard</div>
                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="file">Pilih file:</label>
                                <input type="file" class="form-control-file" name="file" id="file" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Unggah</button>
                        </form>
                        <a class="nav-link" href="logout.php">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>