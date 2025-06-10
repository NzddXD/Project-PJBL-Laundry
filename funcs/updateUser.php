<?php
// filepath: funcs/updateUser.php

include $_SERVER['DOCUMENT_ROOT'] . '/project/connection/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_user = $_POST['id_user'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $role = $_POST['role'];

    try {
        $stmt = $connect->prepare("UPDATE tb_user SET nama=?, username=?, role=? WHERE id_user=?");
        $stmt->bind_param("sssi", $nama, $username, $role, $id_user);
        $stmt->execute();

        header("Location: ../app/admin/settings.php?msg=updated");
        exit();
    } catch (mysqli_sql_exception $e) {
        header("Location: ../app/admin/editUser.php?id=$id_user&msg=error");
        exit();
    }
} else {
    header("Location: ../app/admin/settings.php?msg=invalid");
    exit();
}