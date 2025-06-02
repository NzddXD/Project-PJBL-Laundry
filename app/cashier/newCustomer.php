<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laundry | Pelanggan</title>
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
            <p id="messageText">Data pelanggan baru telah berhasil didaftarkan.</p>
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
        <h1>Pelanggan Baru</h1>
        <div class="text-container">
            <p>Tambahkan pelanggan baru</p>
            <a href="customer.php" class="cancelbutton"><img src="../../assets/back.png" width="20" height="20">  Kembali</a>
        </div>
        <div class="dashboard">
            <form action="../../funcs/tambahPelanggan.php" method="POST">
                <table>
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" id="nama" required>

                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" required>

                    <p>Jenis Kelamin</p>
                    <select name="jenis_kelamin" required>
                        <option value="Laki laki" selected>Laki laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>

                    <label for="alamat">Alamat</label>
                    <input type="text" name="alamat" id="alamat" required>

                    <label for="tlp">Telepon</label>
                    <input type="text" name="tlp" id="tlp" required>

                    <button type="submit" class="addbutton">Simpan</button>
            </form>
        </div>
    </section>

</body>

</html>