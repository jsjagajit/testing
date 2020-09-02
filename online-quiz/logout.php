<?php 
session_start();
include_once 'dbConnection.php';
if(isset($_SESSION['email'])){
	$q = mysqli_query($con,"SELECT id FROM user_login WHERE user_id='".$_SESSION["login_id"]."' ORDER BY id DESC LIMIT 1" )or die('Error157');
	$rows = mysqli_fetch_assoc($q);
	$id = $rows['id'];
	mysqli_query($con,"UPDATE user_login SET logout_time=NOW() WHERE id=$id") or die('Error10');	
	session_destroy();
}
//$ref= @$_GET['q'];
header("location:index.php");
?>