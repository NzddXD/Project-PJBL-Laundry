<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/favicon.png" type="image/x-icon">

    <link rel="stylesheet" href="style/login.css">
    <title>Laundry</title>
</head>

<body>

    <!-- some cool PHP Scripts -->

    <div class="form-area">

        <div class="title">
            <h1>Login</h1>
            <p>Selamat datang! Silahkan masuk dengan akun anda.</p>
        </div>
        <!-- <div class="line"></div> -->
        <form action="loginSystem.php" method="get" id="login-form" style="overflow: hidden;">
            <div class="content">
                <div class="error">
                    <p class="error-msg" id="err">Error blablabla</p>
                </div>
                <div class="status">
                    <p class="status-msg" id="stat"></p>
                </div>

                <label for="Username" class="form-label">Username</label>
                <input type="text" class="form-control" id="Username" aria-describedby="emailHelp" name="username"
                    placeholder="Username">

                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="password"
                    placeholder="Minimal 8 karakter">

                <input type="submit" class="btn btn-primary" value="Log In">
                <input type="reset" class="btn btn-secondary" value="Reset Form">
            </div>

        </form>
    </div>


    <script>
        const errorMsg = document.querySelector('.error');
        const statusMsg = document.querySelector('.status');

        function error(message) {
            errorMsg.classList.add('visible');
            errorMsg.querySelector('.error-msg').textContent = message;
            if (errorMsg.classList.contains('visible')) {
                setTimeout(() => {
                    vanish(".error");
                    errorMsg.classList.remove('visible');
                }, 2500);
            }
        }
        function status(message) {
            statusMsg.classList.add('visible');
            statusMsg.querySelector('.status-msg').textContent = message;
            if (statusMsg.classList.contains('visible')) {
                setTimeout(() => {
                    vanish(".status");
                    statusMsg.classList.remove('visible');
                }, 2500);
            }
        }
    </script>


    <?php
    if (isset($_GET['msg'])) {
        if ($_GET['msg'] === 'error') {
            echo "<script>error('Username atau password salah!');</script>";
        } else if ($_GET['msg'] === 'logout') {
            echo "<script>status('Anda telah berhasil logout.');</script>";
        } else if ($_GET['msg'] === 'not_loggedIn') {
            echo "<script>error('Silakan login terlebih dahulu.');</script>";
        }
    }
    ?>
    <script src="app/scripts/gsap-public/minified/gsap.min.js"></script>
    <script src="scripts/app.js"></script>
</body>

</html>