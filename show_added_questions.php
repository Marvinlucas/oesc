<?php

include 'functions.php';
$question_ids=json_decode($_POST['data']);
$q = array();
foreach($question_ids as $question_id){
    $query = "SELECT id, question_text FROM questions WHERE id = '$question_id'" ;
    $questions = get_data($query);
    foreach($questions as $question){
        $q_id = $question['id'];
        $opt_query ="SELECT id, option_text, is_answer FROM options WHERE question_id='$q_id' ";
        $options = get_data($opt_query);
        $answer = "";
        $q[$question['id']]['question'] = $question['question_text'];
        foreach($options as $option){
            $q[$question['id']]["options"][] = $option['option_text'];
            $q["options"][] = $option['option_text'];
            if($option['is_answer'] == 1){
                $answer = $option['option_text']; 
            } 
        }
        $q[$question['id']]['answer'] = $answer;
    }
} 
echo json_encode($q);
?>

