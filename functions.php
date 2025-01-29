<?php

//CHANGE THIS IF INSTALLED ON LOCAL
$proj_name = "oeswc";
//END CHANGE THIS IF INSTALLED ON LOCAL

$proj_name = $proj_name =="" ? $proj_name : "/".$proj_name;

function db_connect(){

    $server = "localhost";
    $user = "root";
    $password = "";
    $database = "quiz";

    $conn = new mysqli($server, $user, $password,$database);    

    return $conn;
    // Check connection
    if ($conn -> connect_errno) {
    echo "Failed to connect to MySQL: " . $conn -> connect_error;
    exit();
    }
    
}

function login($username, $password){
    session_start();
    $conn = db_connect();
    $myusername = mysqli_real_escape_string($conn,$_POST['username']);
    $mypassword = mysqli_real_escape_string($conn,$_POST['password']); 
      
    $sql = "SELECT id, name, type FROM users WHERE username = '$myusername' and password = '$mypassword'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $result;
    if(mysqli_num_rows($result) == 1){
        $result = array("id"=>$row['id'], "name"=>$row['name'], "type"=>$row['type'], "success"=>"1");
    }else{
        $result = 0;
    }
    return $result;
}

function check_password($id, $password){
    $conn = db_connect();
    $query = "SELECT * FROM users WHERE id = '$id' AND password = '$password'";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) > 0) {
      mysqli_close($conn);
      return true;
    }else{
      mysqli_close($conn);
      return false;
    }
  }
  


  function change_password($id, $old_password, $new_password){
    $conn = db_connect();
    $query = "UPDATE users SET password = '$new_password' WHERE password = '$old_password' AND id = '$id' ";
    $result = false;
    if(mysqli_query($conn, $query)) {
        $result = true;
    } else {
        $result = false;
    }
    mysqli_close($conn);
    return $result;
}
  







function add_examiner($fullname, $course, $username, $password){
    $conn = db_connect();
    $query = "INSERT INTO users (name, course, username, password, type, date_updated) VALUES ('$fullname', '$course', '$username', '$password', 2, 
    DATE(NOW()) )";
    
    if(mysqli_query($conn, $query)){
        $result = true;
    }else{
        $result = false;
    }
    mysqli_close($conn);

    return $result;
}

function execute($query){
    $conn = db_connect();
    
    if($conn->query($query)){
        $result = true;
    }else{
        $result = false;
    }
    mysqli_close($conn);

    return $result;
}

function get_total_examiner(){
    $conn = db_connect();
    $query = "SELECT COUNT(id) AS total FROM users WHERE type = 2 ";

    $result = $conn->query($query);
    $output ;
    while($row = $result->fetch_assoc()){
        $output['total'] = $row['total'];
    }
    mysqli_close($conn);
    return $output['total'];
}

function get_total_examiner_by_month($month){
    $conn = db_connect();
    $query = "SELECT COUNT(id) AS total FROM users WHERE type = 2 AND MONTH(date_created) = '$month' AND YEAR(date_created) = YEAR(curdate()) ";

    $result = $conn->query($query);
    $output ;
    while($row = $result->fetch_assoc()){
        $output['total'] = $row['total'];
    }
    mysqli_close($conn);
    return $output['total'];
}

function my_total_exam($examiner_id){
    $conn = db_connect();
    $query = "SELECT COUNT(id) AS total FROM exams WHERE examiner = '$examiner_id' ";

    $result = $conn->query($query);
    $output ;
    while($row = $result->fetch_assoc()){
        $output['total'] = $row['total'];
    }
    mysqli_close($conn);
    return $output['total'];
}

function my_total_exam_by_month($examiner_id,$month){
    $conn = db_connect();
    $query = "SELECT COUNT(id) AS total FROM exams WHERE examiner = '$examiner_id' AND MONTH(date_created) = '$month' AND YEAR(date_created) = YEAR(curdate()) ";

    $result = $conn->query($query);
    $output ;
    while($row = $result->fetch_assoc()){
        $output['total'] = $row['total'];
    }
    mysqli_close($conn);
    return $output['total'];
}

function get_total_examinees($exam_id){
    $conn = db_connect();
    $query = "SELECT COUNT(DISTINCT examinee_id, exam_id) AS total FROM answers WHERE exam_id = '$exam_id' ";

    $result = $conn->query($query);
    $output ;
    while($row = $result->fetch_assoc()){
        $output['total'] = $row['total'];
    }
    mysqli_close($conn);
    return $output['total'];
}

function get_total_result(){
    $conn = db_connect();
    $query = "SELECT COUNT(DISTINCT examinee_id, exam_id) AS total FROM answers ";

    $result = $conn->query($query);
    $output ;
    while($row = $result->fetch_assoc()){
        $output['total'] = $row['total'];
    }
    mysqli_close($conn);
    return $output['total'];
}

function get_total_result_by_month($month, $user_id){
    $conn = db_connect();
    $query = "SELECT COUNT(DISTINCT answers.examinee_id, answers.exam_id) AS total ";
    $query.= "FROM answers ";
    $query.= "INNER JOIN exams ON answers.exam_id = exams.id ";
    $query.= "WHERE (MONTH(answers.date_taken) = '$month' AND YEAR(answers.date_taken) = YEAR(curdate())) AND exams.examiner = '$user_id' ";
    $result = $conn->query($query);
    $output ;
    while($row = $result->fetch_assoc()){
        $output['total'] = $row['total'];
    }
    mysqli_close($conn);
    return $output['total'];
}

function get_total($table){
    $conn = db_connect();
    $query = "SELECT COUNT(id) AS total FROM ".$table." ";

    $result = $conn->query($query);
    $output ;
    while($row = $result->fetch_assoc()){
        $output['total'] = $row['total'];
    }
    mysqli_close($conn);
    return $output['total'];
}

function get_my_total_examinees($user_id){
    $conn = db_connect();
    $query = "SELECT COUNT(DISTINCT(answers.examinee_id)) AS total ";
    $query.= "FROM answers ";
    $query.= "INNER JOIN exams ON answers.exam_id = exams.id ";
    $query.= "WHERE exams.examiner = '$user_id' ";

    $result = $conn->query($query);
    $output ;
    while($row = $result->fetch_assoc()){
        $output['total'] = $row['total'];
    }
    mysqli_close($conn);
    return $output['total'];
}

function get_total_by_month($table, $month){
    $conn = db_connect();
    $query = "SELECT COUNT(id) AS total FROM ".$table." WHERE MONTH(date_created) = '$month' AND YEAR(date_created) = YEAR(curdate()) ";

    $result = $conn->query($query);
    $output ;
    while($row = $result->fetch_assoc()){
        $output['total'] = $row['total'];
    }
    mysqli_close($conn);
    return $output['total'];
}

function get_score($examinee_id, $exam_id){
    $score = 0;
    $no_questions = "";
    $passing = "";
    $points = "";
    $exam_query = "SELECT points, no_questions, passing_score FROM exams WHERE id = '$exam_id' ";
    $exam_result = get_data($exam_query);
    foreach($exam_result as $exam){
        $no_questions = $exam['no_questions'];
        $passing = $exam['passing_score'];
        $points = $exam['points'];
    }

    $score_query = "SELECT COUNT(exam_question.question_id) AS id ";
    $score_query.= "FROM exam_question ";
    $score_query.= "INNER JOIN answers ON exam_question.question_id = answers.q_no ";
    $score_query.= "WHERE exam_question.answer = answers.answer AND (exam_question.exam_id = '$exam_id' AND answers.examinee_id = '$examinee_id') ";
    $score_result = get_data($score_query);
    foreach($score_result as $scores){
        $score = $scores['id'];
    }
    $output = array();
    if($score > 0){
        $output['score'] = $score * $points;
        $output['total'] = $no_questions * $points;
        $output['result'] = ($output['score'] / $output['total']) * 100 >= $passing ? "Pass" : "Failed"; 
    }else{
        $output['score'] = $score * $points;
        $output['total'] = $no_questions * $points;
        $output['result'] = "Failed";
    }

    return $output;
}


function get_answers($examinee_id, $exam_id){
    $conn = db_connect();
    $query = "SELECT option_id AS answer FROM answers WHERE exam_id ='$exam_id' AND examinee_id = '$examinee_id'";
    $result = $conn->query($query);
    $output ;
    while($row = $result->fetch_assoc()){
        $output[] = $row['answer'];
    }
    mysqli_close($conn);
    return $output;
}

function get_last_id($table){
    $conn = db_connect();
    $query = "SELECT MAX(id) AS latestID FROM $table";
    $result = $conn->query($query);
    $output ;
    while($row = $result->fetch_assoc()){
        $output = $row['latestID'];
    }
    mysqli_close($conn);
    return $output;
}

function get_data($query){
    $conn = db_connect();
    $result = $conn->query($query);
    $output = array();
    while($row = $result->fetch_assoc()){
        $output[$row['id']] = $row;
    }
    mysqli_close($conn);
    return $output;
}


//ACCEPTS NUMBER MINUTES AND RETURNS HR:MIN FORMAT
//EX. minToHr(90) = 1 hour and 30 minutess;
function minToHr($minutes){
    $hrs = floor($minutes / 60);
    $mins = $minutes % 60;

    $hrs_output = $hrs. ($hrs > 1 ? " hours" : " hour");
    $mins_output = $mins. ($mins > 1 ? " minutes" : " minute");
    
    if($hrs == 0){
        return $mins_output;
    }else if($mins == 0){
        return $hrs_output;
    }else{
        return $hrs_output." and ".$mins_output;
    }

}

function minToHrMin($minutes){
    $hrs = floor($minutes / 60);
    $mins = $minutes % 60;

    $hrs_output = $hrs. ($hrs > 1 ? " hours" : " hour");
    $mins_output = $mins. ($mins > 1 ? " minutes" : " minute");
    
    return array("hour"=> $hrs_output, "minute"=> $mins_output);

}

function minToSec($minutes){
    return $minutes*60;
}

function get_total_num_teachers(){
    $conn = db_connect();
    $query = "SELECT COUNT(id) AS teachers FROM users WHERE user_type = 2";
    $result = mysqli_query($conn,$query);
    $data=mysqli_fetch_assoc($result);
    return $data['teachers'];
}


function get_total_num_students(){
    $conn = db_connect();
    $query = "SELECT COUNT(id) AS students FROM users WHERE user_type = 3";
    $result = mysqli_query($conn,$query);
    $data=mysqli_fetch_assoc($result);
    return $data['students'];
}

function get_total_num_exams(){
    $conn = db_connect();
    $query = "SELECT COUNT(id) AS exams FROM quiz_list";
    $result = mysqli_query($conn,$query);
    $data=mysqli_fetch_assoc($result);
    return $data['exams'];
}
function get_total_num_exams_taken($user_id){
    $conn = db_connect();
    $query = "SELECT COUNT(id) AS exams FROM history WHERE user_id = ".$user_id." ";
    $result = mysqli_query($conn,$query);
    $data=mysqli_fetch_assoc($result);
    return $data['exams'];
}



?>