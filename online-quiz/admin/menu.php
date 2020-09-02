 <?php session_start();
	include_once '../dbConnection.php';
	if(!isset($_SESSION["admin"]) && $_SESSION["admin"] != "yes"){
		header("location:index.php?q=You are not authorized your to access this page");
	}
	$email=$_SESSION['email'];
	  if(!(isset($_SESSION['email']))){
		header("location:index.php");
	  }else{
		$name = $_SESSION['name'];
		echo '<span class="pull-right top title" ><span class="log1"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;&nbsp;&nbsp;&nbsp;Hello,</span> &nbsp;'.$name.'&nbsp;|&nbsp;<a href="logout.php" class="log"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>&nbsp;Signout</button></a></span>';
	}
	function checkurl($checkurl){
	 $reg="";
	 $checkuri = strrchr($_SERVER['REQUEST_URI'], "/");
	 if($checkuri == "/".$checkurl) 
		$reg='class="active"';
	  return $reg;
	}
?>
<!DOCTYPE html >
<html>
<head>
    <meta http-equiv="Content-Type" content="NISER Semester Quiz Exam" />
    <meta name="viewport" content="NISER Semester Quiz Exam">
    <title>ADMIN DEMO ONLINE Exam </title>
    <link  rel="stylesheet" href="../css/bootstrap.min.css"/>
    <link  rel="stylesheet" href="../css/bootstrap-theme.min.css"/>    
    <link rel="stylesheet" href="../css/main.css">
    <link  rel="stylesheet" href="../css/font.css">
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <!--<script src="../js/jquery.js" type="text/javascript"></script>-->
    <script src="../js/bootstrap.min.js"  type="text/javascript"></script>
    <script src="../js/jquery.tabledit.js"  type="text/javascript"></script>
    <!--<script src="../js/jquery.validate.min.js" type="text/javascript"></script>-->   
	<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
</head>
<body  style="background:#eee;">
    <div class="header">
    	<div class="row">
    		<div class="col-lg-1">
                <span class="logo"><img src="../image/logo-white.png"></span> 
            </div>
            <div class="col-lg-6">
                <div style="color:#FFF;font-size:30px; margin:20px 0px 0px 0px">DEMO Online Exam (Admin Panel)</div> 
            </div>
        </div>
    </div>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="topics.php"><b>Dashboard</b></a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                     <li <?=checkurl("home.php")?>><a href="home.php">Home<span class="sr-only">(current)</span></a></li>
                     <li>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Exam<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li <?=checkurl("topics.php")?>><a href="topics.php">Exam Listing</a></li>
                            <li <?=checkurl("setexam.php")?>><a href="setexam.php">Exam Set</a></li>                            
                            <li <?=checkurl("add_quiz.php")?>><a href="add_quiz.php">Add Exam</a></li>
                            <li <?=checkurl("import.php")?>><a href="import.php">Import Questions</a></li>
                            <li <?=checkurl("question-edit.php")?>><a href="question-edit.php">Question Edit</a></li>                    
                        </ul>
                    </li>
                    <li>
                    	 <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Students<span class="caret"></span></a>
                         <ul class="dropdown-menu">
                         	<li <?=checkurl("add_student.php")?>><a href="add_student.php">Add Student</a></li>
                            <li <?=checkurl("student_import.php")?>><a href="student_import.php">Student Import Detail</a></li>
                         	<li <?=checkurl("user-listing.php")?>><a href="user-listing.php">Student List</a></li>
                         </ul>
                    </li>
                    <li>
                         <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Exam Result<span class="caret"></span></a>
                         <ul class="dropdown-menu">
                            <li <?=checkurl("exam_result.php")?>><a href="exam_result.php">Search Results</a></li>
                             <li <?=checkurl("export_result.php")?>><a href="export_result.php">Export Results</a></li>
                            
                         </ul>
                    </li>
                    <!--<li class="pull-right"> <a href="logout.php"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>&nbsp;&nbsp;&nbsp;&nbsp;Signout</a></li>-->                
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>