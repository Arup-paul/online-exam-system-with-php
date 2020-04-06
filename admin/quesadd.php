<?php 
    $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/inc/header.php');
	include_once ($filepath.'/../classes/Exam.php');
	$exam = new Exam();
?>

<style>
	.quespanel{width: 600px;color: #999;margin:20px auto 0;padding: 10px;border;1px solid #ddd;}
</style>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$addQue = $exam->addQuestion($_POST);
	}
	//get Total
	$total = $exam->getTotalRows();
	$next = $total+1;
?>
<div class="main">
<h1>Admin Panel- Add Question</h1>
<?php
    if (isset($addQue)) {
    	echo $addQue;
    }
?>

<div class="quespanel">
	 <form action="" method="post">
	 	<table>
	 		<tr>
	 			<td>Question No</td>
	 			<td>:</td>
	 			<td><input type="number" value="<?php 
                        if(isset($next)){
                        	echo $next;
                        }
                      ?>" name="quesno"></td>
	 		</tr>
	 		<tr>
	 			<td>Question</td>
	 			<td>:</td>
	 			<td><input required="" type="text" name="ques" placeholder="Enter Question"></td>
	 		</tr>
	 		<tr>
	 			<td>Choice One</td>
	 			<td>:</td>
	 			<td><input required="" type="text" name="ans1" placeholder="Enter Choice One..."></td>
	 		</tr>
	 		<tr>
	 			<td>Choice Two</td>
	 			<td>:</td>
	 			<td><input required="" type="text" name="ans2" placeholder="Enter Choice Two..."></td>
	 		</tr>
	 		<tr>
	 			<td>Choice Three</td>
	 			<td>:</td>
	 			<td><input required="" type="text" name="ans3" placeholder="Enter Choice Three..."></td>
	 		</tr>
	 		<tr>
	 			<td>Choice Four</td>
	 			<td>:</td>
	 			<td><input required="" type="text" name="ans4" placeholder="Enter Choice Four..."></td>
	 		</tr>
	 		<tr>
	 			<td>Correct No.</td>
	 			<td>:</td>
	 			<td><input required="" type="number" name="rightans"></td>
	 		</tr>

	 		<tr>
	 			<td colspan="3" align="center"><input   type="submit" name="submit" value="Add A Question"></td>
	 		</tr>
	 	</table>
	 </form>
</div>


	
</div>
<?php include 'inc/footer.php'; ?>