<?php

// Include koneksi database
include $_SERVER['DOCUMENT_ROOT'] . '/project/connection/connection.php';

// cek jika form terkirim
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_paket = $_POST['id_paket'];
    $nama = $_POST['nama_paket'];
    $harga = $_POST['harga'];
    $jenis = $_POST['jenis'];

    try {
        // Menyiapkan kueri
        $stmt = $connect->prepare("UPDATE tb_paket SET nama_paket = ?, harga = ?, jenis = ? WHERE id_paket = ?");

        // Menggunakan bind_param untuk menghindari SQL Injection
        $stmt->bind_param("sisi", $nama, $harga, $jenis, $id_paket);

        // Eksekusi Kueri
        $stmt->execute();

        // Selalu redirect dengan pesan berhasil, meskipun tidak ada perubahan data
        header("Location: ../app/admin/order.php?msg=updated");
        exit();
    } catch (mysqli_sql_exception $e) {
        header("Location: ../app/admin/editOrder.php?msg=invalid");
        exit();
    }
}