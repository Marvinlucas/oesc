<?php 
    include 'functions.php';
    $exam=json_decode($_POST['myExam']);

    $hr_to_min = $exam->hour * 60;
    $time_limit = $hr_to_min + $exam->minute;

    $sql = "INSERT INTO exams (title, description, course, points, no_questions, passing_score, examiner, time_limit, schedule, questionnaire, link) VALUES('$exam->title', '$exam->desc', '$exam->course', '$exam->points', '$exam->number', '$exam->passing', '$exam->examiner','$time_limit', '$exam->sched', '$exam->questionnaire', '$exam->code') ";
    if(execute($sql)){
        $exam_id = get_last_id("exams");


        foreach($exam->questions as $key=>$value){
            $question_id = $value->question;
            $num_opts = $value->num_opts;
            $ans = $value->answer;
            $query = "INSERT INTO exam_question (exam_id, question_id, num_options, answer) VALUES('$exam_id', '$question_id', '$num_opts', '$ans' )";
            if(execute($query)){
                echo 1;
            }
        }
        echo "1";
    }else{
        echo "2";
    }
?>