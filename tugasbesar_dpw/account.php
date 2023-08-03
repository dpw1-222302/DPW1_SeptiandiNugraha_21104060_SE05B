<!doctype html>
<html lang="en">
<!doctype html>
<html lang="en">
<?php
// Kredensial database
$host = 'localhost'; // Ganti dengan host database Anda
$dbname = 'javaneseteakhubdata'; // Ganti dengan nama database Anda
$username = 'root'; // Ganti dengan username database Anda
$password = ''; // Ganti dengan password database Anda

try {
    // Membuat instance PDO baru
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);

    // Mengatur atribut PDO
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    // Kini Anda terhubung ke database!
    // Anda dapat melakukan operasi database menggunakan objek $pdo.
} catch (PDOException $e) {
    // Jika terjadi kesalahan pada koneksi, tangani di bagian ini
    die("Koneksi gagal coba lagi: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_lengkap = $_POST["nama_lengkap"];
    $tanggal_lahir = $_POST["tanggal_lahir"];
    $nomor_telepon = $_POST["nomor_telepon"];
    $ibu_kandung = $_POST["ibu_kandung"];
    
    $email = $_POST["email"];

    try {
        $sql = "INSERT INTO userr_detail (nama_lengkap, tanggal_lahir, ibu_kandung, nomor_telepon, email) 
                VALUES (:nama_lengkap, :tanggal_lahir, :ibu_kandung, :nomor_telepon, :email)";

        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':nama_lengkap', $nama_lengkap);
        $stmt->bindParam(':tanggal_lahir', $tanggal_lahir);
        $stmt->bindParam(':nomor_telepon', $nomor_telepon);
        $stmt->bindParam(':ibu_kandung', $ibu_kandung);
        $stmt->bindParam(':email', $email);

        $stmt->execute();

        echo "Data berhasil disimpan ke dalam database.";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="./assets/css/account.css">
    <link rel=" stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Pacifico&display=swap"
        rel="stylesheet">
    <title>Akun Saya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
    <form method="post">
        <nav class="navbar navbar-expand-lg fixed-top" style="background-color: #ddd4cb;">
            <div class="container-fluid">
                <a class="navbar-brand" href="./home.php">
                    <div
                        style="width: 100%; height: 100%; padding-top: 8.25px; padding-bottom: 8.25px; justify-content: center; align-items: center; display: inline-flex">
                        <div
                            style="width: 235px; height: 16.50px; text-align: center; color: #493535; font-size: 25px; font-family: Pacifico; font-weight: 400; word-wrap: break-word">
                            Javanese Teak Hub</div>
                    </div>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-link" aria-current="page" href="home.php">
                            <div style="width: 100%; height: 100%; left: -400px; top: 10px; position: relative">
                                <div
                                    style="width: 75.59px; height: 11.15px; left: 18.32px; top: 5px; position: absolute; text-align: center; color: #493535; font-size: 15px; font-family: Overpass; font-weight: 400; word-wrap: break-word">
                                    Beranda</div>
                                <div
                                    style="width: 113px; height: 27px; left: 0px; top: 0px; position: absolute; border-radius: 10px; border: 1px #493535 solid">
                                </div>
                            </div>
                        </a>
                        <a class="nav-link" href="product.php">
                            <div style="width: 100%; height: 100%; left: -280px; top: 10px; position: relative">
                                <div
                                    style="width: 75.59px; height: 11.15px; left: 18.32px; top: 5px; position: absolute; text-align: center; color: #493535; font-size: 15px; font-family: Overpass; font-weight: 400; word-wrap: break-word">
                                    Produk</div>
                                <div
                                    style="width: 113px; height: 27px; left: 0px; top: 0px; position: absolute; border-radius: 10px; border: 1px #493535 solid">
                                </div>
                            </div>
                        </a>
                        <a class="nav-link" href="account.php">
                            <div style="width: 100%; height: 100%; left: -160px; top: 10px; position: relative">
                                <div
                                    style="width: 75.59px; height: 11.15px; left: 18.32px; top: 5px; position: absolute; text-align: center; color: #493535; font-size: 15px; font-family: Overpass; font-weight: 400; word-wrap: break-word">
                                    Akun Saya</div>
                                <div
                                    style="width: 113px; height: 27px; left: 0px; top: 0px; position: absolute; border-radius: 10px; border: 1px #493535 solid">
                                </div>
                            </div>
                        </a>
                        <a class="nav-link" href="cart.php">
                            <div style="width: 80%; height: 100%; left: -30px; position: relative">
                                <img style="width: 100%; height: 100%;" src="./assets/picture/image12.png" />
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </nav>
        <div class="container"
            style="width: 100%; height: 100%; position: relative; background: #DDD4CB; margin-top: -15%;  margin-bottom: 5%; margin-left: -15%;">
            <div style="width: 24px; height: 24px; left: 103px; top: 273px; position: absolute">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path
                        d="M21 10C21 17 12 23 12 23C12 23 3 17 3 10C3 7.61305 3.94821 5.32387 5.63604 3.63604C7.32387 1.94821 9.61305 1 12 1C14.3869 1 16.6761 1.94821 18.364 3.63604C20.0518 5.32387 21 7.61305 21 10Z"
                        stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    <path
                        d="M12 13C13.6569 13 15 11.6569 15 10C15 8.34315 13.6569 7 12 7C10.3431 7 9 8.34315 9 10C9 11.6569 10.3431 13 12 13Z"
                        stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>
            <div style="width: 24px; height: 24px; left: 103px; top: 322px; position: absolute">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path
                        d="M6 2L3 6V20C3 20.5304 3.21071 21.0391 3.58579 21.4142C3.96086 21.7893 4.46957 22 5 22H19C19.5304 22 20.0391 21.7893 20.4142 21.4142C20.7893 21.0391 21 20.5304 21 20V6L18 2H6Z"
                        stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    <path
                        d="M16 10C16 11.0609 15.5786 12.0783 14.8284 12.8284C14.0783 13.5786 13.0609 14 12 14C10.9391 14 9.92172 13.5786 9.17157 12.8284C8.42143 12.0783 8 11.0609 8 10"
                        stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M3 6H21" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>
            <div style="width: 24px; height: 24px; left: 103px; top: 371px; position: absolute">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path
                        d="M11.9999 8C11.2088 8 10.4355 8.2346 9.77766 8.67412C9.11986 9.11365 8.60717 9.73836 8.30442 10.4693C8.00167 11.2002 7.92246 12.0044 8.0768 12.7804C8.23114 13.5563 8.6121 14.269 9.17151 14.8284C9.73092 15.3878 10.4437 15.7688 11.2196 15.9231C11.9955 16.0775 12.7998 15.9983 13.5307 15.6955C14.2616 15.3928 14.8863 14.8801 15.3258 14.2223C15.7653 13.5645 15.9999 12.7911 15.9999 12C15.9999 10.9391 15.5785 9.92172 14.8284 9.17157C14.0782 8.42143 13.0608 8 11.9999 8ZM11.9999 14C11.6044 14 11.2177 13.8827 10.8888 13.6629C10.5599 13.4432 10.3036 13.1308 10.1522 12.7654C10.0008 12.3999 9.9612 11.9978 10.0384 11.6098C10.1155 11.2219 10.306 10.8655 10.5857 10.5858C10.8654 10.3061 11.2218 10.1156 11.6098 10.0384C11.9977 9.96126 12.3999 10.0009 12.7653 10.1522C13.1308 10.3036 13.4431 10.56 13.6629 10.8889C13.8826 11.2178 13.9999 11.6044 13.9999 12C13.9999 12.5304 13.7892 13.0391 13.4142 13.4142C13.0391 13.7893 12.5304 14 11.9999 14ZM21.7099 11.29L19.3599 9V5.64C19.3599 5.37478 19.2546 5.12043 19.067 4.93289C18.8795 4.74536 18.6252 4.64 18.3599 4.64H15.0499L12.7099 2.29C12.617 2.19627 12.5064 2.12188 12.3845 2.07111C12.2627 2.02034 12.132 1.9942 11.9999 1.9942C11.8679 1.9942 11.7372 2.02034 11.6154 2.07111C11.4935 2.12188 11.3829 2.19627 11.2899 2.29L8.99994 4.64H5.63994C5.37472 4.64 5.12037 4.74536 4.93283 4.93289C4.7453 5.12043 4.63994 5.37478 4.63994 5.64V9L2.28994 11.29C2.19621 11.383 2.12182 11.4936 2.07105 11.6154C2.02028 11.7373 1.99414 11.868 1.99414 12C1.99414 12.132 2.02028 12.2627 2.07105 12.3846C2.12182 12.5064 2.19621 12.617 2.28994 12.71L4.63994 15.05V18.36C4.63994 18.6252 4.7453 18.8796 4.93283 19.0671C5.12037 19.2546 5.37472 19.36 5.63994 19.36H8.99994L11.3399 21.71C11.4329 21.8037 11.5435 21.8781 11.6654 21.9289C11.7872 21.9797 11.9179 22.0058 12.0499 22.0058C12.182 22.0058 12.3127 21.9797 12.4345 21.9289C12.5564 21.8781 12.667 21.8037 12.7599 21.71L15.0999 19.36H18.4099C18.6752 19.36 18.9295 19.2546 19.117 19.0671C19.3046 18.8796 19.4099 18.6252 19.4099 18.36V15.05L21.7599 12.71C21.8505 12.6138 21.921 12.5006 21.9676 12.3769C22.0141 12.2533 22.0356 12.1216 22.031 11.9896C22.0264 11.8575 21.9956 11.7277 21.9405 11.6077C21.8854 11.4876 21.807 11.3796 21.7099 11.29ZM17.6599 13.93C17.5655 14.0226 17.4903 14.1331 17.4388 14.2549C17.3873 14.3768 17.3605 14.5077 17.3599 14.64V17.36H14.6399C14.5076 17.3605 14.3767 17.3873 14.2549 17.4388C14.133 17.4903 14.0226 17.5655 13.9299 17.66L11.9999 19.59L10.0699 17.66C9.97732 17.5655 9.86688 17.4903 9.745 17.4388C9.62313 17.3873 9.49225 17.3605 9.35994 17.36H6.63994V14.64C6.63939 14.5077 6.61259 14.3768 6.56109 14.2549C6.5096 14.1331 6.43443 14.0226 6.33994 13.93L4.40994 12L6.33994 10.07C6.43443 9.97739 6.5096 9.86694 6.56109 9.74507C6.61259 9.62319 6.63939 9.49231 6.63994 9.36V6.64H9.35994C9.49225 6.63945 9.62313 6.61265 9.745 6.56115C9.86688 6.50966 9.97732 6.43449 10.0699 6.34L11.9999 4.41L13.9299 6.34C14.0226 6.43449 14.133 6.50966 14.2549 6.56115C14.3767 6.61265 14.5076 6.63945 14.6399 6.64H17.3599V9.36C17.3605 9.49231 17.3873 9.62319 17.4388 9.74507C17.4903 9.86694 17.5655 9.97739 17.6599 10.07L19.5899 12L17.6599 13.93Z"
                        fill="black" />
                </svg>
            </div>
            <div style="width: 138px; height: 37px; left: 103px; top: 220px; position: absolute; background: white">
            </div>
            <div style="width: 24px; height: 24px; left: 105px; top: 224px; position: absolute">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path
                        d="M20 21V19C20 17.9391 19.5786 16.9217 18.8284 16.1716C18.0783 15.4214 17.0609 15 16 15H8C6.93913 15 5.92172 15.4214 5.17157 16.1716C4.42143 16.9217 4 17.9391 4 19V21"
                        stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    <path
                        d="M12 11C14.2091 11 16 9.20914 16 7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7C8 9.20914 9.79086 11 12 11Z"
                        stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>
            <div
                style="width: 1031px; height: 620px; left: 323px; top: 190px; position: absolute; background: rgba(255, 255, 255, 0.50); box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25); border-radius: 10px">
            </div>
            <div style="width: 137px; height: 37px; left: 1140px; top: 567px; position: absolute">
                <div style="width: 137px; height: 37px; left: 0px; top: 0px; position: absolute;">

                </div>
            </div>
            <div style="width: 137px; height: 37px; left: 1140px; top: 696px; position: absolute">
                <div style="width: 137px; height: 37px; left: 0px; top: 0px; position: absolute;">

                    <button type="submit" name="submit"
                        style="width: 100%; height: 100%; background: #493535; border-radius: 30px; color: #DDD4CB; font-size: 15px; font-family: Overpass; font-weight: 700;">
                        Simpan
                    </button>
    </form>
    </div>
    </div>
    <!-- Kolom Input Pertama -->
    <div
        style="width: 234px; height: 37px; left: 749px; top: 357px; position: absolute; background: rgba(217, 217, 217, 0.30); border: 0.50px rgba(0, 0, 0, 0.30) solid">
        <input type="text"
            style="width: 100%; height: 100%; border: none; background: transparent; padding: 5px; color: #000; font-size: 15px; font-family: Overpass; font-weight: 700;"
            placeholder=" Masukkan teks di sini" name="nama_lengkap">
    </div>

    <!-- Kolom Input Kedua -->
    <div
        style="width: 234px; height: 37px; left: 749px; top: 659px; position: absolute; background: rgba(217, 217, 217, 0.30); border: 0.50px rgba(0, 0, 0, 0.30) solid">
        <input type="text"
            style="width: 100%; height: 100%; border: none; background: transparent; padding: 5px; color: #000; font-size: 15px; font-family: Overpass; font-weight: 700;"
            placeholder="Masukkan teks di sini" name="email">
    </div>

    <!-- Kolom Input Ketiga -->
    <div
        style="width: 234px; height: 37px; left: 1043px; top: 358px; position: absolute; background: rgba(217, 217, 217, 0.30); border: 0.50px rgba(0, 0, 0, 0.30) solid">
        <input type="text"
            style="width: 100%; height: 100%; border: none; background: transparent; padding: 5px; color: #000; font-size: 15px; font-family: Overpass; font-weight: 700;"
            placeholder="Masukkan teks di sini" name="ibu_kandung">
    </div>

    <!-- Kolom Input Keempat -->
    <div
        style="width: 234px; height: 37px; left: 749px; top: 428px; position: absolute; background: rgba(217, 217, 217, 0.30); border: 0.50px rgba(0, 0, 0, 0.30) solid">
        <input type="date" id="input_tanggal"
            style="width: 100%; height: 100%; border: none; background: transparent; padding: 5px; color: #000; font-size: 15px; font-family: Overpass; font-weight: 700;"
            placeholder="Masukkan teks di sini" name="tanggal_lahir">
        <!-- Kolom Input Keempat -->

    </div>


    <!-- Kolom Input Kelima -->
    <div
        style="width: 234px; height: 37px; left: 749px; top: 502px; position: absolute; background: rgba(217, 217, 217, 0.30); border: 0.50px rgba(0, 0, 0, 0.30) solid">
        <input type="text"
            style="width: 100%; height: 100%; border: none; background: transparent; padding: 5px; color: #000; font-size: 15px; font-family: Overpass; font-weight: 700;"
            placeholder="Masukkan teks di sini" name="nomor_telepon">
    </div>

    <div
        style="width: 135px; height: 11px; left: 735px; top: 341px; position: absolute; text-align: center; color: #493535; font-size: 12px; font-family: Overpass; font-weight: 500; word-wrap: break-word">
        Nama Lengkap</div>
    <div
        style="width: 135px; height: 11px; left: 712px; top: 645px; position: absolute; text-align: center; color: #493535; font-size: 12px; font-family: Overpass; font-weight: 500; word-wrap: break-word">
        E- Mail</div>
    <div
        style="width: 135px; height: 11px; left: 732px; top: 408px; position: absolute; text-align: center; color: #493535; font-size: 12px; font-family: Overpass; font-weight: 500; word-wrap: break-word">
        Tanggal Lahir</div>
    <div
        style="width: 135px; height: 11px; left: 735px; top: 482px; position: absolute; text-align: center; color: #493535; font-size: 12px; font-family: Overpass; font-weight: 500; word-wrap: break-word">
        Nomor Telepon</div>
    <div
        style="width: 135px; height: 11px; left: 1045px; top: 341px; position: absolute; text-align: center; color: #493535; font-size: 12px; font-family: Overpass; font-weight: 500; word-wrap: break-word">
        Nama Ibu Kandung</div>
    <div
        style="width: 186px; height: 11px; left: 380px; top: 337px; position: absolute; text-align: center; color: rgba(0, 0, 0, 0.50); font-size: 15px; font-family: Overpass; font-weight: 400; word-wrap: break-word">
        Syarat & ketentuan berlaku</div>
    <div
        style="width: 186px; height: 11px; left: 380px; top: 651px; position: absolute; text-align: center; color: rgba(0, 0, 0, 0.50); font-size: 15px; font-family: Overpass; font-weight: 400; word-wrap: break-word">
        Syarat & ketentuan berlaku</div>
    <div
        style="width: 137px; height: 23px; left: 87px; top: 186px; position: absolute; text-align: center; color: #493535; font-size: 20px; font-family: Overpass; font-weight: 800; word-wrap: break-word">
        Akun saya</div>
    <div
        style="width: 137px; height: 23px; left: 368px; top: 257px; position: absolute; text-align: center; color: #493535; font-size: 20px; font-family: Overpass; font-weight: 800; word-wrap: break-word">
        Detail Akun</div>
    <div
        style="width: 137px; height: 23px; left: 368px; top: 290px; position: absolute; text-align: center; color: #1E1E1E; font-size: 15px; font-family: Overpass; font-weight: 400; word-wrap: break-word">
        Informasi Pribadi</div>
    <div
        style="width: 137px; height: 23px; left: 368px; top: 604px; position: absolute; text-align: center; color: #1E1E1E; font-size: 15px; font-family: Overpass; font-weight: 400; word-wrap: break-word">
        Alamat E-mail</div>
    <div
        style="width: 101px; height: 23px; left: 132px; top: 229px; position: absolute; text-align: center; color: #493535; font-size: 15px; font-family: Overpass; font-weight: 300; word-wrap: break-word">
        Detail Akun</div>
    <div
        style="width: 88px; height: 23px; left: 142px; top: 279px; position: absolute; text-align: center; color: #493535; font-size: 15px; font-family: Overpass; font-weight: 300; word-wrap: break-word">
        Alamat Saya</div>



    <div
        style="width: 97px; height: 23px; left: 142px; top: 326px; position: absolute; text-align: center; color: #493535; font-size: 15px; font-family: Overpass; font-weight: 300; word-wrap: break-word">
        Pesanan Saya</div>
    <div
        style="width: 80px; height: 23px; left: 142px; top: 376px; position: absolute; text-align: center; color: #493535; font-size: 15px; font-family: Overpass; font-weight: 300; word-wrap: break-word">
        Pengaturan</div>
    </div>
    <nav class="navbar-bottom">
        <div class="container-fluid">
            Javanese Teak Hub &copy; 2023. All rights reserved.
        </div>
    </nav>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
</body>

</html>