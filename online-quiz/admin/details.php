<?php
session_start();
include_once('functions.php');
if(!isset($_SESSION["admin"]) && $_SESSION["admin"] != "yes"){
	header("location:index.php?q=You are not authorized your to access this page");
} 
$roll_no = $_REQUEST["roll_no"];
$user_id = $_REQUEST["user_id"];
$quiz_id = $_REQUEST['quiz_id'];
$set_session = $_REQUEST['set_session'];
//echo "<pre>";print_r($_REQUEST);echo "</pre>";
$order_by = "ORDER BY id ASC";
if($roll_no/2==0)
	$order_by = "ORDER BY id DSC";
?>
<nav class="navbar navbar-default ">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="padding-top: 15px;">
            <b>Quiz Name:</b> <?=fill_single_value("quiz","title","id='".$quiz_id."'");?> | 
            <b>Date/Time:</b> <?=fill_single_value("history","date","set_session='".$set_session."'");?> | 
            <b>Score:</b> <?=fill_single_value("history","score","set_session='".$set_session."'");?>
        </div>        
    </div><!-- /.container-fluid -->
</nav><!--navigation menu closed-->
<div class="bg">
    <div class="container"><!--container start-->
        <div class="row">
            <div class="col-md-12">
                <?php 
                //echo "SELECT * FROM exam_details WHERE user_id='".$user_id."' AND quiz_id='".$quiz_id."' AND date='".$date."' $order_by";
                $q=mysqli_query($con,"SELECT * FROM exam_details WHERE user_id='".$user_id."' AND quiz_id='".$quiz_id."' AND set_session='".$set_session."' $order_by" ) or die('Error157');		
                $i=1;
                if(mysqli_num_rows($q)){
                ?>
                <div class="panel">                
                    <span style="color:#660033; margin:10px; font-size:16px; font-weight:900;border-bottom:1px solid #006">All Detail</span>
                    <table class="table table-striped">
						<?php    
                            while($row=mysqli_fetch_array($q)){
                                $right_ans = fill_single_value("answer","option_id","que_id='".$row['que_id']."'");
                        ?>                    
                        <tr>
                            <td>
                               <font><?=$i++?>.</font>
                               <font color="#000099">Question : <?=fill_single_value("questions","qns","id='".$row['que_id']."'")?></font><br/>
                               <font color="#009999">Your Answer : <?=fill_single_value("options","option","id='".$row['ans_id']."'")?></font><br/>
                               <font color="#0066CC"> Right Answer : <?=fill_single_value("options","option","id='".$right_ans."'")?></font>
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