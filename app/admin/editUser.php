<?php
include $_SERVER['DOCUMENT_ROOT'] . '/project/connection/connection.php';

// Get user ID from query string
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Fetch user data
$stmt = $connect->prepare("SELECT * FROM tb_user WHERE id_user = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    echo "User tidak ditemukan!";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/customer.css">
    <?php include '../../funcs/globalFavIcon.php'; ?>
</head>
<body>
    <?php include 'sidebar.php'; ?>
    <section class="content">
        <h1>Edit User</h1>
        <div class="dashboard">
            <form action="../../funcs/updateUser.php" method="POST">
                <input type="hidden" name="id_user" value="<?php echo $user['id_user']; ?>">
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama" value="<?php echo htmlspecialchars($user['nama']); ?>" required>

                <label for="username">Username</label>
                <input type="text" name="username" id="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>

                <label for="role">Role</label>
                <select name="role" id="role" required>
                    <option value="admin" <?php if ($user['role'] === 'admin') echo 'selected'; ?>>Admin</option>
                    <option value="kasir" <?php if ($user['role'] === 'kasir') echo 'selected'; ?>>Kasir</option>
                    <option value="owner" <?php if ($user['role'] === 'owner') echo 'selected'; ?>>Owner</option>
                </select>

                <button type="submit" class="addbutton">Simpan</button>
            </form>
        </div>
    </section>
</body>
</html>