<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Some cool CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Laundry</title>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center py-5">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header mb-2">
                        <h5 class="text-center">Aplikasi Laundry Online</h5>
                    </div>
                    <div class="card-body">

                        <!-- some cool PHP Scripts -->
                        <?php
                        if (isset($_GET['msg'])) {
                            if ($_GET['msg'] === 'error') {
                                echo "<div class='alert alert-danger'><svg xmlns='http://www.w3.org/2000/svg' x='0px' y='0px' width='40' height='40' viewBox='0 0 30 30' class='p-1 me-2'>
    <path d='M15,3C8.373,3,3,8.373,3,15c0,6.627,5.373,12,12,12s12-5.373,12-12C27,8.373,21.627,3,15,3z M16.414,15 c0,0,3.139,3.139,3.293,3.293c0.391,0.391,0.391,1.024,0,1.414c-0.391,0.391-1.024,0.391-1.414,0C18.139,19.554,15,16.414,15,16.414 s-3.139,3.139-3.293,3.293c-0.391,0.391-1.024,0.391-1.414,0c-0.391-0.391-0.391-1.024,0-1.414C10.446,18.139,13.586,15,13.586,15 s-3.139-3.139-3.293-3.293c-0.391-0.391-0.391-1.024,0-1.414c0.391-0.391,1.024-0.391,1.414,0C11.861,10.446,15,13.586,15,13.586 s3.139-3.139,3.293-3.293c0.391-0.391,1.024-0.391,1.414,0c0.391,0.391,0.391,1.024,0,1.414C19.554,11.861,16.414,15,16.414,15z'></path>
</svg> Login failed! Username or Password is Invalid!</div>";
                            } else if ($_GET['msg'] === 'logout') {
                                echo "<div class='alert alert-info'>You have successfully logout</div>";
                            } else if ($_GET['msg'] === 'not_loggedIn') {
                                echo "<div class='alert alert-danger'>Required Username and Password to access Admin page!</div>";
                            }
                        }
                        ?>
                        <form action="loginSystem.php" method="get">
                            <div class="mb-3">
                                <label for="Username" class="form-label">Username</label>
                                <input type="Username" class="form-control" id="Username" aria-describedby="emailHelp"
                                    name="username" placeholder="Username">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Password</label>
                                <input type="password" class="form-control" id="exampleInputPassword1" name="password"
                                    placeholder="Minimal 8 karakter">
                            </div>
                            <div class="mb-3 form-check">
                                <label for="exampleCheck1" class="form-check-label">Skip Login</label>
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            </div>
                            <input type="submit" class="btn btn-primary" value="Log In">
                            <input type="reset" class="btn btn-secondary" value="Reset Form">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>