<!DOCTYPE html>
<html>

<head>
<link rel="icon" type="image/png" href="img/graduation-hat.png">

<?php 
include 'head.php'; 
include 'functions.php'; 
session_start();
$examinee_id = $_SESSION['examinee_id'];
$examinee = $_SESSION['examinee_name'];  
$link= $_GET['code']; 
$id= $_GET['id']; 
?>
    <style>
    .page-description p {
        margin: 0;
        text-align: center;
        font-size: 30px;
        color: #454545;
        font-weight: bold;
        word-spacing: 5px;
    }

    p {
        display: block;
        margin-block-start: 1em;
        margin-block-end: 1em;
        margin-inline-start: 0px;
        margin-inline-end: 0px;
    }

    body {
        margin: 0;
        padding: 0;
        font-family: "Nunito Sans", sans-serif;
        background-color: #f5f5f5;
    }

    .page-title p {
        text-align: center;
        font-size: 70px;
        color: #bdbdbd;
        font-weight: bold;
        letter-spacing: 10px;
        margin: 0 0 25px;
    }

    .page-container {
        height: 100vh;
        width: 100vw;
        margin: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: row;
        flex-wrap: wrap;
    }


    .page-info-image {
        width: 100%;
        text-align: center;
    }

    img {
        overflow-clip-margin: content-box;
        overflow: clip;
        text align: center;
        width: 50%;
        height: 50%;
    }
    </style>
</head>

<body>
    <div class="page-container">
        <div class="page-info">
            <div class="page-info-image"><img src="img/done.png"></div>
            <div class="page-title">
                <p>ANSWERED</p>
            </div>
            <div class="page-description">
                <p>You've already answered this quiz</p>
            </div>
        </div>
    </div>
</body>

</html>