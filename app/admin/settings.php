<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laundry | Pengaturan</title>
    <?php include '../../funcs/globalFavIcon.php';?>

    <link rel="stylesheet" href="style/settings.css">
</head>

<body>
    <div class="popup">
        <div class="popup-content success">
            <span class="close" onclick="closePopup()">&times;</span>
            <div class="header">
                <img src="../../assets/ok.png" alt="ok" width="25" height="25">
                <h2 id="titleText">Berhasil!</h2>
            </div>
            <p id="messageText">Password telah berhasil diubah.</p>
            <button class="close-popup" onclick="closePopup()">Tutup</button>
        </div>
    </div>
    <script src="../scripts/app.js"></script>
    <?php
    if (isset($_GET['msg'])) {
        if ($_GET['msg'] === 'updated') {
            echo "<script>updated('../../app/admin/settings.php')</script>";
        } elseif ($_GET['msg'] === 'error') {
            echo "<script>error()</script>";
        } elseif ($_GET['msg'] === 'invalid') {
            echo "<script>invalid()</script>";
        } elseif ($_GET['msg'] === 'wrong_password') {
            echo "<script>
                popup.style.display = 'flex';
                titleText.textContent = 'Kesalahan!';
                messageText.textContent = 'Password lama salah!';
                closeButton.textContent = 'Tutup';
            </script>";
        } elseif ($_GET['msg'] === 'password_mismatch') {
            echo "<script>
                popup.style.display = 'flex';
                titleText.textContent = 'Kesalahan!';
                messageText.textContent = 'Konfirmasi password baru tidak cocok!';
                closeButton.textContent = 'Tutup';
            </script>";
        }
    }
    ?>

    <?php include 'sidebar.php'; ?> <!-- Cleaner code -->
    <section class="content">
        <h1>Pengaturan</h1>
        <div class="dashboard">
            <div class="password-field">
                <h2>Ubah Password</h2>
                <form action="../../funcs/changePassword.php" method="POST">
                    <label for="oldPasswordChange">Masukkan Password yang lama</label>
                    <input type="password" name="password" id="oldPasswordChange" placeholder="Minimal 8 karakter" required>

                    <label for="newPasswordChange">Masukkan Password yang baru</label>
                    <input type="password" name="new_password" id="newPasswordChange" placeholder="Minimal 8 karakter" required>

                    <label for="confirmPasswordChange">Konfirmasi Password baru</label>
                    <input type="password" name="confirm_password" id="confirmPasswordChange" placeholder="Minimal 8 karakter" required>

                    <input type="submit" name="submit" value="Tetapkan Perubahan">
                </form>
            </div>
        </div>
    </section>
</body>

</html>