<?php 
	session_start();
	date_default_timezone_set('Asia/Kolkata');
	include_once('dbConnection.php');
	/*if(isset($_SESSION['email']) && $_SESSION["key"] !='jagajit9778494674'){
		header("location:index.php");exit();
	}*/
	/*********Session Set  Quiz Set***/
	$result = mysqli_query($con,"SELECT * FROM quiz WHERE enable_exam = 1 and deleted !=1 LIMIT 1") or die('Error2');
	$rows = mysqli_fetch_array($result);
	$_SESSION["time_limit"] = $rows['time'];
	$_SESSION["quiz_title"] = $rows['title'];		
	$_SESSION["quiz_total"] = $rows['total'];
	$_SESSION["right_answer"] = $rows['sahi'];
	$_SESSION["wrong_answer"] = $rows['wrong'];
	$_SESSION["quiz_id"] = $rows['id'];
	
	/*********Session Set  Exam date time***/
	$res_set = mysqli_query($con,"SELECT datetime_set FROM exam_set WHERE quiz_id = '".$_SESSION['quiz_id']."' LIMIT 1") or die('Error3');
	$rows_set = mysqli_fetch_array($res_set);
	$begin_time = explode("T",$rows_set['datetime_set']);
	$date = $begin_time[0];
	$time = $begin_time[1];	
	$_SESSION["begin_time"] = $date." ".$time.":00";//"2018-06-07 17:00:00";	//"Y-m-d H:i:s"	 // 2018-07-13T13:00
	$beginDatetime =  strtotime($_SESSION["begin_time"]);		
	$finalDatetime = $beginDatetime+(60*$_SESSION["time_limit"]);		
	$_SESSION["finalDatetime"] = $finalDatetime;
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
<script>
	/*$("body").on("contextmenu",function(e){
        return false;
    });*/
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
	function fullscreen(){//alert('hii');
		/*top.resizeTo(window.screen.availWidth, window.screen.availHeight);
		top.moveTo(0,0);*/
		window.open ("index.php","","fullscreen=yes");
		//setTimeout(fullscreen(),250);
	}
	function launchFullScreen(element) {//alert(document.documentElement);//alert(1);
	  if(element.requestFullScreen) {//alert(2)
		element.requestFullScreen();
	  } else if(element.mozRequestFullScreen) {//alert(3)
		element.mozRequestFullScreen();
	  }else if(element.webkitRequestFullScreen) {
		element.webkitRequestFullScreen();
	  }
	}
	
	/*launchFullScreen(document.documentElement); */
// Launch fullscreen for browsers that support it!
// the whole page
</script> 
<link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css' />
	<?php if(@$_GET['w'])
    {echo'<script>alert("'.@$_GET['w'].'");</script>';}
    ?>
</head>
<body>
	<div class="header">
		<div class="row" id="element">
        	<div class="col-lg-1">
                <span class="logo"><img src="image/logo-white.png"></span> 
            </div>
            <div class="col-lg-6">
                <div style="color:#FFF;font-size:30px; margin:20px 0px 0px 0px">Demo Online Exam</div> 
            </div>
			<div class="col-md-4 col-md-offset-2">
				<div class=" top title" style="font-weight:bold;">Current Time: <span id="clock" ></span></div>
			</div>
		</div>
   </div>