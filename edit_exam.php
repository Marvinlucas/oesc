<!DOCTYPE html>
<html lang="en">

<head>

    <title>Examiner List - OESWC</title> 

<?php 
    include 'head.php'; 
    include 'functions.php'; 
    session_start();

    $exam_id = $_GET['id'];
    $query = "SELECT questions.id 'id', questions.question_text 'question_text' ";
    $query.= "FROM exam_question ";
    $query.= "INNER JOIN questions ON exam_question.question_id = questions.id ";
    $query.= "WHERE exam_question.exam_id = '$exam_id' ";
    $questions = get_data($query);
    $title = "Edit Exam";

    //UPDATE 
    if(isset($_POST['edit_question'])){
        $form_data = $_POST;
        $q_id = $form_data['question_id'];
        $q_text = $form_data['question_text'];
        $answer = $form_data['answer'];

        unset($form_data['question_id']);
        unset($form_data['question_text']);
        unset($form_data['answer']);
        unset($form_data['edit_question']);

        $q_query = "UPDATE questions SET question_text = '$q_text' WHERE id = '$q_id' ";
        execute($q_query);

        $reset_opt = "UPDATE options SET is_answer = 0 WHERE question_id = '$q_id' ";
        execute($reset_opt);

        foreach($form_data as $key => $val){
            $update = "";
            if($key == $answer){
                $update = "UPDATE options SET is_answer = 1, option_text = '$val' WHERE id = '$key'";
            }else{
                $update = "UPDATE options SET option_text = '$val' WHERE id = '$key'";
            }
            if(execute($update)){
                header('Location:edit_exam.php?id='.$exam_id);
            }
            
        }
    }

    // DELETE
    if(isset($_POST['delete_question'])){
        $q_id = $_POST['id'];

        $question_exam_del = "DELETE FROM exam_question WHERE exam_id = '$exam_id' AND question_id = '$q_id' ";
        execute($question_exam_del);

        header('Location:edit_exam.php?id='.$exam_id);
    }
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
                <?php include 'header.php'; ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Listed Question</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Question</th>
                                            <th>Option</th>
                                            <th>Answer</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i=0; foreach($questions as $question) { $i++;?>
                                        <tr>
                                            <?php $answer = "";?>
                                            <td><?php echo $i;?></td>
                                            <td><?php echo $question['question_text'];?></td>
                                            <td>
                                                <?php
                                                    $q_id = $question['id'];
                                                    $opt_query = "SELECT id, option_text, is_answer FROM options WHERE question_id = '$q_id' ";
                                                    $options = get_data($opt_query);
                                                    $idx =1;
                                                    $opt_html="";
                                                    foreach($options as $option){
                                                        if($option['is_answer'] == 1){
                                                            $answer = chr(64 + $idx)." - ".$option['option_text'];
                                                            $opt_html.= "<div class=option><input type=radio name=answer value=".$option['id']." checked><input type=text name=".$option['id']."  class=form-control value=".$option['option_text']." required></div>";
                                                        }else{
                                                            $opt_html.= "<div class=option><input type=radio name=answer value=".$option['id']."><input type=text name=".$option['id']."  class=form-control value=".$option['option_text']." required></div>";
                                                        }
                                                        echo chr(64 + $idx)." - ".$option['option_text']." <br> ";
                                                        
                                                        $idx++;
                                                    }
                                                ?>
                                            </td>
                                            <td><?php echo $answer; ?></td>       
                                            <td>
                                                <button class="btn btn-warning" data-toggle="modal" data-target="#editModal<?php echo $question['id'];?>" >Edit</button>
                                                
                                                <!-- MODAL -->                        
                                                <div class="modal fade" id="editModal<?php echo $question['id'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="#" method = "POST">
                                                        <label class="label" for="name">Question</label>
                                                        <input  type="hidden" name="question_id"  value="<?php echo $question['id'];?>">
                                                        <input class="form-control" type="text" name="question_text" value="<?php echo $question['question_text']; ?>" required>
                                                        <?php echo $opt_html; ?>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-prev" data-dismiss="modal">Cancel</button>
                                                        <input type="submit" class="btn btn-next" name="edit_question" value = "Save">
                                                    </div>
                                                    </form>
                                                    </div>
                                                </div>
                                                </div>
                                                <!-- END OF MODAL -->

                                                <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal<?php echo $question['id'];?>">Remove</button>

                                                <!-- MODAL -->                        
                                                <div class="modal fade" id="deleteModal<?php echo $question['id'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog v_center" role="document">
                                                        <div class="modal-content text-center custom_modal">
                                                            <div class="modal-body">  
                                                                <img src="img/caution-triangle.png" class="caution" alt="">
                                                                <h5><strong>Are you sure you want to remove this question?</strong></h5>
                                                                <form method="POST">
                                                                    <input type="hidden" name="id"  value = "<?php echo $question['id'];?>">
                                                                    <button type="button" class="btn btn-prev" data-dismiss="modal">No</button>
                                                                    <input type="submit" class="btn btn-next" name="delete_question" value = "Yes">
                                                                </form>
                                                            </div>
                                                        </div>                 
                                                    </div>                        
                                                </div>
                                                <!-- END OF MODAL --> 

                                                
                                            </td>
                                        </tr>
                                    <?php }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid --> 
                                            
            </div>
            <!-- End of Main Content -->

            

    <?php
        include 'footer.php';
    ?>

</body>

</html>