<?php

function getCustomer()
{
    // Include the database connection using an absolute path
    include $_SERVER['DOCUMENT_ROOT'] . '/project/connection/connection.php';

    // Query to count total records in tb_member
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