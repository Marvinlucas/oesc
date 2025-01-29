<!DOCTYPE html>
<html lang="en">

<head>

    <title>Examiner List - OESWC</title> 
    <link rel="icon" type="image/png" href="img/graduation-hat.png">

<?php 
    include 'head.php'; 
    include 'functions.php'; 
    session_start();
    $title = "Create Exam";
    
    $query = "SELECT id, name FROM users WHERE type = 2";
    $examiners = get_data($query);

    $q_query = "SELECT id, question_title, file_name FROM questions";
    $questionnaires = get_data($q_query);

    //EXECUTES WHEN SUBMIT QUESTION BUTTON IS CLICKED
    if(isset($_POST['submit_question'])){
      print_r($_POST);
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

                  <div class="row">
                    <div class="col-md-1"><p id="url" class="hide"><?php echo$_SERVER['SERVER_NAME'].$proj_name; ?></p></div>
                    <div class="col-md-10 exam-container" >
                      <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item">
                          <a class="nav-link active" id="title" data-toggle="pill" href="#pills-title" role="tab" aria-controls="pills-title" aria-selected="true">1. Title/Instruction/Course</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="points" data-toggle="pill" href="#pills-points" role="tab" aria-controls="pills-points" aria-selected="false">2. Points/No. Question/Examiner</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="time" data-toggle="pill" href="#pills-time" role="tab" aria-controls="pills-time" aria-selected="false">3. Time/Schedule</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="question" data-toggle="pill" href="#pills-question" role="tab" aria-controls="pills-question" aria-selected="false">4. Answer Key</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link hide" id="add" data-toggle="pill" href="#pills-add" role="tab" aria-controls="pills-add" aria-selected="false">Add Question</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link hide" id="create" data-toggle="pill" href="#pills-create" role="tab" aria-controls="pills-create" aria-selected="false">Create Question</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link hide" id="link" data-toggle="pill" href="#pills-link" role="tab" aria-controls="pills-link" aria-selected="false">Create Question</a>
                        </li>
                      </ul>
                      <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-title" role="tabpanel" aria-labelledby="pills-title-tab">
                          <div class="tab_body">
                            <div class="form-group mb-3">
                              <label  class="label" for="name">Title *</label>
                              <input id="exam_title" type="text" name="title"  class="form-control">
                              <label class="label" for="name">Instruction *</label>

                              <textarea name="desc" id="desc" class="form-control" placeholder="Enter Instruction here" cols="80" rows="1" minlength="10" maxlength="500" style="height: 150px;" required></textarea>


                             
                              <label class="label" for="name">Course *</label>
                              <input id="course" type="text" name="course"  class="form-control" >
                            </div>
                          </div>
                          
                          <div class="float-right">
                          <a class="btn btn-prev" onclick="history.go(-1);">Back</a>
                            <button id="title_next" class="btn btn-next" disabled>Next</button>
                          </div>
                        </div>
                        <div class="tab-pane fade" id="pills-points" role="tabpanel" aria-labelledby="pills-points-tab">
                          <div class="tab_body">
                            <div class="form-group mb-3">
                              <label class="label" for="name">Questionnaire *</label>
                              <select id="questionnaire" class="form-control" aria-label="Default select example">
                                <option selected>Select here</option>
                                <?php foreach($questionnaires as $questionnaire){ ?>
                                  <option value="<?php echo $questionnaire['id']; ?>" data="<?php echo $questionnaire['file_name']; ?>"><?php echo $questionnaire['question_title']; ?></option>
                                <?php } ?>
                              </select>
                              <label class="label" for="name">Points Per Question*</label>
                              <input id="exam_points" type="number" name="points" class="form-control" >
                              <label class="label" for="name">Number of Question*</label>
                              <input id="number" type="number" name="number"  class="form-control" >
                              <label class="label" for="name">Passing Score (1% to 100%)*</label>
                              <input id="passing" type="number" name="passing"  class="form-control" >
                              <label class="label" for="name">Examiner *</label>
                              <select id="examiner" class="form-control" aria-label="Default select example">
                                <option selected>Select here</option>
                                <?php foreach($examiners as $examiner){ ?>
                                  <option value="<?php echo $examiner['id']; ?>"><?php echo $examiner['name']; ?></option>
                                <?php } ?>
                              </select>
                            </div>
                          </div>
                          <div class="float-right">
                            <button id="points_back" class="btn btn-prev">Back</button>
                            <button id="points_next" class="btn btn-next" disabled>Next</button>
                          </div>
                        </div>
                        <div class="tab-pane fade" id="pills-time" role="tabpanel" aria-labelledby="pills-time-tab">
                          <div class="tab_body">
                            <div class="form-group mb-3 row">
                              <div class="col-md-1"></div>
                              <div class="col-md-10">
                                <label class="label" for="name">Time Limit </label>
                              </div>
                              <div class="col-md-1"></div>
                              <div class="col-md-1"></div>
                              <div class="col-md-2">
                                <label class="label" for="name">Hour </label>
                                <select id="hour" class="form-control" aria-label="Default select example">
                                  <option selected>Hour</option>
                                  <?php for($i=0; $i < 13; $i++){ ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                  <?php } ?>
                                </select>
                              </div>
                              <div class="col-md-2">
                                <label class="label" for="name">Minute </label>
                                <select id="minute" class="form-control " aria-label="Default select example">
                                  <option selected>Minute</option>
                                  <?php for($i=0; $i < 60; $i++){ ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                  <?php } ?>
                                </select>
                              </div>
                              
                              <div class="col-md-4">
                                <label class="label" for="name">Schedule</label>
                                <input id="sched" type="datetime-local" name="sched" placeholder="dd/ mm / yyyy " class="form-control" >
                              </div>
                              <div class="col-md-1"></div>
                            </div>
                          </div>
                          <div class="float-right">
                            <button id="time_back" class="btn btn-prev">Back</button>
                            <button id="time_next" class="btn btn-next" disabled>Next</button>
                          </div>
                        </div>
                        <div class="tab-pane fade" id="pills-question" role="tabpanel" aria-labelledby="pills-question-tab">
                          <div class="tab_body row">
                            <div id="questions_options" class="form-group mb-3 col-md-12">
                              <div class="col-md-8">
                                <iframe id="q_viewer" src="" frameborder="0" style="width:100%; min-height:500px" ></iframe>
                              </div>
                              <div class="col-md-4" id="opt_answers">
                                <div class="qwrapper">
                                  <div class="form-check form-check-inline optwrapper">
                                    <label >
                                      <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                                      <span>A</span>
                                    </label>
                                    
                                    <label >
                                      <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                                      <span>B</span>
                                    </label>
                                    
                                    <label >
                                      <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                                      <span>C</span>
                                    </label>

                                    <label >
                                      <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                                      <span>D</span>
                                    </label>

                                  </div>
                                  <div class="answerwrapper">
                                    <span>Answer:&nbsp;&nbsp;</span>
                                    <input id="ans_field" class="custom-width" type="text" disabled>


                                  </div>
                                  <div class="btnwrapper">
                                    <button class="btn add_option"><i class="fa fa-plus-circle"></i></button>
                                    <button class="btn remove_option"><i class="fa fa-minus-circle"></i></button>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="float-right">
                            <button id="question_back" class="btn btn-prev">Back</button>
                            <button id="submit" class="btn btn-next">Submit</button> 
                          </div>

                          <!-- MODAL FOR EMPTY  -->                        
                          <div class="modal fade" id="empty_q" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog v_center" role="document">
                                                        <div class="modal-content text-center custom_modal">
                                                            <div class="modal-body">
                                                                <img src="img/caution-triangle.png" class="caution" alt="">
                                                                <h5><strong>Please fill all fields</strong></h5>
                                                                <button type="button" class="btn btn-prev" data-dismiss="modal">Okay</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                          <!-- END OF MODAL -->

                          <!-- MODAL CONFIRMATION -->                        
                          <div class="modal fade" id="confirmation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog v_center" role="document">
                                                        <div class="modal-content text-center custom_modal">
                                                            <div class="modal-body">
                                                                <img src="img/caution-triangle.png" class="caution" alt="">
                                                                <h5><strong>Are you sure you want to submit?</strong></h5>
                                                                <button type="button" class="btn btn-prev" data-dismiss="modal">No</button>
                                                                <button id="real_submit" type="button" class="btn btn-next" data-dismiss="modal">Yes</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                          <!-- END OF MODAL -->
                          
                        </div>
                        <div class="tab-pane fade" id="pills-add" role="tabpanel" aria-labelledby="pills-question-tab">
                          <div class="tab_body">
                            <div id="tab_content" class="form-group mb-3 row">
                             
                            </div>
                            
                          </div>
                          <button id="add_back" class="btn btn-prev">Back</button>
                          <button id="add_question" class="btn btn-next">Submit</button> 
                        </div>
                        <div class="tab-pane fade" id="pills-create" role="tabpanel" aria-labelledby="pills-question-tab">
                          <div class="tab_body">
                            
                            <div class="form-group mb-3 row">
                              <label class="label" for="question">Question*</label>
                              <input id="item" type="text" name="question" class="form-control" >
                              
                              <div class="options">
                                <div class="option">
                                <input type="radio" name="options" id="option1" value="option1">
                                <input type="text" name="option1" placeholder="Option 1" autocomplete="off" class="form-control" >
                                <button class="btn add_option"><i class="fa fa-plus-circle"></i></button>
                                <button class="btn remove_option"><i class="fa fa-minus-circle"></i></button>
                                </div>
                              </div>

                              <div class="answer">
                              <p>Answer Key*</p>
                              <input id="answer-text" type="text" name="answer" class="form-control" readonly>
                              <input id="answer" type="hidden" name="answer" class="form-control" >
                              </div>

                            </div>
                          </div>
                          <div class="float-right">
                            <button id="create_back" class="btn btn-prev">Back</button>
                            <button id="submit_question" class="btn btn-next">Submit</button>
                          </div>
                        </div>

                        <!-- MODAL FOR EMPTY  -->                        
                        <div class="modal fade" id="inc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog v_center" role="document">
                                                        <div class="modal-content text-center custom_modal">
                                                            <div class="modal-body">
                                                                <img src="img/caution-triangle.png" class="caution" alt="">
                                                                <h5><strong>Please fill up all the fields</strong></h5>
                                                                <button type="button" class="btn btn-prev" data-dismiss="modal">Okay</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                          <!-- END OF MODAL -->

                        <div class="tab-pane fade" id="pills-link" role="tabpanel" aria-labelledby="pills-link-tab">
                          <div class="tab_body">
                            <label class="label" for="question">Quiz Link</label>
                            <div class="form-group mb-3 row">
                            <input id="link_text" type="text" name="answer" class="form-control" readonly>
                            <button id="copy_link" class="btn btn-next">Copy</button>
                            <a href="exam_list.php" id="close" class="btn btn-next">Close</a>
                            </div>
                          </div>
                          
                        </div>

                      </div>

                    </div>
                    <div class="col-md-1"></div>
                  </div>

                    <!-- Page Heading -->
                    

                    
                  
                    

                </div>
                <!-- /.container-fluid --> 
                                            
            </div>
            <!-- End of Main Content -->

            
    <script>
      $(document).ready(function() {
        let title = false;
        let description = false;
        let course = false;
        let points= false;
        let passing = false;
        let num_question = false;
        let examiner = false;
        let questionnaire = false;
        let hour = false;
        let minute = false;
        let schedule = false;
        let file_name ="";

        selected_question={};

        //TITLE
        $('#exam_title').keyup(function(){
          if($(this).val() != ""){
            title = true;
            $(this).css('border-bottom','1px solid black');
          }else{
            $(this).css('border-bottom','2px solid #f2b5c4');
            title = false;
          }

          if(title == true && description == true && course == true){
            $("#title_next").removeAttr('disabled');
          }else{
            $("#title_next").attr('disabled', 'disabled');
          }

        });
        
        $('#desc').keyup(function(){
          if($(this).val() != ""){
            description = true;
            $(this).css('border-bottom','1px solid black');
          }else{
            $(this).css('border-bottom','2px solid #f2b5c4');
            description = false;
          }

          if(title == true && description == true && course == true){
            $("#title_next").removeAttr('disabled');
          }else{
            $("#title_next").attr('disabled', 'disabled');
          }

        });

        $('#course').keyup(function(){
          if($(this).val() != ""){
            course = true;
            $(this).css('border-bottom','1px solid black');
          }else{
            $(this).css('border-bottom','2px solid #f2b5c4');
            course = false;
          }

          if(title == true && description == true && course == true ){
            $("#title_next").removeAttr('disabled');
          }else{
            $("#title_next").attr('disabled', 'disabled');
          }

        });

        //POINTS
        $('#exam_points').keyup(function(){
          if($(this).val() != ""){
            points = true;
            $(this).css('border-bottom','1px solid black');
          }else{
            $(this).css('border-bottom','2px solid #f2b5c4');
            points = false;
          }

          if(points == true && num_question == true && examiner == true && questionnaire == true && passing == true){
            $("#points_next").removeAttr('disabled');
          }else{
            $("#points_next").attr('disabled', 'disabled');
          }

        });

        $('#passing').keyup(function(){

          if($(this).val() != ""){
            passing = true;
            $(this).css('border-bottom','1px solid black');
          }else{
            $(this).css('border-bottom','2px solid #f2b5c4');
            passing = false;
          }

          if(points == true && num_question == true && examiner == true && questionnaire == true && passing == true){
            $("#points_next").removeAttr('disabled');
          }else{
            $("#points_next").attr('disabled', 'disabled');
          }

        });


        function gen_question_options(numberOfItems){
          var container = $("#opt_answers");
          container.empty();
          for(var i = 1; i <= numberOfItems; i++){
            var opt_ans_format = "<div class='qwrapper"+i+"'>";
            opt_ans_format += "<div class='form-check form-check-inline optwrapper1'>";
            opt_ans_format += "<span class='no'>"+i+". </span><label ><input class='form-check-input' type='radio' name='q_opt"+i+"' class='q_opt' data='"+i+"' value='A'><span>A</span></label>";
            opt_ans_format += "<label ><input class='form-check-input' type='radio' name='q_opt"+i+"' class='q_opt' data='"+i+"' value='B'><span>B</span></label>";
            opt_ans_format += "<label ><input class='form-check-input' type='radio' name='q_opt"+i+"' class='q_opt' data='"+i+"' value='C'><span>C</span></label>";
            opt_ans_format += "<label ><input class='form-check-input' type='radio' name='q_opt"+i+"' class='q_opt' data='"+i+"' value='D'><span>D</span></label>";
            opt_ans_format += "</div>";
            opt_ans_format += "<div class='answerwrapper'><span>Answer:</span><input id='ans_field"+i+"' type='text' disabled></div>";
            opt_ans_format += "<div class='btnwrapper'><button class='btn add_option' trigger='"+i+"'><i class='fa fa-plus-circle'></i></button><button class='btn remove_option' trigger='"+i+"'><i class='fa fa-minus-circle'></i></button></div>";
            opt_ans_format += "</div>";
            container.append(opt_ans_format);
          }
        }

        $('#number').keyup(function(){
          if($(this).val() != ""){
            num_question = true;
            $(this).css('border-bottom','1px solid black');
            gen_question_options($(this).val());
          }else{
            $(this).css('border-bottom','2px solid #f2b5c4');
            num_question = false;
          }

          if(points == true && num_question == true && examiner == true && questionnaire == true && passing == true){
            $("#points_next").removeAttr('disabled');
          }else{
            $("#points_next").attr('disabled', 'disabled');
          }
        });

        $('#examiner').change(function(){
          if($(this).val() != ""){
            examiner = true;
            $(this).css('border','1px solid black');
          }else{
            $(this).css('border','2px solid #f2b5c4');
            examiner = false;
          }

          if(points == true && num_question == true && examiner == true && questionnaire == true && passing == true){
            $("#points_next").removeAttr('disabled');
          }else{
            $("#points_next").attr('disabled', 'disabled');
          }
        });

        $(document).on("change", "input[type=radio]", function(){
          var num = $(this).attr('data');
          $('#ans_field'+num+'').val($(this).val());
        });

        $('#questionnaire').change(function(){
          $("#q_viewer").attr("src","file_viewer.php?name="+ $('option:selected', this).attr('data'));
          if($(this).val() != ""){
            questionnaire = true;
            $(this).css('border','1px solid black');
          }else{
            $(this).css('border','2px solid #f2b5c4');
            questionnaire = false;
          }

          if(points == true && num_question == true && examiner == true && questionnaire == true && passing == true){
            $("#points_next").removeAttr('disabled');
          }else{
            $("#points_next").attr('disabled', 'disabled');
          }
        });

        //TIME
        $('#hour').change(function(){
          if($(this).val() != ""){
            hour = true;
            $(this).css('border-bottom','1px solid black');
          }else{
            $(this).css('border-bottom','2px solid #f2b5c4');
            hour = false;
          }

          if(hour == true && minute == true && schedule == true){
            $("#time_next").removeAttr('disabled');
          }else{
            $("#time_next").attr('disabled', 'disabled');
          }

        });

        $('#minute').change(function(){
          if($(this).val() != ""){
            minute = true;
            $(this).css('border-bottom','1px solid black');
          }else{
            $(this).css('border-bottom','2px solid #f2b5c4');
            minute = false;
          }

          if(hour == true && minute == true && schedule == true){
            $("#time_next").removeAttr('disabled');
          }else{
            $("#time_next").attr('disabled', 'disabled');
          }
        });

        $('#sched').change(function(){
          if($(this).val() != ""){
            schedule = true;
            $(this).css('border','1px solid black');
          }else{
            $(this).css('border','2px solid #f2b5c4');
            schedule = false;
          }

          if(hour == true && minute == true && schedule == true){
            $("#time_next").removeAttr('disabled');
          }else{
            $("#time_next").attr('disabled', 'disabled');
          }
        });


        

        $("#title_next").click(function(){
          $('#points').click()
        });

        $('#points_back').click(function(){
          $('#title').click()
        });

        $('#points_next').click(function(){
          $('#time').click()
        });

        $('#time_back').click(function(){
          $('#points').click()
        });

        $('#time_next').click(function(){
          $('#question').click()
        });

        $('#question_back').click(function(){
          $('#time').click()
        });

        $('#add_next').click(function(){
          $('#add').click()
        });

        $('#add_back').click(function(){
          selected_question = {};
          $('#question').click()
        });

        
        //SHOW SELECTED QUESTION
        $('#add_question').click(function(){
          added_question = {};
          $('input[type="checkbox"]:checked').each(function() {
            added_question["question"+this.value] = this.value;
            
          });
          

          let total_question = $('#number').val();
          
          if(Object.keys(added_question).length > parseInt(total_question)){
            $("#warning").modal("show");
          }else{
            selected_question = added_question;
            $.ajax({
                url: "./show_added_questions.php",
                method: "POST",
                dataType: "json",
                data: {data:JSON.stringify(selected_question)},
                success: function(result) {
                    var elem="";
                    var i = 1;
                    for(var q in result){
                      if(result[q].question !== undefined){
                        elem += "<p class='q_list'>"+i+". "+result[q].question+"</p></br>";
                      }
                        for(var opt in result[q].options){
                          if(result[q].options[opt] !== undefined){
                            elem+="<p class='opt_list'>"+result[q].options[opt]+"</p>";
                          }
                        }
                      if(result[q].answer !== undefined){
                        elem+="<p class='ans'> Answer: "+result[q].answer+"</p></br>";
                      }
                      i++;
                    }
                    $("#questions_options").html(elem);

                },
                error: function(log) {
                    // handle error
                    console.log(log);
                }
            });

            $('#question').click();
          }

        });

        
        $(document).on('click','#create_next', function(){
          $('#create').click();
        });

        $('#create_back').click(function(){
          $('#add').click();
        });

        function make_code(length) {
            var result           = '';
            var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            var charactersLength = characters.length;
            for ( var i = 0; i < length; i++ ) {
                result += characters.charAt(Math.floor(Math.random() * charactersLength));
            }
            return result;
        }


        var questions = [];
        //SUBMIT EXAM
        $('#submit').click(function(){

          var num_items = $('#number').val();
          var answer = 0;
          questions = [];
          for(var i = 1; i <= num_items; i+=1){
            var num_options = $(".qwrapper"+i+" label").length;
            if($("#ans_field"+i+"").val() != ""){
              answer += 1;
              questions.push({"question":i, "num_opts":num_options, "answer": $("#ans_field"+i+"").val()})
            }
          }

          if(answer == num_items){
            $("#confirmation").modal("show");
            console.log(questions);
          }else{
            $("#empty_q").modal("show");
            
          }
        });

        $("#real_submit").click(function(){

          $code = make_code(8);
          exam = {
            "title":$('#exam_title').val(),
            "desc":$('#desc').val(),
            "course":$('#course').val(),
            "points":$('#exam_points').val(),
            "number":$('#number').val(),
            "passing":$('#passing').val(),
            "examiner":$('#examiner').val(),
            "hour":$('#hour').val(),
            "minute":$('#minute').val(),
            "sched":$('#sched').val(),
            "questionnaire": $("#questionnaire").val(),
            "questions": questions,
            "code" :$code
          };

          console.log(exam);

          $.ajax({
                url: "./add_exam.php",
                method: "POST",
                dataType: "json",
                data: {myExam:JSON.stringify(exam)},
                success: function(result) {
                    // continue program
                    console.log(result);
                },
                error: function(log) {
                    // handle error
                    console.log(log);
                }
            });

          $('#link').click();
          $('#link_text').val($("#url").html()+"/exam.php?link="+$code);
        });

        $(document).ready(function() {
                $('#copy_link').click(function() {
                    navigator.clipboard.writeText($('#link_text').val());
                    $(this).tooltip('show');
                    setTimeout(function() {
                        $('.copy_link').not(this).tooltip('hide');
                    }, 500);
                });

                $(function() {
                    $('#copy_link').tooltip({
                        title: "Copied to clipboard",
                        trigger: "manual"
                    })
                });
            });


        let na_add = [];
        //SHOW QUESTIONS
        $('#add').click(function(){
          $.ajax({
            type:"GET",
            url:"questions.php",
            dataType:"html",
            success: function(data){
              $('#tab_content').html(data);

              $('input[type="checkbox"]').each(function() {
                console.log("val "+this.value);
                if (Object.values(selected_question).indexOf(this.value) > -1) {
                  $(this).prop('checked', true);
                  na_add.push(this.value);
                }

              });
            }
          });

          
          console.log("na add "+na_add);
        });

        


        var opt_counter = 1;

        
        // ADD OPTION
        $(document).on('click','.add_option', function(){
          var trig= $(this).attr('trigger');
          var num_options = $(".qwrapper"+trig+" label").length;
          var next_char = num_options + 1;
          var opt_format = "<label ><input class='form-check-input' type='radio' name='q_opt"+trig+"' class='q_opt' data='"+trig+"' value='"+(next_char + 9).toString(36).toUpperCase()+"'><span>"+(next_char + 9).toString(36).toUpperCase()+"</span></label>";
          $(".qwrapper"+trig+" .optwrapper1").append(opt_format);
          
        });
        //REMOVE OPTION
        $(document).on('click','.remove_option', function(){
          var trig= $(this).attr('trigger');
          var num_options = $(".qwrapper"+trig+" label").length;
          if(num_options > 2){
            $(".qwrapper"+trig+" label").last().remove();
            $("#ans_field"+trig+"").val("");
          }
        });

        $(document).on('change', 'input[type=radio][name=options]', function() {
          $('#answer-text').val($(this).next().val());
          $('#answer').val($(this).next().attr('name'));
        });

        
        //SUBMIT QUESTION
        $('#submit_question').click(function(){
            q_content = false;
            o_empty = 0;
            question = {};
            if( $('#item').val() !="" && $('#answer').val() != ""){
              question = {
                "question":$('#item').val(),
                "answer":$('#answer').val(),
              };
              q_content = true;
            }else{
              q_content = false;
            }
            

            options ={};
            $('.options input[type=text]').each(function(){
              if($(this).val() != ""){
                options[$(this).attr('name')] = $(this).val();
              }else{
                o_empty += 1;
              }
            });

            if(q_content == true && o_empty == 0){
              
              question['options'] = options;

              $.ajax({
                  url: "./add_question.php",
                  method: "POST",
                  dataType: "json",
                  data: {data:JSON.stringify(question)},
                  success: function(result) {
                      // continue program
                    if(result==1){
                      $('#item').val('');
                      $('#answer').val('');
                      $('#answer-text').val('');
                      $('.option').not(':first').remove();
                      $('.option input[type=text]').val('');
                      $('input[name="options"]').attr('checked', false);
                      $('#add').click();
                    }
                  },
                  error: function(log) {
                      // handle error
                      console.log(log);
                  }
              });
            }else{
              $("#inc").modal("show");
            }
            
            //console.log(JSON.stringify(question));
        });

      });
    </script>
    <?php
        include 'footer.php';
    ?>

</body>

</html>