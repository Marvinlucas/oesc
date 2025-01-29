<!DOCTYPE html>
<html lang="en">

<head>

    <title>Home - OESWC</title> 
    <link rel="icon" type="image/png" href="img/graduation-hat.png">

<?php 
    include 'head.php'; 
    include 'functions.php'; 
    session_start();
    error_reporting(0);
    $title = "Dashboard";
?>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include 'sidebar.php'; ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper " style="width:100%" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include 'header.php'; ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid this-page-only">

                    <!-- Page Heading -->


                    <!-- Content Row -->
                    <div class="row">
                    
                        <div id="examinees">
                        <?php for($m = 1; $m <= 12; $m++){ ?>
                            <span class="hide"><?php echo get_total_by_month('examinees',$m); ?></span>
                        <?php } ?>
                        </div>
                        <div id="questions">
                        <?php for($m = 1; $m <= 12; $m++){ ?>
                            <span class="hide"><?php echo get_total_by_month('questions',$m); ?></span>
                        <?php } ?>
                        </div>
                        <div id="exams">
                        <?php for($m = 1; $m <= 12; $m++){ ?>
                            <span class="hide"><?php echo get_total_by_month('exams',$m); ?></span>
                        <?php } ?>
                        </div>
                        <div id="examiner">
                        <?php for($m = 1; $m <= 12; $m++){ ?>
                            <span class="hide"><?php echo get_total_examiner_by_month($m); ?></span>
                        <?php } ?>
                        </div>
                    
                        <div id="result">
                        <?php for($m = 1; $m <= 12; $m++){ ?>
                            <span class="hide"><?php echo get_total_result_by_month($m,$_SESSION['id']); ?></span>
                        <?php } ?>
                        </div>

                        <div id="my_exams">
                        <?php for($m = 1; $m <= 12; $m++){ ?>
                            <span class="hide"><?php echo my_total_exam_by_month($_SESSION['id'],$m); ?></span>
                        <?php } ?>
                        </div>
                    
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-round blue-gradient">
                                <div class="card-body">
                                    <img src="img/create_exam.png" class="card-img" alt="">
                                    <?php if($_SESSION['type'] == 1){ ?>
                                    <a class="card-btn" href="create_exam.php">Create Exam</a>
                                    <?php }else{ ?>
                                        <a class="card-btn" href="manage_exam.php">Manage Exam</a>
                                    <?php }?>
                                </div>
                            </div>
                        </div>
                        <?php if($_SESSION['type'] == 1){ ?>
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-round blue-gradient">
                                <div class="card-body">
                                    <img src="img/create_question.png" class="card-img" alt="">
                                    <a class="card-btn" href="create_question.php">Upload Questionnaire</a>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-round pink-gradient">
                                <div class="card-body">
                                    <img src="img/add_examiner.png" class="card-img" alt="">
                                    <a class="card-btn" href="add_examiner.php">Add Examiner</a>
                                </div>
                            </div>
                        </div>
                        <?php }else{ ?>
                            <div class="col-xl-4 col-md-6 mb-4">
                                <div class="card border-round pink-gradient">
                                    <div class="card-body">
                                        <img src="img/create_exam.png" class="card-img" alt="">
                                        <a class="card-btn" href="create_exam.php">Create Exam</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-round blue-gradient">
                                <div class="card-body">
                                    <img src="img/create_question.png" class="card-img" alt="">
                                    <a class="card-btn" href="create_question.php">Upload Questionnaire</a>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <!-- Content Row -->
                    <div class="row">
                        <div class="col-md-12">
                            <h2>Analytics</h2>
                        </div>
                    </div>
                    

                    <div class="row">

                        <!-- Area Chart -->
                        

                        <div class="col-xl-4 col-lg-7 chart_container  <?php echo $_SESSION['type'] == 2 ? "hide" : ''?>">
                            <div class="chart_header">
                                <p><?php echo get_total("examinees");?></p> 
                                <p>Examinee</p>
                            </div>
                            <canvas id="totalExaminee" class="chart blue-gradient">

                            </canvas>
                        </div>

                        <div class="col-xl-4 col-lg-7 chart_container  <?php echo $_SESSION['type'] == 2 ? "hide" : ''?>">
                            <div class="chart_header">
                                <p><?php echo get_total("questions");?></p> 
                                <p>Questionnaire</p>
                            </div>
                            <canvas id="totalQuestion" class="chart pink-gradient">
                                
                            </canvas>
                        </div>

                        <div class="col-xl-4 col-lg-7 chart_container  <?php echo $_SESSION['type'] == 2 ? "hide" : ''?>">
                            <div class="chart_header">
                                <p><?php echo get_total("exams");?></p> 
                                <p>Exams</p>
                            </div>
                            <canvas id="totalExam" class="chart blue-gradient">
                                
                            </canvas>
                        </div>
                        
                        <div class="col-xl-4 col-lg-7 chart_container  <?php echo $_SESSION['type'] == 2 ? "hide" : ''?>">
                            <div class="chart_header">
                                <p><?php echo get_total_examiner();?></p> 
                                <p>Examiner</p>
                            </div>
                            <canvas id="totalExaminer" class="chart pink-gradient">
                                
                            </canvas>
                        </div>

                        <div class="col-xl-4 col-lg-7 <?php echo $_SESSION['type'] == 2 ? "hide" : ''?>">

                        </div>

                        <div class="col-xl-4 col-lg-7 <?php echo $_SESSION['type'] == 2 ? "hide" : ''?>">

                        </div>

                            <div class="col-xl-4 col-lg-7 chart_container  <?php echo $_SESSION['type'] == 1 ? "hide" : ''?>">
                                <div class="chart_header">
                                    <p><?php echo $_SESSION['type'] == 2 ? get_my_total_examinees($_SESSION['id']) : get_total("examinees");?></p> 
                                    <p>Total Exam Result</p>
                                </div>
                                <canvas id="totalRes" class="chart pink-gradient">
                                    
                                </canvas>
                            </div>

                            <div class="col-xl-4 col-lg-7 chart_container  <?php echo $_SESSION['type'] == 1 ? "hide" : ''?>">
                                <div class="chart_header">
                                    <p><?php echo my_total_exam($_SESSION['id']);?></p> 
                                    <p>My Total Exams</p>
                                </div>
                                <canvas id="totalEx" class="chart blue-gradient">
                                    
                                </canvas>
                            </div>


                        

                        

                        
                    </div>

                    

                </div>
                <!-- /.container-fluid -->
                <?php
                    include 'footer.php';
                ?>

            </div>
            <!-- End of Main Content -->
        </div>
    </div>     

    <script>
        $(document).ready(function() {

            //RESULTS
            let res_data =[];

            $('#result span').each(function(){
                res_data.push($(this).html());
            });

            let totalResult = document.getElementById('totalRes').getContext('2d');

            let resultChart = new Chart(totalResult,{
                type:'line',
                data:{
                    labels:['Jan','Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'],
                    datasets:[{
                        label:'Total Result',
                        fill:false,
                        data:res_data,
                        lineTension: 0,
                        pointRadius: 3
                    }]
                },
                options: {
                    layout: {
                        padding: {
                            left: 30,
                            right: 30,
                            bottom: 30,
                            top: 50
                        }
                    },
                    legend:{
                        display:false
                    },
                    scales: {
                        xAxes: [{
                            gridLines: {
                                drawOnChartArea: false,
                                drawBorder: false,
                            },
                            ticks:{
                                display:false
                            }
                        }],
                        yAxes: [{
                            gridLines: {
                                drawOnChartArea: false,
                                drawBorder: false
                            },
                            ticks:{
                                display:false
                            }
                        }]
                    }
                }
            });

            //MY EXAMS
            let my_ex_data =[];

            $('#my_exams span').each(function(){
                my_ex_data.push($(this).html());
            });

            let total_my_ex = document.getElementById('totalEx').getContext('2d');

            let my_ex_Chart = new Chart(total_my_ex,{
                type:'line',
                data:{
                    labels:['Jan','Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'],
                    datasets:[{
                        label:'Total Exam',
                        fill:false,
                        data:my_ex_data,
                        lineTension: 0,
                        pointRadius: 3
                    }]
                },
                options: {
                    layout: {
                        padding: {
                            left: 30,
                            right: 30,
                            bottom: 30,
                            top: 50
                        }
                    },
                    legend:{
                        display:false
                    },
                    scales: {
                        xAxes: [{
                            gridLines: {
                                drawOnChartArea: false,
                                drawBorder: false,
                            },
                            ticks:{
                                display:false
                            }
                        }],
                        yAxes: [{
                            gridLines: {
                                drawOnChartArea: false,
                                drawBorder: false
                            },
                            ticks:{
                                display:false
                            }
                        }]
                    }
                }
            });

            //EXAMINEES
            let ex_data =[];

            $('#examinees span').each(function(){
                ex_data.push($(this).html());
            });


            let totalExaminee = document.getElementById('totalExaminee').getContext('2d');

            let examineeChart = new Chart(totalExaminee,{
                type:'line',
                data:{
                    labels:['Jan','Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'],
                    datasets:[{
                        label:'Total Examinee',
                        fill:false,
                        data:ex_data,
                        lineTension: 0,
                        pointRadius: 3
                    }]
                },
                options: {
                    layout: {
                        padding: {
                            left: 30,
                            right: 30,
                            bottom: 30,
                            top: 50
                        }
                    },
                    legend:{
                        display:false
                    },
                    scales: {
                        xAxes: [{
                            gridLines: {
                                drawOnChartArea: false,
                                drawBorder: false,
                            },
                            ticks:{
                                display:false
                            }
                        }],
                        yAxes: [{
                            gridLines: {
                                drawOnChartArea: false,
                                drawBorder: false
                            },
                            ticks:{
                                display:false
                            }
                        }]
                    }
                }
            });

            //QUESTIONS
            let q_data =[];

            $('#questions span').each(function(){
                q_data.push($(this).html());
            });


            let totalQuestion = document.getElementById('totalQuestion').getContext('2d');

            let questionChart = new Chart(totalQuestion,{
                type:'line',
                data:{
                    labels:['Jan','Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'],
                    datasets:[{
                        label:'Total Questions',
                        fill:false,
                        data:q_data,
                        lineTension: 0,
                        pointRadius: 3
                    }]
                },
                options: {
                    layout: {
                        padding: {
                            left: 30,
                            right: 30,
                            bottom: 30,
                            top: 50
                        }
                    },
                    legend:{
                        display:false
                    },
                    scales: {
                        xAxes: [{
                            gridLines: {
                                drawOnChartArea: false,
                                drawBorder: false,
                            },
                            ticks:{
                                display:false
                            }
                        }],
                        yAxes: [{
                            gridLines: {
                                drawOnChartArea: false,
                                drawBorder: false
                            },
                            ticks:{
                                display:false
                            }
                        }]
                    }
                }
            });

            //EXAMS
            let exam_data =[];

            $('#exams span').each(function(){
                exam_data.push($(this).html());
            });


            let totalExam = document.getElementById('totalExam').getContext('2d');

            let examChart = new Chart(totalExam,{
                type:'line',
                data:{
                    labels:['Jan','Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'],
                    datasets:[{
                        label:'Total Exams',
                        fill:false,
                        data:exam_data,
                        lineTension: 0,
                        pointRadius: 3
                    }]
                },
                options: {
                    layout: {
                        padding: {
                            left: 30,
                            right: 30,
                            bottom: 30,
                            top: 50
                        }
                    },
                    legend:{
                        display:false
                    },
                    scales: {
                        xAxes: [{
                            gridLines: {
                                drawOnChartArea: false,
                                drawBorder: false,
                            },
                            ticks:{
                                display:false
                            }
                        }],
                        yAxes: [{
                            gridLines: {
                                drawOnChartArea: false,
                                drawBorder: false
                            },
                            ticks:{
                                display:false
                            }
                        }]
                    }
                }
            });

            //EXAMINERS
            let examiner_data =[];

            $('#examiner span').each(function(){
                examiner_data.push($(this).html());
            });


            let totalExaminer = document.getElementById('totalExaminer').getContext('2d');

            let examinerChart = new Chart(totalExaminer,{
                type:'line',
                data:{
                    labels:['Jan','Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'],
                    datasets:[{
                        label:'Total Examiners',
                        fill:false,
                        data:examiner_data,
                        lineTension: 0,
                        pointRadius: 3
                    }]
                },
                options: {
                    layout: {
                        padding: {
                            left: 30,
                            right: 30,
                            bottom: 30,
                            top: 50
                        }
                    },
                    legend:{
                        display:false
                    },
                    scales: {
                        xAxes: [{
                            gridLines: {
                                drawOnChartArea: false,
                                drawBorder: false,
                            },
                            ticks:{
                                display:false
                            }
                        }],
                        yAxes: [{
                            gridLines: {
                                drawOnChartArea: false,
                                drawBorder: false
                            },
                            ticks:{
                                display:false
                            }
                        }]
                    }
                }
            });
            

            

        });

        
    </script>

</body>

</html>