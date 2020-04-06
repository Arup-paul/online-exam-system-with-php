<?php 
    $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/inc/header.php');
	include_once ($filepath.'/../classes/Exam.php');
	$exam = new Exam();
?>

<?php
   if (isset($_GET['delque'])) {
   	  $quesno = (int)$_GET['delque'];
   	  $delQue = $exam->delQuestion($quesno);
   }


?>



<div class="main">
	<h1>Admin Panel. Question List</h1>
	<?php
       if (isset($delQue)) {
       	 echo $delQue;
       }
	?>
	
<div class="queslist">
	<table class="tblone">
		<tr>
			<th width="10%">Sl No:</th>
			<th width="60%">Questions</th>
			<th width="3 0%">Action</th>
		</tr>

		<?php
            $getData = $exam->getQueByOrder();
            if ($getData) {
            	$i=0;
            	while ($result = $getData->fetch_assoc()) {
            		$i++;

            
		?>
		<tr>
			<td><?php echo $i;?></td>
		    <td><?php echo $result['ques']; ?></td>
			<td>
               <a onclick="return confirm('Are you sure to Remove')" href="?delque=<?php echo $result['quesno']; ?>">Remove</a>

			</td>
		</tr>
	<?php  }} ?>
	</table>
</div>

	
</div>
<?php include 'inc/footer.php'; ?>