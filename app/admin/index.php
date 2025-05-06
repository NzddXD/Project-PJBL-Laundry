<!DOCTYPE html>
<html>
<head>
    <title>Sistem Informasi Laundry</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body style="background:#f0f0f0">
    <!-- cek sudah login -->
    <?php
    session_start();
    if ($_SESSION['status'] != "login") {
        header("location:../../index.php?msg=not_loggedIn");
    }
    ?>

    <!-- navigasi -->
    <nav class="navbar navbar-inverse" style="border-radius: 0px">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">LAUNDRY SMKN7BE</a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="index.php"><i class="glyphicon glyphicon-home"></i> Dashboard</a></li>
                    <li><a href="pelanggan.php"><i class="glyphicon glyphicon-user"></i> Pelanggan</a></li>
                    <li><a href="transaksi.php"><i class="glyphicon glyphicon-random"></i> Transaksi</a></li>
                    <li><a href="laporan.php"><i class="glyphicon glyphicon-list-alt"></i> Laporan</a></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                            aria-expanded="false">
                            <i class="glyphicon glyphicon-wrench"></i> Pengaturan <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="pengguna.php"><i class="glyphicon glyphicon-user"></i> Pengguna</a></li>
                            <li><a href="ganti_password.php"><i class="glyphicon glyphicon-lock"></i> Ganti Password</a>
                            </li>
                        </ul>
                    </li>
                    <li><a href="logout.php"><i class="glyphicon glyphicon-log-out"></i> Log Out</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a class="navbar-text">Halo, <?php echo $_SESSION['username']; ?></a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- akhir menu navigasi -->
    <div class="container">
        <div class="alert alert-info text-center">
            <h4 style="margin-bottom: 0px"><b>Selamat datang!</b> di sisttem informasi laundry SMK Neferi 7 Baleendah.
            </h4>
        </div>
        <div class="panel">
            <div class="panel-heading">
                <h4>Dashboard</h4>
            </div>
            <div class="panel-body"> Sistem Informasi Laundry Kelompok1 Kekerenan</div>
        </div>
</body>

</html>