<?php
session_start();

if (isset($_POST['nama_produk'])) {
    $nama_produk = $_POST['nama_produk'];

    // Find the index of the product in the cart array
    $index = -1;
    if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
        foreach ($_SESSION['cart'] as $key => $product) {
            if ($product['nama_produk'] === $nama_produk) {
                $index = $key;
                break;
            }
        }
    }

    // Remove the product from the cart array if found
    if ($index !== -1) {
        unset($_SESSION['cart'][$index]);
        $_SESSION['cart'] = array_values($_SESSION['cart']); // Reindex the cart array
    }
}

// Redirect back to the cart page
header("Location: cart.php");
exit();
?>