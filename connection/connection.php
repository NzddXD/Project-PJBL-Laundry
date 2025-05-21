<?php
// Host name, username, password, database name
$connect = mysqli_connect('localhost', 'root', '', 'project_laundry');

// Check for errors
if (mysqli_connect_errno()) {
    print("Connection failed!: " . mysqli_connect_errno());
}
?>