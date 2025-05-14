<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laundry | Pelanggan</title>

    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/customer.css">
</head>

<body>
    <?php include 'sidebar.php'; ?> <!-- Cleaner code -->
    <section class="content">
        <h1>Pelanggan</h1>
        <div class="dashboard">
            <table>
                <tr>
                    <td><p>ID</p></td>
                    <td><p>Email</p></td>
                    <td><p>Username</p></td>
                    <td><p>Action</p></td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>muhammadnezad1212@gmail.com</td>
                    <td>Himiko</td>
                    <td><a href="#" class="edit"><img src="../../assets/pencil.png" width="23" height="23" alt="pencil icon"></a></td>
                    <td><a href="#" class="edit"><img src="../../assets/trash.png" width="23" height="23" alt="trash icon"></a></td>
                </tr>
            </table>
        </div>
    </section>
</body>

</html>