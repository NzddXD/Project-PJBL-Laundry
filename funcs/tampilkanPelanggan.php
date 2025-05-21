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
            echo "<td>
                    <div class='buttons'>
                        <a href='editCustomer.php?id=" . $row['id_member'] . "' class='edit' title='Edit'>
                            <img src='../../assets/pencil.png' width='23' height='23' alt='pencil icon'>
                        </a>
                        <button class='delete' title='Delete' onclick=\"confirmDelete('deletePelanggan.php', '" . $row['id_member'] . "')\">
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

    // Close the statement and connection
    $stmt->close();
    $connect->close();
}

function tampilDashboardPelanggan(){
    // Include the database connection
    include $_SERVER['DOCUMENT_ROOT'] . '/project/connection/connection.php';

    // Query to fetch rows with pagination
    $sql = "SELECT * FROM tb_member";
    $result = $connect->query($sql);

    // Check if the query was successful
    if ($result && $result->num_rows > 0) {
        // Loop through the rows and output them as table rows
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td><p>" . htmlspecialchars($row['id_member']) . "</p></td>";
            echo "<td><p>" . htmlspecialchars($row['nama']) . "</p></td>";
            echo "<td><p>" . htmlspecialchars($row['email']) . "</p></td>";
            echo "<td><p>" . htmlspecialchars($row['jenis_kelamin']) . "</p></td>";
            echo "<td><p>" . htmlspecialchars($row['alamat']) . "</p></td>";
            echo "<td><p>" . htmlspecialchars($row['tlp']) . "</p></td>";
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