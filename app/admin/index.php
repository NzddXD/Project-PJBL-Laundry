<?php
include $_SERVER['DOCUMENT_ROOT'] . '/project/funcs/tampilkanPesanan.php';

$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$limit = 3; // Number of rows per page

// Get the total number of customers
$totalOrder = getTotalOrder();
$totalPages = ceil($totalOrder / $limit);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laundry | Dashboard</title>

    <link rel="stylesheet" href="style/style.css">
</head>

<body>
    <?php include 'sidebar.php'; ?> <!-- Cleaner code -->
    <section class="content">
        <h1>Dashboard</h1>
        <div class="dashboard x">
            <div class="status-details">
                <div class="status">
                    <img src="../../assets/clock.png" alt="clock" width="45" height="45">
                    <div class="status-text">
                        <p>Cucian Menunggu</p>
                        <h2>100</h2>
                    </div>
                </div>
                <div class="status">
                    <img src="../../assets/user.png" alt="user" width="45" height="45">
                    <div class="status-text">
                        <p>Total Pelanggan</p>
                        <h2><?php include_once '../../funcs/hitungPelanggan.php'; echo getCustomer(); ?></h2>
                    </div>

                </div>
                <div class="status">
                    <img src="../../assets/mail.png" alt="mail" width="45" height="45">
                    <div class="status-text">
                        <p>Total Pesanan</p>
                        <h2><?php include_once '../../funcs/hitungPesanan.php'; echo getOrder(); ?></h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="history">
            <h2 class="history-text">Paket pesanan</h2>
            <div class="container">
                <p>Daftar paket pesanan</p>
                <a href="order.php">Lihat Selengkapnya</a>
            </div>
            <div class="history-table">
                <table>
                <tr>
                    <td>
                        <h4>ID Paket</h4>
                    </td>
                    <td>
                        <h4>ID Outlet</h4>
                    </td>
                    <td>
                        <h4>Jenis</h4>
                    </td>
                    <td>
                        <h4>Nama Paket</h>
                    </td>
                    <td>
                        <h4>Harga</h>
                    </td>
                </tr>
                <tr>
                    <?php
                    tampilDashboardPesanan($page, $limit);
                    ?>
                </tr>
            </table>
            </div>
        </div>
    </section>
    <script src="../scripts/dashboard.js"></script>
</body>

</html>