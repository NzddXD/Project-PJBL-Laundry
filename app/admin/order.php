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
        <h1>Dashboard</h1>
        <div class="dashboard">
            <div class="status-details">
                <div class="status">
                    <img src="../../assets/clock.png" alt="clock" width="45" height="45">
                    <div class="status-text">
                        <p>Cucian Menunggu</p>
                        <h2>100</h2>
                    </div>
                </div>
                <div class="status">
                    <img src="../../assets/user.png" alt="user" width="45" height="45">
                    <div class="status-text">
                        <p>Total Pelanggan</p>
                        <h2>100</h2>
                    </div>

                </div>
                <div class="status">
                    <img src="../../assets/cheap-2.png" alt="dollar" width="45" height="45">
                    <div class="status-text">
                        <p>Total Transaksi</p>
                        <h2>100</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="history">
            <h2 class="history-text">Histori Transaksi</h2>
            <div class="container">
                <p>Histori transaksi dari bulan terakhir</p>
                <a href="http://" target="_blank" rel="noopener noreferrer">Lihat Selengkapnya</a>
            </div>
            <div class="history-table">
                <table>
                    <tr>
                        <td>
                            <h3>Tanggal</h3>
                        </td>
                        <td>
                            <h3>Nama Pelanggan</h3>
                        </td>
                        <td>
                            <h3>Jumlah Transaksi</h3>
                        </td>
                        <td>
                            <h3>Catatan</h3>
                        </td>
                    </tr>
                    <tr>
                        <td>12 Mei 2009</td>
                        <td>Muhammad Nezad</td>
                        <td>26.900</td>
                        <td>Tes deskripsi</td>
                    </tr>
                    <tr>
                        <td>12 Oktober 2007</td>
                        <td>Darren Marvel</td>
                        <td>39.750</td>
                        <td>Ini tes deskripsi kerja kerja kerja</td>
                    </tr>
                    <tr>
                        <td>12 Oktober 2007</td>
                        <td>Darren Marvel</td>
                        <td>39.750</td>
                        <td>Tes deskripsi</td>
                    </tr>
                    <tr>
                        <td>12 Oktober 2007</td>
                        <td>Darren Marvel</td>
                        <td>39.750</td>
                        <td>Tes deskripsi</td>
                    </tr>

                </table>
            </div>
        </div>
    </section>
</body>

</html>