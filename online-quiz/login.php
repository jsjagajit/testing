<?php
	//session_start();
	//date_default_timezone_set('Asia/Kolkata');
	//include_once 'dbConnection.php';
	include_once("includes/function.php");
	$ref=@$_GET['q'];
	$email = $_POST['email'];
	//$password = $_POST['password'];
	$roll_no = $_POST['roll_no'];
	$email = stripslashes($email);
	$email = addslashes($email);
	$roll_no = stripslashes($roll_no); 
	$roll_no = addslashes($roll_no);
	//$password = stripslashes($password); 
	//$password = addslashes($password);
	//$password=md5($password); 
	$result = mysqli_query($con,"SELECT id,name FROM user WHERE email = '$email' and roll_no = '$roll_no' LIMIT 1") or die('Error1');
	$count=mysqli_num_rows($result);
	$nowDatetime =  strtotime("now");
	$begin_time = $_SESSION["begin_time"];
	$beginDatetime = strtotime($begin_time);
	/*if($nowDatetime < $beginDatetime){
		$row = mysqli_fetch_array($result);
		//******Session Set USER*****
		$_SESSION['set_session'] = time();
		$_SESSION["key"] ='jagajit9778494674';
		$_SESSION["name"] = $row['name'];
		$_SESSION["email"] = $email;
		$_SESSION["login_id"] = $row['id'];
		$_SESSION["roll_no"] = $roll_no;
		header("location:$ref?w=Exam will start @ $begin_time");exit();
	}else*/ 
	if($count==1){
		$row = mysqli_fetch_array($result);
		/*********Session Set USER***/
		$_SESSION['set_session'] = time();
		$_SESSION["key"] ='jagajit9778494674';
		$_SESSION["name"] = $row['name'];
		$_SESSION["email"] = $email;
		$_SESSION["login_id"] = $row['id'];
		$_SESSION["roll_no"] = $roll_no;
		$q3=mysqli_query($con,"INSERT INTO user_login VALUES('','".$_SESSION["login_id"]."',NOW(),'')")  or die('Error2');
		/*********Session Set  Quiz Set***/
		/*$result = mysqli_query($con,"SELECT id,title,total,time FROM quiz WHERE enable_exam = 1 and deleted !=1 LIMIT 1") or die('Error2');
		$rows = mysqli_fetch_array($result);
		$_SESSION["time_limit"] = $rows['time'];
		$_SESSION["quiz_title"] = $rows['title'];		
		$_SESSION["quiz_total"] = $rows['total'];
		$_SESSION["quiz_id"] = $rows['id'];*/
		
		/*********Session Set  Exam date time***/
		/*$res_set = mysqli_query($con,"SELECT datetime_set FROM exam_set WHERE quiz_id = '".$_SESSION['quiz_id']."' LIMIT 1") or die('Error3');
		$rows_set = mysqli_fetch_array($res_set);
		$begin_time = explode("T",$rows_set['datetime_set']);
		$date = $begin_time[0];
		$time = $begin_time[1];	
		$_SESSION["begin_time"] = $date." ".$time.":00";//"2018-06-07 17:00:00";	//"Y-m-d H:i:s"	 // 2018-07-13T13:00
		$beginDatetime =  strtotime($_SESSION["begin_time"]);		
		$finalDatetime = $beginDatetime+(60*$_SESSION["time_limit"]);		
		$_SESSION["finalDatetime"] = $finalDatetime;*/		
		/*********Redirect Url according to date time***Funtion.php*****/		
		check_time();
	}else{
		header("location:$ref?w=Wrong Username or Password");exit();
	}
?>