<?php

// Include koneksi database
include $_SERVER['DOCUMENT_ROOT'] . '/project/connection/connection.php';

// cek jika form terkirim
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $alamat = $_POST['alamat'];
    $tlp = $_POST['tlp'];

    try {
        // Menyiapkan kueri
        $stmt = $connect->prepare("UPDATE tb_member SET nama = ?, email = ?, jenis_kelamin = ?, alamat = ?, tlp = ? WHERE id_member = ?");
        $stmt->bind_param("sssssi", $nama, $email, $jenis_kelamin, $alamat, $tlp, $id);

        // Eksekusi Kueri
        $stmt->execute();

        // Selalu redirect dengan pesan berhasil, meskipun tidak ada perubahan data
        header("Location: ../app/admin/customer.php?msg=updated");
        exit();
    } catch (mysqli_sql_exception $e) {
        header("Location: ../app/admin/editCustomer.php?msg=invalid");
        exit();
    }
}