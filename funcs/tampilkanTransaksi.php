<?php

function tampilkanTransaksi($page = 1, $limit = 5){
    // Koneksi
    include $_SERVER['DOCUMENT_ROOT'] . '/project/connection/connection.php';

    // Pagination
    $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
    $limit = 5; // Jumlah baris per halaman
    $offset = ($page - 1) * $limit;

    // Query untuk mengambil data dengan pagination
    $sql = "SELECT 
                t.id_transaksi AS id_transaksi,
                t.tgl, t.status, t.dibayar, t.id_outlet, t.id_member, t.id_user,
                o.nama AS nama_outlet, 
                m.nama AS nama_member, 
                u.nama AS nama_user, 
                p.nama_paket,
                p.kode_paket,
                d.berat
            FROM tb_transaksi t
            LEFT JOIN tb_outlet o ON t.id_outlet = o.id_outlet
            LEFT JOIN tb_member m ON t.id_member = m.id_member
            LEFT JOIN tb_user u ON t.id_user = u.id_user
            LEFT JOIN tb_detail_transaksi d ON t.id_transaksi = d.id_transaksi
            LEFT JOIN tb_paket p ON d.id_paket = p.id_paket
            LIMIT ?, ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("ii", $offset, $limit);
    $stmt->execute();
    $result = $stmt->get_result();

    $no = 1 + $offset;

    // Cek apakah query berhasil
    if ($result && $result->num_rows > 0) {
        // Loop melalui hasil dan tampilkan dalam tabel
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $no++ . "</td>";
            echo "<td>" . htmlspecialchars($row['nama_outlet']) . "</td>";
            echo "<td>" . htmlspecialchars($row['nama_member']) . "</td>";
            echo "<td>" . htmlspecialchars($row['tgl']) . "</td>";
            echo "<td>" . htmlspecialchars($row['status']) . "</td>";
            echo "<td>" . htmlspecialchars($row['dibayar']) . "</td>";
            echo "<td>" . htmlspecialchars($row['berat']) . " kg</td>";
            // echo "<td>" . htmlspecialchars($row['kode_paket']) . "</td>";
            echo "<td>" . htmlspecialchars($row['nama_paket']) . "</td>";
            echo "<td>
                    <div class='buttons'>
                        <a href='editTransaksi.php?id=" . $row['id_transaksi'] . "' class='edit' title='Edit'>
                            <img src='../../assets/pencil.png' width='23' height='23' alt='pencil icon'>
                        </a>
                        <a href='generateLaporan.php?id=" . $row['id_transaksi'] . "' class='lapor' title='Buat Laporan'>
                            <img src='../../assets/matt-paper.png' width='23' height='23' alt='pencil icon'>
                        </a>
                        <button class='delete' title='Delete' onclick=\"confirmDelete('deleteTransaksi.php', '" . $row['id_transaksi'] . "')\">
                            <img src='../../assets/trash.png' width='23' height='23' alt='trash icon'>
                        </button>
                    </div>
                </td>";
            echo "</tr>";
        }
    } else {
        // Jika tidak ada data ditemukan
        echo "<tr><td colspan='6'>Ups! Tidak ada data ditemukan di dalam database!</td></tr>";
    }
}
function tampilkanTransaksiOwnerDanKasir($page = 1, $limit = 5){
    // Koneksi
    include $_SERVER['DOCUMENT_ROOT'] . '/project/connection/connection.php';

    // Pagination
    $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
    $limit = 5; // Jumlah baris per halaman
    $offset = ($page - 1) * $limit;

    // Query untuk mengambil data dengan pagination
    $sql = "SELECT 
                t.id_transaksi AS id_transaksi,
                t.tgl, t.status, t.dibayar, t.id_outlet, t.id_member, t.id_user,
                o.nama AS nama_outlet, 
                m.nama AS nama_member, 
                u.nama AS nama_user, 
                p.nama_paket,
                p.kode_paket,
                d.berat
            FROM tb_transaksi t
            LEFT JOIN tb_outlet o ON t.id_outlet = o.id_outlet
            LEFT JOIN tb_member m ON t.id_member = m.id_member
            LEFT JOIN tb_user u ON t.id_user = u.id_user
            LEFT JOIN tb_detail_transaksi d ON t.id_transaksi = d.id_transaksi
            LEFT JOIN tb_paket p ON d.id_paket = p.id_paket
            LIMIT ?, ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("ii", $offset, $limit);
    $stmt->execute();
    $result = $stmt->get_result();

    $no = 1 + $offset;

    // Cek apakah query berhasil
    if ($result && $result->num_rows > 0) {
        // Loop melalui hasil dan tampilkan dalam tabel
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $no++ . "</td>";
            echo "<td>" . htmlspecialchars($row['nama_outlet']) . "</td>";
            echo "<td>" . htmlspecialchars($row['nama_member']) . "</td>";
            echo "<td>" . htmlspecialchars($row['tgl']) . "</td>";
            echo "<td>" . htmlspecialchars($row['status']) . "</td>";
            echo "<td>" . htmlspecialchars($row['dibayar']) . "</td>";
            echo "<td>" . htmlspecialchars($row['berat']) . " kg</td>";
            // echo "<td>" . htmlspecialchars($row['kode_paket']) . "</td>";
            echo "<td>" . htmlspecialchars($row['nama_paket']) . "</td>";
            echo "<td>
                    <div class='buttons'>
                        <a href='generateLaporan.php?id=" . $row['id_transaksi'] . "' class='lapor' title='Buat Laporan'>
                            <img src='../../assets/matt-paper.png' width='23' height='23' alt='pencil icon'>
                        </a>
                    </div>
                </td>";
            echo "</tr>";
        }
    } else {
        // Jika tidak ada data ditemukan
        echo "<tr><td colspan='6'>Ups! Tidak ada data ditemukan di dalam database!</td></tr>";
    }
}
function getTotalTransaction()
{
    // Include the database connection
    include $_SERVER['DOCUMENT_ROOT'] . '/project/connection/connection.php';

    // Query to count total rows in tb_transaksi
    $sql = "SELECT COUNT(*) AS total FROM tb_transaksi";
    $result = $connect->query($sql);

    // Fetch the result
    if ($result && $row = $result->fetch_assoc()) {
        return $row['total'];
    } else {
        return 0; // Return 0 if the query fails
    }
}
?>