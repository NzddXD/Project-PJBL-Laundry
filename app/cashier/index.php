<?php
include $_SERVER['DOCUMENT_ROOT'] . '/project/funcs/tampilkanPelanggan_kasir.php';

$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$limit = 5; // Number of rows per page

// Get the total number of customers
$totalPelanggan = getTotalCustomers();
$totalPages = ceil($totalPelanggan / $limit);
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
        <div class="history">
            <h1 class="header-text">Dashboard</h1>
            <div class="container">
                <p>Daftar pelanggan di database: <b><?php echo getTotalCustomers(); ?> entri</b></p>
                <a href="order.php">Lihat Selengkapnya</a>
            </div>
            <div class="history-table">
                <table>
                    <tr>
                        <td>
                            <h4>ID</h4>
                        </td>
                        <td>
                            <h4>Nama</h4>
                        </td>
                        <td>
                            <h4>Email</h4>
                        </td>
                        <td>
                            <h4>Jenis Kelamin</h>
                        </td>
                        <td>
                            <h4>Alamat</h>
                        </td>
                        <td>
                            <h4>Telepon</h>
                        </td>
                    </tr>
                    <?php
                    tampilkanPelanggan($page, $limit);
                    ?>
                </table>
            </div>
        </div>
    </section>
    <script src="../scripts/dashboard.js"></script>
</body>

</html>