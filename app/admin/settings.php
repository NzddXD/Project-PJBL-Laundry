<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laundry | Pengaturan</title>

    <link rel="stylesheet" href="style/settings.css">
</head>

<body>
    <?php include 'sidebar.php'; ?> <!-- Cleaner code -->
    <section class="content">
        <h1>Pengaturan</h1>
        <div class="dashboard">
            <div class="password-field">
                <h2>Ubah Password</h2>
                <form action="changePassword.php">
                    <label for="oldPasswordChange">Masukkan Password yang lama</label>
                    <input type="password" name="" id="oldPasswordChange" placeholder="Minimal 8 karakter">
                    <label for="newPasswordChange">Masukkan Password yang baru</label>
                    <input type="password" name="" id="newPasswordChange" placeholder="Minimal 8 karakter">
                    <input type="submit" value="Tetapkan Perubahan">
                </form>
            </div>
        </div>
    </section>
</body>

</html>