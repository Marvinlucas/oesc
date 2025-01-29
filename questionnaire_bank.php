<!DOCTYPE html>
<html lang="en">

<head>

    <title>Questionnaire List - OESWC</title>
    <link rel="icon" type="image/png" href="img/graduation-hat.png">

    <?php 
    include 'head.php'; 
    include 'functions.php'; 
    error_reporting(0);
    session_start();

    $query = "SELECT id, question_title, file_name FROM questions";
    $questions = get_data($query);
    $title = "Questionnaire List";


    // DELETE
    if(isset($_POST['delete_question'])){
        $q_id = $_POST['id'];

        $question_del = "DELETE FROM questions WHERE id = '$q_id'";
        execute($question_del);

        $exam_question = "DELETE FROM exam_question WHERE question_id = '$q_id'";
        execute($exam_question);

        $opt_del = "DELETE FROM options WHERE question_id = '$q_id'";
        execute($opt_del);

        header('Location:questionnaire_bank.php');
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

                    <a href="create_question.php"
                        class="d-none d-sm-inline-block btn btn-sm btn-next shadow-sm btn-fat">
                        <iclass="fas fa-download fa-sm text-white-50"></i>
                            Upload Questionnaire
                    </a>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Listed Questionnaire</h6>
                        </div>
                        <div class="card-body special-card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Questionnaire Title</th>
                                            <th>Files</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=0; foreach($questions as $question) { $i++;?>
                                        <tr>
                                            <?php $answer = "";?>
                                            <td><?php echo $i;?></td>
                                            <td><?php echo $question['question_title'];?></td>
                                            <td><?php echo $question['file_name'];?></td>
                                            <td>

                                                <button class="btn btn-warning" data-toggle="modal"
                                                    data-target="#editModal<?php echo $question['id'];?>">Edit</button>

                                                <!-- MODAL -->
                                                <div class="modal fade" id="editModal<?php echo $question['id'];?>"
                                                    tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form method="POST">
                                                                    <label class="label" for="name">Questionnaire</label>
                                                                    <input type="hidden"  id="q_id" name="q_id"
                                                                        value="<?php echo $question['id'];?>">
                                                                    <input id="q_title" class="form-control" type="text"
                                                                        name="q_title"
                                                                        value="<?php echo $question['question_title']; ?>">

                                                                        <p>Click on the "Chosen File" button to upload a Questionnaire file:</p>
                                                                        <input id="q_file" type="file" name="q_file">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-prev"
                                                                    data-dismiss="modal">Cancel</button>
                                                                <button id="edit_question" type="button" class="btn btn-next"
                                                                    name="edit_question" >Save</button>
                                                            </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                <button class="btn btn-danger" data-toggle="modal"
                                                    data-target="#deleteModal<?php echo $question['id'];?>">Delete</button>

                                                <!-- MODAL -->
                                                <div class="modal fade" id="deleteModal<?php echo $question['id'];?>"
                                                    tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog v_center" role="document">
                                                        <div class="modal-content text-center custom_modal">
                                                            <div class="modal-body">
                                                                <img src="img/caution-triangle.png" class="caution"
                                                                    alt="">
                                                                <h5><strong>Are you sure you want to delete this
                                                                        Questionnaire?</strong></h5>
                                                                <form action="#" method="POST" class="signin-form">
                                                                    <input type="hidden" name="id"
                                                                        value="<?php echo $question['id'];?>"
                                                                        autocomplete="off" class="form-control">
                                                                    <button type="button" class="btn btn-prev"
                                                                        data-dismiss="modal">No</button>
                                                                    <input type="submit" class="btn btn-next"
                                                                        name="delete_question" value="Yes">
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- END OF MODAL -->

                                                <!-- END OF MODAL -->

                                                <a href="view_questionnaire.php?name=<?php echo $question['file_name']; ?>" class="btn btn-primary" >View</a>

                                                   <!-- MODAL FOR Confirmation  -->                        
                      <div class="modal fade" id="conf" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog v_center" role="document">
                                                        <div class="modal-content text-center custom_modal">
                                                            <div class="modal-body">
                                                                <img src="img/caution-triangle.png" class="caution" alt="">
                                                                <h5><strong id="message">The file is not a pdf file</strong></h5>
                                                                <button id="no" type="button" class="btn btn-prev" data-dismiss="modal">No</button>
                                                                <button id="submit-trigger" type="button" class="btn btn-next" data-dismiss="modal">Yes</button>
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
            <script>
      $(document).ready(function() {
      


        //SUBMIT QUESTION
        $('#edit_question').click(function() {
            
            var form_data = new FormData();  
            var id = $("#q_id").val();
            form_data.append('id', id);
            var title = $("#q_title").val();
            form_data.append('title', title);
            var file_data = $('#q_file').val != "" ? $('#q_file').prop('files')[0] : "";   
            form_data.append('file', file_data);
      
            $.ajax({
                url: 'edit_question.php', // <-- point to server-side PHP script 
                dataType: 'text',  // <-- what to expect back from the PHP script, if anything
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,                         
                type: 'post',
                success: function(response){
                    if(response == "1"){
                        $("#conf").modal("show");
                    }else{
                        location.reload();
                    }
                    
                }
            });
        });


      });
    </script>



            <?php
        include 'footer.php';
    ?>

</body>

</html>