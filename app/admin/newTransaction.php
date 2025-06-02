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
        <h1>Transaksi Baru</h1>
        <div class="text-container">
            <p>Tambahkan Transaksi baru</p>
            <a href="transaction.php" class="cancelbutton"><img src="../../assets/back.png" width="20" height="20">  Kembali</a>
        </div>
        <div class="dashboard">
            <form action="../../funcs/tambahTransaksi.php" method="POST">
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

                <label for="id_member">Pelanggan</label>
                <select name="id_member" id="id_member" required>
                    <option value="" disabled selected>Pilih Pelanggan</option>
                    <?php
                    $memberResult = $connect->query("SELECT id_member, nama FROM tb_member");
                    while ($member = $memberResult->fetch_assoc()):
                    ?>
                        <option value="<?php echo $member['id_member']; ?>">
                            <?php echo htmlspecialchars($member['nama']); ?>
                        </option>
                    <?php endwhile; ?>
                </select>

                <label for="id_user">Kasir</label>
                <select name="id_user" id="id_user" required>
                    <option value="" disabled selected>Pilih Kasir</option>
                    <?php
                    $userResult = $connect->query("SELECT id_user, nama FROM tb_user WHERE role='kasir'");
                    while ($user = $userResult->fetch_assoc()):
                    ?>
                        <option value="<?php echo $user['id_user']; ?>">
                            <?php echo htmlspecialchars($user['nama']); ?>
                        </option>
                    <?php endwhile; ?>
                </select>

                <label for="tgl">Tanggal</label>
                <input type="date" name="tgl" id="tgl" required>

                <label for="status">Status</label>
                <select name="status" id="status" required>
                    <option value="Baru">Baru</option>
                    <option value="Proses">Proses</option>
                    <option value="Selesai">Selesai</option>
                    <option value="Diambil">Diambil</option>
                </select>

                <label for="dibayar">Dibayar?</label>
                <select name="dibayar" id="dibayar" required>
                    <option value="Dibayar">Dibayar</option>
                    <option value="Belum dibayar">Belum dibayar</option>
                </select>

                <label for="id_paket">Paket</label>
                <select name="id_paket" id="id_paket" required>
                    <option value="" disabled selected>Pilih Paket</option>
                    <?php
                    $paketResult = $connect->query("SELECT id_paket, nama_paket FROM tb_paket");
                    while ($paket = $paketResult->fetch_assoc()):
                    ?>
                        <option value="<?php echo $paket['id_paket']; ?>">
                            <?php echo htmlspecialchars($paket['nama_paket']); ?>
                        </option>
                    <?php endwhile; ?>
                </select>

                <label for="berat">Berat (kg)</label>
                <input type="number" name="berat" id="berat" step="0.01" min="0" required>

                <button type="submit" class="addbutton">Simpan</button>
            </form>
        </div>
    </section>

</body>

</html>