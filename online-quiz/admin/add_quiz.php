<?php
include_once("menu.php");
?>
<div class="container"><!--container start-->
        <div class="row">
            <div class="col-md-12">
            	<div class="panel">
				<?php                
                if(!(@$_GET['step']) ) {
                echo ' 
                <div class="row">
                <span class="title1" style="margin-left:40%;font-size:30px;"><b>Enter Exam Details</b></span><br /><br />
                 <div class="col-md-3" id="result"></div>
				 <div class="col-md-6">   
				 <form class="form-horizontal" name="regform"  action="process.php?p=addquiz" id="regform" method="POST">
                <fieldset>
                
                
                <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-12 control-label" for="name"></label>  
                  <div class="col-md-12">
                  <input id="name" name="name" placeholder="Enter Exam title" class="form-control input-md" type="text">                    
                  </div>
                </div>
                
                <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-12 control-label" for="total"></label>  
                  <div class="col-md-12">
                  <input id="total" name="total" placeholder="Enter total number of questions" class="form-control input-md" type="number">
                    
                  </div>
                </div>
                
                <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-12 control-label" for="right"></label>  
                  <div class="col-md-12">
                  <input id="right" name="right" placeholder="Enter marks on right answer" class="form-control input-md" min="0" type="number">
                    
                  </div>
                </div>
                
                <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-12 control-label" for="wrong"></label>  
                  <div class="col-md-12">
                  <input id="wrong" name="wrong" placeholder="Enter minus marks on wrong answer without sign" class="form-control input-md" min="0" type="number">
                    
                  </div>
                </div>
                
                <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-12 control-label" for="time"></label>  
                  <div class="col-md-12">
                  <input id="time" name="time" placeholder="Enter time limit for test in minute" class="form-control input-md" min="1" type="number">
                    
                  </div>
                </div>
                <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-12 control-label" for="desc"></label>  
                  <div class="col-md-12">
                  <textarea rows="8" cols="8" name="desc" class="form-control" placeholder="Write description here..."></textarea>  
                  </div>
                </div>
                
                
                <div class="form-group">
                  <label class="col-md-12 control-label" for=""></label>
                  <div class="col-md-12"> 
                    <input  type="submit" style="margin-left:45%" class="btn btn-primary" value="Submit" class="btn btn-primary"/>
                  </div>
                </div>
                
                </fieldset>
                </form></div></div>';
                }
                ?>
                <!--add quiz end-->
                
                <!--add quiz step2 start-->
                <?php
                if((isset($_GET['step']) && @$_GET['step'])==2 ) {
					$quiz_id = $_GET['quiz_id'];
					$quiz = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM quiz WHERE id='$quiz_id' limit 1" ));
                echo ' 
                <div class="row">
                <span class="title1" style="margin-left:40%;font-size:30px;"><b>Enter Question Details</b></span><br /><br />
					<div class="panel">
						<div style="float:left">Exam name: <b>'.$quiz['title'].'</b></div>
						<div style="float:right"> <b> Total Question:'.$_GET['n'].'</b></div>
					</div>
                 <div class="col-md-3"></div>
				 <div class="col-md-6">
				 	<form class="form-horizontal" name="form_question" id="form_question" action="update.php?q=addqns&n='.@$_GET['n'].'&quiz_id='.$quiz_id.'&ch=4 "  method="POST">
                
                ';
                 
                 for($i=1;$i<=@$_GET['n'];$i++)
                 {
                echo '<fieldset style="border:1px solid #ccc; padding:10px;"><b>Question number&nbsp;'.$i.'&nbsp;:</b><br /><!-- Text input-->
                <div class="form-group">
                  <label class="col-md-12 control-label" for="qns'.$i.' "></label>  
                  <div class="col-md-12">
                  	<textarea rows="3" cols="5" name="qns'.$i.'" class="form-control" placeholder="Write question number '.$i.' here..."></textarea>  
                  </div>
                </div>
                <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-12 control-label" for="'.$i.'1"></label>  
                  <div class="col-md-12">
                  	<input id="'.$i.'1" name="'.$i.'1" placeholder="Enter option a" class="form-control input-md" type="text">                    
                  </div>
                </div>
                <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-12 control-label" for="'.$i.'2"></label>  
                  <div class="col-md-12">
                  	<input id="'.$i.'2" name="'.$i.'2" placeholder="Enter option b" class="form-control input-md" type="text">                    
                  </div>
                </div>
                <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-12 control-label" for="'.$i.'3"></label>  
                  <div class="col-md-12">
                  	<input id="'.$i.'3" name="'.$i.'3" placeholder="Enter option c" class="form-control input-md" type="text">                    
                  </div>
                </div>
                <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-12 control-label" for="'.$i.'4"></label>  
                  <div class="col-md-12">
                  	<input id="'.$i.'4" name="'.$i.'4" placeholder="Enter option d" class="form-control input-md" type="text">                    
                  </div>
                </div>
                <br />
                <b>Correct answer</b>:<br />
                <select id="ans'.$i.'" name="ans'.$i.'" placeholder="Choose correct answer " class="form-control input-md" >
                  <option value="">Select answer for question '.$i.'</option>
                  <option value="a">option a</option>
                  <option value="b">option b</option>
                  <option value="c">option c</option>
                  <option value="d">option d</option> </select></fieldset><br /><br />'; 
                 }
                    
                echo '<div class="form-group">
                  <label class="col-md-12 control-label" for=""></label>
                  <div class="col-md-12"> 
                    <input  type="submit" style="margin-left:45%" class="btn btn-primary" value="Submit" class="btn btn-primary"/>
                  </div>
                </div>                
                </form></div></div>';
                }
                ?><!--add quiz step 2 end--> 
                </div>
           </div><!--container closed-->
        </div>
    </div>
<script type="text/javascript">
       /*****No back*/
        history.pushState(null, null, location.href);
		window.onpopstate = function () {
			history.go(1);
		};
        
	$('#regform').validate({
		 rules: {
			name: {
					required: true,
				},
			total: {
					required: true,
					number: true
				},
			right: {
					required: true,
					number: true
				},
			wrong: {
					required: true,
					number: true
				},
			time: {
				required: true,
				number: true
			}
		},
		submitHandler: function(form) {
			 $('#regform').submit();
		}
	});
	<?php if(isset($_GET['n']) && $_GET['n'] !=''){?>
	$('#form_question').validate({
		 rules: {
			 <?php for($i=1;$i<=$_GET['n'];$i++){?>
			qns<?php echo $i;?>: {
					required: true,
				},
			ans<?php echo $i;?>: {
					required: true,
				},
				<?php for($j=1;$j<=$_GET['ch'];$j++){?>
				<?php echo $i.$j;?>: {
					required: true,
				},
				<?php }?>
			<?php }?>
		},
		submitHandler: function(form) {
			 $('#form_question').submit();
		}
	});
	<?php }?>
		
    </script>

<?php
	include_once("../footer.php");
?>