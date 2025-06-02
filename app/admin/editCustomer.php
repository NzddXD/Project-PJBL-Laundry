<?php
    include $_SERVER['DOCUMENT_ROOT'] . '/project/connection/connection.php';

    // Dapatkan id dari kueri string
    $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

    // Fetch data pelanggan
    $stmt = $connect->prepare("SELECT * FROM tb_member WHERE id_member = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $hasil = $stmt->get_result();
    $pelanggan = $hasil->fetch_assoc();

    // Cek jika data ada dengan ID yang ditentukna
    if (!$pelanggan) {
        echo "Data pelanggan tidak ditemukan!";
        exit();
    }
?>
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
        <h1>Edit Pelanggan</h1>
        <div class="text-container">
            <p>Edit data pelanggan.</p>
            <a href="customer.php" class="cancelbutton"><img src="https://img.icons8.com/android/ffffff/back.png" width="20" height="20">  Kembali</a>
        </div>
        <div class="dashboard">
            <form action="../../funcs/updatePelanggan.php" method="POST">
                <table>
                    <input type="hidden" name="id" value="<?php echo $pelanggan['id_member']; ?>">
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" id="nama" value="<?php echo htmlspecialchars($pelanggan['nama']); ?>" required>

                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($pelanggan['email']); ?>" required>

                    <p>Jenis Kelamin</p>
                    <select name="jenis_kelamin" required>
                        <option value="Laki laki" <?php echo ($pelanggan['jenis_kelamin']) === 'Laki laki' ? 'selected' : ''; ?>>Laki laki</option>
                        <option value="Perempuan" <?php echo ($pelanggan['jenis_kelamin']) === 'Perempuan' ? 'selected' : ''; ?>>Perempuan</option>
                    </select>

                    <label for="alamat">Alamat</label>
                    <input type="text" name="alamat" id="alamat" value="<?php echo htmlspecialchars($pelanggan['alamat']); ?>" required>

                    <label for="tlp">Telepon</label>
                    <input type="text" name="tlp" id="tlp" value="<?php echo ($pelanggan['tlp']); ?>">

                    <button type="submit" class="addbutton">Simpan</button>
            </form>
        </div>
    </section>

</body>

</html>