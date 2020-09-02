<?php
	session_start();
	if(!isset($_SESSION["email"]) && $_SESSION["email"] ==''){
		session_destroy();
	}
	date_default_timezone_set('Asia/Kolkata');
	$nowDatetime = strtotime("now");
	/*include_once 'dbConnection.php';
	$result = mysqli_query($con,"SELECT datetime_set FROM exam_set WHERE quiz_id = '$email' LIMIT 1") or die('Error');
	$row = mysqli_fetch_array($result);
	define(TIMESET,$row['datetime_set']);*/
	
	//$begin_time = explode("T",$_SESSION["time_set"]);
	//$date = $begin_time[0];
	//$time = $begin_time[1];	
	//$begin_time = $date." ".$time.":00";//"2018-06-07 17:00:00";	//"Y-m-d H:i:s"	 // 2018-07-13T13:00
	$begin_time = $_SESSION["begin_time"];
	
	//echo $begin_time;exit;
	/*******************************/
	$beginDatetime =  strtotime($begin_time);
	//$finalDatetime = $beginDatetime+(60*$_SESSION["time_limit"]);// 5 minutes
	$finalDatetime = $_SESSION["finalDatetime"];
	
	$distance = $finalDatetime - $nowDatetime;
	
	$hours = intval($distance/3600);
    $remain = $distance%3600;
    $minutes = intval($distance/60);    
	$seconds = $remain%60;
	
	/****************Message for Some Minutes Have to Start Exam***********/
	
	$distance_tostart = $beginDatetime - $nowDatetime;
	$remain_tostart = $distance_tostart%3600;
	$minutes_tostart = intval($distance_tostart/60);
	$seconds_tostart = $remain_tostart%60;
	
	
	
	if($nowDatetime >= $beginDatetime && $nowDatetime < $finalDatetime){
		if($hours)
			echo $hours."H".$minutes."m ".$seconds."s ";
		else{
			if($minutes < 5)
				echo "<font color=red>".$minutes."m ".$seconds."s "."</font>";
			else
				echo $minutes."m ".$seconds."s ";
		}
	}else if($nowDatetime >= $finalDatetime){
		echo "Time is over";
	}else if($nowDatetime < $beginDatetime && $minutes_tostart <= 10 && $minutes_tostart >=0) {
		
		echo "<font color=red>".$minutes_tostart."m ".$seconds_tostart."s "." to start</font>";
	}else{
		echo "Exam will start @ $begin_time";
	}
?>