<!DOCTYPE html>
<html lang="en">

<head>

    <title>Exam - OESWC</title>

    <?php 
    include 'head.php'; 
    include 'functions.php'; 
    $link = $_GET['link'];
    $query = "SELECT id, title, description, link FROM exams WHERE link = '$link' ";
    $exams = get_data($query);
    $exam_id = "";
    if(isset($_SESSION['exam_taken'])){
        if($_SESSION['exam_taken']){
            $examinee_id = $_SESSION['examinee_id'];
            header('Location:success.php?id='.$examinee_id.'&code='.$link);
        }
    }

    foreach($exams as $exam){
        $exam_id = $exam['id'];
        
    }

    if(isset($_POST['submit_examinee'])){
        $name = $_POST['examinee'];
        $sql = "INSERT INTO examinees (name, exam_id) VALUES('$name', '$exam_id')";
        if(execute($sql)){
            $examinee_id = get_last_id("examinees");
            session_start();
            $_SESSION['examinee_id'] = $examinee_id;
            $_SESSION['examinee_name'] = $name;
            $_SESSION['exam_taken'] = false;
            header('Location:take_exam.php?link='.$link);
        }
    }
    
?>

</head>

<body id="page-top" class="exam">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <div class="card mb-4 examinee_body">
                                <div class="card-body text-center ">
                                    <h2>Enter Your Full Name</h2>

                                    <input type="text" id="examinee" placeholder="Full Name" autocomplete="off"
                                        class="form-control" required>
                                    <button class="btn btn-prev btn-fat" onclick="history.go(-1);">Cancel</button>
                                    <button class="btn btn-next btn-fat" data-toggle="modal"
                                        data-target="#startModal">Start</button>

                                    <!-- MODAL -->
                                     <div class="modal fade" id="startModal" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog v_center" role="document">
                                            <div class="modal-content text-center custom_modal">
                                                <form method="POST">
                                                    <div class="modal-body">
                                                        <img src="img/caution-triangle.png" class="caution" alt="">
                                                        <h5><strong id="message">Are you sure you want to start this exam?</strong></h5>
                                                        <input id="examinee_name" type="hidden" name="examinee">
                                                    
                                                        <button type="button" class="btn btn-prev"
                                                            data-dismiss="modal">Cancel</button>
                                                        <input id="start" type="submit" class=" btn btn-next"
                                                            name="submit_examinee" value="Start">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END OF MODAL -->

                                </div>
                            </div>
                        </div>
                        <div class="col-md-4"></div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
            <script>
            $(document).ready(function() {
                $('#examinee').change(function() {
                    $('#examinee_name').val($('#examinee').val());
                });
                $('#start').click(function() {
                    localStorage.clear();
                })
            });
            </script>

            <div class="foot">
               
            </div>
        </div>
    </div>

</body>
<!-- Bootstrap core JavaScript-->
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</html>