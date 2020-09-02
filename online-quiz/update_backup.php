<?php session_start();
include_once 'dbConnection.php';
$email=$_SESSION['email'];
//delete feedback
/*if(isset($_SESSION['key'])){
	if(@$_GET['fdid'] && $_SESSION['key']=='jagajit9778494674') {
	$id=@$_GET['fdid'];
	$result = mysqli_query($con,"DELETE FROM feedback WHERE id='$id' ") or die('Error');
	header("location:dash.php?q=3");
	}
}*/

//delete user
/*if(isset($_SESSION['key'])){
if(@$_GET['demail'] && $_SESSION['key']=='jagajit9778494674') {
$demail=@$_GET['demail'];
$r1 = mysqli_query($con,"DELETE FROM rank WHERE email='$demail' ") or die('Error');
$r2 = mysqli_query($con,"DELETE FROM history WHERE email='$demail' ") or die('Error');
$result = mysqli_query($con,"DELETE FROM user WHERE email='$demail' ") or die('Error');
header("location:dash.php?q=1");
}
}*/
//remove quiz
/*if(isset($_SESSION['key'])){
if(@$_GET['q']== 'rmquiz' && $_SESSION['key']=='jagajit9778494674') {
$eid=@$_GET['eid'];
$result = mysqli_query($con,"SELECT * FROM questions WHERE eid='$eid' ") or die('Error');
while($row = mysqli_fetch_array($result)) {
	$qid = $row['qid'];
$r1 = mysqli_query($con,"DELETE FROM options WHERE qid='$qid'") or die('Error');
$r2 = mysqli_query($con,"DELETE FROM answer WHERE qid='$qid' ") or die('Error');
}
$r3 = mysqli_query($con,"DELETE FROM questions WHERE eid='$eid' ") or die('Error');
$r4 = mysqli_query($con,"DELETE FROM quiz WHERE eid='$eid' ") or die('Error');
$r4 = mysqli_query($con,"DELETE FROM history WHERE eid='$eid' ") or die('Error');

header("location:dash.php?q=5");
}
}*/

//add quiz
/*if(isset($_SESSION['key'])){
if(@$_GET['q']== 'addquiz' && $_SESSION['key']=='jagajit9778494674') {
$name = $_POST['name'];
$name= ucwords(strtolower($name));
$total = $_POST['total'];
$sahi = $_POST['right'];
$wrong = $_POST['wrong'];
$time = $_POST['time'];
$tag = $_POST['tag'];
$desc = $_POST['desc'];
$id=uniqid();
$q3=mysqli_query($con,"INSERT INTO quiz VALUES  ('$id','$name' , '$sahi' , '$wrong','$total','$time' ,'$desc','$tag', NOW())");

header("location:dash.php?q=4&step=2&eid=$id&n=$total");
}
}*/

//add question
/*if(isset($_SESSION['key'])){
if(@$_GET['q']== 'addqns' && $_SESSION['key']=='jagajit9778494674') {
$n=@$_GET['n'];
$eid=@$_GET['eid'];
$ch=@$_GET['ch'];

for($i=1;$i<=$n;$i++)
 {
 $qid=uniqid();
 $qns=$_POST['qns'.$i];
$q3=mysqli_query($con,"INSERT INTO questions VALUES  ('$eid','$qid','$qns' , '$ch' , '$i')");
  $oaid=uniqid();
  $obid=uniqid();
$ocid=uniqid();
$odid=uniqid();
$a=$_POST[$i.'1'];
$b=$_POST[$i.'2'];
$c=$_POST[$i.'3'];
$d=$_POST[$i.'4'];
$qa=mysqli_query($con,"INSERT INTO options VALUES  ('$qid','$a','$oaid')") or die('Error61');
$qb=mysqli_query($con,"INSERT INTO options VALUES  ('$qid','$b','$obid')") or die('Error62');
$qc=mysqli_query($con,"INSERT INTO options VALUES  ('$qid','$c','$ocid')") or die('Error63');
$qd=mysqli_query($con,"INSERT INTO options VALUES  ('$qid','$d','$odid')") or die('Error64');
$e=$_POST['ans'.$i];
switch($e)
{
case 'a':
$ansid=$oaid;
break;
case 'b':
$ansid=$obid;
break;
case 'c':
$ansid=$ocid;
break;
case 'd':
$ansid=$odid;
break;
default:
$ansid=$oaid;
}


$qans=mysqli_query($con,"INSERT INTO answer VALUES  ('$qid','$ansid')");

 }
header("location:dash.php?q=0");
}
}*/

//quiz start
if(@$_GET['q']== 'quiz') {
	/**************Session Time*******/
	$nowDatetime =  strtotime("now");
	$finalDatetime = $_SESSION["finalDatetime"];
	/******Sesion User Details********/
	$login_id = $_SESSION["login_id"];
	$set_session = $_SESSION['set_session'];
	$quiz_id=$_SESSION["quiz_id"];
	$total=$_SESSION["quiz_total"];
	/************Getting form form post*****************/
	$sn=@$_GET['n'];
	$ans=isset($_POST['ans'])?$_POST['ans']:0;
	//echo $ans; 
	$qid=@$_GET['qid'];
	/*************Checkright answer*****/
	$q=mysqli_query($con,"SELECT * FROM answer WHERE que_id='$qid' LIMIT 1")or die('Error123');
	$row=mysqli_fetch_array($q);
	$ansid=$row['option_id'];
	/*******Check exam_details table***********/
	
	//$ans_id = isset($ans)?$ans:0;
	
	$q_detail = mysqli_query($con,"SELECT * FROM exam_details WHERE user_id='$login_id' AND quiz_id='$quiz_id' AND que_id ='$qid' AND finalDatetime ='$finalDatetime' LIMIT 1" )or die('Error119');
	$chk_question_details = mysqli_num_rows($q_detail);
	if($chk_question_details)
		mysqli_query($con,"UPDATE `exam_details` SET `ans_id`='$ans' WHERE user_id='$login_id' AND quiz_id ='$quiz_id' AND que_id ='$qid' AND finalDatetime ='$finalDatetime'")or die('Error118');
	else
		mysqli_query($con,"INSERT INTO `exam_details` VALUES('','$login_id','$quiz_id' ,'$qid','$ans','$set_session','$finalDatetime',NOW())")or die('Error120');
	//echo $ansid;
	if($ans == $ansid){
		$q = mysqli_query($con,"SELECT * FROM quiz WHERE id='$quiz_id' LIMIT 1" )or die('Error122');
		$row = mysqli_fetch_array($q);
		$sahi = $row['sahi'];
		
		if($sn == 1 && $chk_question_details ==0){
			$q = mysqli_query($con,"INSERT INTO history VALUES('','$login_id','$quiz_id' ,'0','0','0','0','$set_session','$finalDatetime',NOW())")or die('Error121');
		}
		//echo "SELECT * FROM history WHERE quiz_id='$quiz_id' AND user_id='$login_id' AND set_session ='$set_session' LIMIT 1";
		$q = mysqli_query($con,"SELECT * FROM history WHERE quiz_id='$quiz_id' AND user_id='$login_id' AND finalDatetime ='$finalDatetime' LIMIT 1")or die('Error115');	
		$rows = mysqli_fetch_array($q);
		
		$s = $rows['score'];
		$r = $rows['sahi'];
		
		$r++;
		$s = $s+$sahi;
		//echo "UPDATE `history` SET `score`=$s,`level`=$sn,`sahi`=$r, date= NOW() WHERE user_id ='$login_id' AND quiz_id ='$quiz_id' AND set_session ='$set_session'";
		$q = mysqli_query($con,"UPDATE `history` SET `score`=$s,`level`=$sn,`sahi`=$r, date= NOW() WHERE user_id ='$login_id' AND quiz_id ='$quiz_id' AND finalDatetime ='$finalDatetime'")or die('Error124');
		
		if($sn != $total){
			$sn++;
			header("location:quiz.php?q=quiz&n=$sn&t=$total") or die('Error152');
		}else if($nowDatetime >= $finalDatetime){
			header("location:finalresult.php?q=result");
		}else{
			header("location:quiz.php?q=quiz&n=$sn&t=$total&ans=$ans") or die('Error152');
		}
	}else if($ans==0){
		if($sn == 1 && $chk_question_details ==0){
			$q = mysqli_query($con,"INSERT INTO history VALUES('','$login_id','$quiz_id' ,'0','0','0','0','$set_session','$finalDatetime',NOW())")or die('Error121');
		}
		$q = mysqli_query($con,"UPDATE `history` SET `level`=$sn,date= NOW() WHERE user_id ='$login_id' AND quiz_id ='$quiz_id' AND finalDatetime ='$finalDatetime'")or die('Error140');
		
		if($sn != $total){
			$sn++;
			header("location:quiz.php?q=quiz&n=$sn&t=$total") or die('Error152');
		}else if($nowDatetime >= $finalDatetime){
			header("location:finalresult.php?q=result");
		}else{
			header("location:quiz.php?q=quiz&n=$sn&t=$total&ans=$ans") or die('Error152');
		}
	}else{
		$q = mysqli_query($con,"SELECT * FROM quiz WHERE id='$quiz_id' " ) or die('Error129');
		$row = mysqli_fetch_array($q);
		$wrong = $row['wrong'];
		if($sn == 1 && $chk_question_details ==0){
			$q = mysqli_query($con,"INSERT INTO history VALUES('','$login_id','$quiz_id' ,'0','0','0','0','$set_session','$finalDatetime',NOW() )")or die('Error137');
		}
		
		$q = mysqli_query($con,"SELECT * FROM history WHERE quiz_id='$quiz_id' AND user_id='$login_id' AND finalDatetime ='$finalDatetime' LIMIT 1" )or die('Error139');
		$rows = mysqli_fetch_array($q);
		$s=$rows['score'];
		$w=$rows['wrong'];
		
		$w++;
		$s=$s-$wrong;
		$q=mysqli_query($con,"UPDATE `history` SET `score`=$s,`level`=$sn,`wrong`=$w, date=NOW() WHERE user_id = '$login_id' AND quiz_id ='$quiz_id' AND finalDatetime ='$finalDatetime'")or die('Error147');
		
		/*if($sn != $total){
			$sn++;
			header("location:quiz.php?q=quiz&n=$sn&t=$total")or die('Error152');
		}else{
			header("location:finalresult.php?q=result");
		}*/
		if($sn != $total){
			$sn++;
			header("location:quiz.php?q=quiz&n=$sn&t=$total") or die('Error152');
		}else if($nowDatetime >= $finalDatetime){
			header("location:finalresult.php?q=result");
		}else{
			header("location:quiz.php?q=quiz&n=$sn&t=$total&ans=$ans") or die('Error152');
		}
	}
}

//restart quiz
/*if(@$_GET['q']== 'quizre' && @$_GET['step']== 25 ) {
	$eid=@$_GET['eid'];
	$n=@$_GET['n'];
	$t=@$_GET['t'];
	$q=mysqli_query($con,"SELECT score FROM history WHERE eid='$eid' AND email='$email'" )or die('Error156');
	while($row=mysqli_fetch_array($q) )
	{
		$s=$row['score'];
	}
	$q=mysqli_query($con,"DELETE FROM `history` WHERE eid='$eid' AND email='$email' " )or die('Error184');
	$q=mysqli_query($con,"SELECT * FROM rank WHERE email='$email'" )or die('Error161');
	while($row=mysqli_fetch_array($q) )
	{
		$sun=$row['score'];
	}
	$sun=$sun-$s;
	$q=mysqli_query($con,"UPDATE `rank` SET `score`=$sun ,time=NOW() WHERE email= '$email'")or die('Error174');
	header("location:account.php?q=quiz&step=2&eid=$eid&n=1&t=$t");
}*/

?>



