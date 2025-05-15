<?php

// Koneksi ke database
include $_SERVER['DOCUMENT_ROOT'] . '/project/connection/connection.php';

// Cek jika form terkirim
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $alamat = $_POST['alamat'];
    $tlp = $_POST['tlp'];

    try {
        // Check for the maximum existing id in the table
        $result = $connect->query("SELECT MAX(id_member) AS max_id FROM tb_member");
        $row = $result->fetch_assoc();
        $next_id = $row['max_id'] ? $row['max_id'] + 1 : 1; // If no rows exist, start with 1

        // Menyiapkan kueri mysql
        $stmt = $connect->prepare("INSERT INTO tb_member (id_member, nama, email, jenis_kelamin, alamat, tlp) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssss", $next_id, $nama, $email, $jenis_kelamin, $alamat, $tlp);

        // Eksekusi kueri
        $stmt->execute();

        // Redirect ke halaman tambah pelanggan dengan pesan sukses
        header("Location: ../app/admin/newCustomer.php?msg=success");
        exit();
    } catch (mysqli_sql_exception $e) {
        // Cek jika error adalah entri duplikat
        if ($e->getCode() == 1062) {
            // Redirect ke halaman tambah pelanggan dengan pesan error
            header("Location: ../app/admin/newCustomer.php?msg=duplicate");
        } else {
            // Redirect ke halaman tambah pelanggan dengan pesan error umum
            header("Location: ../app/admin/newCustomer.php?msg=error");
        }
        exit();
    }
} else {
    // Redirect jika request bukan POST
    header("Location: ../app/admin/newCustomer.php?msg=invalid");
    exit();
}
