<!DOCTYPE html>
<html lang="en">

<head>

    <title>Home - OESWC</title> 

<?php 
    include 'head.php'; 
    include 'functions.php'; 
    session_start();
    $link = $_GET['link'];
    $query = "SELECT id, title, description, time_limit, schedule FROM exams WHERE link = '$link' ";
    $exams = get_data($query);
    
    $exam_id = "";
    $title = "";
    $time_limit = "";
    $schedule = "";

    foreach($exams as $exam){
        $exam_id = $exam['id'];
        $title = $exam['title'];
        $time_limit = $exam['time_limit'];
        $schedule = $exam['schedule'];
    }

    //WHEN FORM IS SUBMITTED
    if(isset($_POST['submit_answers'])){

        for($item = 1; $item <= $_POST['num_questions']; $item+=1 ){
            $opt_id = $_POST['q'.$item];
            $sql = "INSERT INTO answers (option_id, examinee_id, exam_id) VALUES ('$opt_id', $examinee_id, $exam_id)";
            execute($sql);
        }
        //header('Location:success.php?id='.$examinee_id.'&code='.$link);
    }


    
?>

</head>

<body id="page-top" class="take_exam">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->

                <nav class="navbar navbar-expand navbar-light topbar mb-4 static-top">

                    <img class="logo" src="img/logo_black.png" alt="">
                    <!-- Topbar Navbar -->
                    
                    <span id="timer"></span>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div id="#printDiv" class="row">
                        <div class="col-md-12 "><button id="print" class="btn btn-next float-right">Print</button><h2 class="text-center"><?php echo $title; ?></h2></div>
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <div class="card mb-4 questionaire">
                                <div class="card-body">
                                    <form method = "POST" class="signin-form">
                                        <?php

                                            $q_query ="SELECT questions.id 'id', questions.question_text 'question' ";
                                            $q_query.="FROM exam_question ";
                                            $q_query.="INNER JOIN questions ON exam_question.question_id = questions.id ";
                                            $q_query.="WHERE exam_question.exam_id = '$exam_id' ";

                                            $questions = get_data($q_query);
                                            $num_questions = sizeof($questions);
                                            $i = 1;
                                            foreach($questions as $question){
                                        ?>
                                        <div class="form-group mb-3">
                                            <label class="label"><?php echo $i.". ".$question['question']?></label></br>
                                            <?php
                                                $q_id = $question['id'];
                                                $opt_query ="SELECT id, option_text FROM options WHERE question_id = '$q_id' ";
                                                $options = get_data($opt_query);

                                                $idx = 1;
                                                foreach($options as $option){
                                                
                                            ?>
                                            <div class="q_option">
                                                <?php echo chr(64 + $idx)." - ".$option['option_text']; ?>
                                            </div>
                                            
                                            <?php $idx++; }?>
                                        </div>
                                        <?php $i++; } ?>
                                        <input type="hidden" name="num_questions" value ="<?php echo $num_questions; ?>">
                                        
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