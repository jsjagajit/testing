<?php
include_once("menu.php");
?>
<div class="container"><!--container start-->
    <div class="col-md-12">
        <div class="panel">
            <div class="row">
                <h2 class="heading">Enter New Student</h2> 
                    <div class="col-md-3" id="result"></div> 
                    <div class="col-md-6">            
                    <form class="form-horizontal" name="regform" id="regform"  method="POST">
                        <!-- Text input-->
                        <fieldset>
                            <div class="form-group">
                                <label class="col-md-12 control-label" for="name"></label>  
                                <div class="col-md-12">
                                    <input type="text"id="name" name="name" placeholder="Enter Student Name" class="form-control input-md" >                    
                                </div>
                            </div>                
                            <!-- Text input-->
                            <div class="form-group">
                              <label class="col-md-12 control-label" for="roll_no"></label>  
                              <div class="col-md-12">
                                <input type="text" id="roll_no" name="roll_no" placeholder="Enter Roll Number" class="form-control input-md">                                
                              </div>
                            </div>                
                            <!-- Text input-->
                            <div class="form-group">
                              <label class="col-md-12 control-label" for="email"></label>  
                              <div class="col-md-12">
                                <input type="email" id="email" name="email" placeholder="Enter Email" class="form-control input-md">
                              </div>
                            </div>                
                            <!-- Text input-->
                            <div class="form-group">
                              <label class="col-md-12 control-label" for="mob"></label>  
                              <div class="col-md-12">
                                <input type="number" id="mob" name="mob" placeholder="Enter Mobile Number" class="form-control input-md">                                
                              </div>
                            </div>                
                            <!-- Text input-->
                            <div class="form-group">
                              <label class="col-md-12 control-label" for="gender"></label>  
                              <div class="col-md-12">
                                <select id="gender" name="gender" class="form-control input-md">
                                    <option value="">--Select Gender--</option>
                                    <option value="M">Male</option>
                                    <option value="F">Female</option>
                                </select>                     
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
	$('#regform').validate({
		 rules: {
			name: {
					required: true,
				},
			roll_no: {
					required: true,
				},
			email: {
					required: true,
					email: true
				},
			gender: {
					required: true,
				},
			mob: {
				required: true,
				number: true
			}
		},
		 submitHandler: function(form) {
			$.ajax({
				type: "POST",
				url: "process.php?p=adduser",
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