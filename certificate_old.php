<!DOCTYPE html>
<html lang="en">

<head>

    <title>Home - OESWC</title> 
    <link rel="icon" type="image/png" href="img/graduation-hat.png">
<?php 
    include 'head.php'; 
    include 'functions.php'; 
    session_start();
    $id = $_GET['id'];
    $exam_id = $_GET['exam_id'];
    $query = "SELECT examinees.id 'id', examinees.name 'name', answers.date_taken 'date_taken', exams.course 'course', exams.title 'title' ";
    $query.= "FROM answers ";
    $query.= "INNER JOIN examinees ON answers.examinee_id = examinees.id ";
    $query.= "INNER JOIN exams ON answers.exam_id = exams.id ";
    $query.= "WHERE exams.id = '$exam_id' AND examinees.id = '$id'";
    $exams = get_data($query);
    
    $title = "";
    $time_limit = "";
    $schedule = "";

    foreach($exams as $exam){

        $title = $exam['title'];
        $name = $exam['name'];
        $date = $exam['date_taken'];
        $course = $exam['course'];
    }

    $exm = get_score($id, $exam_id);
    
?>

</head>

<body id="page-top" >

    <!-- Page Wrapper -->
    <div id="wrapper">

     <!-- Sidebar -->
     <?php 
            include 'sidebar.php'; 


        ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include 'header.php'; ?>

                    <!-- Topbar Navbar -->
                    
                    <span id="timer"></span>
                </nav>
                <!-- End of Topbar -->
                <button class="btn btn-next float-left" id="back" onclick="history.go(-1);" type="button"><i
                        class="fa fa-chevron-left"></i>&nbsp;Back</button>
                        <button class="btn btn-next float-right" id="print" type="button"><i class="fa fa-print" aria-hidden="true"></i>&nbsp;Print</button>
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div id="#printDiv" class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8 text-center">
                            <img src="img/araullo_logo.png" alt="Cite Logo" >
                        </div>
                        <div class="col-md-2"></div>

                        <div class="col-md-2"></div>
                        <div class="col-md-4 text-center">
                            <p> <strong>Name</strong> </p>
                            <p><?php echo $name; ?></p>
                        </div>
                        <div class="col-md-4 text-center">
                            <p><strong>Date of Issue</strong></p>
                            <p><?php echo date("Y-m-d ", strtotime($date));?></p>
                        </div>
                        <div class="col-md-2"></div>

                        <div class="col-md-2"></div>
                        <div class="col-md-4 text-center">
                            <p><strong>Course</strong></p>
                            <p><?php echo $course; ?></p>
                        </div>
                        <div class="col-md-4">

                        </div>
                        <div class="col-md-2"></div>

                        <div class="col-md-12 text-center">
                            <strong>Exam Result</strong>
                        </div>

                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th class="text-center">Exam</th>
                                    <th class="text-center">Score</th>
                                    <th class="text-center">Result</th>
                                </tr>
                                <tr>
                                    <td class="text-center"><?php echo $title; ?></td>
                                    <td class="text-center"><?php echo $exm['score']."/".$exm['total']; ?></td>
                                    <td class="text-center"><?php echo ($exm['score'] / $exm['total']) >= 0.5 ? "Pass" : "Failed"; ?></td>
                                </tr>
                            </tbody>
                        </table>
                        </div>
                        <div class="col-md-3"></div>

                        <div class="col-md-3"></div>
                        <div class="col-md-6"></div>
                        <div class="col-md-3"></div>
                    </div>
                    
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
            <script>
            $(document).ready(function() {
                $('#print').click(function(){
                    $(this).css("opacity","0");
                    $('.sticky-footer').css("opacity","0");
                    
                    window.print();
                });

                window.onafterprint = function(e){
                    $('#print').css("opacity","1");
                    $('.sticky-footer').css("opacity","1");
                    
                }

            });
            </script>                                           
        
    <?php
        include 'footer.php';
    ?>

</body>

</html>