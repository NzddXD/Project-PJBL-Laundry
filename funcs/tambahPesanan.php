<?php

// Koneksi ke database
include $_SERVER['DOCUMENT_ROOT'] . '/project/connection/connection.php';

// Fungsi untuk menghasilkan angka acak
function generateKodePaket($length = 4) {
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

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

        // Mencegah generated kode yang sama
        do {
            $kode_paket = generateKodePaket(4); // 4-character code, change length if needed
            $check = $connect->prepare("SELECT 1 FROM tb_paket WHERE kode_paket = ?");
            $check->bind_param("s", $kode_paket);
            $check->execute();
            $check->store_result();
        } while ($check->num_rows > 0);
        $check->close();
        
        // Menyiapkan kueri mysql
        $stmt = $connect->prepare("INSERT INTO tb_paket (id_paket, id_outlet, nama_paket, harga, jenis, kode_paket) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("iissss", $next_id, $id_outlet, $nama_paket, $harga, $jenis, $kode_paket);

        // Eksekusi kueri
        $stmt->execute();

        // Redirect ke halaman tambah pesanan dengan pesan sukses
        header("Location: ../app/admin/newOrder.php?msg=success");
        exit();
    } catch (mysqli_sql_exception  ) {
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
