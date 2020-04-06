<?php
 
  $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Session.php');
  include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');

class Users{
	
	private $db;
	private $fm;
	public function __construct(){
		$this->db = new Database();
		$this->fm = new Format();
	}

	 public function userRegistrations($name,$username,$password,$email){
		$name = $this->fm->validation($name);
    $username = $this->fm->validation($username);
    $password = $this->fm->validation($password);
    $email = $this->fm->validation($email);

		$name = mysqli_real_escape_string($this->db->link,$name);
    $username = mysqli_real_escape_string($this->db->link,$username);
    $password = mysqli_real_escape_string($this->db->link,$password);
    $email = mysqli_real_escape_string($this->db->link,$email);

    if ($name == "" || $username =="" || $password =="" || $email=="") {
      echo "<span class='error'>Field Must Not Be Empty....</span>";
      exit();
    }else if(filter_var($email,FILTER_VALIDATE_EMAIL) === false){
       echo "<span class='error'>Invalid Email....</span>";
    }else{
      $chkquery = "SELECT * FROM users WHERE email='$email'";
      $chkresult = $this->db->select($chkquery);
      if ($chkresult != false) {
        echo "<span class='error'>Email Address Already Exist....</span>";
        exit();
      }else{
        $query = "INSERT INTO users(name,username,password,email) VALUES('$name','$username','$password','$email')";
           $inserted_row = $this->db->insert($query);
           if ($inserted_row ) {
            header("Location:register.php?&id=1");
             //echo "<span class='success'>Succesfully Registration....</span>";
             exit();
           }else{
            echo "<span class='error'>Error....</span>";
            exit();
           }

      }
    }
		
  		}

      public function userLogin($email,$password){
           $email = $this->fm->validation($email);
           $password = $this->fm->validation($password);

           $email = mysqli_real_escape_string($this->db->link,$email);
           $password = mysqli_real_escape_string($this->db->link,$password);

           if ( $email=="" || $password =="" ) {
      echo "empty";
      exit();
    }else{
       $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
      $result = $this->db->select($query);
      if ($result != false) {
        $value  = $result->fetch_assoc();
         if ($value['status'] == '1') {
            echo "Disable";
            exit();
         }else{
            Session::init();
            Session::set("login",true);
            Session::set("userid",$value['userid']);
            Session::set("username",$value['username']);
            Session::set("name",$value['name']);
            header("Location:exam.php");
         }
      }else{
         echo "error";
         exit();
      }
    }
    
      }

     public function getAllUser(){
     	$query = "SELECT * FROM users ORDER BY userid desc";
     	$result = $this->db->select($query);
     	return $result;
     }

     public function getUserData($userid){
      $query = "SELECT * FROM users WHERE userid = '$userid'";
      $result = $this->db->select($query);
      return $result;
     }

     public function updateUserData($userid,$data){
          $name = $this->fm->validation($data['name']);
          $username = $this->fm->validation($data['username']);
          $email = $this->fm->validation($data['email']);

          $name = mysqli_real_escape_string($this->db->link,$name);
          $username = mysqli_real_escape_string($this->db->link,$username);
          $email = mysqli_real_escape_string($this->db->link,$email);

          $query = "UPDATE users 
          SET
          name = '$name',
          username = '$username',
          email = '$email'
          WHERE userid='$userid'
          ";
        $updated_row = $this->db->update($query);
        if ($updated_row) {
          $msg = "<span class='success'>User Data Update Succesfully.....</span>";
          return $msg;
        }else{
          $msg = "<span class='error'>User Data Not Updated.........</span>";
          return $msg;
        }
     }

     public function DisableUser($userid){
        $query = "UPDATE users 
          SET
          status = '1'
          WHERE userid='$userid'
          ";
        $updated_row = $this->db->update($query);
        if ($updated_row) {
        	$msg = "<span class='success'>User Disable!</span>";
        	return $msg;
        }else{
        	$msg = "<span class='error'>User Not Disable!</span>";
        	return $msg;
        }

     }

     public function EnableUser($userid){
        $query = "UPDATE users 
          SET
          status = '0'
          WHERE userid='$userid'
          ";
        $updated_row = $this->db->update($query);
        if ($updated_row) {
        	$msg = "<span class='success'>User Enable!</span>";
        	return $msg;
        }else{
        	$msg = "<span class='error'>User Not Enable!</span>";
        	return $msg;
        }

     }

     public function DeleteUser($userid){
         $query = "DELETE FROM users WHERE userid='$userid'";
         $delData = $this->db->delete($query);
          if ($delData) {
        	$msg = "<span class='success'>User Removed!</span>";
        	return $msg;
        }else{
        	$msg = "<span class='error'>Error...User Not Removed!</span>";
        	return $msg;
        }
     }


  	 }
  ?>