<!DOCTYPE html>
<html lang="en">

<head>

    <title>Examiner List - OESWC</title> 
    <link rel="icon" type="image/png" href="img/graduation-hat.png">

<?php 
    include 'head.php'; 
    include 'functions.php'; 
    session_start();

    $title = "Upload Questionnaire";
    
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


                  <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8 exam-container" >

                      <div class="tab-content" id="pills-tabContent">
                        
                        <div class="tab-pane fade active show" id="pills-create" role="tabpanel" aria-labelledby="pills-question-tab">
                          <div class="tab_body">
                            
                            <div class="form-group">
                              <form method="POST" enctype="multipart/form-data">
                                <label class="label" for="questionire">Questionnaire Title*</label>
                                <input id="q_title" type="text" name="q_title" class="form-control" >
                                <p>Click on the "Choose File" button to upload a Questionnaire file:</p>
                                <input id="q_file" type="file" name="q_file">
                              </form>
                            </div>
                          </div>
                          <div class="float-right">
                          <a class="btn btn-prev" onclick="history.go(-1);">Back</a>
                          <button id="modal_submit" data-toggle="modal" data-target="#conf" class="btn btn-next" disabled>Submit</button>
                          </div>
                          

                        </div>
                      </div>

                          <!-- MODAL FOR Confirmation  -->                        
                      <div class="modal fade" id="conf" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog v_center" role="document">
                                                        <div class="modal-content text-center custom_modal">
                                                            <div class="modal-body">
                                                                <img src="img/caution-triangle.png" class="caution" alt="">
                                                                <h5><strong id="message">Are you sure you want to submit questionaire?</strong></h5>
                                                                <button id="no" type="button" class="btn btn-prev" data-dismiss="modal">No</button>
                                                                <button id="submit-trigger" type="button" class="btn btn-next" data-dismiss="modal">Yes</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                          <!-- END OF MODAL -->

                    </div>
                    <div class="col-md-2"></div>
                  </div>

                    <!-- Page Heading -->
                  
                </div>
                <!-- /.container-fluid --> 
                                            
            </div>
            <!-- End of Main Content -->

            
    <script>
      $(document).ready(function() {
      
        let title = false;
        let file = false;

        $(document).on("change", "#q_title", function(){
          if($(this).val() != ""){
            title = true;
            $(this).css('border-bottom','1px solid black');
          }else{
            $(this).css('border-bottom','2px solid #f2b5c4');
            title = false;
          }

          if(title == true && file == true ){
            $("#modal_submit").removeAttr('disabled');
          }else{
            $("#modal_submit").attr('disabled', 'disabled');
          }
        });

        $(document).on("change", "#q_file", function(){
          if($(this).val() != ""){
            file = true;
            $(this).css('border-bottom','1px solid black');
          }else{
            $(this).css('border-bottom','2px solid #f2b5c4');
            file = false;
          }

          if(title == true && file == true ){
            $("#modal_submit").removeAttr('disabled');
          }else{
            $("#modal_submit").attr('disabled', 'disabled');
          }

        });


        //SUBMIT QUESTION
        $('#submit-trigger').click(function() {
            
            var form_data = new FormData();  
            var title = $("#q_title").val();
            form_data.append('title', title);
            var file_data = $('#q_file').prop('files')[0];   
            form_data.append('file', file_data);
                        
            $.ajax({
                url: 'add_question.php', // <-- point to server-side PHP script 
                dataType: 'text',  // <-- what to expect back from the PHP script, if anything
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,                         
                type: 'post',
                success: function(response){
                    if(response == "1"){
                      $("#message").html("The file is not a pdf file");
                      $("#submit-trigger").hide();
                      $("#conf").modal('toggle');
                    }else if(response == "2"){
                      $("#message").html("File already exists");
                      $("#submit-trigger").hide();
                      $("#no").html("Okay");
                      $("#conf").modal('toggle');
                    }else{
                      location.replace("questionnaire_bank.php");
                    }
                    console.log(response);
                }
            });
        });

        $("#modal_submit").click(function(){
          $("#submit-trigger").show();
            $("#no").html("No");
            $("#message").html("Are you sure you want submit?");
        });


      });
    </script>
    <?php
        include 'footer.php';
    ?>

</body>

</html>