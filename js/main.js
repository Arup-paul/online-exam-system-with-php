$(function(){
   //for user registration
   $("$regsubmit").click(function(){
   	 var name     = $("#name").val();
   	 var username = $("#username").val();
   	 var password = $("#password").val();
   	 var email    = $("#email").val();
   	 var dataString = 'name=' +name+ '&username=' +username+ '&password=' +password+ '&email='+email;
   	 $.ajax({
   	 	type:'post',
   	 	url:'getregister.php',
   	 	data:dataString,
   	 	success: function(data){
            $("#state").html(data);
   	 	}
   	 });
   	 return true;
   });

   //for user login
   $("$loginsubmit").click(function(){
   	 var email    = $("#email").val();
   	 var password = $("#password").val(); 
   	 var dataString = 'email='+email+'&password='+password;
   	 $.ajax({
   	 	type: "POST",
   	 	url: "getlogin.php",
   	 	data: dataString,
   	 	success: function(data){
   	 		if ($.trim(data) == 'empty') {
               $("empty").show();
               $("error").hide();
               $("disable").hide();
   	 		}else if($.trim(data) == 'disable'){
               $("empty").hide();
               $("error").hide();
               $("disable").show(); 
   	 		}else if($.trim(data) == 'error'){
                 $("empty").hide();
               $("error").show();
               $("disable").hide();
   	 		}else{
   	 			window.location = "exam.php";
   	 		}
   	 	}
   	 });
   	 return false;
   });

});