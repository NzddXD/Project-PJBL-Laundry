<?php
include $_SERVER['DOCUMENT_ROOT'] . '/project/connection/connection.php';
include $_SERVER['DOCUMENT_ROOT'] . '/project/funcs/tampilkanPesanan.php';

$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$limit = 5; // Number of rows per page

// Get the total number of customers
$totalOrder = getTotalOrder();
$totalPages = ceil($totalOrder / $limit);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laundry | Pesanan</title>
    <?php include '../../funcs/globalFavIcon.php';?>

    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/order.css">
</head>

<body>
    <div class="popup deleteConfirmation">
        <div class="popup-content">
            <span class="close" onclick="closePopup()">&times;</span>
            <div class="header">
                <img src="../../assets/info.png" alt="ok" width="29" height="29">
                <h2 id="titleText">Konfirmasi</h2>
            </div>
            <p id="messageText">Data pesanan baru telah berhasil didaftarkan.</p>
            <div class="choices">
                <button class="close-popup" onclick="closePopup()">Batal</button>
                <button class="delete-button">Hapus</button>
            </div>
        </div>
    </div>
    <script src="../scripts/app.js"></script>
    <?php
    if (isset($_GET['msg'])) {
        if ($_GET['msg'] === 'deleted') {
            echo "<script>deleted('../../app/admin/order.php')</script>";
        } elseif ($_GET['msg'] === 'error') {
            echo "<script>errorOnDelete()</script>";
        } elseif ($_GET['msg'] === 'invalid') {
            echo "<script>errorOnDelete()</script>";
        } elseif ($_GET['msg'] === 'updated') {
            echo "<script>updated('../../app/admin/order.php')</script>";
        } elseif ($_GET['msg'] === 'error') {
            echo "<script>error('../../app/admin/order.php')</script>";
        } elseif ($_GET['msg'] === 'invalid') {
            echo "<script>errorOnDelete()</script>";
        }
    }
    ?>
    <?php include 'sidebar.php'; ?> <!-- Cleaner code -->
    <section class="content">
        <h1>Paket</h1>
        <div class="text-container">
            <p>Total data paket di Database: <b><?php echo getTotalOrder(); ?> entri</b></p>
            <a href="newOrder.php" class="addbutton">Pesanan Baru</a>
        </div>
        <div class="dashboard">
            <table>
                <tr>
                    <td>
                        <h4>No.</h4>
                    </td>
                    <td>
                        <h4>Nama Outlet</h4>
                    </td>
                    <td>
                        <h4>Jenis Paket</h4>
                    </td>
                    <td>
                        <h4>Nama Paket</h>
                    </td>
                    <td>
                        <h4>Kode Paket</h>
                    </td>
                    <td>
                        <h4>Harga</h>
                    </td>
                    <td>
                        <h4>Action</h>
                    </td>
                </tr>
                <tr>
                    <?php
                    tampilkanPesanan($page, $limit);
                    ?>
                </tr>
            </table>
        </div>
        <div class="pagination">
            <?php if ($page > 1): ?>
                <a href="?page=<?php echo $page - 1; ?>" class="prev">Previous</a>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a href="?page=<?php echo $i; ?>" class="<?php echo ($i == $page) ? 'active' : ''; ?>">
                    <?php echo $i; ?>
                </a>
            <?php endfor; ?>

            <?php if ($page < $totalPages): ?>
                <a href="?page=<?php echo $page + 1; ?>" class="next">Next</a>
            <?php endif; ?>
        </div>
    </section>
</body>

</html>