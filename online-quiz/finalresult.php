<?php 
	include_once("includes/header_final.php");
	/*****************check previous exam session;***********/
	$finalDatetime =  $_SESSION['finalDatetime'];
	$sql_history = mysqli_query($con,"SELECT id FROM history WHERE finalDatetime='".$finalDatetime."' LIMIT 1");
	if(mysqli_num_rows($sql_history) == 0){
		header("location:result_details.php");exit();
	}
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
						<center><h2 class="heading">Result</h2></center>
                        <a href="details.php" style="float:right;font-size:16px; font-weight:900;" class="logo1">Details</a>
                    <table class="table table-striped" style="font-size:20px;">
					<?php 
                    if(@$_GET['q']== 'result' && $_SESSION['quiz_id'] !=''){
						$quiz_id=$_SESSION['quiz_id'];
						$login_id = $_SESSION['login_id'];
						$set_session = $_SESSION['set_session'];						
						$q=mysqli_query($con,"SELECT * FROM history WHERE quiz_id='$quiz_id' AND user_id='$login_id' AND finalDatetime = '$finalDatetime' " )or die('Error157');
						
						while($row=mysqli_fetch_array($q) )
						{
							$s=$row['score'];
							$w=$row['wrong'];
							$r=$row['sahi'];
							$qa=$row['level'];
						?>
                        	<tr style="color:#66CCFF"><td>Total Questions</td><td><?=$qa?></td></tr>
                            <tr style="color:#99cc32"><td>Right Answer&nbsp;<span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span></td><td><?=$r?></td></tr> 
                            <tr style="color:red"><td>Wrong Answer&nbsp;<span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span></td><td><?=$w?></td></tr>
                            <tr style="color:#66CCFF"><td>Score&nbsp;<span class="glyphicon glyphicon-star" aria-hidden="true"></span></td><td><?=$s?></td></tr>
						<?php }?>
						</table>
                       
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