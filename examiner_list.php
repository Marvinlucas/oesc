<!DOCTYPE html>
<html lang="en">

<head>

    <title>Examiner List - OESWC</title>
    <link rel="icon" type="image/png" href="img/graduation-hat.png">

    <?php 
    include 'head.php'; 
    include 'functions.php'; 
    session_start();

    $title = "Examiner List";

    $query = "SELECT id, name, course, username, password FROM users WHERE type = 2";
    $examiners = get_data($query);

    //UPDATE DATA
    if(isset($_POST['save'])){

        $id = $_POST['id'];
        $fullname = $_POST['fullname'];
        $course = $_POST['course'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        $query = "UPDATE users SET name = '$fullname', course = '$course', username = '$username', password = '$password' WHERE id = '$id' ";
        if(execute($query)){
            header('Location:examiner_list.php');
            echo '<script>alert("Successfully saved")</script>';
        }else{
            echo '<script>alert("Failed")</script>';
        }
    }
    

    if(isset($_POST['delete'])){
        $id = $_POST['id'];
        $query = "DELETE FROM users WHERE id = '$id'";
        if(execute($query)){
            header('Location:examiner_list.php');
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

                    <a href="add_examiner.php" class="d-none d-sm-inline-block btn btn-sm btn-next shadow-sm btn-fat">
                        <iclass="fas fa-download fa-sm text-white-50"></i>
                            Add Examiner
                    </a>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Listed Examiner</h6>
                        </div>
                        <div class="card-body special-card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Examiner Name</th>
                                            <th>Course</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
$i = 0;
foreach(!empty($examiners) ? $examiners : [] as $examiner) { 
  $i++;?>
                                        <tr>
                                            <td><?php echo $i;?></td>
                                            <td><?php echo $examiner['name'];?></td>
                                            <td><?php echo $examiner['course'];?></td>
                                            <td>
                                                <button class="btn btn-warning" data-toggle="modal"
                                                    data-target="#editModal<?php echo $examiner['id'];?>">Edit</button>

                                                <!-- MODAL -->
                                                <div class="modal fade" id="editModal<?php echo $examiner['id'];?>"
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
                                                                <form action="#" method="POST" class="signin-form">

                                                                    <div class="form-group mb-3">
                                                                        <label class="label" for="name">Full Name
                                                                            *</label>
                                                                        <input type="hidden" name="id"
                                                                            value="<?php echo $examiner['id'];?>"
                                                                            autocomplete="off" class="form-control">
                                                                        <input type="text" name="fullname"
                                                                            placeholder="Input Examiner Full Name"
                                                                            value="<?php echo $examiner['name'];?>"
                                                                            autocomplete="off" class="form-control"
                                                                            required>
                                                                    </div>

                                                                    <div class="form-group mb-3">
                                                                        <label class="label" for="name">Course *</label>
                                                                        <input type="text" name="course"
                                                                            placeholder="Input Examiner Course"
                                                                            value="<?php echo $examiner['course'];?>"
                                                                            autocomplete="off" class="form-control"
                                                                            required>
                                                                    </div>

                                                                    <div class="form-group mb-3">
                                                                        <label class="label" for="name">Username
                                                                            *</label>
                                                                        <input type="text" name="username"
                                                                            placeholder="Input Examiner Username"
                                                                            value="<?php echo $examiner['username'];?>"
                                                                            autocomplete="off" class="form-control"
                                                                            required>
                                                                    </div>

                                                                    <div class="form-group mb-3">
    <label class="label" for="password">Password *</label>
    <div class="input-group">
        <input type="password" name="password" placeholder="Input Examiner Password" value="<?php echo $examiner['password'];?>" autocomplete="off" class="form-control" required>
        <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="button" id="show-password">
                <i class="fa fa-eye"></i>
            </button>
        </div>
    </div>
</div>



                                                            </div>
                                                            <div class="modal-footer">
                                                                <div class="float-right">
                                                                    <button type="button" class="btn btn-prev"
                                                                        data-dismiss="modal">Back</button>
                                                                    <input type="submit" class=" btn btn-next"
                                                                        name="save" value="Save">
                                                                </div>
                                                            </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- END OF MODAL -->

                                                <button class="btn btn-danger" data-toggle="modal"
                                                    data-target="#deleteModal<?php echo $examiner['id'];?>">Delete</button>

                                                <!-- MODAL -->
                                                <div class="modal fade" id="deleteModal<?php echo $examiner['id'];?>"
                                                    tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog v_center" role="document">
                                                        <div class="modal-content text-center custom_modal">
                                                            <div class="modal-body">
                                                                <img src="img/caution-triangle.png" class="caution"
                                                                    alt="">
                                                                <h5><strong>Are you sure you want to delete this
                                                                        examiner?</strong></h5>
                                                                <form method="POST">
                                                                    <input type="hidden" name="id"
                                                                        value="<?php echo $examiner['id'];?>">
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
    <script>
    var passwordInput = document.querySelector('input[name="password"]');
    var showPasswordButton = document.querySelector('button[id="show-password"]');

    showPasswordButton.addEventListener('click', function () {
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            showPasswordButton.innerHTML = '<i class="fa fa-eye-slash"></i>';
        } else {
            passwordInput.type = "password";
            showPasswordButton.innerHTML = '<i class="fa fa-eye"></i>';
        }
    });
</script>


</body>

</html>