<?php
include_once("menu.php");
?>
<div class="container"><!--container start-->
    <div class="col-md-12">
        <div class="panel">
            <div class="row">
                <h2 class="heading">Edit Questions</h2>
                <?php 
                $result = mysqli_query($con,"SELECT * FROM quiz Where deleted !=1") or die('Error');
                echo  '<div class="panel"><div class="table-responsive">
                <table class="table table-striped">
                <tr><td><b>S.N.</b></td><td><b>Topic</b></td><td><b>Total question</b></td><td><b>Marks</b></td><td><b>Time limit</b></td><td></td></tr>';
                $c=1;
                while($row = mysqli_fetch_array($result)) {
                    $title = $row['title'];
                    $total = $row['total'];
                    $sahi = $row['sahi'];
                    $time = $row['time'];
                    //$eid = $row['eid'];
                    $quiz_id = $row['id'];
                    //$q12=mysqli_query($con,"SELECT score FROM history WHERE quiz_id='$quiz_id'" )or die('Error98');
                    //$rowcount=mysqli_num_rows($q12);
                    echo '<tr><td>'.$c++.'</td><td>'.$title.'</td>
                    <td>'.$total.'</td><td>'.$sahi*$total.'</td>
                    <td>'.$time.'&nbsp;min</td>';
                    if($row['enter_question'] ==1)
                        echo '<td><b><a href="question-update.php?q=quiz&step=2&quiz_id='.$quiz_id.'&n=1&t='.$total.'" class="pull-right btn sub1" style="margin:0px;background:#99cc32"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>&nbsp;<span><b>Edit</b></span></a></b></td></tr>';
                    else
                        echo '<td><b><a href="add_quiz.php?q=quiz&step=2&quiz_id='.$quiz_id.'&t=1&n='.$total.'&ch=4" class="pull-right btn sub1" style="margin:0px;"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;<span><b>Add</b></span></a></b></td></tr>';		
                    
                
                }
                $c=0;
                echo '</table></div></div>';
                ?>
            
            </div>
        </div><!--container closed-->
    </div>
</div>
<?php
	include_once("../footer.php");
?>
