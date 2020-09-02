<?php
include_once("menu.php");
?>
<script type="text/javascript" src="../fancybox/source/jquery.fancybox.js?v=2.1.5"></script>
<link rel="stylesheet" type="text/css" href="../fancybox/source/jquery.fancybox.css?v=2.1.5" media="screen" />
<script type="text/javascript" src="http://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/minified/jquery-ui.min.css" type="text/css" />
<div class="container"><!--container start-->	
    <div class="col-md-12">
        <div class="panel">
            <div class="row">
                <h2 class="heading">Serach Result</h2>
                <div class="col-md-3"></div> 
                <div class="col-md-6">            
                    <form class="form-horizontal" name="regform" id="regform"  method="POST">
                        <!-- Text input-->
                        <fieldset>               
                            <!-- Text input-->
                            <div class="form-group">
                              <label class="col-md-12 control-label" for="roll_no"></label>  
                              <div class="col-md-12">
                                <input type="text" id="roll_no" name="roll_no" placeholder="Enter Roll Number" class="form-control">                                
                              </div>
                            </div>                
                            <!-- Text input-->
                            <div class="form-group">
                              <label class="col-md-12 control-label" for="email"></label>  
                              <div class="col-md-12">
                                <input type="email" id="email" name="email" placeholder="Enter Email" class="form-control auto">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-md-12 control-label" for="mob"></label>  
                              <div class="col-md-12">
                                <input type="date" id="date" name="date" placeholder="Enter Date" class="form-control">                                
                              </div>
                            </div> 
                            <div class="form-group">
                              <label class="col-md-12 control-label" for=""></label>
                              <div class="col-md-12"> 
                                <input type="submit" style="margin-left:45%" class="btn btn-primary" value="Submit" />
                              </div>
                            </div>
                        </fieldset>
                    </form>
                </div>         
          </div>
           <div id="result"></div>
       </div>
    </div>
</div>
    
<script type="text/javascript">
	$(document).ready(function() {
		$('.fancybox').fancybox();
	});	
	$(function() {			
		//autocomplete
		$(".auto").autocomplete({
			source: "search.php",
			minLength: 1
		});                
	
	});
	$('#regform').validate({
		 rules: {
			roll_no: {
					require_from_group: [1, ".form-control"],
					number:true,
					minlength: 6
				},
			email: {
					require_from_group: [1, ".form-control"],
					email: true
				},
			date: {
					require_from_group: [1, ".form-control"]
				}
		},
		 submitHandler: function(form) {
			$.ajax({
				type: "POST",
				url: "process.php?p=search",
				data: new FormData($("#regform")[0]),
				processData: false,
				contentType: false,
				cache: false,
				timeout: 600000,
				success: function (res) {//alert(res);
					$("#result").html(res);
					//console.log("SUCCESS : ", data);
					//$("#btnSubmit").prop("disabled", true);
	
				},
				error: function (e) {
	
					$("#result").html(e.responseText);
					//console.log("ERROR : ", e);
					//$("#btnSubmit").prop("disabled", false);
	
				}
			});
		}
	});
	
</script>
<?php
	include_once("../footer.php");
?>