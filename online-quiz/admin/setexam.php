<?php
include_once("menu.php");
include_once("functions.php");
?>
<script>
		function set_examset(){//alert(11);
			var datetime_set = document.forms["set_exam"]["datetime_set"].value;			
			var quiz_id = document.forms["set_exam"]["quiz_id"].value;
			//alert(datetime_set+"---"+quiz_id);
			var pass_data = {
					'datetime_set' : datetime_set,
					'quiz_id' : quiz_id,
				};
			$.ajax({
				url : "process.php?p=exam_timeset",
				type : "POST",
				data: pass_data,
				success : function(data) {
					alert(data);
				}
			});
		}
		
    </script>
<!--navigation menu closed-->
    <div class="container"><!--container start-->
    	<div class="col-md-12">
        	 <div class="panel">
        		<div class="row">             
            		<h2 class="heading">Exam Set</h2>               
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered title1">
                            <thead>
                                <tr>
                                    <th>Topic</th>
                                    <th>Right Question Mark</th>
                                    <th>Wrong Question Mark</th>
                                    <th>Total question</th>
                                    <th>Time limit</th>
                                    <th>Marks</th>
                                    <th>Date Time Set</th>                   
                                 </tr>
                             </thead>
                             <tbody id="views">
                             <?php 
							 $result = mysqli_query($con,"SELECT * FROM quiz WHERE deleted !=1 and enable_exam =1") or die('Error');
							 $row = mysqli_fetch_assoc($result);
							 $datetime = fill_single_value("exam_set","datetime_set","quiz_id='".$row['id']."'");
							?>
                                 <tr>
                                     <td><?=$row['title']?></td>            
                                     <td><?=$row['sahi']?></td>
                                     <td><?=$row['wrong']?></td>
                                     <td><?=$row['total']?></td>    
                                     <td><?=$row['time']?></td>
                                     <td><?=$row['sahi']*$row['total']?></td>
                                     <td>
                                        <form name="set_exam" id="set_exam" onSubmit="set_examset()" action="javascript:void(0)" method="post">
                                          <input type="datetime-local" name="datetime_set" required value="<?=$datetime?>">
                                          <input type="hidden" name="quiz_id" value="<?=$row['id']?>">
                                          <input type="submit" value="Submit">
                                        </form>
                                    </td>         
                                 </tr>
							
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