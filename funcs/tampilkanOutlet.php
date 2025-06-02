<?php

function tampilkanOutlet($page = 1, $limit = 5)
{
    // Include the database connection
    include $_SERVER['DOCUMENT_ROOT'] . '/project/connection/connection.php';

    // Calculate the offset for the query
    $offset = ($page - 1) * $limit;

    // Query to fetch rows with pagination
    $sql = "SELECT * FROM tb_outlet LIMIT ?, ?";
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
            echo "<td>" . htmlspecialchars($row['alamat']) . "</td>";
            echo "<td>" . htmlspecialchars($row['tlp']) . "</td>";
            echo "<td>
                    <div class='buttons'>
                        <a href='editOutlet.php?id=" . $row['id_outlet'] . "' class='edit' title='Edit'>
                            <img src='../../assets/pencil.png' width='23' height='23' alt='pencil icon'>
                        </a>
                        <button class='delete' title='Delete' onclick=\"confirmDelete('deleteOutlet.php', " . $row['id_outlet'] . ")\">
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

function getTotalOutlet()
{
    // Include the database connection
    include $_SERVER['DOCUMENT_ROOT'] . '/project/connection/connection.php';

    // Query to count total rows in tb_member
    $sql = "SELECT COUNT(*) AS total FROM tb_outlet";
    $result = $connect->query($sql);

    // Fetch the result
    if ($result && $row = $result->fetch_assoc()) {
        return $row['total'];
    } else {
        return 0; // Return 0 if the query fails
    }
}
?>