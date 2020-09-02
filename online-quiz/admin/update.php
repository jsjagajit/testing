<?php
include_once '../dbConnection.php';
session_start();
$email=$_SESSION['email'];
if(isset($_SESSION['key']) && $_SESSION['key']=='jagajit9778494674'){
	if(@$_GET['q'] == 'addquiz'){
		//print_r($_POST);exit;
		$name = $_POST['name'];
		$total = $_POST['total'];
		$sahi = $_POST['right'];
		$wrong = $_POST['wrong'];
		$time = $_POST['time'];
		$desc = $_POST['desc'];
		$id=uniqid();
		$q3=mysqli_query($con,"INSERT INTO quiz VALUES  ('','$id','$name' ,'$sahi','$wrong','$total','$time','$desc','','','',NOW())")or die('Error');
		if($q3){
			header("location:add_quiz.php?q=4&step=2&eid=$id&n=$total");exit;
		}	
	}else if(@$_GET['q']== 'addqns') {
		$n=@$_GET['n'];
		$quiz_id=@$_GET['quiz_id'];
		$ch=@$_GET['ch'];		
		for($i=1;$i<=$n;$i++){
			//$qid=uniqid();
			$qns=addslashes($_POST['qns'.$i]);
			$q3=mysqli_query($con,"INSERT INTO questions VALUES ('','$quiz_id','$qns','$ch','$i',NOW())") or die('Error60');
			$qid = mysqli_insert_id($con);
			
			//$oaid=uniqid();
			//$obid=uniqid();
			//$ocid=uniqid();
			//$odid=uniqid();
			$a=addslashes($_POST[$i.'1']);
			$b=addslashes($_POST[$i.'2']);
			$c=addslashes($_POST[$i.'3']);
			$d=addslashes($_POST[$i.'4']);
			
			$qa=mysqli_query($con,"INSERT INTO options VALUES ('','$qid','$a',NOW())") or die('Error61');
			$oaid = mysqli_insert_id($con);
			$qb=mysqli_query($con,"INSERT INTO options VALUES ('','$qid','$b',NOW())") or die('Error62');
			$obid = mysqli_insert_id($con);
			$qc=mysqli_query($con,"INSERT INTO options VALUES ('','$qid','$c',NOW())") or die('Error63');
			$ocid = mysqli_insert_id($con);
			$qd=mysqli_query($con,"INSERT INTO options VALUES ('','$qid','$d',NOW())") or die('Error64');
			$odid = mysqli_insert_id($con);
			$e=$_POST['ans'.$i];
			switch($e)
			{
				case 'a':
				$optionid=$oaid;
				break;
				case 'b':
				$optionid=$obid;
				break;
				case 'c':
				$optionid=$ocid;
				break;
				case 'd':
				$optionid=$odid;
				break;
				default:
				$optionid=$oaid;
			}
			$qans=mysqli_query($con,"INSERT INTO answer VALUES ('','$qid','$optionid',NOW())") or die('Error65');		
		 }
		 mysqli_query($con,"UPDATE quiz SET enter_question=1 WHERE id='".$quiz_id."'") or die('Error66');
		 header("location:question-edit.php");exit;
	}else if(@$_GET['q']== 'updateqns') {
		
		$n=@$_GET['n'];
		$quiz_id=@$_GET['quiz_id'];
		$t=@$_GET['t'];
		if(empty($_REQUEST['question'])){
			header("location:question-update.php?q=quiz&quiz_id=$quiz_id&step=2&n=$n&t=$t&msg=Please Enter Question");exit;
		}//echo "<pre>"; print_r($_REQUEST);exit;
		foreach($_REQUEST['question'] as $key => $val){
			mysqli_query($con,"UPDATE questions SET qns='".addslashes($val)."' WHERE id='".$key."'") or die('Error50');
		}
		//mysqli_query($con,$sql_que) or die('Error50');
		foreach($_REQUEST['answer'] as $key => $val){
			mysqli_query($con,"UPDATE answer SET option_id='".$val."' WHERE que_id='".$key."'") or die('Error51');
		}
		//echo "UPDATE answer SET ansid='".$val."' WHERE qid='".$key."'";exit;
		foreach($_REQUEST['option'] as $key => $val){
			mysqli_query($con,"UPDATE options SET option='".addslashes($val)."' WHERE id='".$key."'") or die('Error52');
		}
		 //echo "location:update.php?q=updateqns&step=2&eid=$eid&n=$n&t=$t";exit;
		header("location:question-update.php?q=quiz&quiz_id=$quiz_id&step=2&n=$n&t=$t&msg=Successfully Updated");exit;
	}
}
?>