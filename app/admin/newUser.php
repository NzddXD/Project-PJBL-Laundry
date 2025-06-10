<?php include '../../funcs/globalFavIcon.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah User</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/customer.css">
</head>
<body>
    <?php include 'sidebar.php'; ?>
    <section class="content">
        <h1>Tambah User</h1>
        <div class="dashboard">
            <form action="../../funcs/tambahUser.php" method="POST">
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama" required>

                <label for="username">Username</label>
                <input type="text" name="username" id="username" required>

                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>

                <label for="role">Role</label>
                <select name="role" id="role" required>
                    <option value="admin">Admin</option>
                    <option value="kasir">Kasir</option>
                    <option value="owner">Owner</option>
                </select>

                <button type="submit" class="addbutton">Simpan</button>
            </form>
        </div>
    </section>
</body>
</html>