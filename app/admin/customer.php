<?php
include $_SERVER['DOCUMENT_ROOT'] . '/project/connection/connection.php';
include $_SERVER['DOCUMENT_ROOT'] . '/project/funcs/tampilkanPelanggan.php';

$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$limit = 5; // Number of rows per page

// Get the total number of customers
$totalCustomers = getTotalCustomers();
$totalPages = ceil($totalCustomers / $limit);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laundry | Pelanggan</title>
    <?php include '../../funcs/globalFavIcon.php'; ?>


    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/customer.css">
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
            echo "<script>deleted('../../app/admin/customer.php')</script>";
        } elseif ($_GET['msg'] === 'error') {
            echo "<script>errorOnDelete('../../app/admin/customer.php')</script>";
        } elseif ($_GET['msg'] === 'invalid') {
            echo "<script>errorOnDelete()</script>";
        } elseif ($_GET['msg'] === 'updated') {
            echo "<script>updated('../../app/admin/customer.php')</script>";
        } elseif ($_GET['msg'] === 'error') {
            echo "<script>error()</script>";
        } elseif ($_GET['msg'] === 'invalid') {
            echo "<script>errorOnDelete()</script>";
        }
    }
    ?>
    <?php include 'sidebar.php'; ?> <!-- Cleaner code -->
    <section class="content">
        <h1>Pelanggan</h1>
        <div class="text-container">
            <p>Total data pelanggan di Database: <b><?php echo getTotalCustomers(); ?> entri</b></p>
            <a href="newCustomer.php" class="addbutton">Pelanggan Baru</a>
        </div>
        <div class="dashboard">
            <table>
                <tr>
                    <td>
                        <h4>No.</h>
                    </td>
                    <td>
                        <h4>Nama</h4>
                    </td>
                    <td>
                        <h4>Email</h4>
                    </td>
                    <td>
                        <h4>Jenis Kelamin</h4>
                    </td>
                    <td>
                        <h4>Alamat</h>
                    </td>
                    <td>
                        <h4>Telepon</h4>
                    </td>
                    <td>
                        <h4>Action</h4>
                    </td>
                </tr>
                <?php
                // Display customers for the current page
                tampilkanPelanggan($page, $limit);
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