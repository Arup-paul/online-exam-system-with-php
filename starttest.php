<?php include 'inc/header.php'; ?>
<?php

   Session::checkSession();
   $question = $exam->getQuestion();
   $total = $exam->getTotalRows();


?>

<div class="main">
<h1>Welcome to Online Exam</h1>
	<div class="startest">
	    <h2>Test Your Knowledge</h2>
	    <p>This is Multiple choice quiz to test your Knowledge</p>
	    <ul>
	    	<li><strong>Number Of Question:</strong><?php echo $total;?></li>
	    	<li><strong>Question Type:</strong>Multiple Choice</li>
	    </ul>
	    <a href="test.php?q=<?php echo $question['quesno'];?>">Start Test</a>
	 </div>
	
  </div>
<?php include 'inc/footer.php'; ?>