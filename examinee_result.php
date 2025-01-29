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


    $query = "SELECT id, title, description, time_limit, schedule FROM exams WHERE id = '$exam_id' ";
    $exams = get_data($query);
    
    $title = "";
    $time_limit = "";
    $schedule = "";

    foreach($exams as $exam){
        $title = $exam['title'];
        $time_limit = $exam['time_limit'];
        $schedule = $exam['schedule'];
    }

    $q_query = "SELECT question_id 'id', num_options, answer FROM exam_question WHERE exam_id = '$exam_id' ";
    $questions = get_data($q_query);

    $ans_query = "SELECT q_no 'id', answer FROM answers WHERE exam_id = '$exam_id' AND examinee_id = '$examinee_id' ";
    $answers = get_data($ans_query);


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
                <!-- Topbar -->
                <?php include 'header.php'; ?>
                <!-- End of Topbar -->

                <!-- End of Topbar -->

                <!-- Begin Page Content -->
          
                <div class="container-fluid">

                <button class="btn btn-next float-left" onclick="history.go(-1);" type="button"><i
                        class="fa fa-chevron-left"></i>&nbsp;Back</button>

                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h1><?php echo $title; ?></h1>
                        </div>
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <div class="card mb-4 questionaire">
                                <div>
                                    <span class="float-right"><strong>Score : <?php $output = get_score($examinee_id, $exam_id); echo $output["score"]." / ".$output["total"]; ?>
                                        </strong></span>
                                </div>
                                <div class="card-body no-shadow">
                                    <form method="POST" class="result_container">
                                    <table>
                                    <?php 
                                                        foreach($questions as $question){?>
                                                            <tr>
                                                            <div class="form-check form-check-inline">
                                                                <!--<div class="numbering">
                                                                    <span class='no'><?php echo $question["id"]; ?>. </span>
                                                                </div>-->
                                                                <td class="text-right numbering"><?php echo $question["id"]; ?>.</td>
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
                                                                    <label><input class="form-check-input" type="radio" name="q_opt<?php echo $question["id"]?>" class="q_opt"  value="<?php echo $letter; ?>" <?php echo $bg;?> disabled><span><?php echo $letter; ?></span></label>
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

            });
            </script>


            <?php
        include 'footer.php';
    ?>

</body>

</html>