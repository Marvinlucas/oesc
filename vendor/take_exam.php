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
    $link = $_GET['link'];
    $query = "SELECT exams.id 'id', exams.title 'title', exams.description 'description', exams.no_questions 'no_questions', exams.time_limit 'time_limit', exams.schedule 'schedule', questions.file_name 'file_name' ";
    $query .= "FROM exams ";
    $query .= "INNER JOIN questions ON exams.questionnaire = questions.id ";
    $query .= "WHERE link = '$link' ";
    $exams = get_data($query);
    
    $exam_id = "";
    $title = "";
    $time_limit = "";
    $schedule = "";
    $desc ="";
    $num_questions = "";

    

    foreach($exams as $exam){
        $exam_id = $exam['id'];
        $title = $exam['title'];
        $desc = $exam['description'];
        $time_limit = $exam['time_limit'];
        $schedule = $exam['schedule'];
        $file_name = $exam['file_name'];
        $num_questions = $exam['no_questions'];
    }
    
    //WHEN FORM IS SUBMITTED
    if(isset($_POST['submit_answers'])){
        array_shift($_POST); 
        if(empty($_POST)){
            for($q = 1; $q <= $num_questions; $q++){
                $_POST["q_opt".$q] = "";
            }
        }

        for($i = 1; $i <= $num_questions; $i++){
            $val;
            if(!isset($_POST["q_opt".$i])){
                $_POST["q_opt".$i] = "";
                $val = $_POST["q_opt".$i];
            }
            $val = $_POST["q_opt".$i];
            $sql = "INSERT INTO answers (answer, q_no, examinee_id, exam_id) VALUES ('$val', '$i', '$examinee_id', '$exam_id')";
            execute($sql);
        }

        /*foreach($_POST as $key=>$value){
            $qno = str_replace('q_opt', '', $key);
            if(isset($value)){
                $sql = "INSERT INTO answers (answer, q_no, examinee_id, exam_id) VALUES ('$value', '$qno', '$examinee_id', '$exam_id')";
                execute($sql);
            }
        }*/

        header('Location:success.php?id='.$examinee_id.'&code='.$link);
    }

    $q_query = "SELECT question_id 'id', num_options FROM exam_question WHERE exam_id = '$exam_id' ";
    $questions = get_data($q_query);

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

                    
                    <!-- Topbar Navbar -->
                    
                    <span id="timer"></span>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12 text-center" ><h2 id="exam_name"><?php echo $title; ?></h2></div>
                        <div class="col-md-1"><span id="time" class="hide"><?php echo minToSec($time_limit); ?></span></div>
                        <div class="col-md-10">
                            <div class="card mb-4 questionaire no-shadow">
                                <div class="card-body row">
                                    <div class="col-md-6">
                                        <iframe src="file_viewer.php?name=<?php echo $file_name; ?>" frameborder="0" style="width:100%; min-height:600px"></iframe>
                                    </div>
                                    <div class="col-md-6 ans_sheet">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="exam_header">
                                                    <h5><b>Name:</b> <?php echo $examinee; ?></h5> 
                                                </div>
                                                
                                            </div>
                                            <div class="col-md-6"> <h5><b>Exam Title:</b> <?php echo $title; ?></h5> </div>
                                            <div class="col-md-12 opt_list">
                                                <form id="q_form" method="post" class="q_form">
                                                    <table>
                                                    <?php 
                                                        foreach($questions as $question){ ?>
                                                        <tr>
                                                            <div class="form-check form-check-inline optwrapper">
                                                                
                                                                <td class="text-right numbering"><?php echo $question["id"]?>. </td>
                                                                <td class="optwrapper">
                                                                <?php for($i = 1; $i <= $question["num_options"]; $i++){
                                                                    $letter = chr(64 + $i);
                                                                ?>
                                                                    <label><input class="form-check-input" type="radio" name="q_opt<?php echo $question["id"]?>" class="q_opt"  value="<?php echo $letter; ?>" ><span><?php echo $letter; ?></span></label>
                                                                <?php } ?>
                                                                </td>
                                                            </div>
                                                        </tr>
                                                    <?php } ?>
                                                    <input id="submit_answers" type="submit" class="hide" name="submit_answers">
                                                    </table>
                                                </form><br><br>
                                                <div class="text-center">
                                                    <button  class="btn btn-pink btn-fat" data-toggle="modal" data-target="#cautionModal">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
                                    <!-- MODAL -->                        
                                    <div class="modal fade" id="cautionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog v_center" role="document">
                                                    <div class="modal-content text-center custom_modal">
                                                        <div class="modal-body text-center">
                                                        <img src="img/caution-triangle.png" class="caution" alt="">
                                                        <h5><strong id="message">Are you sure you want to submit this exam</strong></h5>
                                                        
                                                            <button type="button" class="btn btn-prev" data-dismiss="modal">No</button>
                                                            <button id="trigger_submit" type="button" class="btn btn-next" data-dismiss="modal">Yes</button>
                                                        </div>

                                                    </div>
                                                </div>
                                    </div>
                                     <!-- END OF MODAL -->
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                    
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
            <script>

                $(document).ready(function() {
                    $('#examinee').change(function(){
                        $('#examinee_name').val($('#examinee').val());
                    })

                    $('#trigger_submit').click(function(){
                        $('#submit_answers').click();
                        
                    });

                    //SCRIPT FOR TIMER

                    /*var timer = $("#timer");
                    
                    var time = parseInt($("#time").text());

                    var Timer = setInterval(function(){
                        time--;
                        document.getElementById("timer").textContent = timeFormat(time);
                        if(time <= 0){
                        clearInterval(Timer);
                        alert("Times up");
                        timer.html("Submitted");
                        $("#submit_answers").click();
                        }
                    },1000);
                    
                    function timeFormat(time){
                        var date = new Date(null);
                        date.setSeconds(time); // specify value for SECONDS here
                        var result = date.toISOString().substr(11, 8);
                        return result;
                    }*/

                    

                });

                (function(){
                    var forms = document.getElementById("q_form");
                    var timer = document.getElementById("timer");
                    var time = document.getElementById("time").innerHTML;
                    var interval;
                    let minutes;
                    let currentTime = localStorage.getItem('currentTime');
                    let targetTime = localStorage.getItem('targetTime');
                    //GET THE STORED ANSWERS
                    for(input = 1; input <= forms.length-1; input++){
                        try{
                            let val = localStorage.getItem('q_opt'+input);
                            if(val != null){
                                document.querySelector("input[name=q_opt"+input+"][value="+val+"]").setAttribute('checked', true);
                            }
                        }
                        catch{

                        }
                        
                    }

                    if (targetTime == null && currentTime == null) {
                        minutes = time;
                        currentTime = new Date();
                        targetTime = new Date(currentTime.getTime() + (minutes * 1000));
                        localStorage.setItem('currentTime', currentTime);
                        localStorage.setItem('targetTime', targetTime);
                    }
                    else{
                        currentTime = new Date(currentTime);
                        targetTime = new Date(targetTime);
                    }

                    if(!checkComplete()){
                        interval = setInterval(checkComplete, 1000);
                    }

                    function checkComplete() {
                        if (currentTime > targetTime) {
                            clearInterval(interval);
                            alert("Time is up");
                            localStorage.clear();
                            submit_button.click();
                        } else {
                            currentTime = new Date();
                            
                            timer.innerHTML = timeFormat(((targetTime - currentTime) / 1000));
                        }
                    }

                    function timeFormat(time){
                        var date = new Date(null);
                        date.setSeconds(time); // specify value for SECONDS here
                        var result = date.toISOString().substr(11, 8);
                        return result;
                    }

                   

                    document.onbeforeunload = function(){
                        localStorage.setItem('currentTime', currentTime);
                    }

                    var submit_button = document.getElementById('submit_answers');
                    //SAVE ANSWERS WHEN CLICKED
                    forms.addEventListener("click", function(){
                        for(i = 1; i<=forms.length-1; i++){
                            try{
                                localStorage.setItem('q_opt'+i, document.querySelector('input[name=q_opt'+i+']:checked').value);
                            }catch{

                            }
                        }
                    });

                    document.addEventListener("visibilitychange", (event) => {
                        if (document.visibilityState == "visible") {
                            console.log("tab is active")
                        } else {
                            submit_button.click();
                        }
                    });

                }());

                


            </script>
            

    <?php
        include 'footer.php';
    ?>

</body>

</html>