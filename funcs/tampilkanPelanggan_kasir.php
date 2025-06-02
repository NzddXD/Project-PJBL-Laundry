<?php

function tampilkanPelanggan($page = 1, $limit = 5)
{
    // Include the database connection
    include $_SERVER['DOCUMENT_ROOT'] . '/project/connection/connection.php';

    // Calculate the offset for the query
    $offset = ($page - 1) * $limit;

    // Query to fetch rows with pagination
    $sql = "SELECT * FROM tb_member LIMIT ?, ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("ii", $offset, $limit);
    $stmt->execute();
    $result = $stmt->get_result();

    $no = 1 + $offset;

    // Check if the query was successful
    if ($result && $result->num_rows > 0) {
        // Loop through the rows and output them as table rows
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $no++ . "</td>";
            echo "<td>" . htmlspecialchars($row['nama']) . "</td>";
            echo "<td>" . htmlspecialchars($row['email']) . "</td>";
            echo "<td>" . htmlspecialchars($row['jenis_kelamin']) . "</td>";
            echo "<td>" . htmlspecialchars($row['alamat']) . "</td>";
            echo "<td>" . htmlspecialchars($row['tlp']) . "</td>";
        }
    } else {
        // If no data is found, display a message
        echo "<tr><td colspan='7'>Ups! Tidak ada data ditemukan di dalam database!</td></tr>";
    }

    // Close the statement and connection
    $stmt->close();
    $connect->close();
}

function tampilDashboardPelanggan($page, $limit){
    // Include the database connection
    include $_SERVER['DOCUMENT_ROOT'] . '/project/connection/connection.php';
    $offset = ($page - 1) * $limit;

    // Query to fetch rows with pagination
    $sql = "SELECT * FROM tb_member LIMIT ?, ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("ii", $offset, $limit);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the query was successful
    if ($result && $result->num_rows > 0) {
        // Loop through the rows and output them as table rows
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['id_member']) . "</td>";
            echo "<td>" . htmlspecialchars($row['nama']) . "</td>";
            echo "<td>" . htmlspecialchars($row['email']) . "</td>";
            echo "<td>" . htmlspecialchars($row['jenis_kelamin']) . "</td>";
            echo "<td>" . htmlspecialchars($row['alamat']) . "</td>";
            echo "<td>" . htmlspecialchars($row['tlp']) . "</td>";
            echo "</tr>";
        }
    } else {
        // If no data is found, display a message
        echo "<tr><td colspan='6'>Ups! Tidak ada data ditemukan di dalam database!</td></tr>";
    }

    // Close the connection
    $connect->close();
}

function getTotalCustomers()
{
    // Include the database connection
    include $_SERVER['DOCUMENT_ROOT'] . '/project/connection/connection.php';

    // Query to count total rows in tb_member
    $sql = "SELECT COUNT(*) AS total FROM tb_member";
    $result = $connect->query($sql);

    // Fetch the result
    if ($result && $row = $result->fetch_assoc()) {
        return $row['total'];
    } else {
        return 0; // Return 0 if the query fails
    }
}
?>