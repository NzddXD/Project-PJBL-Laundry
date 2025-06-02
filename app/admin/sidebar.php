<link rel="stylesheet" href="style/sidebar.css">
<link rel="icon" type="image" href="../../assets/favicon.png">

<aside class="navbar">
    <!-- <div class="collapse-button">
        <button id="collapse"><img src="https://img.icons8.com/material-sharp/314345/menu--v1.png" alt="menu" width="20" height="20"></button>
    </div> -->
    <div class="greeting">
        <h1>Menu</h1>
        <p>Sistem Laundry Online</p>
        <!-- <ul>
                <li><?php
                // Start session 
                session_start();

                // Check if user is logged in
                if (!isset($_SESSION["username"])) {
                    header("location:../../index.php?msg=not_loggedIn");
                    exit();
                }

                // Display username
                echo "<p>Selamat datang, " . htmlspecialchars($_SESSION["username"]) . "!</p>";
                ?>
                </li>
            </ul> -->
    </div>
    <div class="menu">
        <ul>
            <li><a href="index.php">Dashboard</a><img src="../../assets/home.png" width="28" height="28" /></li>
            <li><a href="customer.php">Pelanggan</a><img src="../../assets/user.png" width="28" height="28" /></li>
            <li><a href="order.php">Paket</a><img src="../../assets/box.png" width="28" height="28" /></li>
            <li><a href="transaction.php">Transaksi</a><img src="../../assets/cheap-2.png" width="28" height="28" />
            </li>
            <li><a href="outlet.php">Outlet</a><img src="../../assets/shop.png" width="28" height="28" /></li>
            <li><a href="settings.php">Pengaturan</a><img src="../../assets/settings.png" width="25" height="25" /></li>
        </ul>
    </div>
    <div class="logout">
        <ul>
            <div class="login-as">
                <p>Masuk sebagai: <br> <b><?php echo htmlspecialchars($_SESSION["nama"]) ?></b></p>
                <h3>
                    <?php
                    // Check if user is logged in
                    if (!isset($_SESSION["username"])) {
                        header("location:../../index.php?msg=not_loggedIn");
                        exit();
                    }

                    // Display username
                    echo htmlspecialchars($_SESSION["username"]);
                    ?>
                    ( <?php echo htmlspecialchars($_SESSION["role"]) ?> )
                </h3>
            </div>
            <li><a href="logout.php">Logout</a><img src="../../assets/exit.png" width="28" height="28" /></li>
        </ul>
    </div>
    <script src="../scripts/gsap-public/minified/gsap.min.js"></script>
    <script src="../scripts/sidebarScripts.js"></script>
</aside>