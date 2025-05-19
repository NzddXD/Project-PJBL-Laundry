<?php

// Menampilkan pesanan dengan pagination
function tampilkanPesanan($page = 1, $limit = 5)
{
    // koneksi database
    include $_SERVER['DOCUMENT_ROOT'] . '/project/connection/connection.php';

    // Hitung offset untuk kueri
    $offset = ($page - 1) * $limit;

    // Kueri untuk mengambil baris dengan pagination
    $sql = "SELECT * FROM tb_paket LIMIT ?, ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("ii", $offset, $limit);
    $stmt->execute();
    $result = $stmt->get_result();

    // Periksa apakah kueri berhasil
    if ($result && $result->num_rows > 0) {

        // Loop melalui baris dan output sebagai baris tabel
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['id_paket']) . "</td>";
            echo "<td>" . htmlspecialchars($row['id_outlet']) . "</td>";
            echo "<td>" . htmlspecialchars($row['jenis']) . "</td>";
            echo "<td>" . htmlspecialchars($row['nama_paket']) . "</td>";
            echo "<td>Rp " . number_format($row['harga'], 0, ',', '.') . "</td>";
            echo "<td>
                    <div class='buttons'>
                        <a href='editOrder.php?id=" . $row['id_paket'] . "' class='edit' title='Edit'>
                            <img src='../../assets/pencil.png' width='23' height='23' alt='pencil icon'>
                        </a>
                        <button class='delete' title='Delete' onclick=\"confirmDelete('deletePesanan.php', " . $row['id_paket'] . ")\">
                            <img src='../../assets/trash.png' width='23' height='23' alt='trash icon'>
                        </button>
                    </div>
                </td>";
            echo "</tr>";
        }
    } else {

        // Jika tidak ada data ditemukan, tampilkan pesan
        echo "<tr><td colspan='7'>Ups! Tidak ada data ditemukan di dalam database!</td></tr>";
    }

    $stmt->close();
    $connect->close();
}

function tampilDashboardPesanan($page = 1, $limit = 3)
{
    // koneksi database
    include $_SERVER['DOCUMENT_ROOT'] . '/project/connection/connection.php';
    // Hitung offset untuk kueri
    $offset = ($page - 1) * $limit;

    // Kueri untuk mengambil baris dengan pagination
    $sql = "SELECT * FROM tb_paket LIMIT ?, ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("ii", $offset, $limit);
    $stmt->execute();
    $result = $stmt->get_result();

    // Periksa apakah kueri berhasil
    if ($result && $result->num_rows > 0) {

        // Loop melalui baris dan output sebagai baris tabel
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['id_paket']) . "</td>";
            echo "<td>" . htmlspecialchars($row['id_outlet']) . "</td>";
            echo "<td>" . htmlspecialchars($row['jenis']) . "</td>";
            echo "<td>" . htmlspecialchars($row['nama_paket']) . "</td>";
            echo "<td>Rp " . number_format($row['harga'], 0, ',', '.') . "</td>";
            echo "</tr>";
        }
    } else {

        // Jika tidak ada data ditemukan, tampilkan pesan
        echo "<tr><td colspan='7'>Ups! Tidak ada data ditemukan di dalam database!</td></tr>";
    }

    $stmt->close();
    $connect->close();
}

function getTotalOrder()
{
    // Include koneksi database
    include $_SERVER['DOCUMENT_ROOT'] . '/project/connection/connection.php';

    // Kueri untuk menghitung total baris di tb_paket
    $sql = "SELECT COUNT(*) AS total FROM tb_paket";
    $result = $connect->query($sql);

    // Ambil hasilnya
    if ($result && $row = $result->fetch_assoc()) {
        return $row['total'];
    } else {
        return 0; // Return 0 if the query fails
    }
}
?>