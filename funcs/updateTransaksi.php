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

    try {
        // Menyiapkan kueri
        $stmt = $connect->prepare("UPDATE tb_transaksi SET id_outlet = ?, id_member = ?, id_user = ?, tgl = ?, status = ?, dibayar = ? WHERE id_transaksi = ?");

        // Menggunakan bind_param untuk menghindari SQL Injection
        $stmt->bind_param("iiisssi", $id_outlet, $id_member, $id_user, $tgl, $status, $dibayar, $id_transaksi);
        // Eksekusi Kueri   
        $stmt->execute();
        // Selalu redirect dengan pesan berhasil, meskipun tidak ada perubahan data
        header("Location: ../app/admin/transaction.php?msg=updated");
        exit();

    } catch (mysqli_sql_exception $e) {
        header("Location: ../app/admin/editOrder.php?msg=invalid");
        exit();
    }
}