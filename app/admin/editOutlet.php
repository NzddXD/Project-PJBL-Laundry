<?php
    include $_SERVER['DOCUMENT_ROOT'] . '/project/connection/connection.php';

    // Dapatkan id dari kueri string
    $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

    // Fetch data outlet
    $stmt = $connect->prepare("SELECT * FROM tb_outlet WHERE id_outlet = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $hasil = $stmt->get_result();
    $outlet = $hasil->fetch_assoc();

    // Cek jika data ada dengan ID yang ditentukna
    if (!$outlet) {
        echo "Data outlet tidak ditemukan!";
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laundry | Outlet</title>
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
            <p id="messageText">Data Outlet baru telah berhasil didaftarkan.</p>
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
        <h1>Edit Outlet</h1>
        <div class="text-container">
            <p>Edit data Outlet.</p>
            <a href="outlet.php" class="cancelbutton"><img src="../../assets/back.png" width="20" height="20">  Kembali</a>
        </div>
        <div class="dashboard">
            <form action="../../funcs/updateOutlet.php" method="POST">
                <table>
                    <input type="hidden" name="id_outlet" value="<?php echo $outlet['id_outlet']; ?>">

                    <label for="nama_outlet">Nama Outlet</label>
                    <input type="text" name="nama" id="nama" value="<?php echo htmlspecialchars($outlet['nama']); ?>" required>

                    <label for="harga">Alamat</label>
                    <input type="text" name="alamat" id="alamat" value="<?php echo htmlspecialchars($outlet['alamat']); ?>" required>
                    
                    <label for="harga">Nomor Telepon</label>
                    <input type="number" name="tlp" id="tlp" value="<?php echo htmlspecialchars($outlet['tlp']); ?>" required>

                    <button type="submit" class="addbutton">Simpan</button>
            </form>
        </div>
    </section>

</body>

</html>