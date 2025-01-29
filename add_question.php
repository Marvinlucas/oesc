<?php
    include 'functions.php';
    
    $dir = "questionnaires/";
    $file = $dir.$_FILES["file"]["name"];
    $filetype = strtolower(pathinfo($file, PATHINFO_EXTENSION));
    if($filetype != "pdf"){
        echo "1";
    }else{
        $title = $_POST["title"];
        $file_name = $_FILES["file"]["name"];
        $i = 1;
        while (file_exists($dir . $file_name)) {
            $file_name = pathinfo($file_name, PATHINFO_FILENAME) . '_' . $i . '.' . pathinfo($file_name, PATHINFO_EXTENSION);
            $i++;
        }
        $file = $dir . $file_name;
        $insert = "INSERT INTO questions (question_title, file_name) VALUES ('$title', '$file_name') ";
        if(execute($insert)){
            move_uploaded_file($_FILES["file"]["tmp_name"], $file);
        }
    }
?>
