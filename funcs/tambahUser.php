<?php
include $_SERVER['DOCUMENT_ROOT'] . '/project/connection/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = md5($_POST['password']); // Use MD5 for consistency with login
    $role = $_POST['role'];

    try {
        $stmt = $connect->prepare("INSERT INTO tb_user (nama, username, password, role) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nama, $username, $password, $role);
        $stmt->execute();

        header("Location: ../app/admin/settings.php?msg=success");
        exit();
    } catch (mysqli_sql_exception $e) {
        header("Location: ../app/admin/newUser.php?msg=error");
        exit();
    }
} else {
    header("Location: ../app/admin/newUser.php?msg=invalid");
    exit();
}