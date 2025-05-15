<?php

// Include the database connection
include $_SERVER['DOCUMENT_ROOT'] . '/project/connection/connection.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $alamat = $_POST['alamat'];
    $tlp = $_POST['tlp'];

    try {
        // Prepare the update query
        $stmt = $connect->prepare("UPDATE tb_member SET nama = ?, email = ?, jenis_kelamin = ?, alamat = ?, tlp = ? WHERE id_member = ?");
        $stmt->bind_param("sssssi", $nama, $email, $jenis_kelamin, $alamat, $tlp, $id);

        // Execute the query
        $stmt->execute();

        // Redirect to the customer page with a success message
        header("Location: ../app/admin/customer.php?msg=updated");
        exit();
    } catch (mysqli_sql_exception $e) {
        // Redirect to the customer page with an error message
        header("Location: ../app/admin/customer.php?msg=error");
        exit();
    }
} else {
    // Redirect to the customer page if the request method is not POST
    header("Location: ../app/admin/customer.php?msg=invalid");
    exit();
}
?>