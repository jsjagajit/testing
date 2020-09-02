<?php
include_once("menu.php");
?>
<div class="container"><!--container start-->
	<div class="row">
    	<h2 class="heading">Update Questions</h2>
		<div class="col-md-12">
        	<div class="panel">
            <?php if(isset($_GET['msg']) && $_GET['msg'] !=''){?>
            	<p style="color:#03F;"><?=$_GET['msg']?></p>
            <?php }?> 

<?php
if(@$_GET['q']== 'quiz' && @$_GET['step']== 2) {
	$quiz_id = @$_GET['quiz_id'];
    $sn=@$_GET['n'];
    $total=@$_GET['t'];
	$quiz = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM quiz WHERE id='$quiz_id' limit 1" ));
	$q_que = mysqli_query($con,"SELECT * FROM questions WHERE quiz_id='$quiz_id' AND sn='$sn' LIMIT 1" );
	
	echo '<div class="panel">
			<div style="float:left">Exam name: <b>'.$quiz['title'].'</b></div>
			<div style="float:right"> <b> Total Question:'.$total.'</b></div>
		  </div>';
	if(isset($_GET['update']) && $_GET['update'] !='')
		echo '<div style="color:blue"> <b>'.$_GET['update'].'</b></div>';
		
	echo '<form action="update.php?q=updateqns&quiz_id='.$quiz_id.'&n='.$sn.'&t='.$total.'" method="POST" name="updateque" id="updateque" class="form-horizontal"><br />';
	$rows=mysqli_fetch_array($q_que);
	$qns=$rows['qns'];
	$que_id = $rows['id'];
	echo '<b>Question No.'.$sn.'</b><br/><textarea rows="3" cols="5" name="question['.$que_id.']" class="form-control">'.$qns.'</textarea>  ';
	
	$q_options=mysqli_query($con,"SELECT * FROM options WHERE que_id='$que_id' " );	
	$arr = array();
	$i=0;
	while($row=mysqli_fetch_array($q_options) )
	{
		$option=$row['option'];
		//$optionid[]=$row['id'];
		$arr[++$i] = $row['id'];
		echo '<b>Answar '.$i.'</b> <input name="option['.$row['id'].']" class="form-control input-md" type="text" value="'.$option.'">';
	}
	echo '<b>Correct answer</b>:<br />
	<select  name="answer['.$que_id.']" placeholder="Choose correct answer " class="form-control input-md" >';
	
	$q_ans = mysqli_query($con,"SELECT * FROM answer WHERE que_id='$que_id' " );
	$roww = mysqli_fetch_array($q_ans);
	$select = "";
	foreach($arr as $key => $val){
		if($val == $roww['option_id']){
			$select = "selected";
			echo '<option value="'.$val.'" '.$select.'>'.$key.'</option>';
		}else{
			echo '<option value="'.$val.'">'.$key.'</option>';
		}
	}
	echo'</select><br /><button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span>&nbsp;Update</button></form></div>Questions : ';
	
	for($i=1; $i <= $total; $i++){
		echo '<a href="question-update.php?q=quiz&step=2&quiz_id='.$quiz_id.'&n='.$i.'&t='.$total.'">';
		if($sn==$i) 
			echo '<b>'.$i.'</b>'.'</a> | ';
		else
		   echo $i.'</a> | ';
	} 
	//header("location:dash.php?q=4&step=2&eid=$id&n=$total");
}

?>

			</div>
		</div>
	</div>
</div>
<!--<script type="text/javascript">
       /*****No back*/
        history.pushState(null, null, location.href);
		window.onpopstate = function () {
			history.go(1);
		};
        
	$('#updateque').validate({
		 rules: {
			question[<?php //echo $qid?>]: {
					required: true,
				},
			answer[<?php //echo $qid?>]: {
					required: true,
				},
		<?php //foreach($optionid as $key => $val){?>
			option[<?php //echo $val?>]: {
				required: true,
			},

		<?php //}?>
						
		},
		submitHandler: function(form) {
			 $('#updateque').submit();
		}
	});
    </script>-->
<?php
	include_once("../footer.php");
?>
