<!DOCTYPE html>
<html lang="en">

<head>

    <title>Home - OESWC</title> 
    <link rel="icon" type="image/png" href="img/graduation-hat.png">
<?php 


    include 'head.php'; 
    include 'functions.php'; 
    session_start();
    $title = "ExamList";
    $examiner_id = $_SESSION['id'];
    $query = "SELECT id, title, no_questions, points, schedule, time_limit, link FROM exams WHERE examiner = '$examiner_id' ";
    $exams = get_data($query);
?>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include 'sidebar.php'; ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper " style="width:100%" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include 'header.php'; ?>
                <!-- End of Topbar -->
                
                <!-- Begin Page Content -->
                <div class="container-fluid">
                <button class="btn btn-next float-left" id="back" onclick="history.go(-1);" type="button"><i
                        class="fa fa-chevron-left"></i>&nbsp;Back</button><br><br><br>
                    <!-- Page Heading -->


                    <!-- Content Row -->
                    <div class="row">
                    
                    
                        <!-- Earnings (Monthly) Card Example -->
                        <?php foreach($exams as $exam){?>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-round pink-gradient exam_card">
                                <div class="card-body text-center no-shadow">
                                    <h4><?php echo $exam['title']; ?></h4>
                                    
                                    <div class="btn-group dropright float-right">
                                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                        </button>
                                        <div class="dropdown-menu border-round pink-gradient dropdown_body">
                                            <a href="examinees_result.php?id=<?php echo $exam['id']; ?>" class="card_link" >View</a>
                                            <hr>
                                            <button id="copy" class="copy_link" data="<?php echo "http://" . $_SERVER['SERVER_NAME'].$proj_name."/exam.php?link=".$exam['link'];?>">Copy Link</button>
                                            <hr>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
 
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
        </div>
    </div>     
    
    <script>
        $(document).ready(function() {
            $('.copy_link').click(function(){
                navigator.clipboard.writeText($(this).attr('data'));
            });
        });
    </script>

    <?php
        include 'footer.php';
    ?>
    
</body>

</html>