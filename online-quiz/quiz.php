<?php 
include_once("includes/session_header.php");
$nowDatetime =  strtotime("now");
$finalDatetime = $_SESSION["finalDatetime"];
$quiz_id = $_SESSION["quiz_id"];
$login_id = $_SESSION["login_id"];
$beginDatetime = strtotime($_SESSION["begin_time"]);
/*******Check for question answer given by user or not*******/
function chkclass($que_id){
	global $con;
	$question_check = mysqli_query($con,"SELECT * FROM exam_details WHERE user_id ='".$_SESSION["login_id"]."' and quiz_id='".$_SESSION["quiz_id"]."' and finalDatetime='".$_SESSION["finalDatetime"]."' and que_id='".$que_id."' LIMIT 1");
	$class = "";
	if(mysqli_num_rows($question_check)){
		$class = "given";
	}
	return $class;
}
//echo $_SESSION["begin_time"]." "." ".strtotime($_SESSION["begin_time"])." ".$nowDatetime."---".$finalDatetime;
if($nowDatetime >= $finalDatetime){
	//header("location:result_details.php");exit();
}
//print_r($_SESSION["finalDatetime"]);
?>
    <div class="container"><!--container start-->
        <div class="row">
            <div class="col-md-8">
                <?php				
				$order_by = "ORDER BY id ASC";
				$question = mysqli_query($con,"SELECT * FROM questions WHERE quiz_id='$quiz_id' $order_by");				
				/*$question_check = mysqli_query($con,"SELECT * FROM exam_details WHERE user_id ='".$login_id."' and quiz_id='$quiz_id' and finalDatetime='".$finalDatetime."'");
				$all_details = array();
				if(mysqli_num_rows($question_check)){	
					while($row_que = mysqli_fetch_array($question_check)){
						$all_details[] = $row_que;
					}
				}*/
                if(@$_GET['q']== 'quiz') {
                    //$_SESSION["time_limit"];
                    //$_SESSION["quiz_title"]
                   $qid_chk = isset($_GET['qid'])?$_GET['qid']:"";
                    $sn=@$_GET['n'];
                    $total=$_SESSION["quiz_total"];
                    $roll_no = $_SESSION["roll_no"];
					
					if($roll_no/2==0)
						$order_by = "ORDER BY id DSC";
					$sn = $sn-1;	
                    $sql_que=mysqli_query($con,"SELECT * FROM questions WHERE quiz_id='$quiz_id' $order_by LIMIT $sn,1");
					
					$que_rows = mysqli_fetch_array($sql_que);
					
					$q_check = mysqli_query($con,"SELECT * FROM exam_details WHERE user_id ='".$login_id."' and quiz_id='$quiz_id' and que_id ='".$que_rows['id']."' and finalDatetime='".$finalDatetime."' LIMIT 1");
					$ques_chkrows = mysqli_fetch_array($q_check);
					$ans_chk = $ques_chkrows['ans_id'];
								
					$q=mysqli_query($con,"SELECT * FROM questions WHERE quiz_id='$quiz_id' $order_by LIMIT $sn,1");
					?>
                    <div class="panel" style="margin:5%">
                    <?php
					//print_r($ques_chkrows);
					//echo $finalDatetime;
					//echo "SELECT id FROM questions WHERE quiz_id='$quiz_id' AND sn='$sn' LIMIT 1";
					//echo "SELECT * FROM exam_details WHERE user_id ='".$login_id."' and quiz_id='$quiz_id' and que_id ='".$que_rows['id']."' and finalDatetime='".$finalDatetime."' LIMIT 1";
						if(!isset($_REQUEST['ans'])){ 
							$row=mysqli_fetch_array($q);
							$qns=$row['qns'];
							$qid=$row['id'];
							$q=mysqli_query($con,"SELECT * FROM options WHERE que_id='$qid' " );
							echo '<b>Question &nbsp;'.$_GET['n'].'&nbsp;::<br />'.$qns.'</b><br /><br />';?>
							<form action="update.php?q=quiz&n=<?=$_GET['n'].'&qid='.$qid?>" method="POST"  class="form-horizontal">
							   <?php
							                       
								while($row=mysqli_fetch_array($q) ){
									$option = $row['option'];
                                	$optionid = $row['id'];
                            	?>                
                                <input type="radio" name="ans" value="<?=$optionid?>" <?php if(($ans_chk !='') && ($ans_chk==$optionid)) echo 'checked="checked"' ?>>&nbsp;<?=$option?><br /><br />
                     	<?php }
							$value = "Submit";
							if($ans_chk !=''){
								$value = "Update";
							}
						?>
							<br /><button type="submit" class="btn btn-primary" disabled><span class="glyphicon glyphicon-lock" aria-hidden="true"></span>&nbsp;<?=$value?></button>
				<?php }if(isset($_REQUEST['ans'])){?>
                        <font style="color:green; font-weight:bold;">
                            Your data has been submitted successfully...<br/>                            
                            Time dutaion is not competed to submit your page..<br/>Please wait... 
                        </font>
					<?php
					  }
					?>
                </form></div>
           <?php } ?>
                <!--quiz end-->
             
            </div>
            <div class="col-md-4">
            	 <div class="panel question" style="margin:5%">
                 <h3>Question Listing</h3>
                 <?php				 				 
				 while($row_que = mysqli_fetch_array($question)){
					 //echo $row_que['sn'],"---",$ans_chk;					
				?>
               	 <a href="quiz.php?q=quiz&n=<?=$row_que['sn'].'&qid='.$row_que['id'].'&t='.$total.'&n='.$row_que['sn']?>" class="<?php echo chkclass($row_que['id']); echo ($row_que['sn']==$_GET['n'])?" active":"";?>"><?=$row_que['sn']?></a>
                <?php
					 } 
				 ?>
                 </div>
            </div>
        </div>
    </div>
    </div>
    
<?php include_once("above_footer.php")?>
<?php
	include_once("footer.php");
?>
