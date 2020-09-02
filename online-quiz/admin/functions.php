<?php
include_once '../dbConnection.php';
function fill_single_value($table,$find,$where){
	global $con;
	$value = "";
	$where = "WHERE $where";
	$result = mysqli_query($con,"SELECT $find FROM $table $where LIMIT 1");
	if(mysqli_num_rows($result)){
		$row = mysqli_fetch_assoc($result);
		$value = $row[$find];
	}
	return $value;
}
/*FETCH Record from History table for candidates
SELECT q.title as Quiz,u.name as Name,u.email as Email,Q.total as Total,h.level as Visit,h.sahi,h.wrong,h.score,DATE(u.date) as Date FROM `history` as h, `user` as u, `quiz` as q WHERE h.user_id= u.id and h.quiz_id=q.id
*/
?>