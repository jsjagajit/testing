<?php 
	include_once("includes/header_finish.php");
	/*****************check previous exam session;***********/
	$finalDatetime =  $_SESSION['finalDatetime'];
	//$sql_history = mysqli_query($con,"SELECT id FROM history WHERE finalDatetime='".$finalDatetime."' LIMIT 1");
	//if(mysqli_num_rows($sql_history) == 0){
		//header("location:result_details.php");exit();
	//}
?>
<nav class="navbar navbar-default ">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <a class="navbar-brand" href="#">Quiz Name: <b><?=$_SESSION["quiz_title"]?></b></a>&nbsp;&nbsp; <a class="navbar-brand" href="#">Total Questions: <b><?=$_SESSION["quiz_total"]?></b></a>&nbsp;&nbsp; <a class="navbar-brand" href="#">Time Duration: <b><?=$_SESSION["time_limit"]?></b> min</a> &nbsp;&nbsp; <span class="navbar-brand" style="font-weight:bold">[Time Over]</span> 
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        	<!--<div style="top:20px; font-weight:bold;">
            	 <p id="demo"></p>
            </div>-->
        </div>
        
      </div><!-- /.container-fluid -->
    </nav><!--navigation menu closed-->
    <div class="bg">
        <div class="container"><!--container start-->
            <div class="row">
                <div class="col-md-12">
                	<div class="panel">
						
					<?php 
                    if(@$_GET['q']== 'result' && $_SESSION['quiz_id'] !=''){
					?>
                    	<center><h2 class="heading">Thank you for your time !! Exam is over now. </h2></center>
                    <?php
					}else{
						echo "You are in wrong place";
					}
                    ?>
                   </div>
                </div>
            </div>
        </div>
    </div>
    <!--Footer start-->
    <script type="text/javascript">
		history.pushState(null, null, location.href);
		window.onpopstate = function () {
			history.go(1);
		};
	</script>
    <?php
	include_once("footer.php");
	?>
    
</body>
</html>