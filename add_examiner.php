<!DOCTYPE html>
<html lang="en">

<head>

    <title>Examiner List - OESWC</title>
    <link rel="icon" type="image/png" href="img/graduation-hat.png">

    <?php 
    include 'head.php'; 
    include 'functions.php';

    $title="Add Examiner";

    session_start();

    if(isset($_POST['submit'])){
        if(add_examiner($_POST['fullname'], $_POST['course'], $_POST['username'], $_POST['password'])){
            header('Location:examiner_list.php');
        }else{
            echo '<script>alert("Failed")</script>';
        }
    }
?>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include 'sidebar.php'; ?>
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

                    <div class="row examiner-form-container">
                        <div class="col-md-1"></div>
                        <div class="col-md-10 examiner-form">
                            <form action="#" method="POST" class="signin-form">

                                <div class="form-group mb-3">
                                    <label class="label" for="name">Full Name *</label>
                                    <input id="fullname" type="text" name="fullname"
                                        placeholder="Input Examiner Full Name" autocomplete="off" class="form-control">
                                </div>

                                <div class="form-group mb-3">
                                    <label class="label" for="name">Course *</label>
                                    <input id="course" type="text" name="course" placeholder="Input Examiner Course"
                                        autocomplete="off" class="form-control">
                                </div>

                                <div class="form-group mb-3">
                                    <label class="label" for="name">Username *</label>
                                    <input id="username" type="text" name="username"
                                        placeholder="Input Examiner Username" autocomplete="off" class="form-control">
                                </div>

                                <div class="form-group mb-3">
                                    <label class="label" for="password">Password *</label>
                                    <input id="password" type="password" name="password"
                                        placeholder="Input Examiner Password" autocomplete="new-password" class="form-control">
                                    <input id="submit_examiner" type="submit" class=" btn btn-next hide" name="submit"
                                        value="Submit">
                                </div>
                            </form>
                            <div class="form-group float-right">
                                <a class="btn btn-prev" onclick="history.go(-1);">Back</a>
                                <button id="addModalBtn" class="btn btn-next" data-toggle="modal"
                                    data-target="#addModal" disabled>Submit</button>
                            </div>
                        </div>


                        <!-- MODAL -->
                        <div class="modal fade" id="addModal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog v_center" role="document">
                                <div class="modal-content text-center custom_modal">
                                    <div class="modal-body">
                                        <img src="img/caution-triangle.png" class="caution" alt="">
                                        <h5><strong>Are you sure you want to add this examiner?</strong></h5>
                                        <button type="button" class="btn btn-prev" data-dismiss="modal">Cancel</button>
                                        <input id="submit_trigger" type="submit" class=" btn btn-next"
                                            name="submit_examinee" value="Submit">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END OF MODAL -->

                        <div class="col-md-1"></div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <script>
            $(document).ready(function() {

                let name = false;
                let course = false;
                let username = false;
                let password = false;
                $('#fullname').keyup(function() {
                    if ($(this).val() != "") {
                        name = true;
                        $(this).css('border-bottom', '1px solid black');
                    } else {
                        $(this).css('border-bottom', '2px solid #f2b5c4');
                        name = false;
                    }

                    if (name == true && course == true && username == true && password == true) {
                        $("#addModalBtn").removeAttr('disabled');
                    } else {
                        $("#addModalBtn").attr('disabled', 'disabled');
                    }

                });

                $('#course').keyup(function() {
                    if ($(this).val() != "") {
                        course = true;
                        $(this).css('border-bottom', '1px solid black');
                    } else {
                        $(this).css('border-bottom', '2px solid #f2b5c4');
                        course = false;
                    }

                    if (name == true && course == true && username == true && password == true) {
                        $("#addModalBtn").removeAttr('disabled');
                    } else {
                        $("#addModalBtn").attr('disabled', 'disabled');
                    }

                });

                $('#username').keyup(function() {
                    if ($(this).val() != "") {
                        username = true;
                        $(this).css('border-bottom', '1px solid black');
                    } else {
                        $(this).css('border-bottom', '2px solid #f2b5c4');
                        username = false;
                    }

                    if (name == true && course == true && username == true && password == true) {
                        $("#addModalBtn").removeAttr('disabled');
                    } else {
                        $("#addModalBtn").attr('disabled', 'disabled');
                    }

                });

                $('#password').keyup(function() {
                    if ($(this).val() != "") {
                        password = true;
                        $(this).css('border-bottom', '1px solid black');
                    } else {
                        $(this).css('border-bottom', '2px solid #f2b5c4');
                        password = false;
                    }

                    if (name == true && course == true && username == true && password == true) {
                        $("#addModalBtn").removeAttr('disabled');
                    } else {
                        $("#addModalBtn").attr('disabled', 'disabled');
                    }

                });



                $('#submit_trigger').click(function() {
                    $('#submit_examiner').click();
                });
            });
            </script>

            <?php
        include 'footer.php';
    ?>

</body>

</html>