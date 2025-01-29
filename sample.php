<?php
session_start();
error_reporting(0);
include 'functions.php';

    /*$conn = db_connect();
    $query = "SELECT COUNT(id) AS total FROM questions WHERE MONTH(date_created) = 11 AND YEAR(date_created) = YEAR(curdate()) ";

    $result = $conn->query($query);
    $output ;
    while($row = $result->fetch_assoc()){
        $output['total'] = $row['total'];
    }
    mysqli_close($conn);
    echo $output['total'];*/
    $exam_id = 1;
    $examinee_id = 1;

    $exam_query = "SELECT question_id 'id', answer 'correct_answer' ";
    $exam_query.= "FROM exam_question ";
    $exam_query.= "WHERE exam_question.exam_id = '$exam_id' ";
    $exams = get_data($exam_query);

    echo '<pre>';
    print_r($exams);
    echo '</pre>';

    $conn = db_connect();

    $answer_query = "SELECT q_no 'id', answer 'user_answer', examinee_id 'user' ";
    $answer_query.= "FROM answers ";
    $answer_query.= "WHERE answers.exam_id = '$exam_id'";
    $result = $conn->query($answer_query);
    
    while($row = $result->fetch_assoc()){
        print_r($row);
        echo '<br>';
        if(!isset($exams[$row['id']]['total'])){
            $exams[$row['id']]['total'] = 0;
        }

        if(!isset($exams[$row['id']]['correct_user'])){
            $exams[$row['id']]['correct_user'] = 0;
        }


        $exams[$row['id']]['total'] += 1;
        if($exams[$row['id']]['correct_answer'] == $row['user_answer']){
            $exams[$row['id']]['correct_user'] += 1;
        }
    }

    echo '<pre>';
    print_r($exams);
    echo '</pre>';

    
?>
