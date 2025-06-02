<?php
// include $_SERVER['DOCUMENT_ROOT'] . '/project/funcs/tampilkanPelanggan_kasir.php';
include $_SERVER['DOCUMENT_ROOT'] . '/project/funcs/tampilkanPesanan.php';
include $_SERVER['DOCUMENT_ROOT'] . '/project/funcs/tampilkanTransaksi.php';

$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$limit = 5; // Number of rows per page

// Get the total number of customers
$totalPelanggan = getTotalTransaction();
$totalPages = ceil($totalPelanggan / $limit);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laundry | Dashboard</title>
    <?php include '../../funcs/globalFavIcon.php';?>

    <link rel="stylesheet" href="style/style.css">
</head>

<body>
    <?php include 'sidebar.php'; ?> <!-- Cleaner code -->
    <section class="content">
        <div class="history">
            <h1 class="header-text">Dashboard</h1>
            <div class="container">
                <p>Daftar transaksi di database: <b><?php echo getTotalTransaction(); ?> entri</b></p>
                <a href="transaction.php">Lihat Selengkapnya</a>
            </div>
            <div class="history-table">
                <table>
                    <tr>
                        <td>
                            <h4>No.</h4>
                        </td>
                        <td>
                            <h4>Nama Outlet</h4>
                        </td>
                        <td>
                            <h4>Nama Pelanggan</h4>
                        </td>
                        <td>
                            <h4>Tanggal</h>
                        </td>
                        <td>
                            <h4>Status</h>
                        </td>
                        <td>
                            <h4>Dibayar?</h>
                        </td>
                        <td>
                            <h4>Berat</h>
                        </td>
                        <td>
                            <h4>Nama Paket</h>
                        </td>
                        <td>
                            <h4>Aksi</h4>
                        </td>
                    </tr>
                    <?php
                    tampilkanTransaksiOwnerDanKasir($page, $limit);
                    ?>
                </table>
            </div>
        </div>
    </section>
    <script src="../scripts/dashboard.js"></script>
</body>

</html>