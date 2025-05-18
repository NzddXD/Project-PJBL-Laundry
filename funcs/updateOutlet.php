<?php

// Include koneksi database
include $_SERVER['DOCUMENT_ROOT'] . '/project/connection/connection.php';

// cek jika form terkirim
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_outlet = $_POST['id_outlet'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $tlp = $_POST['tlp'];

    try {
        // Menyiapkan kueri
        $stmt = $connect->prepare("UPDATE tb_outlet SET nama = ?, alamat = ?, tlp = ? WHERE id_outlet = ?");
        $stmt->bind_param("sssi", $nama, $alamat, $tlp, $id_outlet);

        // Eksekusi Kueri
        $stmt->execute();

        // Selalu redirect dengan pesan berhasil, meskipun tidak ada perubahan data
        header("Location: ../app/admin/outlet.php?msg=updated");
        exit();
    } catch (mysqli_sql_exception $e) {

        // Jika terjadi kesalahan, redirect ke halaman edit dengan pesan error
        header("Location: ../app/admin/editOutlet.php?msg=invalid");
        exit();
    }
}