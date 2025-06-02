<?php
include $_SERVER['DOCUMENT_ROOT'] . '/project/connection/connection.php';

// Dapatkan id dari kueri string
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

// Fetch data transaksi
$stmt = $connect->prepare(
    "SELECT 
        t.*, 
        o.nama AS nama_outlet, o.alamat AS alamat_outlet, o.tlp AS tlp_outlet,
        m.nama AS nama_member, m.alamat AS alamat_member, m.tlp AS tlp_member, m.email AS email_member,
        p.nama_paket, p.jenis AS jenis_paket, p.harga AS harga_paket, p.kode_paket, d.berat
    FROM tb_transaksi t
    LEFT JOIN tb_outlet o ON t.id_outlet = o.id_outlet
    LEFT JOIN tb_member m ON t.id_member = m.id_member
    LEFT JOIN tb_detail_transaksi d ON t.id_transaksi = d.id_transaksi
    LEFT JOIN tb_paket p ON d.id_paket = p.id_paket
    WHERE t.id_transaksi = ?"
);
$stmt->bind_param("i", $id);
$stmt->execute();
$hasil = $stmt->get_result();
$transaksi = $hasil->fetch_assoc();

// Join data dari outlet


// Cek jika data ada dengan ID yang ditentukan
if (!$transaksi) {
    echo "Data transaksi tidak ditemukan!";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laundry | Laporan</title>
    <?php include '../../funcs/globalFavIcon.php';?>

    <link rel="stylesheet" href="style/laporan.css">
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="title">
                <h1>Laporan</h1>
                <p>RPLaundry</p>
            </div>
            <div class="print">
                <button onclick="window.print()">
                    <img src="../../assets/print.png" alt="print" width="27" height="27">
                    Print
                </button>
            </div>
        </div>
        <div class="content">
            <!-- <table>
                <tr width="20%">
                    <th><img src="../../assets/material-rounded/24/calendar--v1.png" alt="date" width="27" height="27">Tanggal</th>
                    <td colspan="2">12 Oktober 2007</td>
                </tr>
                <tr>
                    <th>Nama</th>
                    <td colspan="2">Darren Marvel</td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td colspan="2">Jakarta</td>
                </tr>
                </tr>
                <tr>
                    <th>Jenis Pakaian</th>
                    <td colspan="2">Kaos</td>
                </tr>
                <tr>
                    <th>Total Berat Pakaian</th>
                    <td colspan="2">1.1 kg</td>
                </tr>
                <tr>
                    <th>Kode Paket</th>
                    <td colspan="2" style="font-family: 'Consolas';">1425</td>
                </tr>
                <tr>
                    <th>Harga Total</th>
                    <td colspan="2">40000</td>
                </tr>
            </table> -->
            <!-- Tanggal -->
            <div class="items">
                <div class="item">
                    <div class="item-name">
                        <img src="../../assets/date.png" alt="date" width="27" height="27">
                        <b>Tanggal</b>
                    </div>
                    <p><?= date('M d, Y', strtotime($transaksi['tgl'])); ?></p>
                </div>

                <!-- Nama Pelanggan -->
                <div class="item">
                    <div class="item-name">
                        <img src="../../assets/user.png" alt="user" width="27" height="27">
                        <b>Nama Pelanggan</b>
                    </div>
                    <p><?= htmlspecialchars($transaksi['nama_member']); ?></p>
                </div>

                <!-- Alamat Pelanggan -->
                <div class="item">
                    <div class="item-name">
                        <img src="../../assets/marker.png" alt="user" width="27" height="27">
                        <b>Alamat Pelanggan</b>
                    </div>
                    <p><?= htmlspecialchars($transaksi['alamat_member']); ?></p>
                </div>

                <!-- Nama Outlet -->
                <div class="item">
                    <div class="item-name">
                        <img src="../../assets/shop.png" alt="user" width="27" height="27">
                        <b>Nama Outlet</b>
                    </div>
                    <p><?= htmlspecialchars($transaksi['nama_outlet']); ?></p>
                </div>

                <!-- Alamat Outlet -->
                <div class="item">
                    <div class="item-name">
                        <img src="../../assets/marker-outline.png" alt="home" width="27" height="27">
                        <b>Alamat Outlet</b>
                    </div>
                    <p><?= htmlspecialchars($transaksi['alamat_outlet']); ?></p>
                </div>

                <!-- Nama Paket -->
                <div class="item">
                    <div class="item-name">
                        <img src="../../assets/price-tag.png" alt="t-shirt" width="27" height="27">
                        <b>Nama Paket</b>
                    </div>
                    <p><?= htmlspecialchars($transaksi['nama_paket']); ?></p>
                </div>

                <!-- Jenis Paket -->
                <div class="item">
                    <div class="item-name">
                        <img src="../../assets/box.png" alt="t-shirt" width="27" height="27">
                        <b>Jenis Paket</b>
                    </div>
                    <p><?= htmlspecialchars($transaksi['jenis_paket']); ?></p>
                </div>

                <!-- Kode Paket -->
                <div class="item">
                    <div class="item-name">
                        <img src="../../assets/package.png" alt="package" width="27" height="27">
                        <b>Kode Paket</b>
                    </div>
                    <p style="font-family: 'Consolas';"><?= htmlspecialchars($transaksi['kode_paket']); ?></p>
                </div>

                <!-- Berat -->
                <div class="item">
                    <div class="item-name">
                        <img src="../../assets/weight.png" alt="weight" width="27" height="27">
                        <b>Total Berat Pakaian</b>
                    </div>
                    <p><?= htmlspecialchars($transaksi['berat']); ?> kg</p>
                </div>

                <!-- Harga -->
                <div class="item">
                    <div class="item-name">
                        <img src="../../assets/money.png" alt="money" width="27" height="27">
                        <b>Harga Total</b>
                    </div>
                    <p>Rp <?= number_format($transaksi['harga_paket'], 0, ',', '.'); ?></p>
                </div>

                <!-- Status Dibayar -->
                <div class="item">
                    <div class="item-name">
                        <img src="../../assets/info.png" alt="money" width="27" height="27">
                        <b>Dibayar?</b>
                    </div>
                    <p><?php
                    if ($transaksi['dibayar'] === 'Dibayar') {
                        echo "Sudah Dibayar";
                    } else {
                        echo "Belum Dibayar";
                    }
                    ?></p>
                </div>
                <p align="center">Terima kasih telah memilih layanan laundry kami!</p>
            </div>
        </div>
    </div>
    <script src="../scripts/gsap-public/minified/gsap.min.js"></script>

    <script src="../scripts/reportTransition.js"></script>
</body>

</html>