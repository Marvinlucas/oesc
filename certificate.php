<!DOCTYPE html>
<html lang="en">

<head>

    <title>Exam Result - OESWC</title>
    <link rel="icon" type="image/png" href="img/graduation-hat.png">
    <?php 
    include 'head.php'; 
    include 'functions.php'; 
    session_start();
    error_reporting(0);
    $examinee_id = $_GET['id'];
    $exam_id = $_GET['exam_id'];


    $query = "SELECT id, title, description, time_limit, course FROM exams WHERE id = '$exam_id' ";
    $exams = get_data($query);
    
    $title = "";
    $time_limit = "";
    $schedule = "";
    $course = "";
    $desc ="";

    foreach($exams as $exam){
        $title = $exam['title'];
        $time_limit = $exam['time_limit'];
        $course = $exam['course'];
        $desc = $exam['description'];
    }

    $name = "";
    $taker_query = "SELECT id, name FROM examinees WHERE id = '$examinee_id' ";
    $takers = get_data($taker_query);
    foreach($takers as $taker){
        $name = $taker['name'];
    }

    $q_query = "SELECT question_id 'id', num_options, answer FROM exam_question WHERE exam_id = '$exam_id' ";
    $questions = get_data($q_query);

    $ans_query = "SELECT q_no 'id', answer FROM answers WHERE exam_id = '$exam_id' AND examinee_id = '$examinee_id' ";
    $answers = get_data($ans_query);



?>

</head>

<body id="page-top">

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
                <!-- Topbar -->
                <?php include 'header.php'; ?>
                <!-- End of Topbar -->

                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                
                
                <div class="container-fluid">
                <button id="print" class="btn btn-next float-right" type="button">&nbsp;Print</button>
                <button id="back" class="btn btn-next float-left" onclick="history.go(-1);" type="button"><i
                        class="fa fa-chevron-left"></i>&nbsp;Back</button><br><br>

                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <div class="card mb-4 questionaire">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">Exam Title</th>
                                            <th scope="col">Score</th>
                                            <th scope="col">Course</th>
                                            <th scope="col">Result</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><?php echo $name; ?></td>
                                            <td><?php echo $title; ?></td>
                                            <td><?php $output = get_score($examinee_id, $exam_id); echo $output["score"]." / ".$output["total"]; ?>
                                            </td>
                                            <td><?php echo $course; ?></td>
                                            <td>
                                                <?php
   // Retrieve the passing score for the exam
   $passing_query = "SELECT passing_score FROM exams WHERE id = '$exam_id' ";
   $passing_result = mysqli_query($conn, $passing_query);
   $passing_data = mysqli_fetch_assoc($passing_result);
   $passing = $passing_data['passing_score']/100;
   
   // check if $score, $points, $no_questions are defined 
   if(isset($score) && isset($points) && isset($no_questions)){
    $output['score'] = $score * $points;
    $output['total'] = $no_questions * $points;
    $output['result'] = ($output['score'] / $output['total']) * 100 >= $passing ? "Pass" : "Failed"; 
   }
   echo "<span class='";
   echo $output['result'] == "Pass" ? "text-success" : "text-danger";
   echo "'>".$output['result']."</span>";
   ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="card-body no-shadow">
                                    <form method="POST" class="result_container">
                                        <div class="watermark">
                                            <img src="img/araullo_logo.png " alt="Watermark" width="400" height="400">
                                        </div>
                                        <table>
                                            <?php 
                                                        foreach($questions as $question){?>
                                            <tr>
                                                <div class="form-check form-check-inline">
                                                    <!--<div class="numbering">
                                                                    <span class='no'><?php echo $question["id"]; ?>. </span>
                                                                </div>-->
                                                    <td class="text-right numbering"><?php echo $question["id"]; ?>.
                                                    </td>
                                                    <td class="optwrapper">
                                                        <?php
                                                                $bg = "";
                                                                for($i = 1; $i <= $question["num_options"]; $i++){
                                                                    $letter = chr(64 + $i); 
                                                                    if(array_key_exists($question["id"] , $answers)){
                                                                        if($letter == $question["answer"] && $letter == $answers[$question["id"]]["answer"]){
                                                                            $bg = "style=background-color:#75fd75;";
                                                                        }elseif($letter == $question["answer"]){
                                                                            $bg = "style=background-color:#f2b5c4;";
                                                                        }elseif($letter == $answers[$question["id"]]["answer"]){
                                                                            $bg = "style=background-color:#e1e1e1";
                                                                        }else{
                                                                            $bg = "";
                                                                        }
                                                                    }elseif($letter == $question["answer"]){
                                                                        $bg = "style=background-color:#f2b5c4;";
                                                                    }else{
                                                                        $bg = "";
                                                                    }
                                                                ?>
                                                        <label><input class="form-check-input" type="radio"
                                                                name="q_opt<?php echo $question["id"]?>" class="q_opt"
                                                                value="<?php echo $letter; ?>" <?php echo $bg;?>
                                                                disabled><span><?php echo $letter; ?></span></label>
                                                        <?php } ?>
                                                    </td>
                                                </div>
                                            </tr>
                                            <?php } ?>

                                        </table>


                                    </form>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-2"></div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
            <script>
            $(document).ready(function() {
                $('#print').click(function() {
                    $(this).css("opacity", "0");
                    $('.sticky-footer').css("opacity", "0");

                    window.print();
                });

                window.onafterprint = function(e) {
                    $('#print').css("opacity", "1");
                    $('.sticky-footer').css("opacity", "1");

                }

            });
            </script>


            <?php
        include 'footer.php';
    ?>

</body>

</html>