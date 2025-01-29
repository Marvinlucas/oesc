<!DOCTYPE html>
<html lang="en">

<head>

    <title>TRAQ - OESWC</title>
    <link rel="icon" type="image/png" href="img/graduation-hat.png">

    <?php 
    include 'head.php'; 
    include 'functions.php'; 
    session_start();
    error_reporting(0);
    $exam_id = $_GET["id"];

    $title = "TRAQ";
    $no_questions = 0;
    $num_query = "SELECT id, no_questions FROM exams WHERE id = '$exam_id' ";
    $num_items = get_data($num_query);
    foreach($num_items as $num_item){
        $no_questions = $num_item["no_questions"];
    }

    /*$takers = 0;
    $no_examinees = "SELECT COUNT(DISTINCT(answers.examinee_id)) AS id FROM answers WHERE exam_id = '$exam_id'";
    $no_of_takers = get_data($no_examinees);
    foreach($no_of_takers as $val){
        $takers = $val['id'];
    }


    $correct = "SELECT exam_question.question_id 'id', COUNT(answers.examinee_id) AS user ";
    $correct.= "FROM exam_question ";
    $correct.= "INNER JOIN answers ON exam_question.question_id = answers.q_no ";
    $correct.= "INNER JOIN exams ON exam_question.exam_id = exams.id ";
    $correct.= "WHERE (exam_question.exam_id = $exam_id) AND (exam_question.answer = answers.answer) ";
    $correct.= "GROUP BY exam_question.question_id ";
    if($takers > 0){
        $check = get_data($correct);
    }


    $output = array();
    if($takers > 0){
        for($i = 1; $i <= $no_questions; $i++){
            $output[$i]["no"] = "q".$i;
            $output[$i]["correct"] = array_key_exists($i,$check) ? $check[$i]["user"] : "0";
            $output[$i]["wrong"] = array_key_exists($i,$check) ?$takers - $check[$i]["user"] : $takers;
        } 
    }*/

    $exam_query = "SELECT question_id 'id', answer 'correct_answer' ";
    $exam_query.= "FROM exam_question ";
    $exam_query.= "WHERE exam_question.exam_id = '$exam_id' ";
    $exams = get_data($exam_query);

    $conn = db_connect();

    $answer_query = "SELECT q_no 'id', answer 'user_answer', examinee_id 'user' ";
    $answer_query.= "FROM answers ";
    $answer_query.= "WHERE answers.exam_id = '$exam_id'";
    $result = $conn->query($answer_query);
    
    while($row = $result->fetch_assoc()){
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
                <button id="print" class="btn btn-next float-right">Print</button>
                    <button class="btn btn-next float-left" id="back" onclick="history.go(-1);" type="button"><i
                            class="fa fa-chevron-left"></i>&nbsp;Back</button><br><br><br>
                            
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8 exam-container">

                            <div class="tab-content" id="pills-tabContent">

                                <div class="tab-pane fade active show" id="pills-create" role="tabpanel"
                                    aria-labelledby="pills-question-tab">
                                  
                                    <div class="tab_body">
                                        <table class="table-bordered traq_table">
                                            <thead>
                                                <tr>
                                                    <th>Questions</th>
                                                    <th>Correct</th>
                                                    <th>%</th>
                                                    <th>Wrong</th>
                                                    <th>%</th>
                                                    <th>Total</th>
                                                    <th>%</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach($exams as $key=>$items){ 
                                        $wrong = $items["total"] - $items["correct_user"];
                                    ?>
                                                <tr>
                                                    <td><?php echo $items["id"]; ?></td>
                                                    <td><?php echo $items["correct_user"]; ?></td>
                                                    <td><?php echo $items["correct_user"] > 0 ? number_format(($items["correct_user"] / $items["total"])*100) : 0 ; ?>
                                                        %</td>
                                                    <td><?php echo $wrong; ?></td>
                                                    <td><?php echo $wrong > 0 ? number_format(($wrong / $items["total"])*100) : 0; ?>%
                                                    </td>
                                                    <td><?php echo $items["total"]; ?></td>
                                                    <td><?php echo number_format(($items["total"] / $items["total"])*100); ?>
                                                    </td>
                                                </tr>
                                                <?php } ?>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <!-- MODAL FOR Confirmation  -->
                            <div class="modal fade" id="conf" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog v_center" role="document">
                                    <div class="modal-content text-center custom_modal">
                                        <div class="modal-body">
                                            <img src="img/caution-triangle.png" class="caution" alt="">
                                            <h5><strong id="message">Are you sure you want to submit
                                                    questionaire?</strong></h5>
                                            <button id="no" type="button" class="btn btn-prev"
                                                data-dismiss="modal">No</button>
                                            <button id="submit-trigger" type="button" class="btn btn-next"
                                                data-dismiss="modal">Yes</button>
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

                $('#print').click(function() {
                    $(this).css("opacity", "0");
                    $('.sticky-footer').css("opacity", "0");

                    window.print();
                });

                window.onafterprint = function(e) {
                    $('#print').css("opacity", "1");
                    $('.sticky-footer').css("opacity", "1");

                }

            });
            </script>
            <?php
        include 'footer.php';
    ?>

</body>

</html>