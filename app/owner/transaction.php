<?php
include $_SERVER['DOCUMENT_ROOT'] . '/project/connection/connection.php';
include $_SERVER['DOCUMENT_ROOT'] . '/project/funcs/tampilkanTransaksi.php';

$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$limit = 5; // Number of rows per page

$totalTransaction = getTotalTransaction();
$totalPages = ceil($totalTransaction / $limit);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laundry | Pelanggan</title>
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
            <p id="messageText">Data pelanggan baru telah berhasil didaftarkan.</p>
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
            echo "<script>deleted('../../app/admin/transaction.php')</script>";
        } elseif ($_GET['msg'] === 'error') {
            echo "<script>errorOnDelete('../../app/admin/transaction.php')</script>";
        } elseif ($_GET['msg'] === 'invalid') {
            echo "<script>errorOnDelete()</script>";
        } elseif ($_GET['msg'] === 'updated') {
            echo "<script>updated('../../app/admin/transaction.php')</script>";
        } elseif ($_GET['msg'] === 'error') {
            echo "<script>error()</script>";
        } elseif ($_GET['msg'] === 'invalid') {
            echo "<script>errorOnDelete()</script>";
        }
    }
    ?>
    <?php include 'sidebar.php'; ?> <!-- Cleaner code -->
    <section class="content">
        <h1>Transaksi</h1>
        <div class="text-container">
            <p>Total data Transaksi di Database: <b><?php echo getTotalTransaction(); ?> entri</b></p>
            <!-- <a href="newTransaction.php" class="addbutton">Transaksi Baru</a> -->
        </div>
        <div class="dashboard">
            <table>
                <tr>
                    <td>
                        <h4>No.</h>
                    </td>
                    <td>
                        <h4>Nama Outlet</h4>
                    </td>
                    <td>
                        <h4>Nama Pelanggan</h4>
                    </td>
                    <td>
                        <h4>Tanggal</h4>
                    </td>
                    <td>
                        <h4>Status</h4>
                    </td>
                    <td>
                        <h4>Dibayar?</h4>
                    </td>
                    <td>
                        <h4>Berat</h4>
                    </td>
                    <!-- <td>
                        <h4>Kode Paket</h4>
                    </td> -->
                    <td>
                        <h4>Nama Paket</h4>
                    </td>
                    <td>
                        <h4>Aksi</h4>
                    </td>
                </tr>
                <?php
                // Display transactions for the current page
                tampilkanTransaksiOwnerDanKasir($page, $limit);
                ?>
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