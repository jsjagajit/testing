<?php 
session_start();
date_default_timezone_set('Asia/Kolkata');
if(!isset($_SESSION['email']) && $_SESSION["key"] !='jagajit9778494674'){
	header("location:index.php");exit();
}
include_once('dbConnection.php');
//print_r($_SESSION);
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Demo Online Exam </title>
<link  rel="stylesheet" href="css/bootstrap.min.css"/>
<link  rel="stylesheet" href="css/bootstrap-theme.min.css"/>    
<link rel="stylesheet" href="css/main.css">
<link  rel="stylesheet" href="css/font.css">
<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/bootstrap.min.js"  type="text/javascript"></script>
<script type="text/javascript">
	$("body").on("contextmenu",function(e){
        return false;
    });
	var d = new Date(<?php echo time() * 1000 ?>);
	function digitalClock() {
	  d.setTime(d.getTime() + 1000);
	  var hrs = d.getHours();
	  var mins = d.getMinutes();
	  var secs = d.getSeconds();
	  mins = (mins < 10 ? "0" : "") + mins;
	  secs = (secs < 10 ? "0" : "") + secs;
	  var apm = (hrs < 12) ? "am" : "pm";
	  hrs = (hrs > 12) ? hrs - 12 : hrs;
	  hrs = (hrs == 0) ? 12 : hrs;
	  var ctime = hrs + ":" + mins + ":" + secs + " " + apm;
	  document.getElementById("clock").innerHTML = ctime;
	  //alert(document.getElementById("clock").value);
	}
	var myclock = setInterval(digitalClock, 1000);
	function fullscreen(){
		top.resizeTo(window.screen.availWidth, window.screen.availHeight);
		top.moveTo(0,0);
		setTimeout(fullscreen(),250);
	}
</script> 
<link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css' />
	<?php if(@$_GET['w'])
    {echo'<script>alert("'.@$_GET['w'].'");</script>';}
    ?>
</head>
<body>
	<div class="header">
		<div class="row">
        	<div class="col-lg-1">
                <span class="logo"><img src="image/logo-white.png"></span> 
            </div>
            <div class="col-lg-6">
                <div style="color:#FFF;font-size:30px; margin:20px 0px 0px 0px">Demo Online Exam</div> 
            </div>
			<div class="col-md-4 col-md-offset-2">
				<div class="log1">
                	<span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;&nbsp;&nbsp;&nbsp;Hello, <?=$_SESSION['email']?> |&nbsp;&nbsp; Current Time:<span id="clock" class="log1"></span>
                </div>
			</div>
		</div>
   </div>
   <nav class="navbar navbar-default ">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <a class="navbar-brand" href="#">Exam Name: <b><?=$_SESSION["quiz_title"]?></b></a>&nbsp;&nbsp; <a class="navbar-brand" href="#">Total Questions: <b><?=$_SESSION["quiz_total"]?></b></a>&nbsp;&nbsp;<a class="navbar-brand" href="#">Time duration: <b><?=$_SESSION["time_limit"]?> min</b></a><a class="navbar-brand" href="#">Time Left:</a> <a class="navbar-brand" href="#"><span class="navbar-brand" id="demo" style="top:20px; font-weight:bold;"></span></a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        	<!--<div style="top:20px; font-weight:bold;">
            	 <p id="demo"></p>
            </div>-->
        </div>
        
      </div><!-- /.container-fluid -->
    </nav><!--navigation menu closed-->
    <div class="bg">