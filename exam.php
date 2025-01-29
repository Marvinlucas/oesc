<!DOCTYPE html>
<html lang="en">

<head>

    <title>Exam - OESWC</title>
    <link rel="icon" type="image/png" href="img/graduation-hat.png">

    <?php 
    include 'head.php'; 
    include 'functions.php'; 
    date_default_timezone_set('Asia/Manila');
    $link = $_GET['link'];
    $query = "SELECT id, title, description,schedule, link FROM exams WHERE link = '$link' ";
    $exams = get_data($query);

    $title = "";
    $desc = "";
    $sched = "";
    $link = "";
    foreach($exams as $exam){
        $title = $exam['title'];
        $desc = $exam['description'];
        $sched = $exam['schedule'];
        $link = $exam['link'];
    }
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
                        <div class="col-md-4"></div>
                        <div class="col-md-4 text-center intro">

                            <h1><b><?php echo $title; ?></b></h1>
                            <h5 id="descr"><b>Instructions*</b></h5><br>

                            <div class="scrollbar" id="style-3">
                                <div class="force-overflow">
                                    <p id="display"><?php echo $desc; ?></p>
                                </div>
                            </div>

                            <?php if(date("Y-m-d H:i:s") >= $sched){ ?>
                            <a href="register.php?link=<?php echo $_GET['link']; ?>"
                                class="btn btn-pink btn-fat">Start</a>
                            <?php }else{ ?>
                            <p>"Exam not available, check back<b> <?php echo date("F j, Y, g:i a", strtotime($exam['schedule']));?></b>.</p>
                            <?php } ?>

                        </div>
                        <div class="col-md-4"></div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->




<div class="message">Sorry, this website is not compatible with mobile devices please use Laptop or Computer.</div>
</body>

</html>