<!DOCTYPE html>
<html lang="en">

<head>

    <title>Exam List - OESWC</title>
    <link rel="icon" type="image/png" href="img/graduation-hat.png">

    <?php 
    include 'head.php'; 
    include 'functions.php'; 
    session_start();
    error_reporting(0);

    $title = "Examinees' Result";

    $exam_id = $_GET['id'];

    $query = "SELECT examinees.id 'id', exams.id 'exam_id', examinees.name 'name', answers.date_taken 'date_taken' ";
    $query.= "FROM answers ";
    $query.= "INNER JOIN exams on answers.exam_id = exams.id ";
    $query.= "INNER JOIN  examinees on answers.examinee_id = examinees.id "; 
    $query.= "WHERE answers.exam_id = '$exam_id' ";
    $exams = get_data($query);


    if(isset($_POST['delete'])){
        echo "delete";
        $id = $_POST['id'];
        $query = "DELETE FROM answers WHERE examinee_id = $id AND exam_id = '$exam_id'";
        execute($query);
        $query = "DELETE FROM examinees WHERE id = $id ";
        if(execute($query)){
            header('Location:examinees_result.php?id='.$exam_id);
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
                
                    <button class="btn btn-next float-left" id="back" onclick="history.go(-1);" type="button"><i
                            class="fa fa-chevron-left"></i>&nbsp;Back</button><br><br><br>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Listed Exam Result</h6>
                            <button class="btn btn-next no-print" onclick="window.print()">Print</button>
                        </div>
                        <div class="card-body special-card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered text-center" id="dataTable" width="100%"
                                    cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Examinee Name</th>
                                            <th>Score</th>
                                            <th>Ratings</th>
                                            <th>Time</th>
                                            <th>Date</th>
                                            <th>Result</th>
                                            <th class="no-print">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=0; foreach($exams as $exam) { 
                                        $i++;
                                        $exm = get_score($exam['id'], $exam['exam_id']);
                                        ?>
                                        <tr>
                                            <td><?php echo $i;?></td>
                                            <td><?php echo $exam['name'];?></td>
                                            <td><?php echo $exm['score']."/".$exm['total'];?></td>
                                            <td><?php echo $exm['score'] > 0 ? number_format(($exm['score']/ $exm['total'])*100) : "0"; ?>%
                                            </td>
                                            <td><?php echo date("h:i A", strtotime($exam['date_taken']));?></td>
                                            <td><?php echo date("Y/m/d ", strtotime($exam['date_taken']));?></td>
                                            <td><?php echo $exm['result']; ?></td>

                                            <td class="no-print">

                                               <!-- <button class="btn btn-danger" data-toggle="modal"
                                                    data-target="#deleteModal <?php echo $exam['id'];?>">Delete</button>-->

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
                                                                        result?</strong></h5>
                                                                <form method="POST">
                                                                    <input type="hidden" name="id"
                                                                        value="<?php echo $exam['id'];?>">
                                                                    <button type="button" class="btn btn-prev"
                                                                        data-dismiss="modal">No</button>
                                                                    <input type="submit" class=" btn btn-next"
                                                                        name="delete" value="Yes">
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <!-- END OF MODAL -->

                                                <a href="examinee_result.php?id=<?php echo $exam['id'];?>&exam_id=<?php echo $exam['exam_id'];?>"
                                                    class="btn btn-primary">View</a>
                                                <a href="certificate.php?id=<?php echo $exam['id'];?>&exam_id=<?php echo $exam['exam_id'];?>"
                                                    class="btn btn-success">Print</a>
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
                });

                $(function() {
                    $('.copy_link').tooltip({
                        title: "Copied to clipboard",
                        trigger: "click"
                    })
                });
            });


           
            </script>

            <?php
        include 'footer.php';
    ?>

</body>

</html>