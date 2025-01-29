<!DOCTYPE html>
<html lang="en">

<head>
    <title>OESWC</title>

    <?php 
    include 'head.php';
    include 'functions.php';
    error_reporting(0);

    session_start();

    if(isset($_SESSION['id'])){
        header('Location:home.php');
    }

    if(isset($_POST['submit'])){
        $result = login($_POST['username'], $_POST['password']);
        if($result['success'] == 1){
            session_start();
            $_SESSION['id'] = $result['id'];
            $_SESSION['name'] = $result['name'];
            $_SESSION['type'] = $result['type'];
            header('Location:home.php');
        }else{
            echo '<script>alert("Incorrect Username or Password")</script>';
        }
    }
    
?>
</head>

<body>


    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-6 col-lg-6 col-md-6">

                <div class="rounded-1 shadow-none my-5">


                    <div class="card mb-4">
                        <div class="card text-center">
                            <div class="card-header" style="color:white;">

                                <img src="img/logo.png" alt="Flowers in Chania" width="200" height="60" class="center">
                            </div>
                        </div>
                        <div class="card-body no-shadow">
                            <br>
                            <h4>Sign In</h4><br>
                            <form action="#" method="POST" class="signin-form">
                                <div class="form-group mb-3">
                                    <label class="label" for="name">Username</label>
                                    <input type="text" name="username" placeholder="Username" autocomplete="off"
                                        class="form-control" required="">
                                </div>
                                <div class="form-group mb-3">
                                    <label class="label" for="password">Password</label>
                                    <input type="password" name="password" placeholder="Password" autocomplete="off"
                                        class="form-control" required="">
                                </div>
                                <div class="form-group">

                                    <button class="form-control btn btn-pink rounded submit px-3"
                                        name="submit">Login</button>
                                </div>

                            </form>
                        </div>

                    </div>
                </div>



            </div>



        </div>

    </div>
    <div class="message">Sorry, this website is not compatible with mobile devices please use Laptop or Computer.</div>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>