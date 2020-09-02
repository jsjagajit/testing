<?php
	session_start();
	date_default_timezone_set('Asia/Kolkata');
	$nowDatetime = strtotime("now");
	$begin_time = $_SESSION["begin_time"];
	
	//echo $begin_time;exit;
	/*******************************/
	$beginDatetime =  strtotime($begin_time);
	//$finalDatetime = $beginDatetime+(60*$_SESSION["time_limit"]);// 5 minutes
	//$finalDatetime = $_SESSION["finalDatetime"];
	
	$distance = $beginDatetime - $nowDatetime;	
	$hours = intval($distance/3600);
    $remain = $distance%3600;
    $minutes = intval($distance/60);    
	$seconds = $remain%60;
	
	/****************Message for Some Minutes Have to Start Exam***********/
	
	$finalDatetime = $_SESSION["finalDatetime"];
	$distance_final = $finalDatetime - $nowDatetime;	
	$hours_final = intval($distance_final/3600);
    $remain_final = $distance_final%3600;
    $minutes_final = intval($distance_final/60);    
	$seconds_final = $remain_final%60;
	
	
	if($nowDatetime <= $beginDatetime){		
		if($minutes < 5 &&  $seconds > 1){
			echo "login_active";
		}else if($minutes < 1 && $seconds < 1){ 
			echo "instruction";
		}
	}
	if(($beginDatetime <= $nowDatetime) && ($finalDatetime >= $nowDatetime)){		
		echo "instruction";
	}
	/****************check end time****************/	
?>