<?php
    include $_SERVER['DOCUMENT_ROOT'] . '/project/connection/connection.php';

    // Dapatkan id dari kueri string
    $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

    // Fetch data pesanan
    $stmt = $connect->prepare("SELECT * FROM tb_paket WHERE id_paket = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $hasil = $stmt->get_result();
    $pesanan = $hasil->fetch_assoc();

    // Cek jika data ada dengan ID yang ditentukna
    if (!$pesanan) {
        echo "Data pesanan tidak ditemukan!";
        exit();
    }

    $outletResult = $connect->query("SELECT id_outlet, nama FROM tb_outlet");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laundry | Pesanan</title>
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
            <p id="messageText">Data Pesanan baru telah berhasil didaftarkan.</p>
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
        <h1>Edit Pesanan</h1>
        <div class="text-container">
            <p>Edit data Pesanan.</p>
            <a href="order.php" class="cancelbutton"><img src="../../assets/back.png" width="20" height="20">  Kembali</a>
        </div>
        <div class="dashboard">
            <form action="../../funcs/updatePesanan.php" method="POST">
                <table>
                    <input type="hidden" name="id_paket" value="<?php echo $pesanan['id_paket']; ?>">

                    <!-- <input type="hidden" name="id_outlet" value="<?php echo $pesanan['id_outlet']; ?>"> -->

                    <label for="id_outlet">Outlet</label>
                    <select name="id_outlet" id="id_outlet" required>
                        <?php while ($outlet = $outletResult->fetch_assoc()) : ?>
                            <option value="<?php echo $outlet['id_outlet']; ?>" <?php echo ($outlet['id_outlet'] === $pesanan['id_outlet']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($outlet['nama']); ?>
                            </option>
                        <?php endwhile; ?>
                    </select>

                    <label for="nama_paket">Nama Pesanan</label>
                    <input type="text" name="nama_paket" id="nama_paket" value="<?php echo htmlspecialchars($pesanan['nama_paket']); ?>" required>

                    <label for="harga">Harga</label>
                    <input type="number" name="harga" id="harga" value="<?php echo htmlspecialchars($pesanan['harga']); ?>" required>

                    <p>Jenis Pesanan</p>
                    <select name="jenis" required>
                        <option value="kiloan" <?php echo ($pesanan['jenis']) === 'kiloan' ? 'selected' : ''; ?>>Kiloan</option>
                        <option value="selimut" <?php echo ($pesanan['jenis']) === 'selimut' ? 'selected' : ''; ?>>Selimut</option>
                        <option value="bed_cover" <?php echo ($pesanan['jenis']) === 'bed_cover' ? 'selected' : ''; ?>>Bed Cover</option>
                        <option value="kaos" <?php echo ($pesanan['jenis']) === 'kaos' ? 'selected' : ''; ?>>Kaus</option>
                        <option value="lain" <?php echo ($pesanan['jenis']) === 'lain' ? 'selected' : ''; ?>>Lainnya</option>
                    </select>
                    <button type="submit" class="addbutton">Simpan</button>
            </form>
        </div>
    </section>

</body>

</html>