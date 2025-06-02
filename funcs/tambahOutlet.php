<?php

// Koneksi ke database
include $_SERVER['DOCUMENT_ROOT'] . '/project/connection/connection.php';

// Cek jika form terkirim
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $tlp = $_POST['tlp'];

    try {
        // Mendapatkan ID outlet berikutnya
        $result = $connect->query("SELECT MAX(id_outlet) AS max_id FROM tb_outlet");
        $row = $result->fetch_assoc();
        $next_id = $row['max_id'] ? $row['max_id'] + 1 : 1; // If no rows exist, start with 1

        // Menyiapkan kueri mysql
        $stmt = $connect->prepare("INSERT INTO tb_outlet (id_outlet, nama, alamat, tlp) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $next_id, $nama, $alamat, $tlp);

        // Eksekusi kueri
        $stmt->execute();

        // Redirect ke halaman tambah outlet dengan pesan sukses
        header("Location: ../app/admin/newOutlet.php?msg=success");
        exit();
    } catch (mysqli_sql_exception $e) {
        // Cek jika error adalah entri duplikat
        if ($e->getCode() == 1062) {
            header("Location: ../app/admin/newOutlet.php?msg=duplicate");
        } else {
            header("Location: ../app/admin/newOutlet.php?msg=error");
        }
        exit();
    }
} else {
    header("Location: ../app/admin/newOutlet.php?msg=invalid");
    exit();
}
