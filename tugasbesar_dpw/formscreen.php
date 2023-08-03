<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Splashscreen 1</title>
    <style>
    /* CSS untuk efek transisi smooth */
    body {
        margin: 0;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #ddd4cb;
        /* Warna latar belakang */
    }

    .notification {
        font-family: Overpass, sans-serif;
        font-size: 30px;
        background-color: #493535;
        /* Warna notifikasi */
        color: #ddd4cb;
        padding: 15px;
        border-radius: 8px;
        text-align: center;
        animation: fadeIn 2s;
        /* Animasi fade in selama 2 detik saat halaman dimuat */
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            /* Mulai dengan opasitas 0 (tersembunyi) */
        }

        to {
            opacity: 1;
            /* Akhiri dengan opasitas 1 (muncul) */
        }
    }
    </style>
    <script>
    setTimeout(function() {
        window.location.href = "signup.php";
    }, 1500);
    </script>
</head>

<body>
    <div class="notification">Isi semua form</div>
</body>

</html>