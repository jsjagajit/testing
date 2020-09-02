<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Demo Online Exam</title>
    <link  rel="stylesheet" href="css/bootstrap.min.css"/>
    <link  rel="stylesheet" href="css/bootstrap-theme.min.css"/>    
    <link rel="stylesheet" href="css/main.css">
    <link  rel="stylesheet" href="css/font.css">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <!--<script src="js/jquery.js" type="text/javascript"></script>-->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"  type="text/javascript"></script>
    <?php if(@$_GET['w']){
    echo'<script>alert("'.@$_GET['w'].'");</script>';
    }
    ?>
</head>
<body>
	<div class="header">
		<div class="row">
			<div class="col-lg-6">
				<span class="logo"><img src="image/logo-white.png">DEMO Online Exam</span></div>
				<div class="col-md-4 col-md-offset-2">
				 <?php
                if(!(isset($_SESSION['email']))){
                    header("location:index.php");
                }
				else{
					$name = $_SESSION['name'];
					$email=$_SESSION['email'];					
					include_once 'dbConnection.php';
					echo '<span class="pull-right top"><span class="log1"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;&nbsp;&nbsp;&nbsp;Hello, '.$name.'</span></span>';
				}?>
			</div>
		</div>
	</div>
    <nav class="navbar navbar-default ">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <a class="navbar-brand" href="#">Quiz Name: <b><?=$_SESSION["quiz_title"]?></b></a>&nbsp;&nbsp; <a class="navbar-brand" href="#">Total Questions: <b><?=$_SESSION["quiz_total"]?></b></a>&nbsp;&nbsp; <a class="navbar-brand" href="#">Total Questions: <b><?=$_SESSION["time_limit"]?></b></a> &nbsp;&nbsp;<span class="navbar-brand">Time Left:</span> <span class="navbar-brand" id="demo" style="top:20px; font-weight:bold;"></span>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        	<!--<div style="top:20px; font-weight:bold;">
            	 <p id="demo"></p>
            </div>-->
        </div>
        
      </div><!-- /.container-fluid -->
    </nav><!--navigation menu closed-->
    <div class="bg">