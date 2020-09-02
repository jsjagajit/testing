<?php
include_once("menu.php");
?>
<script>
		$(function () {
			$(document).ready(function(){
				//viewData();
				viewUserData();
			});
			$(document).on( 'scroll', function(){
				console.log('scroll top : ' + $(window).scrollTop());
				if($(window).scrollTop()>=$(".logo").height())
				{
					 $(".navbar").addClass("navbar-fixed-top");
				}
		
				if($(window).scrollTop()<$(".logo").height())
				{
					 $(".navbar").removeClass("navbar-fixed-top");
				}
			});
		});
		/*function viewData(){
			$.ajax({
				url: "process.php?p=view",
				metjod: "GET",
				}).done(function(data){
					$('#views').html(data);
					//tableData();						
				});
		}*/
		function viewUserData(){
			$.ajax({
				url: "process.php?p=viewUserData",
				metjod: "GET",
				}).done(function(data){
					$('#view').html(data);
					tableData();						
				});
		}
		function tableData(){
			$('#tabledit').Tabledit({
				url: 'process.php?p=edituser',
				eventType: 'dblclick',
    			editButton: true,
				deleteButton: true,
				columns: {
					identifier: [0, 'id'],
					editable: [[1, 'name'], [2, 'mob'], [3, 'gender'], [4, 'email'], [5, 'roll_no']]
				},
				onSuccess: function(data, textStatus, jqXHR) {//alert("onSuccess "+data+" "+textStatus+" "+jqXHR);
					viewUserData();
				},
				onFail: function(jqXHR, textStatus, errorThrown) {//alert("onFail "+jqXHR+" "+textStatus+" "+errorThrown);
					console.log('onFail(jqXHR, textStatus, errorThrown)');
					console.log(jqXHR);
					console.log(textStatus);
					console.log(errorThrown);
				},
				onAjax: function(action, serialize) {//alert("onAjax "+action+" "+serialize);
					console.log('onAjax(action, serialize)');
					console.log(action);
					console.log(serialize);
				}
			});
		}
    </script>
<!--navigation menu closed-->
<div class="container"><!--container start-->
     <div class="col-md-12">
        <div class="panel">
            <div class="row">
            <h2 class="heading">Student Listing</h2>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered title1" id="tabledit">
                        <thead>
                            <tr>
                                <th>S.N.</th>
                                <th>Name</th>
                                <th>Mobile</th>
                                <th>Gender</th>
                                <th>Email</th>
                                <th>Roll No</th>                                 
                             </tr>
                         </thead>
                         <tbody id="view"></tbody>
                    </table>
                 </div>
            </div>     
        </div><!--container closed-->
    </div>
</div>
<?php
	include_once("../footer.php");
?>