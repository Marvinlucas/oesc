<!DOCTYPE html>
<html lang="en">

<head>

    <title>Home - OESWC</title>
    <link rel="icon" type="image/png" href="img/graduation-hat.png">

    <?php 
    include 'head.php'; 
    include 'functions.php'; 
    session_start();
    $examinee_id = $_SESSION['examinee_id'];
    $examinee = $_SESSION['examinee_name'];  
    $link= $_GET['code']; 
    $id= $_GET['id']; 
?>

</head>

<body id="page-top" class="exam">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->

                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top">

                    <!-- Sidebar Toggle (Topbar) -->


                    <!-- Topbar Search -->


                    <!-- Topbar Navbar -->


                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h2></h2>
                        </div>
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <div class="card mb-4 examinee_body">
                                <div class="card-body text-center">
                                    <img class="submitted-img" src="img/submitted.png" alt="">
                                    <h6>Submitted</h6>
                                    <p>Thank you for completing this exam</p>
                                    <!--  <a href="view_result.php?id=<?php echo $id?>&code=<?php echo $link;?>" class="btn btn-next"> View result</a> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4"></div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
            <script>



$(document).ready(function() {
 
          });

      

          

            </script>


            <?php
        include 'footer.php';
    ?>

</body>

</html>