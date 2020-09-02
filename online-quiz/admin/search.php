<?php
	session_start();
	include_once '../dbConnection.php';
	
	$term = $_REQUEST['term'];
	
	if(isset($_REQUEST['ch']) && $_REQUEST['ch'] =='quiz'){
		$sql_query = mysqli_query($con,"SELECT title FROM quiz WHERE title LIKE '%".$term."%' AND enter_question =1");
		while($row = mysqli_fetch_array($sql_query)) {
    		$return_arr[] =  $row['title'];
    	}
	}else{
		$sql_query = mysqli_query($con,"SELECT email FROM user WHERE email LIKE '%".$term."%'");
		while($row = mysqli_fetch_array($sql_query)) {
			$return_arr[] =  $row['email'];
		}
	}
	echo json_encode($return_arr);
?>