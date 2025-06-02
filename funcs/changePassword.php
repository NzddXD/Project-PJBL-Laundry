<?php

include $_SERVER['DOCUMENT_ROOT'] . '/project/connection/connection.php';
session_start();

if (isset($_POST['submit'])) {
    $id = $_SESSION['id'];
    $password = $_POST['password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Ambil password lama dari database
    $stmt = $connect->prepare("SELECT password FROM tb_user WHERE id_user = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($hashed_password);
    $stmt->fetch();
    $stmt->close();

    // Cek password lama (pakai MD5)
    if (md5($password) !== $hashed_password) {
        header("Location: ../app/admin/settings.php?msg=wrong_password");
        exit();
    }

    // Cek konfirmasi password baru
    if ($new_password !== $confirm_password) {
        header("Location: ../app/admin/settings.php?msg=password_mismatch");
        exit();
    }

    // Hash password baru dengan MD5 (agar konsisten dengan login)
    $hashed_new_password = md5($new_password);

    $stmt = $connect->prepare("UPDATE tb_user SET password = ? WHERE id_user = ?");
    $stmt->bind_param("si", $hashed_new_password, $id);

    if ($stmt->execute()) {
        header("Location: ../app/admin/settings.php?msg=success");
        exit();
    } else {
        header("Location: ../app/admin/settings.php?msg=error");
        exit();
    }
}