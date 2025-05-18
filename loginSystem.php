<?php
// Start session
session_start();

// Connection
include 'connection/connection.php';

$username = $_GET['username'];
$password = md5($_GET["password"]); // Encrypt to MD5

// Prepare and execute query for admin
$stmt = $connect->prepare("SELECT * FROM tb_user WHERE username = ? AND password = ? AND role = 'admin'");
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$result = $stmt->get_result();
$admin_cek = $result->num_rows;

if ($admin_cek > 0) {
    $user = $result->fetch_assoc();
    $_SESSION["username"] = $username;
    $_SESSION["status"] = 'login';
    $_SESSION["role"] = 'admin';
    $_SESSION["id"] = $user['id_user'];
    header("location:app/admin/index.php");
    exit();
} else {
    // Prepare and execute query for cashier

    //  ? is a placeholder for the prepared statement
    // The bind_param method binds the parameters to the SQL query
    
    $stmt = $connect->prepare("SELECT * FROM tb_user WHERE username = ? AND password = ? AND role = 'kasir'");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    $cashier_cek = $result->num_rows;

    if ($cashier_cek > 0) {
        $user = $result->fetch_assoc();
        $_SESSION["username"] = $username;
        $_SESSION["status"] = 'login';
        $_SESSION["role"] = 'cashier';
        $_SESSION["id"] = $user['id_user'];
        header("location:app/cashier/index.php");
        exit();
    } else {
        // Handle invalid login
        header("location:index.php?msg=error");
        exit();
    }
}

// Close statement and connection
$stmt->close();
$connect->close();