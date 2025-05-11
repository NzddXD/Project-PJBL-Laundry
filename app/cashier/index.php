<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laundry | Dashboard</title>
</head>
<body>
    <h1>Welcome to the Cashier's Dashboard</h1>
    <p>This is a protected area for Cashier only.</p>

    <?php
    // Start session
    session_start();

    // Check if user is logged in
    if (!isset($_SESSION["username"])) {
        if ($_SESSION["role"] != 'cashier')
        header("location:../../index.php?msg=not_loggedIn");
        exit();
    }

    // Display username
    echo "<p>Hello, " . htmlspecialchars($_SESSION["username"]) . "!</p>";
    ?>

    <a href="logout.php">Logout</a>
</body>
</html>