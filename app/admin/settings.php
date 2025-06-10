<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laundry | Pengaturan</title>
    <?php include '../../funcs/globalFavIcon.php'; ?>

    <link rel="stylesheet" href="style/settings.css">
    <link rel="stylesheet" href="style/customer.css">
</head>

<body>
    <!-- Replace your popup HTML with this: -->
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
                    <input type="password" name="password" id="oldPasswordChange" placeholder="Minimal 8 karakter"
                        required>

                    <label for="newPasswordChange">Masukkan Password yang baru</label>
                    <input type="password" name="new_password" id="newPasswordChange" placeholder="Minimal 8 karakter"
                        required>

                    <label for="confirmPasswordChange">Konfirmasi Password baru</label>
                    <input type="password" name="confirm_password" id="confirmPasswordChange"
                        placeholder="Minimal 8 karakter" required>

                    <input type="submit" name="submit" value="Tetapkan Perubahan">
                </form>
            </div>
        </div>
        <div class="dashboard" style="margin-top: 2.4em">
            <!-- Kelola User -->
            <div class="password-field">
                <div class="text-container">
                    <h2>Kelola User</h2>

                    <a href="newUser.php" class="addbutton" style="width: fit-content; float: right;">Tambah User</a>
                </div>
                <table style="width: 100%; border-collapse: collapse; margin: 20px; text-align: left;">
                    <tr>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Aksi</th>
                        </tr>
                    <?php
                    include $_SERVER['DOCUMENT_ROOT'] . '/project/connection/connection.php';

                    $query = "SELECT * FROM tb_user";
                    $result = mysqli_query($connect, $query);

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['nama']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['username']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['role']) . "</td>";
                        echo "<td>
                            <div class='buttons'>
                                <a href='editUser.php?id=" . $row['id_user'] . "' class='edit' title='Edit'>
                                    <img src='../../assets/pencil.png' width='23' height='23' alt='pencil icon'>
                                </a>
                                <button class='delete' title='Delete' onclick=\"confirmDelete('deleteUser.php', '" . $row['id_user'] . "')\">
                                    <img src='../../assets/trash.png' width='23' height='23' alt='trash icon'>
                                </button>
                            </div>
                        </td>";
                        echo "</tr>";
                    }
                    ?>
                </table>
            </div>
        </div>
    </section>

    <script src="../../scripts/app.js"></script>
    <script src="../scripts/app.js"></script>
</body>

</html>