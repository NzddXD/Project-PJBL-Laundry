<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Some cool CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Afacad:ital,wght@0,400..700;1,400..700&family=Merriweather+Sans:ital,wght@0,300..800;1,300..800&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
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
        <form action="loginSystem.php" method="get" id="login-form" style="overflow: hidden;">
            <div class="error">
                <p class="error-msg" id="err">Error blablabla</p>
            </div>
            <div class="status">
                <p class="status-msg" id="stat"></p>
            </div>
            <div class="mb-3">
                <label for="Username" class="form-label">Username</label>
                <input type="Username" class="form-control" id="Username" aria-describedby="emailHelp" name="username"
                    placeholder="Username">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="password"
                    placeholder="Minimal 8 karakter">
            </div>

            <input type="submit" class="btn btn-primary" value="Log In">
            <input type="reset" class="btn btn-secondary" value="Reset Form">
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