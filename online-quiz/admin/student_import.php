<?php
include_once("menu.php");
$sql = mysqli_query($con,"SELECT id,title,total FROM quiz WHERE enable_exam !=1");
?>
<div class="container"><!--container start-->
	<div class="col-md-12">
		<div class="panel">
            <div class="row">
                <h2 class="heading">Import Student Details</h2> 
                <div class="col-md-3" id="result"></div> 
                <div class="col-md-6">            
                 	<form class="form-horizontal" name="import" id="import"  method="POST" enctype="multipart/form-data">
                		<!-- Text input-->
                        <fieldset>
                            <div class="form-group">
                                <label class="col-md-12 control-label" for="name"></label>  
                                <div class="col-md-12">                                
                                    <input type="file" id="file" name="file" class="form-control input-md">                    
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
		</div><!--container closed-->
	</div>
</div>
    <script type="text/javascript">
	$('#import').validate({
		 rules: {
			file: {
					required: true,
				}
		},
		 submitHandler: function(form) {
			$.ajax({
				type: "POST",
				url: "process.php?p=import_students",
				data: new FormData($("#import")[0]),
				processData: false,
				contentType: false,
				cache: false,
				timeout: 600000,
				success: function (res) {alert(res);
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