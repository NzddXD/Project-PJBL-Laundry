<?php

function tampilkanTransaksi($page = 1, $limit = 5){
    // Koneksi
    include $_SERVER['DOCUMENT_ROOT'] . '/project/connection/connection.php';

    // Pagination
    $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
    $limit = 5; // Jumlah baris per halaman
    $offset = ($page - 1) * $limit;

    // Query untuk mengambil data dengan pagination
    $sql = "SELECT id_transaksi, id_outlet, id_member, id_user, tgl, status, dibayar FROM tb_transaksi LIMIT ?, ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("ii", $offset, $limit);
    $stmt->execute();
    $result = $stmt->get_result();

    // Cek apakah query berhasil
    if ($result && $result->num_rows > 0) {
        // Loop melalui hasil dan tampilkan dalam tabel
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td><p>" . htmlspecialchars($row['id_transaksi']) . "</p></td>";
            echo "<td><p>" . htmlspecialchars($row['id_outlet']) . "</p></td>";
            echo "<td><p>" . htmlspecialchars($row['id_member']) . "</p></td>";
            echo "<td><p>" . htmlspecialchars($row['id_user']) . "</p></td>";
            echo "<td><p>" . htmlspecialchars($row['tgl']) . "</p></td>";
            echo "<td><p>" . htmlspecialchars($row['status']) . "</p></td>";
            echo "<td><p>" . htmlspecialchars($row['dibayar']) . "</p></td>";
            // echo "<td><p>" . htmlspecialchars($row['total_bayar']) . "</p></td>";
            echo "<td>
                    <div class='buttons'>
                        <a href='editTransaksi.php?id=" . $row['id_transaksi'] . "' class='edit' title='Edit'>
                            <img src='../../assets/pencil.png' width='23' height='23' alt='pencil icon'>
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