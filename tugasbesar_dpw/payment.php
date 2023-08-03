<?php
session_start();
include 'connect.php';

// ... (Code to retrieve $productData and $selectedQuantity from session cart) ...

$payment_message = ''; // Initialize the variable with an empty string

if (isset($_POST['submit_payment'])) {
    $payment_option = $_POST['payment_option'];
    
    // Validate the selected payment option and other fields
    if ($payment_option === 'tunai' || $payment_option === 'masukkan_bayar_ke_ATM') {
        // Proceed with payment confirmation via WhatsApp
        $delivery_service = $_POST['delivery_service'];
        $address = $_POST['address'];

        $payment_message = 'Silakan melakukan pembayaran ' . $payment_option . ' saat produk diterima. Produk akan dikirimkan melalui ' . $delivery_service . ' ke alamat ' . $address . '. Produk akan datang dalam waktu 4-6 hari (dalam pulau jawa) dan 10-15 hari (luar pulau jawa)';
    } else {
        // Invalid payment option selected
        $payment_message = 'Pilihan pembayaran tidak valid.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lanjutkan Pembayaran</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Overpass:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
    body {
        font-family: "Overpass", sans-serif;
        background-color: #DDD4CB;
    }

    .container {
        max-width: 600px;
        margin: 0 auto;
        padding-top: 50px;
    }
    </style>
</head>

<body>
    <!-- Add the form for payment options and delivery details -->
    <div class="container mt-5">
        <h1 class="text-center">Lanjutkan Pembayaran</h1>
        <?php if ($payment_message !== '') { ?>
        <div class="alert alert-success" role="alert"><?php echo $payment_message; ?></div>
        <?php } ?>
        <form action="payment.php" method="post">
            <input type="hidden" name="nama_produk" value="<?php echo $productData['nama_produk']; ?>">
            <input type="hidden" name="jumlah" value="<?php echo $selectedQuantity; ?>">
            <div class="form-group">
                <label for="payment_option">Pilih Metode Pembayaran:</label>
                <select class="form-control" name="payment_option" id="payment_option">
                    <option value="tunai">Tunai</option>
                    <option value="masukkan_bayar_ke_ATM">Masukkan Bayar ke ATM</option>
                </select>
            </div>
            <div class="form-group">
                <label for="delivery_service">Pilih Jasa Pengiriman:</label>
                <select class="form-control" name="delivery_service" id="delivery_service">
                    <option value="JNE">JNE</option>
                    <option value="J&T">J&T</option>
                    <option value="TIKI">TIKI</option>
                    <!-- Add other delivery service options as needed -->
                </select>
            </div>
            <div class="form-group">
                <label for="address">Alamat Pengiriman:</label>
                <textarea class="form-control" name="address" id="address" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary" name="submit_payment">Konfirmasi Pembayaran</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>