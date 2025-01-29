<!DOCTYPE html>
<html lang="en">

<head>

    <title>Exam List - OESWC</title>
    <link rel="icon" type="image/png" href="img/graduation-hat.png">

    <?php 

    include 'head.php'; 
    include 'functions.php'; 
    error_reporting(0);
    session_start();
  

    $title = "Exam List";
    $user_id = $_SESSION['id'];
    $query = "SELECT id, title, description, no_questions, points, schedule, passing_score, time_limit, course, examiner, link FROM exams ";
    if($_SESSION['type'] == 2){
        $query.= "WHERE examiner = '$user_id' ";
    }
    $exams = get_data($query);

    $query = "SELECT id, name FROM users WHERE type = 2";
    
    $examiners = get_data($query);

    //UPDATE
    if(isset($_POST['edit_exam'])){
        $id = $_POST['id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $course = $_POST['course'];
        $points = $_POST['points'];
        $no_questions = $_POST['number'];
        $passing = $_POST['passing'];
        $schedule = $_POST['sched'];
        $hr = $_POST['hour'];
        $min = $_POST['minute'];
        $hrToMin = $hr * 60;
        $time_limit = $hrToMin + $min;
        $examiner = $_POST['examiner'];

        $update = "UPDATE exams SET title = '$title', description = '$description', no_questions = '$no_questions', passing_score = '$passing', points = '$points', schedule = '$schedule', time_limit = '$time_limit', course = '$course', examiner = '$examiner' WHERE id = '$id' ";
        if(execute($update)){
            header('Location:exam_list.php');
        }
    }

    //DELETE
    if(isset($_POST['delete_exam'])){
        $exam_id = $_POST['id'];

        $delete_exam = "DELETE FROM exams WHERE id = '$exam_id'";
        execute($delete_exam);

        $del_exam_question = "DELETE FROM exam_question WHERE exam_id = '$exam_id' ";
        execute($del_exam_question);

        $del_answers = "DELETE FROM answers WHERE  exam_id = '$exam_id'";
        execute($del_answers);

        $del_examinees = "DELETE FROM examinees WHERE exam_id = '$exam_id' ";
        execute($del_examinees);

        header('Location:exam_list.php');
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

                    <a href="create_exam.php" class="d-none d-sm-inline-block btn btn-sm shadow-sm btn-next btn-fat">
                        <i class="fas fa-plus fa-sm text-white-50"></i>
                        Create Exam
                    </a>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Listed Exams</h6>
                        </div>
                        <div class="card-body special-card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered numbered" id="dataTable" width="100%"
                                    cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Title of Exam</th>
                                            <th>Course</th>
                                            <th>Points</th>
                                            <th>No. Result</th>
                                            <th>Schedule</th>
                                            <th>Time Limit</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($exams as $exam) {?>
                                        <tr>
                                            <td><?php $time = minToHrMin($exam['time_limit']); ?></td>
                                            <td><?php echo $exam['title'];?></td>
                                            <td><?php echo $exam['course'];?></td>
                                            <td><?php echo $exam['points'];?></td>
                                            <td><?php echo get_total_examinees($exam['id']);?></td>
                                            <td><?php echo date("Y-m-d H:i A", strtotime($exam['schedule']));?></td>
                                            <td><?php echo minToHr($exam['time_limit']);?></td>

                                            <td>
                                                <button class="btn btn-warning" data-toggle="modal"
                                                    data-target="#editModal<?php echo $exam['id'];?>">Edit</button>

                                                <!-- MODAL -->
                                                <div class="modal fade" id="editModal<?php echo $exam['id'];?>"
                                                    tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Edit Exam
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="#" method="POST" class="signin-form">

                                                                    <div class="form-group mb-3">
                                                                        <label class="label" for="name">Title *</label>
                                                                        <input type="hidden" name="id"
                                                                            value="<?php echo $exam['id'];?>"
                                                                            class="form-control">
                                                                        <input type="text" name="title"
                                                                            value="<?php echo $exam['title'];?>"
                                                                            class="form-control" required>
                                                                    </div>

                                                                    <div class="form-group mb-3">
                                                                        <label class="label" for="name">Instruction
                                                                            *</label>
                                                                        <textarea name="description"
                                                                            class="form-control" cols="80" rows="1"
                                                                            minlength="10" maxlength="500"
                                                                            style="height: 150px;"
                                                                            required><?php echo $exam['description'];?></textarea>
                                                                    </div>

                                                                    <div class="form-group mb-3">
                                                                        <label class="label" for="name">Course *</label>
                                                                        <input type="text" name="course"
                                                                            value="<?php echo $exam['course'];?>"
                                                                            class="form-control" required>
                                                                    </div>

                                                                    <div class="form-group mb-3">
                                                                        <label class="label" for="password">Points
                                                                            *</label>
                                                                        <input type="number" name="points"
                                                                            value="<?php echo $exam['points'];?>"
                                                                            class="form-control" required>
                                                                    </div>



                                                                    <div class="form-group mb-3">
                                                                        <label class="label" for="password">Passing
                                                                            Score *</label>
                                                                        <input type="number" name="passing"
                                                                            value="<?php echo $exam['passing_score'];?>"
                                                                            class="form-control" required>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-md-6">Time Limit</div>
                                                                        <div class="col-md-6">Schedule </div>
                                                                        <div class="col-md-3">Hour</div>
                                                                        <div class="col-md-3">Minute</div>
                                                                        <div class="col-md-6"></div>
                                                                        <div class="col-md-3">
                                                                            <select id="hour" name="hour"
                                                                                class="form-control"
                                                                                aria-label="Default select example">
                                                                                <?php for($i=0; $i < 13; $i++){ ?>
                                                                                <option value="<?php echo $i; ?>"
                                                                                    <?php echo $i == $time['hour'] ? "selected" : "";?>>
                                                                                    <?php echo $i; ?></option>
                                                                                <?php } ?>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            <select id="minute" name="minute"
                                                                                class="form-control "
                                                                                aria-label="Default select example">
                                                                                <?php for($i=0; $i < 60; $i++){ ?>
                                                                                <option value="<?php echo $i; ?>"
                                                                                    <?php echo $i == $time['minute'] ? "selected" : "";?>>
                                                                                    <?php echo $i; ?></option>
                                                                                <?php } ?>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <input id="sched" type="datetime-local"
                                                                                name="sched" class="form-control"
                                                                                value=<?php echo date('Y-m-d\TH:i', strtotime($exam['schedule'])) ?>>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group mb-3">
                                                                        <label class="label" for="password">Examiner
                                                                            *</label>
                                                                        <select id="examiner" name="examiner"
                                                                            class="form-control"
                                                                            aria-label="Default select example">
                                                                            <?php foreach($examiners as $examiner){ ?>
                                                                            <option
                                                                                value="<?php echo $examiner['id']; ?>"
                                                                                <?php echo $exam['examiner'] == $examiner['id'] ? "selected" : "";  ?>>
                                                                                <?php echo $examiner['name']; ?>
                                                                            </option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </div>

                                                            </div>
                                                            <div class="modal-footer">
                                                                <div class="float-right">
                                                                    <button type="button" class="btn btn-prev"
                                                                        data-dismiss="modal">Back</button>
                                                                    <input type="submit" class=" btn btn-next"
                                                                        name="edit_exam" value="Save">
                                                                </div>
                                                            </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- END OF MODAL -->

                                                <button class="btn btn-danger" data-toggle="modal"
                                                    data-target="#deleteModal<?php echo $exam['id'];?>">Delete</button>

                                                <!-- MODAL -->
                                                <div class="modal fade" id="deleteModal<?php echo $exam['id'];?>"
                                                    tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog v_center" role="document">
                                                        <div class="modal-content text-center custom_modal">
                                                            <div class="modal-body">
                                                                <img src="img/caution-triangle.png" class="caution"
                                                                    alt="">
                                                                <h5><strong>Are you sure you want to delete this
                                                                        exam?</strong></h5>
                                                                <form action="#" method="POST" class="signin-form">
                                                                    <input type="hidden" name="id"
                                                                        value="<?php echo $exam['id'];?>"
                                                                        autocomplete="off" class="form-control">
                                                                    <button type="button" class="btn btn-prev"
                                                                        data-dismiss="modal">No</button>
                                                                    <input type="submit" class="btn btn-next"
                                                                        name="delete_exam" value="Yes">
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- END OF MODAL -->


                                                <a href="examinees_result.php?id=<?php echo $exam['id']; ?>"
                                                    class="btn btn-primary">View</a>
                                                <a href="traq.php?id=<?php echo $exam['id']; ?>"
                                                    class="btn btn-primary">TRAQ</a>
                                                <button class="btn btn-warning copy_link black" data-toggle="tooltip"
                                                    data-placement="right"
                                                    data="<?php echo "http://" . $_SERVER['SERVER_NAME'].$proj_name."/exam.php?link=".$exam['link'];?>">Copy
                                                    Link</button>
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
                $('.copy_link').click(function() {
                    navigator.clipboard.writeText($(this).attr('data'));
                    $(this).tooltip('show');
                    setTimeout(function() {
                        $('.copy_link').not(this).tooltip('hide');
                    }, 500);
                });

                $(function() {
                    $('.copy_link').tooltip({
                        title: "Copied to clipboard",
                        trigger: "manual"
                    })
                });
            });
            </script>

            <?php
        include 'footer.php';
    ?>

</body>

</html>