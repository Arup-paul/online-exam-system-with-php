<?php include 'inc/header.php'; ?>
<?php

   Session::checkSession();
    $total = $exam->getTotalRows();
   ?>

<div class="main">
<h1>All Question & Answer <?php echo $total;?> </h1>
	<div class="viewans">
		<table> 
			<?php 
               $getQues = $exam->getQueByOrder();
               	  if ($getQues) {
               	  	while ($question = $getQues->fetch_assoc()) {
               	  		
			?>
			<tr>
				<td colspan="2">
				 <h3>Que <?php echo $question['quesno'] . ':' .$question['ques']?></h3>
				</td>
			</tr>
              <?php
               $number = $question['quesno'];
               $answer = $exam->getAnswer($number);
               if ($answer) {
               	while($result = $answer->fetch_assoc()){

              ?>
			<tr>
				<td>
				 <input type="radio">
				 <?php
				  if ($result['rightans']=='1') {
				  	echo "<span style='color:blue; '>".$result['ans']."</span>";
				  }else{
				  	echo $result['ans'];
				  }
				   
				  ?>
				</td>
			</tr>
		<?php } } ?>
		<?php } } ?>
			

			
		</table>
</div>
 </div>
<?php include 'inc/footer.php'; ?>