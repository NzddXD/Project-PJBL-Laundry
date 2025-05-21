<?php
include $_SERVER['DOCUMENT_ROOT'] . '/project/connection/connection.php';

// Dapatkan id dari kueri string
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

// Fetch data transaksi
$stmt = $connect->prepare("SELECT * FROM tb_transaksi WHERE id_transaksi = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

$hasil = $stmt->get_result();
$transaksi = $hasil->fetch_assoc();

// error_log("Edit transaksi id: " . $id);

// Cek jika data ada dengan ID yang ditentukna
if (!$transaksi) {
    echo "Data transaksi tidak ditemukan!";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laundry | Transaksi</title>

    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/customer.css">
</head>

<body>

    <div class="popup">
        <div class="popup-content success">
            <span class="close" onclick="closePopup()">&times;</span>
            <div class="header">
                <img src="../../assets/ok.png" alt="ok" width="25" height="25">
                <h2 id="titleText">Berhasil!</h2>
            </div>
            <p id="messageText">Data transaksi baru telah berhasil didaftarkan.</p>
            <button class="close-popup" onclick="closePopup()">Tutup</button>
            <!-- <button class="to-dashboard">Dashboard</button> -->
        </div>
    </div>

    <!-- Late load -->
    <script src="../scripts/app.js"></script>

    <?php
    if (isset($_GET['msg'])) {
        if ($_GET['msg'] === 'updated') {
            echo "<script>updated()</script>";
        } elseif ($_GET['msg'] === 'error') {
            echo "<script>error()</script>";
        } elseif ($_GET['msg'] === 'invalid') {
            echo "<script>invalid()</script>";
        }
    }
    ?>
    <?php include 'sidebar.php'; ?> <!-- Cleaner code -->
    <section class="content">
        <h1>Edit transaksi</h1>
        <div class="text-container">
            <p>Edit data transaksi.</p>
            <a href="transaction.php" class="cancelbutton"><img src="../../assets/back.png" width="20" height="20">
                Kembali</a>
        </div>
        <div class="dashboard">
            <form action="../../funcs/updateTransaksi.php" method="POST">
                <table>
                    <input type="hidden" name="id_transaksi" value="<?php echo $transaksi['id_transaksi']; ?>" required>
                    <input type="hidden" name="id_outlet" value="<?php echo $transaksi['id_outlet']; ?>" required>
                    <input type="hidden" name="id_member" value="<?php echo $transaksi['id_member']; ?>" required>
                    <input type="hidden" name="id_user" value="<?php echo $transaksi['id_user']; ?>" required>

                    <label for="tgl">Tanggal transaksi</label>
                    <input type="date" name="tgl" id="tgl" value="<?php
                    // Convert to Y-m-d if needed
                    $tgl = $transaksi['tgl'];
                    // If $tgl is not already Y-m-d, convert it:
                    if ($tgl && strpos($tgl, '-') !== 4) { // crude check for non-Y-m-d
                        $tgl = date('Y-m-d', strtotime($tgl));
                    }
                    echo htmlspecialchars($tgl);
                    ?>" required>
                    
                    <label for="status">Status</label>
                    <select name="status" required>
                        <option value="Baru" <?php echo ($transaksi['status']) === 'baru' ? 'selected' : ''; ?>>Baru
                        </option>
                        <option value="Proses" <?php echo ($transaksi['status']) === 'proses' ? 'selected' : ''; ?>>Proses
                        </option>
                        <option value="Selesai" <?php echo ($transaksi['status']) === 'selesai' ? 'selected' : ''; ?>>
                            Selesai</option>
                        <option value="Diambil" <?php echo ($transaksi['status']) === 'diambil' ? 'selected' : ''; ?>>
                            Diambil</option>
                    </select>

                    <label for="dibayar">Dibayar</label>
                    <select name="dibayar" required>
                        <option value="Dibayar" <?php echo ($transaksi['dibayar']) === 'dibayar' ? 'selected' : ''; ?>>
                            Dibayar</option>
                        <option value="Belum_dibayar" <?php echo ($transaksi['dibayar']) === 'belum_dibayar' ? 'selected' : ''; ?>>Belum dibayar</option>
                    </select>
                    <button type="submit" class="addbutton">Simpan</button>
            </form>
        </div>
    </section>

</body>

</html>