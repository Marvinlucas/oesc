<!DOCTYPE html>
<html lang="en">

<head>

    <title>Examiner List - OESWC</title>
    <link rel="icon" type="image/png" href="img/graduation-hat.png">

<?php 
    include 'head.php'; 
    include 'functions.php'; 
    session_start();
    $title = "Change Password";



    if(isset($_POST['submit'])){
        $current_password = $_POST['password'];
      
        // check if the current password matches
        if(check_password($_SESSION['id'], $current_password)){
          if(change_password($_SESSION['id'], $current_password, $_POST['newpassword'])){
            echo '<script>alert("Successfully Changed");</script>';
          }else{
            echo '<script>alert("Password Change Failed");</script>';
          }
        }else{
          echo '<script>alert("Current Password is Wrong");</script>';
        }
      }
      


?>
<script type="text/javascript">
function valid(){
	if(document.chngpwd.newpassword.value!= document.chngpwd.confirmpassword.value){
		alert("New Password and Confirm Password Field do not match  !!");
		document.chngpwd.confirmpassword.focus();
		return false;
	}
	return true;
}
</script>


</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include 'sidebar.php';?>
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


      
    <div class="ts-main-content">
        
		<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">
					
						

						<div class="row">
							<div class="col-md-10">
								<div class="panel panel-default">
									
									<div class="panel-body">
										<form method="post" name="chngpwd" class="form-horizontal" onSubmit="return valid();">
										
											
  	        	 
											
                                            <div class="form-group">
												<label class="col-sm-4 control-label">Current Password</label>
												<div class="col-sm-8">
													<input type="password" class="form-control" name="password" id="password" required>
												</div>
											</div>
											<div class="hr-dashed"></div>
											
											<div class="form-group">
												<label class="col-sm-4 control-label">New Password</label>
												<div class="col-sm-8">
													<input type="password" class="form-control" name="newpassword" id="newpassword" required>
												</div>
											</div>
											<div class="hr-dashed"></div>

											<div class="form-group">
												<label class="col-sm-4 control-label">Confirm Password</label>
												<div class="col-sm-8">
													<input type="password" class="form-control" name="confirmpassword" id="confirmpassword" required>
												</div>
											</div>
											<div class="hr-dashed"></div>
										
								
											
											<div class="form-group">
												<div class="col-sm-8 col-sm-offset-4">
								
													<button class="btn btn-primary" name="submit" type="submit">Save changes</button>
												</div>
											</div>

										</form>

									</div>
								</div>
							</div>
							
						</div>
						
					

					</div>
				</div>
				
			
			</div>
		</div>
	</div>

	<!-- Loading Scripts -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>


                </div>


            </div>
            <!-- End of Main Content -->



            <?php include 'footer.php';?>

</body>

</html>