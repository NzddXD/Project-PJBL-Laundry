<?php
// filepath: funcs/deleteUser.php

include $_SERVER['DOCUMENT_ROOT'] . '/project/connection/connection.php';

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];

    try {
        $stmt = $connect->prepare("DELETE FROM tb_user WHERE id_user = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        header("Location: ../app/admin/settings.php?msg=deleted");
        exit();
    } catch (mysqli_sql_exception $e) {
        header("Location: ../app/admin/settings.php?msg=error");
        exit();
    }
} else {
    header("Location: ../app/admin/settings.php?msg=invalid");
    exit();
}