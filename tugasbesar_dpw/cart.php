<?php    
session_start();
include 'connect.php';
// Initialize variables to hold the selected product's data and quantity
$productData = null;
$selectedQuantity = 1; // Default quantity

// Check if the form is submitted and process the data
if (isset($_POST['nama_produk']) && isset($_POST['jumlah'])) {
    // Sanitize user input to prevent potential SQL injection
    $nama_produk = $_POST['nama_produk'];
    $jumlah = intval($_POST['jumlah']);
    
    // Fetch data from the database for the selected product
    $sql = "SELECT id_produk, id_pnjl, nama_produk, dkps_produk, harga, stock FROM produk WHERE nama_produk = '$nama_produk'";
    $result = $conn->query($sql);

    // Check if the product exists in the database
    if ($result->num_rows > 0) {
        // Fetch the product data
        $productData = $result->fetch_assoc();
        // Calculate the total price
        $total_harga = $jumlah * $productData['harga'];

        // Check if the form has been submitted with a different quantity (edit quantity)
        if (isset($_POST['update_quantity']) && isset($_POST['updated_quantity'])) {
            // Sanitize and update the quantity
            $updatedQuantity = intval($_POST['updated_quantity']);
            $updatedQuantity = min($updatedQuantity, $productData['stock']); // Ensure the updated quantity does not exceed the available stock
            $selectedQuantity = $updatedQuantity;
            $total_harga = $updatedQuantity * $productData['harga'];
        }
    } else {
        echo "<tr><td colspan='7'>No products found.</td></tr>";
    }
} else {
    echo "<tr><td colspan='7'>No products selected.</td></tr>";
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="./assets/css/home.css">
    <link rel=" stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Pacifico&display=swap"
        rel="stylesheet">
    <title>Keranjang Saya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
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
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
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
    <div class="container mt-5">
        <h1 class="text-center">Products in Cart</h1>
        <table class="table table-bordered table-striped text-center">
            <thead>
                <tr>
                    <th>ID Produk</th>
                    <th>ID Penjual</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Stock</th>
                    <th>Jumlah Pemesanan</th>
                    <th>Total Harga</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($productData) { ?>
                <tr>
                    <td><?php echo $productData['id_produk']; ?></td>
                    <td><?php echo $productData['id_pnjl']; ?></td>
                    <td><?php echo $productData['nama_produk']; ?></td>
                    <td><?php echo $productData['harga']; ?></td>
                    <td><?php echo $productData['stock']; ?></td>
                    <td>
                        <!-- Edit quantity form -->
                        <form action="cart.php" method="post">
                            <input type="hidden" name="nama_produk" value="<?php echo $productData['nama_produk']; ?>">
                            <input type="hidden" name="jumlah" value="<?php echo $selectedQuantity; ?>">
                            <div class="input-group mb-3">
                                <input type="number" name="updated_quantity" value="<?php echo $selectedQuantity; ?>"
                                    min="1" max="<?php echo $productData['stock']; ?>" class="form-control">
                                <button type="submit" class="btn btn-primary" name="update_quantity">Update</button>
                            </div>
                            <?php
                            // Validate and process the updated quantity
                            if (isset($_POST['update_quantity'])) {
                                $updatedQuantity = intval($_POST['updated_quantity']);

                                if ($updatedQuantity > 0 && $updatedQuantity <= $productData['stock']) {
                                    // Quantity is valid, update the displayed quantity and total price
                                    $selectedQuantity = $updatedQuantity;
                                    $total_harga = $updatedQuantity * $productData['harga'];

                                    // Display a success message
                                    echo '<div class="alert alert-success" role="alert">Quantity updated successfully!</div>';
                                } else {
                                        // Display an error message if the quantity is invalid
                                    echo '<div class="alert alert-danger" role="alert">Invalid quantity. Please enter a valid quantity between 1 and ' . $productData['stock'] . '.</div>';
                                }
                            }
                            ?>
                            <div class="form-text">Remaining stock:
                                <?php echo $productData['stock'] - $selectedQuantity; ?></div>
                        </form>
                    </td>
                    <td><?php echo $total_harga; ?></td>
                    <td>
                        <!-- Lanjutkan Pembayaran button -->
                        <form class="mt-3" action="payment.php" method="post">
                            <input type="hidden" name="nama_produk" value="<?php echo $productData['nama_produk']; ?>">
                            <input type="hidden" name="jumlah" value="<?php echo $selectedQuantity; ?>">
                            <button type="submit" class="btn btn-success">Lanjutkan Pembayaran</button>
                        </form>
                        <!-- Batalkan Pesanan button -->
                        <form class="mt-3" action="cancel_order.php" method="post">
                            <input type="hidden" name="nama_produk" value="<?php echo $productData['nama_produk']; ?>">
                            <!-- Include other hidden fields with product details, if needed -->
                            <button type="submit" class="btn btn-danger">Batalkan Pesanan</button>
                        </form>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>

</html>