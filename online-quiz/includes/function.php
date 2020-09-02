<?php
session_start();
date_default_timezone_set('Asia/Kolkata');
include_once('dbConnection.php'); 
function find_single_value($table,$key,$condition){
	global $con;
	$rows= "";
	$sql ="SELECT $key FROM $table WHERE $condition LIMIT 1";
	//return $sql; 
	$rows = mysqli_fetch_array(mysqli_query($con,$sql));
	return $rows[$key];
}
function check_time(){
	global $con;
	$quiz_total = $_SESSION["quiz_total"];
	$quiz_id = $_SESSION["quiz_id"];
	$login_id = $_SESSION["login_id"];
	$set_session = $_SESSION['set_session'];
	$nowDatetime = strtotime("now");
	//echo "Now Date: ".date("Y-m-d H:i:s a",$nowDatetime)."<br/>";
	
	//echo $begin_time;exit;
	/*************Calculate time from exam begining time**************/
	$beginDatetime =  strtotime($_SESSION["begin_time"]);
	$distance_begin = $beginDatetime - $nowDatetime;
	
	$hours_begin = intval($distance_begin/3600);
    $remain_begin = $distance_begin%3600;
    $minutes_begin = intval($distance_begin/60);    
	$seconds_begin = $remain_begin%60;
	
	/*************Calculate time from exam time finished**************/
	$finalDatetime = $_SESSION["finalDatetime"];
	$distance = $finalDatetime - $nowDatetime;	
	$hours = intval($distance/3600);
    $remain = $distance%3600;
    $minutes = intval($distance/60);    
	$seconds = $remain%60;
	//echo $hours."---".$minutes."--".$seconds;exit();
	//echo "Begin Date: ".date("Y-m-d H:i:s a",$beginDatetime)."<br/>";
	//echo "Now Date: ".$nowDatetime." Begin Time: ".$beginDatetime."<br/>".$date;exit; 
	if($seconds_begin > 0 ||  $minutes_begin > 0){
		header("location:after_login.php");exit();
	}else if($seconds > 0 ||  $minutes > 0){
		$q = mysqli_query($con,"SELECT level FROM history WHERE quiz_id='$quiz_id' AND user_id='$login_id' AND finalDatetime ='$finalDatetime' LIMIT 1") or die('Error140');
		if(mysqli_num_rows($q)){	
			$rows = mysqli_fetch_array($q);
			$level = $rows['level'];			
			if($level==$quiz_total){				
				header("location:quiz.php?q=quiz&n=$level&t=$quiz_total&ans=123");exit();
			}else{
				$level++;
				header("location:quiz.php?q=quiz&n=$level&t=$quiz_total");exit();
			}
		}
		header("location:quiz.php?q=quiz&n=1");exit();
	}else if($nowDatetime > $finalDatetime){
		header("location:result_details.php");exit();
	}
	//header("location:quiz.php?q=quiz&n=1");exit(); 
}
?>