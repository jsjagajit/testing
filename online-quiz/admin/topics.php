<?php
include_once("menu.php");
?>
<script>
		$(function () {
			$(document).ready(function(){
				//viewData();
				viewDataRecent();
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
		function exam_set(){
			//var con = confirm("Are you sure to set exam");
			//if(con){
				var radio1=$('input[type="radio"]:checked').val();
				var pass_data = {
						'radio1' : radio1,
					};
				$.ajax({
					url : "process.php?p=exam_set",
					type : "POST",
					data: pass_data,
					success : function(data) {
						alert(data);
					}
				});
			//}
			
		}
		/*function viewData(){
			$.ajax({
				url: "process.php?p=view",
				metjod: "GET",
				}).done(function(data){
					$('#views').html(data);
					//tableData();						
				});
		}*/
		function viewDataRecent(){
			$.ajax({
				url: "process.php?p=recent_view",
				metjod: "GET",
				}).done(function(data){
					$('#recent_added').html(data);
					tableData();						
				});
		}
		function tableData(){
			$('#tabledit').Tabledit({
				url: 'process.php?p=editquiz',
				eventType: 'dblclick',
    			editButton: true,
				deleteButton: true,
				columns: {
					identifier: [0, 'id'],
					editable: [[1, 'title'], [2, 'sahi'], [3, 'wrong'], [4, 'total'], [5, 'time']]
				},
				onSuccess: function(data, textStatus, jqXHR) {//alert("onSuccess "+data+" "+textStatus+" "+jqXHR);
					viewDataRecent();
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
        			<h2 class="heading">Recent Added</h2>  
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered title1" id="tabledit">
                            <thead>
                                <tr>
                                    <th>S.N.</th>
                                    <th>Topic</th>
                                    <th>Right Question Mark</th>
                                    <th>Wrong Question Mark</th>
                                    <th>Total question</th>
                                    <th>Time limit</th>
                                    <th>Marks</th>                                    
                                 </tr>
                             </thead>
                             <tbody id="recent_added"></tbody>
                        </table>
                     </div>
                </div>       
            </div>
            
            <div class="col-md-12">
                <div class="panel">
                <h2 class="heading">Quiz Listing</h2>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered title1">
                            <thead>
                                <tr>
                                    <th>S.N.</th>
                                    <th>Topic</th>
                                    <th>Right Question Mark</th>
                                    <th>Wrong Question Mark</th>
                                    <th>Total question</th>
                                    <th>Time limit</th>
                                    <th>Marks</th>
                                    <th>Enable Exam</th>                                    
                                 </tr>
                             </thead>
                             <tbody id="views">
                             <?php 
							 $result = mysqli_query($con,"SELECT * FROM quiz WHERE deleted !=1 and enter_question =1") or die('Error');
							 //echo "SELECT * FROM quiz WHERE deleted !=1 and enter_question =1";exit;
							 while($row = mysqli_fetch_assoc($result)) {
							?>
								 <tr>
									 <td><?=$row['id']?></td>
									 <td><?=$row['title']?></td>            
									 <td><?=$row['sahi']?></td>
									 <td><?=$row['wrong']?></td>
									 <td><?=$row['total']?></td>    
									 <td><?=$row['time']?></td>
									 <td><?=$row['sahi']*$row['total']?></td>
                                     <td><input type="radio" name="enable_exam" value="<?=$row['id']?>" onClick="exam_set()" <?php echo ($row['enable_exam'])?"checked":"";?>></td>             
								 </tr>
							<?php
							 }
							 ?>
                             </tbody>
                        </table>
                     </div>
                </div>       
            </div>
        </div>
    </div>
<?php
	include_once("../footer.php");
?>
