<?php 
// Start session
session_start();

// Connection
include 'connection/connection.php';

$username = $_GET['username'];
$password = md5($_GET["password"]); // Encrypt to MD5

// Admin data
$data = mysqli_query($connect, "SELECT * FROM tb_user WHERE username = '$username' AND password = '$password' AND role = 'admin'");
$cek = mysqli_num_rows($data);

if ($cek > 0){
    $_SESSION["username"] = $username;
    // $_SESSION["password"] = md5($password);
    $_SESSION["status"] = 'login';
    header("location:app/admin/index.php");
} else {
    header("location:index.php?msg=error");
}