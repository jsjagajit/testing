<?php
	include_once("includes/header.php");
?>
   <div class="bg1">
		<div class="row">
			<div class="modall" id="myModal">
            	<div class="col-md-2 col-md-offset-4">
                    <div class="modal-dialog">
                    <?php
						//$nowDatetime =  strtotime("now");
						//$finalDatetime = $_SESSION["finalDatetime"];
						//$beginDatetime = strtotime($_SESSION["begin_time"]);
						
						//echo $_SESSION["begin_time"]." "." ".strtotime($_SESSION["begin_time"])." ".$nowDatetime."---".$finalDatetime;
						//if($nowDatetime < $beginDatetime){
						?>
                            <div class="modal-content" id="instruction" style="display:none;">
                              <div class="modal-header">
                                <h4 class="modal-title"><span style="color:orange;font-family:'typo">Instruction</span></h4>
                              </div>
                              <div class="modal-body">
                                <ul>
                                    <li>Question is Start @ <?=$_SESSION["begin_time"]?> <?php //date('d-m-Y h:m:s',strtotime($_SESSION["begin_time"]))?></li>
                                    <li>Quiz name: <?=$_SESSION["quiz_title"]?></li>
                                    <li>Total Questions: <?=$_SESSION["quiz_total"]?></li>
                                    <li>Each Right Answer: <?=$_SESSION["right_answer"]?> Mark</li>
                                    <li>Each Wrong Answer: <?=$_SESSION["wrong_answer"]?> Mark</li>
                                    <li>Time Limit: <?=$_SESSION["time_limit"]?> min</li>
                                </ul>
                              </div><!-- /.modal-content -->
                               <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" onclick="loginpage()">Go to Login Page</button>
                                </div>
                            </div>
                        <?php 		
						//}else{
						?>
                        	<div class="panel" id="notstart">
                                <div class="table-responsive" style="text-align:center">
                                    Exam is not yet started ....<br/>
                                    
                                 </div>
                            </div>
                        	
                        <?php //}?>
                        <div class="modal-content" id="login" style="display:none;">
                          <div class="modal-header">
                            <h4 class="modal-title"><span style="color:orange;font-family:'typo">USER LOG IN</span></h4>
                          </div>
                          <div class="modal-body">
                            <form class="form-horizontal" action="login.php?q=index.php" method="POST">
                                <fieldset>
                                    <div class="form-group">
                                      <label class="col-md-3 control-label" for="email"></label>  
                                      <div class="col-md-6">
                                      <input id="email" name="email" placeholder="Enter your email-id" class="form-control input-md" type="email">
                                        
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="col-md-3 control-label" for="password"></label>
                                      <div class="col-md-6">
                                        <input id="roll_no" name="roll_no" placeholder="Enter your Roll no" class="form-control input-md" type="text">
                                        
                                      </div>
                                    </div>
                                    <div class="modal-footer" style="float:left;">
                                    	<button type="button" class="btn btn-primary" onclick="instructpage()">Go Back Instruction Page</button>
                                	</div>
                                    
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Log in</button>
                                    </div>
                                </fieldset>
                            </form>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
<!--sign in modal closed-->
			</div>
        </div> 
    </div>
</div>

<!--Footer start-->
<script type="text/javascript">
  //window.onbeforeunload = function() { return "Your work will be lost."; };
  var myVar = setInterval(myTimer, 1000);
	function myTimer() {
		$.get("timecheck.php", function(data, status){//console.log(data);			
			if(data == "login_active"){
				$("#instruction").css("display", "block");
				$("#notstart").css("display", "none");
				//clearInterval(myVar);
			}
			if(data == "instruction"){
				$("#login").css("display", "block");
				$("#instruction").css("display", "none");
				$("#notstart").css("display", "none");
			}
    	});
	}
	function loginpage(){
		$("#login").css("display", "block");
		$("#instruction").css("display", "none");
		clearInterval(myVar);
	}
	function instructpage(){
		$("#login").css("display", "none");
		$("#instruction").css("display", "block");
		clearInterval(myVar);
	}
  </script>
<?php
	include_once("footer.php");
?>