<?php 
include_once("includes/session_header.php");
$nowDatetime =  strtotime("now");
$finalDatetime = $_SESSION["finalDatetime"];
$beginDatetime = strtotime($_SESSION["begin_time"]);
//echo $_SESSION["begin_time"]." "." ".strtotime($_SESSION["begin_time"])." ".$nowDatetime."---".$finalDatetime;
if($nowDatetime >= $finalDatetime){
	header("location:result_details.php");exit();
}
?>
    <div class="container"><!--container start-->
        <div class="row">
            <div class="col-md-12">
               <div class="panel">
                    <div class="table-responsive" style="text-align:center">
                        Questions are arise shortly...
                     </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script type="text/javascript">
		var myVarredirect = setInterval(myTimerrediredt, 1000);
		function myTimerrediredt() {
			$.get("timecheck.php", function(data, status){//console.log(data);			
				if(data == "instruction"){
					clearInterval(myVarredirect);			
					window.location = "quiz.php?q=quiz&n=1";
					//clearInterval(myVar);
				}			
			});
			
		}
	</script>
    
<?php include_once("above_footer.php")?>
<?php
	include_once("footer.php");
?>
