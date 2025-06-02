<?php
// filepath: funcs/deleteTransaksi.php

include $_SERVER['DOCUMENT_ROOT'] . '/project/connection/connection.php';

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];

    try {
        // Delete from tb_detail_transaksi first (to maintain referential integrity)
        $stmtDetail = $connect->prepare("DELETE FROM tb_detail_transaksi WHERE id_transaksi = ?");
        $stmtDetail->bind_param("i", $id);
        $stmtDetail->execute();

        // Then delete from tb_transaksi
        $stmt = $connect->prepare("DELETE FROM tb_transaksi WHERE id_transaksi = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        header("Location: ../app/admin/transaction.php?msg=deleted");
        exit();
    } catch (mysqli_sql_exception $e) {
        header("Location: ../app/admin/transaction.php?msg=error");
        exit();
    }
} else {
    header("Location: ../app/admin/transaction.php?msg=invalid");
    exit();
}