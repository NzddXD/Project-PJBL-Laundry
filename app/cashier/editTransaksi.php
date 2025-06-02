<?php
include $_SERVER['DOCUMENT_ROOT'] . '/project/connection/connection.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

// Fetch data transaksi + detail
$stmt = $connect->prepare(
    "SELECT t.*, d.id_paket, d.berat
     FROM tb_transaksi t
     LEFT JOIN tb_detail_transaksi d ON t.id_transaksi = d.id_transaksi
     WHERE t.id_transaksi = ?"
);
$stmt->bind_param("i", $id);
$stmt->execute();
$hasil = $stmt->get_result();
$transaksi = $hasil->fetch_assoc();

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
    <?php include '../../funcs/globalFavIcon.php';?>

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
                        <option value="Baru" <?php echo ($transaksi['status']) === 'Baru' ? 'selected' : ''; ?>>Baru</option>
                        <option value="Proses" <?php echo ($transaksi['status']) === 'Proses' ? 'selected' : ''; ?>>Proses</option>
                        <option value="Selesai" <?php echo ($transaksi['status']) === 'Selesai' ? 'selected' : ''; ?>>Selesai</option>
                        <option value="Diambil" <?php echo ($transaksi['status']) === 'Diambil' ? 'selected' : ''; ?>>Diambil</option>
                    </select>

                    <label for="dibayar">Dibayar</label>
                    <select name="dibayar" required>
                        <option value="Dibayar" <?php echo ($transaksi['dibayar']) === 'Dibayar' ? 'selected' : ''; ?>>Dibayar</option>
                        <option value="Belum dibayar" <?php echo ($transaksi['dibayar']) === 'Belum dibayar' ? 'selected' : ''; ?>>Belum dibayar</option>
                    </select>
                    
                    <!-- Outlet Dropdown -->
                    <label for="id_outlet">Outlet</label>
                    <select name="id_outlet" id="id_outlet" required>
                        <?php
                        $outletResult = $connect->query("SELECT id_outlet, nama FROM tb_outlet");
                        while ($outlet = $outletResult->fetch_assoc()):
                        ?>
                            <option value="<?php echo $outlet['id_outlet']; ?>"
                                <?php if ($outlet['id_outlet'] == $transaksi['id_outlet']) echo 'selected'; ?>>
                                <?php echo htmlspecialchars($outlet['nama']); ?>
                            </option>
                        <?php endwhile; ?>
                    </select>

                    <!-- Pelanggan Dropdown -->
                    <label for="id_member">Pelanggan</label>
                    <select name="id_member" id="id_member" required>
                        <?php
                        $memberResult = $connect->query("SELECT id_member, nama FROM tb_member");
                        while ($member = $memberResult->fetch_assoc()):
                        ?>
                            <option value="<?php echo $member['id_member']; ?>"
                                <?php if ($member['id_member'] == $transaksi['id_member']) echo 'selected'; ?>>
                                <?php echo htmlspecialchars($member['nama']); ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                    
                    <!-- Paket Dropdown -->
                    <label for="id_paket">Paket</label>
                    <select name="id_paket" id="id_paket" required>
                        <?php
                        $paketResult = $connect->query("SELECT id_paket, nama_paket FROM tb_paket");
                        while ($paket = $paketResult->fetch_assoc()):
                        ?>
                            <option value="<?php echo $paket['id_paket']; ?>"
                                <?php if ($paket['id_paket'] == $transaksi['id_paket']) echo 'selected'; ?>>
                                <?php echo htmlspecialchars($paket['nama_paket']); ?>
                            </option>
                        <?php endwhile; ?>
                    </select>

                    <!-- Berat -->
                    <label for="berat">Berat (kg)</label>
                    <input type="number" step="0.01" name="berat" id="berat" value="<?php echo htmlspecialchars($transaksi['berat']); ?>" required>

                    <button type="submit" class="addbutton">Simpan</button>
            </form>
        </div>
    </section>

</body>

</html>