<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="ADMIN NISER Semester Quiz Exam" />
<meta name="viewport" content="ADMIN NISER Semester Quiz Exam">
<title>ADMIN NISER Semester Quiz Exam</title>
<link  rel="stylesheet" href="../css/bootstrap.min.css"/>
<link  rel="stylesheet" href="../css/bootstrap-theme.min.css"/>    
<link rel="stylesheet" href="../css/main.css">
<link  rel="stylesheet" href="../css/font.css">
<script src="../js/jquery.js" type="text/javascript"></script>
<script src="../js/bootstrap.min.js"  type="text/javascript"></script>
<?php
if(@$_GET['w']){
	echo'<script>alert("'.@$_GET['w'].'");</script>';
}
if(isset($_SESSION["admin"]) && $_SESSION["admin"] == "yes"){
		header("location:home.php");
	}
?>
<script>
function validateForm() {var y = document.forms["form"]["name"].value;	var letters = /^[A-Za-z]+$/;if (y == null || y == "") {alert("Name must be filled out.");return false;}var z =document.forms["form"]["college"].value;if (z == null || z == "") {alert("college must be filled out.");return false;}var x = document.forms["form"]["email"].value;var atpos = x.indexOf("@");
var dotpos = x.lastIndexOf(".");if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {alert("Not a valid e-mail address.");return false;}var a = document.forms["form"]["password"].value;if(a == null || a == ""){alert("Password must be filled out");return false;}if(a.length<5 || a.length>25){alert("Passwords must be 5 to 25 characters long.");return false;}
var b = document.forms["form"]["cpassword"].value;if (a!=b){alert("Passwords must match.");return false;}}
</script>


</head>

<body>
<div class="header">
    <div class="row">
        <div class="col-lg-1">
        	<span class="logo"><img src="../image/logo-white.png"></span> 
        </div>
        <div class="col-lg-6">
        	<div style="color:#FFF;font-size:30px; margin:20px 0px 0px 0px">DEMO Online Exam (Admin Panel)</div> 
        </div>
        <div class="col-md-2 col-md-offset-4">            
        	<div class="modal1" id="login">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title"><span style="color:orange;font-family:'typo'">ADMIN LOGIN</span></h4>
                  </div>
                  <div class="modal-body title1">
                    <div class="row">
                    	<div class="col-md-3"></div>
                        <div class="col-md-6">
                            <form role="form" method="post" action="admin.php?q=index.php">
                                <div class="form-group">
                                    <input type="text" name="uname" maxlength="20"  placeholder="Admin user id" class="form-control"/> 
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" maxlength="15" placeholder="Password" class="form-control"/>
                                </div>
                                <div class="form-group" align="center">
                                    <input type="submit" name="login" value="Login" class="btn btn-primary" />
                                </div>
                            </form>
                        </div>
                  		<div class="col-md-3"></div>
                  	</div>
                  </div>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div>
        </div>
	</div>
</div><!--container end-->
 <div class="bg1">
    <div class="row"> 
    </div>
 </div>

<?php
	include_once("../footer.php");
?>
