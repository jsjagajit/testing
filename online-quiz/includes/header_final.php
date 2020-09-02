<?php 
include_once("includes/function.php");
if(!isset($_SESSION['email']) && $_SESSION["key"] !='jagajit9778494674'){
	header("location:index.php");exit();
}
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
	/*history.pushState(null, null, location.href);
	window.onpopstate = function () {
		history.go(1);
	};*/
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
                <div style="color:#FFF;font-size:30px; margin:10px 0px 0px 0px">Demo Online Exam</div> 
            </div>
			<div class="col-md-4 col-md-offset-2">
				<div class="log1">
                	<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                    &nbsp;&nbsp;Hello, <?=$_SESSION['email']?> 
                    |&nbsp;&nbsp;<span class="glyphicon glyphicon-list"></span><a href="result_details.php" class="log1">Exam History</a>
                    |&nbsp;&nbsp;<a href="logout.php?q=index.php" class="log1"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Signout</a>
                    |&nbsp;&nbsp;<span class="glyphicon glyphicon-time"></span><span id="clock" class="log" style="font-weight:bold;"></span>                   
                </div>
			</div>
		</div>
   </div>