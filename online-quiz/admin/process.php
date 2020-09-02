<?php session_start();
// Basic example of PHP script to handle with jQuery-Tabledit plug-in.
// Note that is just an example. Should take precautions such as filtering the input data.
date_default_timezone_set('Asia/Kolkata');
include_once('functions.php');
require('spreadsheet/php-excel-reader/excel_reader2.php');
require('spreadsheet/SpreadsheetReader.php');
$page = $_GET['p'];
//print_r($_GET);exit;
if(isset($_SESSION['key']) && $_SESSION['key']=='jagajit9778494674'){
	if($page=="recent_view"){
		 $result = mysqli_query($con,"SELECT * FROM quiz WHERE deleted !=1 AND enter_question !=1") or die('Error');
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
			 </tr>
	<?php
		 }
	}else if($page=="export"){
		 $sql="";
		 $i=1;	
		if(isset($_REQUEST['quiz']) && $_REQUEST['quiz'] !='')
			$quiz_id = fill_single_value("quiz","id","title='".$_REQUEST['quiz']."'");		
			$sql .=" quiz_id=$quiz_id AND";
		if(isset($_REQUEST['date']) && $_REQUEST['date'] !='')
			$sql .=" DATE(date)='".$_REQUEST['date']."'";
			$sql = rtrim($sql,"AND");
		if($sql !=''){		
			//echo "SELECT * FROM history WHERE $sql";
			$result = mysqli_query($con,"SELECT * FROM history WHERE $sql");
			if(mysqli_num_rows($result)){
				?>                
				<table id="tab" class="table table-bordered table-striped">
				<tr>
				 <th>#</th>
				 <th>Name</th>
                 <th>Roll No.</th>
				 <th>Quiz</th>
                 <th>Duration</th>
                 <th>Total</th>
                 <th>Visit</th>          
				 <th>Right</th>
				 <th>Wrong</th>                     
				 <th>Score</th>
				 <th>Date/Time</th>
				</tr>
				<?php
				while($row = mysqli_fetch_array($result)) {
					$roll_no = fill_single_value("user","roll_no","id='".$row['user_id']."'");
				?>
				 <tr>
					 <td><?=$i++?></td>
					 <td><?=fill_single_value("user","name","id='".$row['user_id']."'")?></td>
                     <td><?=$roll_no?></td>
					 <td><?=fill_single_value("quiz","title","id='".$row['quiz_id']."'")?></td>
                     <td><?=fill_single_value("quiz","time","id='".$row['quiz_id']."'")?> Min</td>
                     <td><?=fill_single_value("quiz","total","id='".$row['quiz_id']."'")?></td>                     
					 <td><?=$row['level']?></td>             
					 <td><?=$row['sahi']?></td>
					 <td><?=$row['wrong']?></td>					    
					 <td><?=$row['score']?></td>
					 <td><?=$row['date']?></td>                      
				 </tr>
				<?php
			}
			?>
            <tr><td colspan="11" align="center"></td></tr>
				</table>
                
			<?php			 
			}else{
				echo "No result found";
			} 
		}
	}else if($page=="search"){
		 //echo "<pre>"; print_r($_REQUEST);echo "</pre>";
		 $sql="";
		 $i=1;
		 if(isset($_REQUEST['email']) && $_REQUEST['email'] !='')
		 	$user_id = fill_single_value("user","id","email='".$_REQUEST['email']."'");
		 if(isset($_REQUEST['roll_no']) && $_REQUEST['roll_no'] !='')
			$user_id = fill_single_value("user","id","roll_no='".$_REQUEST['roll_no']."'");		
		if(isset($user_id) && $user_id !='')
			$sql .=" user_id=$user_id AND";
		if(isset($_REQUEST['date']) && $_REQUEST['date'] !='')
			$sql .=" DATE(date)='".$_REQUEST['date']."'";
			$sql = rtrim($sql,"AND");
		if($sql !=''){		
			//echo "SELECT * FROM history WHERE $sql";
			$result = mysqli_query($con,"SELECT * FROM history WHERE $sql");
			if(mysqli_num_rows($result)){
				?>                
				<table width="100%">
				<tr>
				 <th>#</th>
				 <th>Name</th>
                 <th>Roll No.</th>
				 <th>Quiz</th>
                 <th>Duration</th>
                 <th>Total</th>
                 <th>Visit</th>          
				 <th>Right</th>
				 <th>Wrong</th>                     
				 <th>Score</th>
				 <th>Date/Time</th>
                 <th>Details</th> 
				</tr>
				<?php
				while($row = mysqli_fetch_array($result)) {
					$roll_no = fill_single_value("user","roll_no","id='".$row['user_id']."'");
				?>
				 <tr>
					 <td><?=$i++?></td>
					 <td><?=fill_single_value("user","name","id='".$row['user_id']."'")?></td>
                     <td><?=$roll_no?></td>
					 <td><?=fill_single_value("quiz","title","id='".$row['quiz_id']."'")?></td>
                     <td><?=fill_single_value("quiz","time","id='".$row['quiz_id']."'")?> Min</td>
                     <td><?=fill_single_value("quiz","total","id='".$row['quiz_id']."'")?></td>                     
					 <td><?=$row['level']?></td>             
					 <td><?=$row['sahi']?></td>
					 <td><?=$row['wrong']?></td>					    
					 <td><?=$row['score']?></td>
					 <td><?=$row['date']?></td>
                      <td><a href="details.php?user_id=<?=$row['user_id']?>&quiz_id=<?=$row['quiz_id']?>&set_session=<?=$row['set_session']?>&roll_no=<?=$roll_no?>" class="fancybox fancybox.ajax">Details</a></td>       
				 </tr>
				<?php
			}
			?>
				</table>
			<?php			 
			}else{
				echo "No result found";
			} 
		}
	}else if($page=="viewUserData"){
			$result = mysqli_query($con,"SELECT * FROM user WHERE deleted !=1") or die('Error');
			while($row = mysqli_fetch_array($result)) {
				?>
			 <tr>
				 <td><?=$row['id']?></td>
				 <td><?=$row['name']?></td>            
				 <td><?=$row['mob']?></td>
				 <td><?=$row['gender']?></td>
				 <td><?=$row['email']?></td>    
				 <td><?=$row['roll_no']?></td>   
			 </tr>
		<?php
			}
	}else if($page=="exam_set"){
		//print_r($_POST);
		$result = mysqli_query($con,"UPDATE quiz SET enable_exam = 0") or die('Error1');
		$result = mysqli_query($con,"UPDATE quiz SET enable_exam = 1 WHERE id='".$_POST['radio1']."'") or die('Error');		
		if($result){
			$checkset = mysqli_query($con,"SELECT * FROM exam_set WHERE quiz_id ='".$_POST['radio1']."'");
			$num_rows = mysqli_num_rows($checkset);
			if(!$num_rows){
				$result = mysqli_query($con,"INSERT INTO exam_set VALUES('','".$_POST['radio1']."','',NOW())");
			}
			
			//echo "INSERT INTO exam_set VALUES('','".$_POST['radio1']."','',NOW())";	
			echo "Successfuly Enabled";		
		}
	}else if($page=="exam_timeset"){
		//print_r($_POST);
		$result = mysqli_query($con,"UPDATE exam_set SET datetime_set = '".$_POST['datetime_set']."' WHERE quiz_id='".$_POST['quiz_id']."'") or die('Error');		
		if($result){
			echo "Updated successfuly";		
		}
	}else if($page == 'adduser'){
		$name= ucwords(strtolower($_POST['name']));
		$roll_no = $_POST['roll_no'];
		$email = $_POST['email'];
		$mob = $_POST['mob'];
		$gender = $_POST['gender'];
		$sql_query = mysqli_query($con,"SELECT email from user WHERE email ='$email' LIMIT 1");
		$sql_roll_query = mysqli_query($con,"SELECT roll_no from user WHERE roll_no='$roll_no' LIMIT 1");
		if(mysqli_num_rows($sql_query)){
			echo "<font color='red'>"."$email"."</font>"." Email-id is already exist.";exit(0);
		}if(mysqli_num_rows($sql_roll_query)){
			echo "<font color='red'>"."$roll_no"."</font>"." Roll no is already exist.";exit(0);
		}else{
			$q3 = mysqli_query($con,"INSERT INTO user VALUES  ('','$name' , '$gender' , '$roll_no','$email','$mob','', NOW())")or die('Error');
			if($q3){
				 echo "<font color='green'><b>Succesfully Added"."</b></font>";exit(0);
				 
			}else{
				echo "<font color='red'>Something going wrong...Please try after some time...</font>";exit(0);
			}	
		}
	}else if($page == 'addquiz'){
		//print_r($_POST);exit;
		$name = $_POST['name'];
		$total = $_POST['total'];
		$sahi = $_POST['right'];
		$wrong = $_POST['wrong'];
		$time = $_POST['time'];
		$desc = $_POST['desc'];
		//$id=uniqid();
		$q3=mysqli_query($con,"INSERT INTO quiz VALUES  ('','$name','$sahi','$wrong','$total','$time','$desc','','','',NOW())")or die('Error');
		$id = mysqli_insert_id($con);
		if($id){
			header("location:add_quiz.php?q=4&step=2&eid=$id&n=$total");exit;
		}
		
	}else if($page == 'edituser'){
		header('Content-Type: application/json');
		$input = filter_input_array(INPUT_POST);		
		//echo "<pre>";print_r(INPUT_POST);echo "</pre>";exit;
		if ($input['action'] === 'edit') {
			mysqli_query($con,"UPDATE user SET name='" . $input['name'] . "', mob='" . $input['mob'] . "', gender='" . $input['gender'] . "', email='" . $input['email'] . "', roll_no='" . $input['roll_no'] . "' WHERE id='" . $input['id'] . "'");
		} else if ($input['action'] === 'delete') {
			mysqli_query($con,"UPDATE user SET deleted=1 WHERE id='" . $input['id'] . "'");
		} else if ($input['action'] === 'restore') {
			mysqli_query($con,"UPDATE user SET deleted=0 WHERE id='" . $input['id'] . "'");
		}
		//mysqli_close($mysqli);
		echo json_encode($input);
	}else if($page == 'editquiz'){
		header('Content-Type: application/json');
		$input = filter_input_array(INPUT_POST);
		if ($input['action'] === 'edit') {
			mysqli_query($con,"UPDATE quiz SET title='".$input['title'] . "', sahi='".$input['sahi']."', wrong='".$input['wrong']."', total='".$input['total']."', time='".$input['time']."' WHERE id='".$input['id']."'");
		} else if ($input['action'] === 'delete') {
			mysqli_query($con,"UPDATE quiz SET deleted=1 WHERE id='" . $input['id'] . "'");
		} else if ($input['action'] === 'restore') {
			mysqli_query($con,"UPDATE quiz SET deleted=0 WHERE id='" . $input['id'] . "'");
		}
		echo json_encode($input);
	}else if($page == 'import_students'){		
		$allowedFileType = array('application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		if(in_array($_FILES["file"]["type"],$allowedFileType)){			
			$targetPath = 'uploads/'.$_FILES['file']['name'];
			move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);
			try{
				$Spreadsheet = new SpreadsheetReader($targetPath);
				$Sheets = $Spreadsheet -> Sheets();
				//print_r($Sheets);
				foreach ($Sheets as $Index => $Name){
						
					foreach($Spreadsheet as $Key => $Row){
						//print_r($Row);								
						if($Key > 0){
							if(!empty( $Row[0])){
								//echo "INSERT INTO user(`name`,`gender`,`roll_no`,`email`,`mob`,`sem`,`batch`,`date`) VALUES('".$Row[0]."','".$Row[1]."','".$Row[2]."','".$Row[3]."','".$Row[4]."',NOW())"."<br/>";
								mysqli_query($con,"INSERT INTO user(`name`,`gender`,`roll_no`,`email`,`mob`,`date`) VALUES('".$Row[0]."','".$Row[1]."','".$Row[2]."','".$Row[3]."','".$Row[4]."',NOW())") or die('Error61');								
							}	
						}
					}
				}
				echo "Upload Successfully";
			}catch (Exception $E){
				echo $E -> getMessage();
			}
  		}else{ 
			echo "Invalid File Type. Upload Excel File.";exit();
  		}		
	}else if($page == 'import_question'){
		
		//print_r($_FILES['file']);
		$allowedFileType = array('application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		if(in_array($_FILES["file"]["type"],$allowedFileType)){			
			$targetPath = 'uploads/'.$_FILES['file']['name'];
			move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);
			$quiz_id = $_REQUEST['quiz'];
			try{
				$Spreadsheet = new SpreadsheetReader($targetPath);
				$Sheets = $Spreadsheet -> Sheets();
				$i=0;
				foreach ($Sheets as $Index => $Name){
					$Spreadsheet -> ChangeSheet($Index);		
					foreach($Spreadsheet as $Key => $Row){
						if($Key > 0){													
							foreach($Row as $k => $v){
								
								if(!empty( $v)){									
									$v = mysqli_real_escape_string($con,$v);
									if ($k===0){
										$i++;				
										mysqli_query($con, "INSERT INTO questions(quiz_id,qns,choice,sn,date) VALUES('$quiz_id','".$v."','4','".$i."',NOW())") or die('Error61');
										$qid = mysqli_insert_id($con);		
									}
									if($k===1){
										mysqli_query($con,"INSERT INTO options(que_id,option,date) VALUES('$qid','".$v."',NOW())") or die('Error62');
										$oaid = mysqli_insert_id($con);
									}
									if($k===2){
										mysqli_query($con,"INSERT INTO options(que_id,option,date) VALUES('$qid','".$v."',NOW())") or die('Error63');
										$obid = mysqli_insert_id($con);
									}
									if($k===3){
										mysqli_query($con,"INSERT INTO options(que_id,option,date) VALUES('$qid','".$v."',NOW())") or die('Error64');
										$ocid = mysqli_insert_id($con);
									}
									if($k===4){
										mysqli_query($con,"INSERT INTO options(que_id,option,date) VALUES('$qid','".$v."',NOW())") or die('Error65');
										$odid = mysqli_insert_id($con);
									}
									if($k===5){
										switch($v){
											case '1':
											$optionid=$oaid;
											break;
											case '2':
											$optionid=$obid;
											break;
											case '3':
											$optionid=$ocid;
											break;
											case '4':
											$optionid=$odid;
											break;
											default:
											$optionid=$oaid;
										}
										mysqli_query($con,"INSERT INTO answer(que_id,option_id,date) VALUES ('$qid','$optionid',NOW())") or die('Error66');
									}
								}																
							}
						}
					}
				}
				mysqli_query($con,"UPDATE quiz SET enter_question=1 WHERE id='".$quiz_id."'") or die('Error67');
				echo "Upload Successfully";
				
			}catch (Exception $E){
				echo $E -> getMessage();
			}
			/*try{
				$Reader = new SpreadsheetReader($targetPath);
				foreach ($Reader as $Row){
					print_r($Row);
				}
				$sheetCount = count($Reader->sheets());
				//print_r($Reader->ChangeSheet(1));exit;
				
				for($i=0;$i<$sheetCount;$i++){
					$Reader->ChangeSheet($i);
					foreach ($Reader as $Row){			
						$name = "";
						if(isset($Row[0])) {
							$name = mysqli_real_escape_string($conn,$Row[0]);
						}					
						$description = "";
						if(isset($Row[1])) {
							$description = mysqli_real_escape_string($conn,$Row[1]);
						}				
						if (!empty($name) || !empty($description)) {					
							$query = "insert into tbl_info(name,description) values('".$name."','".$description."')";
							$result = mysqli_query($conn, $query);				
							if (!empty($result)) {
								echo "Excel Data Imported into the Database";exit();
							} else {					
								echo "Problem in Importing Excel Data";exit();
							}
						}
					 }			
				}
			}
			catch (Exception $E){
				echo $E -> getMessage();
			}*/
  		}else{ 
			echo "Invalid File Type. Upload Excel File.";exit();
  		}	
	}
}
