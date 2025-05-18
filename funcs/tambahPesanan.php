<?php

// Koneksi ke database
include $_SERVER['DOCUMENT_ROOT'] . '/project/connection/connection.php';

// Cek jika form terkirim
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $id_outlet = $_POST['id_outlet'];
    $nama_paket = $_POST['nama_paket'];
    $harga = $_POST['harga'];
    $jenis = $_POST['jenis'];

    try {
        // Mendapatkan ID paket berikutnya
        $result = $connect->query("SELECT MAX(id_paket) AS max_id FROM tb_paket");
        $row = $result->fetch_assoc();
        $next_id = $row['max_id'] ? $row['max_id'] + 1 : 1; // If no rows exist, start with 1

        // Menyiapkan kueri mysql
        $stmt = $connect->prepare("INSERT INTO tb_paket (id_paket, id_outlet, nama_paket, harga, jenis) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("iisis", $next_id, $id_outlet, $nama_paket, $harga, $jenis);

        // Eksekusi kueri
        $stmt->execute();

        // Redirect ke halaman tambah pesanan dengan pesan sukses
        header("Location: ../app/admin/newOrder.php?msg=success");
        exit();
    } catch (mysqli_sql_exception $e) {
        // Cek jika error adalah entri duplikat
        if ($e->getCode() == 1062) {
            header("Location: ../app/admin/newOrder.php?msg=duplicate");
        } else {
            header("Location: ../app/admin/newOrder.php?msg=error");
        }
        exit();
    }
} else {
    header("Location: ../app/admin/newOrder.php?msg=invalid");
    exit();
}
