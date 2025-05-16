<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laundry | Pesanan</title>

    <link rel="stylesheet" href="style/style.css">
</head>

<body>
    <?php include 'sidebar.php'; ?> <!-- Cleaner code -->
    <section class="content">
        <h1>Pesanan</h1>
        <div class="dashboard">
            <div class="text-container">
                <p>Data pesanan yang ada di Database</p>
                <!-- <a href="newCustomer.php" class="addbutton">Pelanggan Baru</a> -->
            </div>
            <div class="dashboard">
                <table>
                    <tr>
                        <td>
                            <p>ID</p>
                        </td>
                        <td>
                            <p>Nama</p>
                        </td>
                        <td>
                            <p>Email</p>
                        </td>
                        <td>
                            <p>Jenis Kelamin</p>
                        </td>
                        <td>
                            <p>Alamat</p>
                        </td>
                        <td>
                            <p>Telepon</p>
                        </td>
                        <td>
                            <p>Action</p>
                        </td>
                    </tr>
                    <tr>
                        <td><p></p></td>
                    </tr>
                </table>
            </div>
    </section>
</body>

</html>