<?php

include $_SERVER['DOCUMENT_ROOT'] . '/project/connection/connection.php';

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];

    try {
        // Siapkan kueri delete
        $stmt = $connect->prepare("DELETE FROM tb_paket WHERE id_paket = ?");
        $stmt->bind_param("i", $id);

        // Execute
        $stmt->execute();

        header("Location: ../app/admin/order.php?msg=deleted");
        exit();
    } catch (mysqli_sql_exception $e) {
        header("Location: ../app/admin/order.php?msg=error");
        exit();
    }
} else {
    header("Location: ../app/admin/order.php?msg=invalid");
    exit();
}