<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laundry | Pesanan</title>

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
            <p id="messageText">Data pesanan baru telah berhasil didaftarkan.</p>
            <button class="close-popup" onclick="closePopup()">Tutup</button>
            <!-- <button class="to-dashboard">Dashboard</button> -->
        </div>
    </div>
    
    <!-- Late load -->
     <script src="../scripts/app.js"></script>
     
    <?php
    if (isset($_GET['msg'])) {
        if ($_GET['msg'] === 'success') {
            echo "<script>success()</script>";
        } elseif ($_GET['msg'] === 'duplicate') {
            echo "<script>duplicate()</script>";
        } elseif ($_GET['msg'] === 'error') {
            echo "<script>error()</script>";
        } elseif ($_GET['msg'] === 'invalid') {
            echo "<script>invalid()</script>";
        }
    }
    ?>
    <?php include 'sidebar.php'; ?> <!-- Cleaner code -->
    <section class="content">
        <h1>Pesanan Baru</h1>
        <div class="text-container">
            <p>Tambahkan pesanan baru</p>
            <a href="order.php" class="cancelbutton"><img src="../../assets/back.png" width="20" height="20">  Kembali</a>
        </div>
        <div class="dashboard">
            <form action="../../funcs/tambahPesanan.php" method="POST">
                <label for="id_outlet">Outlet</label>
                <select name="id_outlet" id="id_outlet" required>
                    <option value="" disabled selected>Pilih Outlet</option>
                    <?php

                    include $_SERVER['DOCUMENT_ROOT'] . '/project/connection/connection.php';
                    $outletResult = $connect->query("SELECT id_outlet, nama, alamat FROM tb_outlet");
                    while ($outlet = $outletResult->fetch_assoc()):
                    ?>
                        <option value="<?php echo $outlet['id_outlet']; ?>">
                            <?php echo $outlet['id_outlet'] . " - " . htmlspecialchars($outlet['nama']) . " (" . htmlspecialchars($outlet['alamat']) . ")"; ?>
                        </option>
                    <?php endwhile; ?>
                </select>

                <label for="nama_paket">Nama Paket</label>
                <input type="text" name="nama_paket" id="nama_paket" required>

                <label for="harga">Harga</label>
                <input type="number" name="harga" id="harga" required>

                <label for="jenis">Jenis</label>
                <select name="jenis" id="jenis" required>
                    <option value="kiloan">Kiloan</option>
                    <option value="selimut">Selimut</option>
                    <option value="bed_cover">Bed Cover</option>
                    <option value="kaos">Kaus</option>
                    <option value="lain">Lainnya</option>
                </select>

                <button type="submit" class="addbutton">Simpan</button>
            </form>
        </div>
    </section>

</body>

</html>