<?php session_start();
include_once 'dbConnection.php';

/**************Session Time*******/
	$email=$_SESSION['email'];
	$nowDatetime =  strtotime("now");
	$finalDatetime = $_SESSION["finalDatetime"];
	/******Sesion User Details********/
	$login_id = $_SESSION["login_id"];
	$set_session = $_SESSION['set_session'];
	$quiz_id=$_SESSION["quiz_id"];
	$total=$_SESSION["quiz_total"];
	$default = 0;
//quiz start
if(@$_GET['q']== 'quiz') {	
	/************Getting form form post*****************/
	$sn = @$_GET['n'];
	$ans = isset($_POST['ans'])?$_POST['ans']:0;
	//echo $ans; 
	$qid = @$_GET['qid'];
	/*************Checkright answer*****/
	$q = mysqli_query($con,"SELECT * FROM answer WHERE que_id='$qid' LIMIT 1")or die('Error123');
	$row = mysqli_fetch_array($q);
	$ansid = $row['option_id'];
	/*********Check Quiq table**********/
	$q = mysqli_query($con,"SELECT * FROM quiz WHERE id='$quiz_id' LIMIT 1" )or die('Error122');
	$row = mysqli_fetch_array($q);
	$sahi = $row['sahi'];
	$wrong = $row['wrong'];
	/*****************Check write or wrong************/
	if($ans == $ansid)
		$chk = $sahi;
	else if($ans != 0)
		$chk = $default - $wrong;
	else
		$chk = $default;
	
		//Add new 'chk' field in exam_details table 
	/**********************************************
	/*******Check exam_details table***********/	
	$q_detail = mysqli_query($con,"SELECT * FROM exam_details WHERE user_id='$login_id' AND quiz_id='$quiz_id' AND que_id ='$qid' AND finalDatetime ='$finalDatetime' LIMIT 1" )or die('Error119');
	//echo "SELECT * FROM exam_details WHERE user_id='$login_id' AND quiz_id='$quiz_id' AND que_id ='$qid' AND finalDatetime ='$finalDatetime' LIMIT 1";
	$chk_question_details = mysqli_num_rows($q_detail);
	//echo $chk_question_details;
	//echo "UPDATE `exam_details` SET `ans_id`='$ans' WHERE user_id='$login_id' AND quiz_id ='$quiz_id' AND que_id ='$qid' AND finalDatetime ='$finalDatetime'";exit;
	
	if($chk_question_details){		
		mysqli_query($con,"UPDATE `exam_details` SET `ans_id`='$ans', chk = '$chk' WHERE user_id='$login_id' AND quiz_id ='$quiz_id' AND que_id ='$qid' AND finalDatetime ='$finalDatetime'")or die('Error118');
	}else{
		mysqli_query($con,"INSERT INTO `exam_details` VALUES('','$login_id','$quiz_id' ,'$qid','$ans','$chk','$set_session','$finalDatetime',NOW())")or die('Error120');
	}
	//echo $ansid;
	if($chk_question_details == $total){
		header("location:quiz.php?q=quiz&n=$sn&t=$total&ans=$ans") or die('Error152');	
	}else if($nowDatetime >= $finalDatetime){
		//header("location:finalresult.php?q=result");
		header("location:finalpage.php?q=result");
	}else if($sn == $total){
		//header("location:quiz.php?q=quiz&n=$sn&t=$total") or die('Error222');
		header("location:quiz.php?q=quiz&n=1&t=$total") or die('Error222');
	}else{
		$sn++;
		header("location:quiz.php?q=quiz&n=$sn&t=$total") or die('Error152');
	}
}

?>



