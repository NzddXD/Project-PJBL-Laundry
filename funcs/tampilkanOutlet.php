<?php

function tampilkanPelanggan($page = 1, $limit = 5)
{
    // Include the database connection
    include $_SERVER['DOCUMENT_ROOT'] . '/project/connection/connection.php';

    // Calculate the offset for the query
    $offset = ($page - 1) * $limit;

    // Query to fetch rows with pagination
    $sql = "SELECT * FROM tb_paket LIMIT ?, ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("ii", $offset, $limit);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the query was successful
    if ($result && $result->num_rows > 0) {
        // Loop through the rows and output them as table rows
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['id_paket']) . "</td>";
            echo "<td>" . htmlspecialchars($row['id_outlet']) . "</td>";
            echo "<td>" . htmlspecialchars($row['jenis']) . "</td>";
            echo "<td>" . htmlspecialchars($row['nama_paket']) . "</td>";
            echo "<td>" . htmlspecialchars($row['harga']) . "</td>";
            echo "<td>
                    <div class='buttons'>
                        <a href='editCustomer.php?id=" . $row['id_member'] . "' class='edit' title='Edit'>
                            <img src='../../assets/pencil.png' width='23' height='23' alt='pencil icon'>
                        </a>
                        <button class='delete' title='Delete' onclick=\"confirmDelete(" . $row['id_member'] . ")\">
                            <img src='../../assets/trash.png' width='23' height='23' alt='trash icon'>
                        </button>
                    </div>
                </td>";
            echo "</tr>";
        }
    } else {
        
        // If no data is found, display a message
        echo "<tr><td colspan='7'>Ups! Tidak ada data ditemukan di dalam database!</td></tr>";
    }

    $stmt->close();
    $connect->close();
}

function getTotalOrder()
{
    // Include the database connection
    include $_SERVER['DOCUMENT_ROOT'] . '/project/connection/connection.php';

    // Query to count total rows in tb_member
    $sql = "SELECT COUNT(*) AS total FROM tb_paket";
    $result = $connect->query($sql);

    // Fetch the result
    if ($result && $row = $result->fetch_assoc()) {
        return $row['total'];
    } else {
        return 0; // Return 0 if the query fails
    }
}
?>