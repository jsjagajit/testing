<?php
include_once '../dbConnection.php';
$ref=@$_GET['q'];
$email = $_POST['uname'];
$password = $_POST['password'];

$email = stripslashes($email);
$email = addslashes($email);
$password = stripslashes($password); 
$password = addslashes($password);
$result = mysqli_query($con,"SELECT email FROM admin WHERE email = '$email' and password = '$password'") or die('Error');
$count=mysqli_num_rows($result);
if($count==1){
	session_start();
	if(isset($_SESSION['email'])){
		session_unset();
	}
	$_SESSION["name"] = 'Admin';
	$_SESSION["admin"] = 'yes';
	$_SESSION["key"] ='jagajit9778494674';
	$_SESSION["email"] = $email;
	header("location:home.php");
}
else header("location:$ref?w=Warning : Access denied");
?>