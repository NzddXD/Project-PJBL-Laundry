<?php

// Koneksi ke database
include $_SERVER['DOCUMENT_ROOT'] . '/project/connection/connection.php';

// Fungsi untuk menghasilkan angka acak

// Cek jika form terkirim
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $id_outlet = $_POST['id_outlet'];
    $id_member = $_POST['id_member'];
    $id_user = $_POST['id_user'];
    $tgl = $_POST['tgl'];
    $status = $_POST['status'];
    $dibayar = $_POST['dibayar'];
    $id_paket = $_POST['id_paket'];
    $berat = $_POST['berat'];

    try {
        // 1. Insert into tb_transaksi
        $stmt = $connect->prepare("INSERT INTO tb_transaksi (id_outlet, id_member, id_user, tgl, status, dibayar) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("iiisss", $id_outlet, $id_member, $id_user, $tgl, $status, $dibayar);
        $stmt->execute();

        // Get the new id_transaksi
        $id_transaksi = $connect->insert_id;

        // 2. Insert into tb_detail_transaksi
        $stmt2 = $connect->prepare("INSERT INTO tb_detail_transaksi (id_transaksi, id_paket, berat) VALUES (?, ?, ?)");
        $stmt2->bind_param("iid", $id_transaksi, $id_paket, $berat);
        $stmt2->execute();

        header("Location: ../app/admin/transaction.php?msg=success");
        exit();
    } catch (mysqli_sql_exception $e) {
        header("Location: ../app/admin/newTransaction.php?msg=error");
        exit();
    }
} else {
    header("Location: ../app/admin/newTransaction.php?msg=invalid");
    exit();
}
