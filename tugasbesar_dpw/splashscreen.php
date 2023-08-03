<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/splashscreen.css">
    <title>Welcome to Javanese Teak Hub</title>
    <style>
    body {
        opacity: 1;
        transition: opacity 0.5s ease;
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="Loading"></div>
    </div>

    <script>
    setTimeout(function() {
        document.body.style.opacity = "1";
        window.location.href = "signin.php";
    }, 5000);
    </script>
</body>

</html>