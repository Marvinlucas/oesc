<?php
    include 'functions.php';
    
    

    if(isset($_FILES["file"]["name"])){

        $dir = "questionnaires/";
        $file = $dir.$_FILES["file"]["name"];
        $filetype = strtolower(pathinfo($file, PATHINFO_EXTENSION));

        if($filetype != "pdf"){
            echo "1";
        }else{
            $id = $_POST["id"];
            $title = $_POST["title"];
            $file_name = $_FILES["file"]["name"];
            $update = "UPDATE questions SET question_title = '$title', file_name = '$file_name' WHERE id = '$id'";
            if(execute($update)){
                move_uploaded_file($_FILES["file"]["tmp_name"], $file);
            }
        }
    }else{
        
        $id = $_POST["id"];
        $title = $_POST["title"];
        $update = "UPDATE questions SET question_title = '$title' WHERE id = '$id'";
        execute($update);

    }
    

   

?>