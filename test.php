<?php include 'inc/header.php'; ?>
<?php

   Session::checkSession();
   if (isset($_GET['q'])) {
   	  $number = (int) $_GET['q'];
   }else{
   	header("Location:exam.php");
   }
   $total = $exam->getTotalRows();
   $question = $exam->getQuestionByNumber($number);
?>
<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $process = $pro->processData($_POST);
    }


?>

<div class="main">
<h1>Question <?php  echo $question['quesno'].' of '.$total;?></h1>
	<div class="test">
		<form method="post" action="">
		<table> 
			<tr>
				<td colspan="2">
				 <h3>Que <?php echo $question['quesno'] . ':' .$question['ques']?></h3>
				</td>
			</tr>
              <?php
               $answer = $exam->getAnswer($number);
               if ($answer) {
               	while($result = $answer->fetch_assoc()){

              ?>
			<tr>
				<td>
				 <input type="radio" name="ans" value="<?php echo $result['id'];?>" /><?php echo $result['ans'];?>
				</td>
			</tr>
		<?php } } ?>
			

			<tr>
			  <td>
				<input type="submit" name="submit" value="Next Question"/>
				<input type="hidden" name="number" value="<?php echo $number;?>" />
			</td>
			</tr>
			
		</table>
	</form>
</div>
 </div>
<?php include 'inc/footer.php'; ?>