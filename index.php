<?php include 'inc/header.php'; ?>
<?php

   Session::checkLogin();


?>
<div class="main">
<h1>Online Exam System - User Login</h1>
	<div class="segment" style="margin-right:30px;">
		<img src="img/test.png"/>
	</div>
	<div class="segment">
	<form action="getlogin.php" method="post">
		<table class="tbl">    
			 <tr>
			   <td>Email</td>
			   <td><input name="email" type="text" id="email"></td>
			 </tr>
			 <tr>
			   <td>Password </td>
			   <td><input name="password" id="password" type="password"></td>
			 </tr>
			 
			  <tr>
			  <td></td>
			   <td><input type="submit" name="login" id="loginsubmit" value="Login">
			   </td>
			 </tr>
       </table>
	   </form>
	   <p>New User ? <a href="register.php">Signup</a> Free</p>
	   <span class="empty" style="display: none;">Field Must not be Empty.</span>
	   <span class="error" style="display: none;">Email or Password Not Match.</span>
	   <span class="disable" style="display: none;">UserId Disable.</span>
	</div>


	
</div>
<?php include 'inc/footer.php'; ?>