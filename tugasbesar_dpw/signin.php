<?php
include 'connect.php';

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Cek apakah ada form yang kosong
    if (empty($email) || empty($password)) {
        header("Location: notloginscreen.php");
        exit();
    }

    // Cek apakah email sudah terdaftar sebelumnya
    $checkQuery = "SELECT * FROM `users` WHERE email='$email'";
    $checkResult = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($checkResult) <= 0) {
        // Email tidak ditemukan di database, alihkan ke halaman notloginscreen.php
        header("Location: notloginscreen.php");
        exit();
    } else {
        // Email ditemukan di database
        $user = mysqli_fetch_assoc($checkResult);

        // Bandingkan password yang dimasukkan dengan password di database
        if (password_verify($password, $user['password'])) {
            // Password cocok, login berhasil
            // Lakukan sesuatu, misalnya simpan data session dan alihkan ke halaman selanjutnya
            session_start();
            $_SESSION['email'] = $user['email']; // Change 'user_id' to 'email'
            // Ganti "splashscreenlogin.php" dengan halaman tujuan setelah login berhasil
            header("Location: splashscreenlogin.php");
            exit();
        } else {
            // Password tidak cocok, alihkan kembali ke halaman login dan berikan pesan kesalahan
            header("Location: notloginscreen.php");
            exit();
        }
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="./assets/css/signin.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Pacifico&display=swap"
        rel="stylesheet">
    <title>Masuk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
    <form action="signin.php" method="POST">
        <img style="width: 720px; height: 1024px; left: 0px; top: -150px; position: absolute"
            src="./assets/picture/signinbckground1.png" />
        <div class="form-group">
            <input type="email" name="email"
                style="width: 491px; height: 56px; left: 835px; top: 230px; position: absolute; color: #493535; font-size: 15px; font-family: Overpass; font-weight: 400; background-color: rgba(255, 255, 255, 0.50); border: none; padding: 10px 10px 10px 125px;"
                placeholder="E-Mail" />
            <div style="width: 94px; height: 56px; left: 835px; top: 230px; position: absolute; background: #493535">
            </div>
            <div style="width: 34px; height: 34px; left: 865px; top: 240px; position: absolute">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 34 34" fill="none">
                        <path
                            d="M24.0834 9.91667H25.5V11.3333C25.5 11.7091 25.6493 12.0694 25.915 12.3351C26.1806 12.6007 26.541 12.75 26.9167 12.75C27.2924 12.75 27.6528 12.6007 27.9184 12.3351C28.1841 12.0694 28.3334 11.7091 28.3334 11.3333V9.91667H29.75C30.1258 9.91667 30.4861 9.76741 30.7518 9.50173C31.0175 9.23606 31.1667 8.87572 31.1667 8.5C31.1667 8.12428 31.0175 7.76394 30.7518 7.49827C30.4861 7.23259 30.1258 7.08333 29.75 7.08333H28.3334V5.66667C28.3334 5.29094 28.1841 4.93061 27.9184 4.66493C27.6528 4.39926 27.2924 4.25 26.9167 4.25C26.541 4.25 26.1806 4.39926 25.915 4.66493C25.6493 4.93061 25.5 5.29094 25.5 5.66667V7.08333H24.0834C23.7076 7.08333 23.3473 7.23259 23.0816 7.49827C22.816 7.76394 22.6667 8.12428 22.6667 8.5C22.6667 8.87572 22.816 9.23606 23.0816 9.50173C23.3473 9.76741 23.7076 9.91667 24.0834 9.91667ZM29.75 15.5833C29.3743 15.5833 29.014 15.7326 28.7483 15.9983C28.4826 16.2639 28.3334 16.6243 28.3334 17V25.5C28.3334 25.8757 28.1841 26.2361 27.9184 26.5017C27.6528 26.7674 27.2924 26.9167 26.9167 26.9167H7.08337C6.70765 26.9167 6.34732 26.7674 6.08164 26.5017C5.81596 26.2361 5.66671 25.8757 5.66671 25.5V11.9142L13.9967 20.2583C14.7936 21.0542 15.8738 21.5013 17 21.5013C18.1263 21.5013 19.2065 21.0542 20.0034 20.2583L23.5025 16.7592C23.7693 16.4924 23.9192 16.1306 23.9192 15.7533C23.9192 15.3761 23.7693 15.0143 23.5025 14.7475C23.2358 14.4807 22.874 14.3309 22.4967 14.3309C22.1194 14.3309 21.7576 14.4807 21.4909 14.7475L17.9917 18.2467C17.7269 18.5062 17.3709 18.6516 17 18.6516C16.6292 18.6516 16.2732 18.5062 16.0084 18.2467L7.66421 9.91667H18.4167C18.7924 9.91667 19.1528 9.76741 19.4184 9.50173C19.6841 9.23606 19.8334 8.87572 19.8334 8.5C19.8334 8.12428 19.6841 7.76394 19.4184 7.49827C19.1528 7.23259 18.7924 7.08333 18.4167 7.08333H7.08337C5.9562 7.08333 4.8752 7.5311 4.07817 8.32813C3.28114 9.12516 2.83337 10.2062 2.83337 11.3333V25.5C2.83337 26.6272 3.28114 27.7082 4.07817 28.5052C4.8752 29.3022 5.9562 29.75 7.08337 29.75H26.9167C28.0439 29.75 29.1249 29.3022 29.9219 28.5052C30.7189 27.7082 31.1667 26.6272 31.1667 25.5V17C31.1667 16.6243 31.0175 16.2639 30.7518 15.9983C30.4861 15.7326 30.1258 15.5833 29.75 15.5833Z"
                            fill="white" />
                    </svg>
                </div>
            </div>
        </div>
        <div class="form-group">
            <input type="password" name="password"
                style="width: 491px; height: 56px; left: 835px; top: 330px; position: absolute; color: #493535; font-size: 15px; font-family: Overpass; font-weight: 400; background-color: rgba(255, 255, 255, 0.50); border: none; padding: 10px 10px 10px 125px;"
                placeholder="Password" />
            <div style="width: 94px; height: 56px; left: 835px; top: 330px; position: absolute; background: #493535">
            </div>
            <div style="width: 34px; height: 34px; left: 865px; top: 340px; position: absolute">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 34 34" fill="none">
                        <path
                            d="M17 18.4167C16.6242 18.4167 16.2639 18.5659 15.9982 18.8316C15.7325 19.0973 15.5833 19.4576 15.5833 19.8333V24.0833C15.5833 24.4591 15.7325 24.8194 15.9982 25.0851C16.2639 25.3507 16.6242 25.5 17 25.5C17.3757 25.5 17.736 25.3507 18.0017 25.0851C18.2674 24.8194 18.4166 24.4591 18.4166 24.0833V19.8333C18.4166 19.4576 18.2674 19.0973 18.0017 18.8316C17.736 18.5659 17.3757 18.4167 17 18.4167ZM24.0833 12.75H12.75V9.91667C12.7479 9.07543 12.9955 8.25251 13.4615 7.55211C13.9275 6.85172 14.5908 6.30537 15.3675 5.98224C16.1442 5.65912 16.9993 5.57377 17.8246 5.737C18.6498 5.90023 19.4081 6.30469 20.0033 6.89917C20.5359 7.44326 20.9168 8.11725 21.1083 8.85417C21.1548 9.03463 21.2364 9.20416 21.3484 9.35308C21.4605 9.502 21.6007 9.6274 21.7612 9.72212C21.9217 9.81683 22.0993 9.87901 22.2838 9.9051C22.4683 9.93119 22.6562 9.92068 22.8366 9.87417C23.0171 9.82766 23.1866 9.74606 23.3355 9.63403C23.4845 9.522 23.6099 9.38174 23.7046 9.22125C23.7993 9.06076 23.8615 8.88318 23.8876 8.69866C23.9136 8.51414 23.9031 8.32629 23.8566 8.14583C23.5339 6.92014 22.8938 5.80116 22.0008 4.90167C21.0094 3.91335 19.7474 3.24096 18.3741 2.9694C17.0008 2.69783 15.5778 2.83927 14.2849 3.37586C12.9919 3.91244 11.8869 4.82011 11.1095 5.98425C10.332 7.14838 9.91692 8.51679 9.91663 9.91667V12.75C8.78946 12.75 7.70845 13.1978 6.91142 13.9948C6.11439 14.7918 5.66663 15.8728 5.66663 17V26.9167C5.66663 28.0438 6.11439 29.1248 6.91142 29.9219C7.70845 30.7189 8.78946 31.1667 9.91663 31.1667H24.0833C25.2105 31.1667 26.2915 30.7189 27.0885 29.9219C27.8855 29.1248 28.3333 28.0438 28.3333 26.9167V17C28.3333 15.8728 27.8855 14.7918 27.0885 13.9948C26.2915 13.1978 25.2105 12.75 24.0833 12.75ZM25.5 26.9167C25.5 27.2924 25.3507 27.6527 25.085 27.9184C24.8194 28.1841 24.459 28.3333 24.0833 28.3333H9.91663C9.5409 28.3333 9.18057 28.1841 8.91489 27.9184C8.64922 27.6527 8.49996 27.2924 8.49996 26.9167V17C8.49996 16.6243 8.64922 16.2639 8.91489 15.9983C9.18057 15.7326 9.5409 15.5833 9.91663 15.5833H24.0833C24.459 15.5833 24.8194 15.7326 25.085 15.9983C25.3507 16.2639 25.5 16.6243 25.5 17V26.9167Z"
                            fill="white" />
                    </svg>
                </div>
            </div>
        </div>
        <div style="width: 253px; height: 19px; left: 954px; top: 600px; position: absolute; text-align: center">
            <a href="signup.php" class="signin-link">
                <span
                    style="color: #493535; font-size: 13px; font-family: Overpass; font-weight: 300; word-wrap: break-word">Belum
                    punya akun? </span>
                <span
                    style="color: #493535; font-size: 13px; font-family: Overpass; font-weight: 700; word-wrap: break-word">Coba
                    buat yuk...</span>
            </a>
        </div>
        <a class="in-button" href="aboutmesignin.php">Tentang kami</a>
        <div
            style="width: 491px; height: 19px; left: 835px; top: 400px; position: absolute; text-align: right; color: #0B666A; font-size: 11px; font-family: Overpass; font-weight: 400; word-wrap: break-word">
            Lupa kata sandi?</div>
        <div
            style="width: 510px; height: 19px; left: 823px; top: 179px; position: absolute; text-align: center; color: #493535; font-size: 25px; font-family: Overpass; font-weight: 400; word-wrap: break-word">
            Selamat datang kembali</div>
        <button type="submit"
            style="width: 144px; height: 38px; left: 1009px; top: 440px; position: absolute; border-radius: 30px"
            name="submit">
            <div id="btn-container"
                style="width: 144px; height: 38px; left: -2px; top: -1px; position: absolute; background: #493535; border-radius: 30px; transition: background-color 0.3s, transform 0.3s; cursor: pointer;">
                <div
                    style="width: 78px; height: 22px; left: 33px; top: 10px; position: absolute; text-align: center; color: #DDD4CB; font-size: 15px; font-family: Overpass; font-weight: 700; word-wrap: break-word;">
                    Masuk</div>
            </div>
        </button>

        <script>
        const btnContainer = document.getElementById("btn-container");

        btnContainer.addEventListener("click", () => {
            btnContainer.style.backgroundColor = "#846c6c";
            btnContainer.style.transform = "scale(0.95)";
        });

        btnContainer.addEventListener("transitionend", () => {
            btnContainer.style.backgroundColor = "#493535";
            btnContainer.style.transform = "scale(1)";
        });
        </script>
    </form>
</body>

</html>