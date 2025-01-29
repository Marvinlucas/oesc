<!DOCTYPE html>
<html lang="en">

<head>

    <title>View Questionnaire - OESWC</title>
    <link rel="icon" type="image/png" href="img/graduation-hat.png">

    <?php 
    include 'head.php'; 
    include 'functions.php';

    $title="View Questionnaire";

    session_start();

    $filename = $_GET['name'];

?>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include 'sidebar.php'; ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include 'header.php'; ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                <div class="form-group">
                            <a class="btn btn-next" onclick="history.go(-1);">Back</a>
                        </div>

                    <div class="col-md-2"></div>
                    <div class="col-md-8 examiner-form">
                        
                        <iframe src="file_viewer.php?name=<?php echo $_GET['name']; ?>" frameborder="0"
                            style="width:100%; min-height:600px"></iframe>
                    </div>



                    <div class="col-md-2"></div>


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