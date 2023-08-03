<?php
include 'connect.php';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];
    $password = $_POST['password'];

    // Cek apakah ada form yang kosong
    if (empty($name) || empty($email) || empty($tel) || empty($password)) {
        header("Location: formscreen.php");
        exit();
    }

    // Cek apakah email atau nomor telepon sudah terdaftar sebelumnya
    $checkQuery = "SELECT * FROM `users` WHERE email='$email' OR tel='$tel'";
    $checkResult = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        header("Location: identityscreen.php");
        exit();
    } else {
        // Email dan nomor telepon belum terdaftar, lanjutkan proses pendaftaran
        // Hash password menggunakan password_hash() dengan algoritma bcrypt
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $sql = "INSERT INTO `users` (name, email, tel, password)
                VALUES ('$name', '$email', '$tel', '$hashedPassword')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            header("Location: splashscreen.php");
            exit(); // Pastikan untuk keluar dari skrip setelah mengalihkan halaman
        } else {
            die(mysqli_error($conn));
        }
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="./assets/css/signup.css">
    <link rel=" stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Pacifico&display=swap"
        rel="stylesheet">
    <title>Daftar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <form method="POST">
            <img style="width: 720px; height: 1024px; left: 0px; top: -150px; position: absolute"
                src="./assets/picture/signinbckground1.png" />
            <div class="form-group">
                <input type="text" class="form-control"
                    style="width: 491px; height: 40px; left: 835px; top: 230px; position: absolute; color: #493535; font-size: 15px; font-family: Overpass; font-weight: 400; background-color: rgba(255, 255, 255, 0.50); border: none; padding: 10px 10px 10px 125px;"
                    name="name" placeholder="Nama Lengkap" value="" />
                <div
                    style="width: 94px; height: 40px; left: 835px; top: 230px; position: absolute; background: #493535">
                </div>
                <div style="width: 34px; height: 20px; left: 865px; top: 234px; position: absolute">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="25" viewBox="0 0 34 34" fill=" none">
                            <path
                                d="M29.7502 14.875H28.3335V13.4583C28.3335 13.0826 28.1842 12.7223 27.9186 12.4566C27.6529 12.1909 27.2926 12.0417 26.9168 12.0417C26.5411 12.0417 26.1808 12.1909 25.9151 12.4566C25.6494 12.7223 25.5002 13.0826 25.5002 13.4583V14.875H24.0835C23.7078 14.875 23.3474 15.0243 23.0818 15.2899C22.8161 15.5556 22.6668 15.9159 22.6668 16.2917C22.6668 16.6674 22.8161 17.0277 23.0818 17.2934C23.3474 17.5591 23.7078 17.7083 24.0835 17.7083H25.5002V19.125C25.5002 19.5007 25.6494 19.8611 25.9151 20.1267C26.1808 20.3924 26.5411 20.5417 26.9168 20.5417C27.2926 20.5417 27.6529 20.3924 27.9186 20.1267C28.1842 19.8611 28.3335 19.5007 28.3335 19.125V17.7083H29.7502C30.1259 17.7083 30.4862 17.5591 30.7519 17.2934C31.0176 17.0277 31.1668 16.6674 31.1668 16.2917C31.1668 15.9159 31.0176 15.5556 30.7519 15.2899C30.4862 15.0243 30.1259 14.875 29.7502 14.875ZM18.8418 17.3117C19.5977 16.6574 20.204 15.8481 20.6196 14.9388C21.0351 14.0295 21.2502 13.0414 21.2502 12.0417C21.2502 10.163 20.5039 8.36137 19.1755 7.03299C17.8471 5.70461 16.0454 4.95833 14.1668 4.95833C12.2882 4.95833 10.4865 5.70461 9.15816 7.03299C7.82977 8.36137 7.0835 10.163 7.0835 12.0417C7.08349 13.0414 7.29855 14.0295 7.71409 14.9388C8.12963 15.8481 8.73593 16.6574 9.49183 17.3117C7.50869 18.2097 5.82616 19.6598 4.64538 21.4888C3.46461 23.3177 2.83558 25.448 2.8335 27.625C2.8335 28.0007 2.98275 28.3611 3.24843 28.6267C3.5141 28.8924 3.87444 29.0417 4.25016 29.0417C4.62589 29.0417 4.98622 28.8924 5.2519 28.6267C5.51757 28.3611 5.66683 28.0007 5.66683 27.625C5.66683 25.3707 6.56236 23.2086 8.15642 21.6146C9.75048 20.0205 11.9125 19.125 14.1668 19.125C16.4212 19.125 18.5832 20.0205 20.1772 21.6146C21.7713 23.2086 22.6668 25.3707 22.6668 27.625C22.6668 28.0007 22.8161 28.3611 23.0818 28.6267C23.3474 28.8924 23.7078 29.0417 24.0835 29.0417C24.4592 29.0417 24.8196 28.8924 25.0852 28.6267C25.3509 28.3611 25.5002 28.0007 25.5002 27.625C25.4981 25.448 24.869 23.3177 23.6883 21.4888C22.5075 19.6598 20.825 18.2097 18.8418 17.3117ZM14.1668 16.2917C13.3263 16.2917 12.5046 16.0424 11.8057 15.5754C11.1067 15.1084 10.562 14.4447 10.2403 13.6681C9.91867 12.8915 9.83451 12.0369 9.99849 11.2125C10.1625 10.3881 10.5673 9.63083 11.1616 9.03646C11.756 8.44208 12.5133 8.03731 13.3377 7.87332C14.1621 7.70934 15.0166 7.7935 15.7932 8.11517C16.5698 8.43685 17.2336 8.98158 17.7006 9.68049C18.1676 10.3794 18.4168 11.2011 18.4168 12.0417C18.4168 13.1688 17.9691 14.2498 17.172 15.0469C16.375 15.8439 15.294 16.2917 14.1668 16.2917Z"
                                fill="white" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <input type="email" class="form-control"
                    style="width: 491px; height: 40px; left: 835px; top: 280px; position: absolute; color: #493535; font-size: 15px; font-family: Overpass; font-weight: 400; background-color: rgba(255, 255, 255, 0.50); border: none; padding: 10px 10px 10px 125px;"
                    name="email" placeholder="Email" value="" />
                <div
                    style="width: 94px; height: 40px; left: 835px; top: 280px; position: absolute; background: #493535">
                </div>
                <div style="width: 34px; height: 34px; left: 865px; top: 284px; position: absolute">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="25" viewBox="0 0 34 34" fill="none">
                            <path
                                d="M24.0835 9.91667H25.5002V11.3333C25.5002 11.7091 25.6494 12.0694 25.9151 12.3351C26.1808 12.6007 26.5411 12.75 26.9168 12.75C27.2926 12.75 27.6529 12.6007 27.9186 12.3351C28.1842 12.0694 28.3335 11.7091 28.3335 11.3333V9.91667H29.7502C30.1259 9.91667 30.4862 9.76741 30.7519 9.50173C31.0176 9.23606 31.1668 8.87572 31.1668 8.5C31.1668 8.12428 31.0176 7.76394 30.7519 7.49827C30.4862 7.23259 30.1259 7.08333 29.7502 7.08333H28.3335V5.66667C28.3335 5.29094 28.1842 4.93061 27.9186 4.66493C27.6529 4.39926 27.2926 4.25 26.9168 4.25C26.5411 4.25 26.1808 4.39926 25.9151 4.66493C25.6494 4.93061 25.5002 5.29094 25.5002 5.66667V7.08333H24.0835C23.7078 7.08333 23.3474 7.23259 23.0818 7.49827C22.8161 7.76394 22.6668 8.12428 22.6668 8.5C22.6668 8.87572 22.8161 9.23606 23.0818 9.50173C23.3474 9.76741 23.7078 9.91667 24.0835 9.91667ZM29.7502 15.5833C29.3744 15.5833 29.0141 15.7326 28.7484 15.9983C28.4827 16.2639 28.3335 16.6243 28.3335 17V25.5C28.3335 25.8757 28.1842 26.2361 27.9186 26.5017C27.6529 26.7674 27.2926 26.9167 26.9168 26.9167H7.0835C6.70777 26.9167 6.34744 26.7674 6.08176 26.5017C5.81609 26.2361 5.66683 25.8757 5.66683 25.5V11.9142L13.9968 20.2583C14.7937 21.0542 15.8739 21.5013 17.0002 21.5013C18.1264 21.5013 19.2066 21.0542 20.0035 20.2583L23.5027 16.7592C23.7694 16.4924 23.9193 16.1306 23.9193 15.7533C23.9193 15.3761 23.7694 15.0143 23.5027 14.7475C23.2359 14.4807 22.8741 14.3309 22.4968 14.3309C22.1196 14.3309 21.7578 14.4807 21.491 14.7475L17.9918 18.2467C17.727 18.5062 17.371 18.6516 17.0002 18.6516C16.6293 18.6516 16.2733 18.5062 16.0085 18.2467L7.66433 9.91667H18.4168C18.7926 9.91667 19.1529 9.76741 19.4186 9.50173C19.6842 9.23606 19.8335 8.87572 19.8335 8.5C19.8335 8.12428 19.6842 7.76394 19.4186 7.49827C19.1529 7.23259 18.7926 7.08333 18.4168 7.08333H7.0835C5.95633 7.08333 4.87532 7.5311 4.07829 8.32813C3.28126 9.12516 2.8335 10.2062 2.8335 11.3333V25.5C2.8335 26.6272 3.28126 27.7082 4.07829 28.5052C4.87532 29.3022 5.95633 29.75 7.0835 29.75H26.9168C28.044 29.75 29.125 29.3022 29.922 28.5052C30.7191 27.7082 31.1668 26.6272 31.1668 25.5V17C31.1668 16.6243 31.0176 16.2639 30.7519 15.9983C30.4862 15.7326 30.1259 15.5833 29.7502 15.5833Z"
                                fill="white" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <input type="tel" class="form-control"
                    style="width: 491px; height: 40px; left: 835px; top: 330px; position: absolute; color: #493535; font-size: 15px; font-family: Overpass; font-weight: 400; background-color: rgba(255, 255, 255, 0.50); border: none; padding: 10px 10px 10px 125px;"
                    name="tel" placeholder="No. Telp" value="" />
                <div
                    style="width: 94px; height: 40px; left: 835px; top: 330px; position: absolute; background: #493535">
                </div>
                <div style="width: 34px; height: 34px; left: 865px; top: 334px; position: absolute">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="25" viewBox="0 0 34 34" fill="none">
                            <path
                                d="M28.9992 12.75C29.2794 12.75 29.5533 12.6669 29.7862 12.5112C30.0192 12.3556 30.2008 12.1343 30.308 11.8755C30.4152 11.6166 30.4433 11.3318 30.3886 11.057C30.334 10.7821 30.199 10.5297 30.0009 10.3316C29.8028 10.1335 29.5504 9.99855 29.2756 9.94389C29.0007 9.88923 28.7159 9.91728 28.457 10.0245C28.1982 10.1317 27.9769 10.3133 27.8213 10.5463C27.6656 10.7792 27.5825 11.0531 27.5825 11.3333C27.5825 11.7091 27.7318 12.0694 27.9974 12.3351C28.2631 12.6007 28.6235 12.75 28.9992 12.75ZM24.7492 12.75C25.0294 12.75 25.3033 12.6669 25.5362 12.5112C25.7692 12.3556 25.9508 12.1343 26.058 11.8755C26.1652 11.6166 26.1933 11.3318 26.1386 11.057C26.084 10.7821 25.949 10.5297 25.7509 10.3316C25.5528 10.1335 25.3004 9.99855 25.0256 9.94389C24.7507 9.88923 24.4659 9.91728 24.207 10.0245C23.9482 10.1317 23.7269 10.3133 23.5713 10.5463C23.4156 10.7792 23.3325 11.0531 23.3325 11.3333C23.3325 11.7091 23.4818 12.0694 23.7474 12.3351C24.0131 12.6007 24.3735 12.75 24.7492 12.75ZM20.4992 12.75C20.7794 12.75 21.0533 12.6669 21.2862 12.5112C21.5192 12.3556 21.7008 12.1343 21.808 11.8755C21.9152 11.6166 21.9433 11.3318 21.8886 11.057C21.834 10.7821 21.699 10.5297 21.5009 10.3316C21.3028 10.1335 21.0504 9.99855 20.7756 9.94389C20.5007 9.88923 20.2159 9.91728 19.957 10.0245C19.6982 10.1317 19.4769 10.3133 19.3213 10.5463C19.1656 10.7792 19.0825 11.0531 19.0825 11.3333C19.0825 11.5194 19.1192 11.7036 19.1903 11.8755C19.2615 12.0473 19.3659 12.2035 19.4974 12.3351C19.629 12.4666 19.7852 12.571 19.957 12.6422C20.1289 12.7134 20.3131 12.75 20.4992 12.75ZM26.7892 18.4167C26.4775 18.4167 26.1517 18.3175 25.84 18.2467C25.2089 18.1076 24.5886 17.9229 23.9842 17.6942C23.327 17.4551 22.6046 17.4675 21.9559 17.729C21.3073 17.9906 20.7784 18.4827 20.4708 19.1108L20.1592 19.7483C18.7772 18.9774 17.505 18.0245 16.3767 16.915C15.2726 15.7872 14.3202 14.5205 13.5433 13.1467L14.1667 12.75C14.7948 12.4425 15.2869 11.9135 15.5485 11.2649C15.81 10.6163 15.8224 9.89388 15.5833 9.23667C15.3584 8.63093 15.1738 8.01096 15.0308 7.38083C14.96 7.055 14.9033 6.74333 14.8608 6.4175C14.6888 5.41963 14.1661 4.51597 13.387 3.86926C12.6078 3.22254 11.6233 2.87528 10.6108 2.89H6.36084C5.76194 2.88922 5.16964 3.01502 4.62276 3.25916C4.07588 3.5033 3.58678 3.86027 3.18751 4.30667C2.7819 4.76354 2.47956 5.30248 2.3011 5.88678C2.12263 6.47107 2.07223 7.08697 2.15334 7.6925C2.89952 13.6241 5.59921 19.1386 9.82657 23.3659C14.0539 27.5933 19.5684 30.293 25.5 31.0392C25.6839 31.0532 25.8686 31.0532 26.0525 31.0392C27.1797 31.0392 28.2607 30.5914 29.0577 29.7944C29.8547 28.9973 30.3025 27.9163 30.3025 26.7892V22.5392C30.2878 21.5506 29.9289 20.5982 29.2877 19.8457C28.6464 19.0933 27.7629 18.5879 26.7892 18.4167ZM27.4833 26.9167C27.4857 27.122 27.4433 27.3254 27.3592 27.5128C27.2751 27.7001 27.1513 27.867 26.9964 28.0017C26.8414 28.1365 26.659 28.2359 26.4617 28.2932C26.2645 28.3505 26.0572 28.3642 25.8542 28.3333C20.5646 27.6431 15.6501 25.2282 11.8717 21.4625C8.09626 17.6585 5.68544 12.7124 5.01501 7.395C4.98423 7.18722 5.00004 6.9752 5.0613 6.77429C5.12255 6.57338 5.22772 6.3886 5.36918 6.23333C5.50035 6.084 5.66148 5.96394 5.84209 5.88095C6.0227 5.79797 6.21876 5.75392 6.41751 5.75167H10.6675C10.997 5.74434 11.3186 5.85208 11.5772 6.05635C11.8358 6.26062 12.0151 6.54864 12.0842 6.87083C12.1408 7.25806 12.2117 7.64056 12.2967 8.01833C12.4603 8.76512 12.6781 9.499 12.9483 10.2142L10.965 11.135C10.7954 11.2128 10.6429 11.3233 10.5161 11.4603C10.3894 11.5972 10.291 11.7578 10.2265 11.9329C10.162 12.1079 10.1327 12.294 10.1403 12.4804C10.1479 12.6669 10.1923 12.8499 10.2708 13.0192C12.3097 17.3864 15.8203 20.897 20.1875 22.9358C20.5324 23.0775 20.9193 23.0775 21.2642 22.9358C21.6157 22.805 21.901 22.5401 22.0575 22.1992L22.95 20.2158C23.6824 20.4777 24.4298 20.6954 25.1883 20.8675C25.5567 20.9525 25.9533 21.0233 26.3358 21.08C26.6554 21.152 26.9402 21.3325 27.1416 21.5908C27.3431 21.8491 27.4488 22.1692 27.4408 22.4967L27.4833 26.9167Z"
                                fill="white" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <input type="password" class="form-control"
                    style="width: 491px; height: 40px; left: 835px; top: 380px; position: absolute; color: #493535; font-size: 15px; font-family: Overpass; font-weight: 400; background-color: rgba(255, 255, 255, 0.50); border: none; padding: 10px 10px 10px 125px;"
                    name="password" placeholder="Password" value="" />
                <div
                    style="width: 94px; height: 40px; left: 835px; top: 380px; position: absolute; background: #493535">
                </div>
                <div style="width: 34px; height: 34px; left: 865px; top: 384px; position: absolute">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="25" viewBox="0 0 34 34" fill="none">
                            <path
                                d="M16.9998 18.4167C16.6241 18.4167 16.2638 18.5659 15.9981 18.8316C15.7324 19.0973 15.5832 19.4576 15.5832 19.8333V24.0833C15.5832 24.4591 15.7324 24.8194 15.9981 25.0851C16.2638 25.3507 16.6241 25.5 16.9998 25.5C17.3756 25.5 17.7359 25.3507 18.0016 25.0851C18.2672 24.8194 18.4165 24.4591 18.4165 24.0833V19.8333C18.4165 19.4576 18.2672 19.0973 18.0016 18.8316C17.7359 18.5659 17.3756 18.4167 16.9998 18.4167ZM24.0832 12.75H12.7498V9.91667C12.7478 9.07543 12.9954 8.25251 13.4614 7.55211C13.9273 6.85172 14.5907 6.30537 15.3674 5.98224C16.1441 5.65912 16.9992 5.57377 17.8245 5.737C18.6497 5.90023 19.408 6.30469 20.0032 6.89917C20.5358 7.44326 20.9167 8.11725 21.1082 8.85417C21.1547 9.03463 21.2363 9.20416 21.3483 9.35308C21.4603 9.502 21.6006 9.6274 21.7611 9.72212C21.9216 9.81683 22.0992 9.87901 22.2837 9.9051C22.4682 9.93119 22.656 9.92068 22.8365 9.87417C23.017 9.82766 23.1865 9.74606 23.3354 9.63403C23.4843 9.522 23.6097 9.38174 23.7045 9.22125C23.7992 9.06076 23.8613 8.88318 23.8874 8.69866C23.9135 8.51414 23.903 8.32629 23.8565 8.14583C23.5338 6.92014 22.8937 5.80116 22.0007 4.90167C21.0093 3.91335 19.7472 3.24096 18.3739 2.9694C17.0007 2.69783 15.5777 2.83927 14.2847 3.37586C12.9918 3.91244 11.8868 4.82011 11.1093 5.98425C10.3319 7.14838 9.9168 8.51679 9.9165 9.91667V12.75C8.78933 12.75 7.70833 13.1978 6.9113 13.9948C6.11427 14.7918 5.6665 15.8728 5.6665 17V26.9167C5.6665 28.0438 6.11427 29.1248 6.9113 29.9219C7.70833 30.7189 8.78933 31.1667 9.9165 31.1667H24.0832C25.2103 31.1667 26.2913 30.7189 27.0884 29.9219C27.8854 29.1248 28.3332 28.0438 28.3332 26.9167V17C28.3332 15.8728 27.8854 14.7918 27.0884 13.9948C26.2913 13.1978 25.2103 12.75 24.0832 12.75ZM25.4998 26.9167C25.4998 27.2924 25.3506 27.6527 25.0849 27.9184C24.8192 28.1841 24.4589 28.3333 24.0832 28.3333H9.9165C9.54078 28.3333 9.18045 28.1841 8.91477 27.9184C8.64909 27.6527 8.49984 27.2924 8.49984 26.9167V17C8.49984 16.6243 8.64909 16.2639 8.91477 15.9983C9.18045 15.7326 9.54078 15.5833 9.9165 15.5833H24.0832C24.4589 15.5833 24.8192 15.7326 25.0849 15.9983C25.3506 16.2639 25.4998 16.6243 25.4998 17V26.9167Z"
                                fill="white" />
                        </svg>
                    </div>
                </div>
            </div>
            <div
                style="left: 877px; top: 50px; position: absolute; text-align: center; color: #493535; font-size: 50px; font-family: Pacifico; font-weight: 400; word-wrap: break-word">
                Javanese Teak Hub</div>
            <div
                style="width: 510px; height: 19px; left: 826px; top: 120px; position: absolute; text-align: center; color: #493535; font-size: 15px; font-family: Overpass; font-weight: 400; word-wrap: break-word">
                Tropis Eksotis | Klasik elegant | Modern Minimalist | Nusantara | Vintage Chic </div>
            <div style="width: 253px; height: 19px; left: 954px; top: 610px; position: absolute; text-align: center">
                <a href="signin.php" class="signup-link">
                    <span
                        style="color: #493535; font-size: 13px; font-family: Overpass; font-weight: 300; word-wrap: break-word">Sudah
                        punya akun? </span><span
                        style="color: #493535; font-size: 13px; font-family: Overpass; font-weight: 700; word-wrap: break-word">Coba
                        masuk yuk...</span>
                </a>
            </div>
            <a class="back-button" href="aboutmesignup.php">Tentang kami</a>
            <div
                style="width: 510px; height: 19px; left: 823px; top: 179px; position: absolute; text-align: center; color: #493535; font-size: 25px; font-family: Overpass; font-weight: 400; word-wrap: break-word">
                Selamat datang</div>
            <button type="submit"
                style="width: 144px; height: 38px; left: 1009px; top: 440px; position: absolute; border-radius: 30px; color: #DDD4CB;"
                name="submit">
                <div id="btn-container"
                    style="width: 144px; height: 38px; left: -2px; top: -1px; position: absolute; background: #493535; border-radius: 30px; transition: background-color 0.3s, transform 0.3s; cursor: pointer;">
                    <div
                        style="width: 78px; height: 22px; left: 33px; top: 10px; position: absolute; text-align: center; color: #DDD4CB; font-size: 15px; font-family: Overpass; font-weight: 700; word-wrap: break-word;">
                        Daftar
                    </div>
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

            <style>
            @keyframes borderAnimation {
                0% {
                    border-bottom: 0 solid #493535;
                }

                100% {
                    border-bottom: 2px solid #493535;
                }
            }
            </style>
            <div
                style="width: 235px; height: 38px; left: 963px; top: 560px; position: absolute; justify-content: center; align-items: center; gap: 12px; display: inline-flex">
                <div id="google-btn"
                    style="width: 235px; height: 38px; position: absolute; justify-content: center; align-items: center; display: inline-flex; cursor: pointer; border-radius: 30px; overflow: hidden; padding: 8px;">
                    <img style="width: 30px; height: 30px" src="./assets/picture/google.png" />
                    <div
                        style="width: 189px; height: 19px; color: #493535; font-size: 15px; font-family: Overpass; font-weight: 300; word-wrap: break-word; padding: 0px 0px 0px 5px; white-space: nowrap;">
                        Daftar dengan akun Google
                    </div>
                </div>
            </div>

            <style>
            #google-btn {
                transition: transform 0.3s;
            }

            #google-btn:hover {
                transform: scale(1.1);
            }
            </style>

            <div style="width: 222.01px; left: 970px; top: 530px; position: absolute">
                <div
                    style="left: 96px; top: 0px; position: absolute; color: #493535; font-size: 15px; font-family: Overpass; font-weight: 700; word-wrap: break-word">
                    atau</div>
                <div
                    style="width: 96.01px; height: 0px; left: -4px; top: 10px; position: absolute; border: 0.50px #493535 solid">
                </div>
                <div
                    style="width: 96.01px; height: 0px; left: 130px; top: 10px; position: absolute; border: 0.50px #493535 solid">
                </div>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
</body>

</html>