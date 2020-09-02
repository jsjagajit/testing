<?php 
include_once("includes/header_final.php");
//include_once("includes/function.php");
$set_session = isset($_REQUEST['set_session'])?$_REQUEST['set_session']:$_SESSION["set_session"];
$finalDatetime = $_SESSION["finalDatetime"];
$roll_no = $_SESSION["roll_no"];
$order_by = "ORDER BY id ASC";
if($roll_no/2==0)
	$order_by = "ORDER BY id DSC";
?>
<nav class="navbar navbar-default ">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
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
        
        <!--home start-->
        <?php 
		//echo "SELECT * FROM exam_details WHERE user_id='".$_SESSION["login_id"]."' AND finalDatetime='".$finalDatetime."' $order_by";
        $q=mysqli_query($con,"SELECT * FROM exam_details WHERE user_id='".$_SESSION["login_id"]."' AND finalDatetime='".$finalDatetime."' $order_by" ) or die('Error157');
		$q_hist =mysqli_query($con,"SELECT * FROM history WHERE user_id='".$_SESSION["login_id"]."' AND finalDatetime='".$finalDatetime."' LIMIT 1" ) or die('Error158');
		$rows = mysqli_fetch_array($q_hist);		
		$i=1;
        if(mysqli_num_rows($q)){
		?>
            <div class="panel">
            	<center><h1 class="heading" style="color:#660033">Exam: <?=find_single_value("quiz","title","id='".$_SESSION['quiz_id']."'")?></h1></center>
            	<div>
                <table align="center" class="table table-striped" cellpadding="2" cellspacing="2" >
                	<tr><td colspan="2" align="center"><b>Short Details</b></td></tr>
                	<tr><td align="right">Date/Time:</td><td><b><?=date("d/m/Y h:i:sa", $rows['set_session']);?></b></td></tr>
                    <tr><td align="right">Total No. of Questions:</td><td><b><?=find_single_value("quiz","total","id='".$rows['quiz_id']."'")?></b></td></tr>
                    <tr><td align="right">No. of Atained Question:</td><td><b><?=$rows['level']?></b></td></tr>
                    <tr><td align="right">Score:</td><td><b><?=$rows['score']?></b></td></tr>
                    <tr><td align="right">No. of Right Answer: </td><td><b><?=$rows['sahi']?></b></td></tr>
                    <tr><td align="right">No. of Wrong Answer:</td><td><b><?=$rows['wrong']?></b></td></tr>
                </table>
                	
                </div>
                
            	<span style="color:#660033; margin:10px; font-size:16px; font-weight:900;border-bottom:1px solid #006">All Detail</span>
            	<table class="table table-striped">
					<?php    
                        while($row=mysqli_fetch_array($q)){
							$right_ans = find_single_value("answer","option_id","que_id='".$row['que_id']."'");
					?>                    
                    <tr>
                        <td>
                           <font><?=$i++?>.</font>
                           <font color="#000099">Question : <?=find_single_value("questions","qns","id='".$row['que_id']."'")?></font><br/>
                           <font color="#009999">Your Answer : <?=find_single_value("options","option","id='".$row['ans_id']."'")?></font><br/>
                           <font color="#0066CC"> Right Answer : <?=find_single_value("options","option","id='".$right_ans."'")?></font>
                        </td>
                    </tr>
                <?php
                    }
                }else{
                ?>
                    <tr><td bgcolor="#996600" align="center" style="color:#fff;">Reesult is not available.</td></tr>
              <?php
                }
                ?>
                 </table>
         			</div>        
                </div>
            </div>
         </div>
    </div>
    <!--Footer start-->
    
    <?php
	include_once("footer.php");
	?>
</body>
</html>