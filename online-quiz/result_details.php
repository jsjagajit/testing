<?php 
include_once("includes/header_final.php");
?>
<nav class="navbar navbar-default ">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <!--<div style="top:20px; font-weight:bold;">
                 <p id="demo"></p>
            </div>-->
        </div>        
    </div><!-- /.container-fluid -->
</nav><!--navigation menu closed-->
<div class="container"><!--container start-->
    <div class="col-md-12">
        <div class="panel">
            <div class="row">
                <div class="table-responsive">
                    <!--home start-->
                    <?php 		
                    $q=mysqli_query($con,"SELECT * FROM history WHERE user_id='".$_SESSION["login_id"]."'" )or die('Error157');
                    if(mysqli_num_rows($q)){
                    ?>
                    
                    <h1 class="heading" style="color:#660033">Exam History</h1>
                    <table class="table table-striped">
                    <tr>
                        <th>Date/Time</th>
                        <th>Exam Name</th>
                        <th>Total Questions</th>
                        <th style="color:#99cc32"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span>Right Answer</th>
                        <th style="color:red"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span>Wrong Answer</th>
                        <th style="color:#66CCFF"><span class="glyphicon glyphicon-star" aria-hidden="true"></span>Score</th>
                        <th>Details</th>
                    </tr>
                    <?php    
                        while($row=mysqli_fetch_array($q)){
                            $s = $row['score'];
                            $w = $row['wrong'];
                            $r = $row['sahi'];
                            $qa = $row['level'];
                            $session = $row['set_session'];
                    ?>                    
                    <tr>
                        <td><?=date('d/m/Y h:m:s',strtotime($row['date']))?></td>
                        <td><?=find_single_value("quiz","title","id='".$row['quiz_id']."'")?></td>
                        <td><?=$qa?></td>
                        <td><?=$r?></td>
                        <td><?=$w?></td>
                        <td><?=$s?></td>
                        <td><a href="details.php?&set_session=<?=$session?>" style="float:right;font-size:16px; font-weight:900;" class="logo1">Details</a></td>
                    </tr>
                    <?php
                    }
                    }else{
                    ?>
                    <tr><td colspan="6" bgcolor="#996600" align="center" style="color:#fff;">Reesult is not available.</td></tr>
                    <?php
                    }
                    ?>
                    </table>
                </div>
            </div>        
        </div>
    </div>
</div>
    <!--Footer start-->
    
    <?php
	include_once("footer.php");
	?>
</body>
</html>