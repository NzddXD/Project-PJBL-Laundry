<?php

// Include koneksi database
include $_SERVER['DOCUMENT_ROOT'] . '/project/connection/connection.php';

// cek jika form terkirim
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_transaksi = $_POST['id_transaksi'];
    $id_outlet = $_POST['id_outlet'];
    $id_member = $_POST['id_member'];
    $id_user = $_POST['id_user'];
    $tgl = $_POST['tgl'];
    $status = $_POST['status'];
    $dibayar = $_POST['dibayar'];
    $id_paket = $_POST['id_paket'];
    $berat = $_POST['berat'];

    try {
        $connect->begin_transaction(); // Memulai (BEGIN)

        // Update tb_transaksi
        $stmt = $connect->prepare("UPDATE tb_transaksi SET id_outlet=?, id_member=?, id_user=?, tgl=?, status=?, dibayar=? WHERE id_transaksi=?");
        $stmt->bind_param("iiisssi", $id_outlet, $id_member, $id_user, $tgl, $status, $dibayar, $id_transaksi);
        $stmt->execute();

        // Update tb_detail_transaksi
        $stmt2 = $connect->prepare("UPDATE tb_detail_transaksi SET id_paket=?, berat=? WHERE id_transaksi=?");
        $stmt2->bind_param("idi", $id_paket, $berat, $id_transaksi);
        $stmt2->execute();

        $connect->commit(); // Menetapkan (COMMIT)

        header("Location: ../app/admin/transaction.php?msg=updated");
        exit();
    } catch (mysqli_sql_exception $e) {
        $connect->rollback(); // Kembalikan (ROLLBACK)
        header("Location: ../app/admin/editTransaksi.php?id=$id_transaksi&msg=error");
        exit();
    }
} else {
    header("Location: ../app/admin/transaction.php?msg=invalid");
    exit();
}