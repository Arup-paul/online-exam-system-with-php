<?php
 
  $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Session.php');
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');

class Admin{
	
	private $db;
	private $fm;
	public function __construct(){
		$this->db = new Database();
		$this->fm = new Format();
	}

	public function getAdminData($data){
		$adminUser = $this->fm->validation($data['adminUser']);
		$adminPass = $this->fm->validation($data['adminPass']);
		$adminUser = mysqli_real_escape_string($this->db->link,$adminUser);
		$adminPass = mysqli_real_escape_string($this->db->link,md5($adminPass));
		if (empty($adminUser) || empty($adminPass)) {
  		$loginmsg = "<span class='error'>Username & Password Must Not Be Empty!!</span>";
  		return $loginmsg;
  		}else{

		$query = "SELECT * FROM admin WHERE adminUser='$adminUser' AND adminPass ='$adminPass'";
		$result = $this->db->select($query);
		if ($result != false) {
			$value = $result->fetch_assoc();
			Session::init();
			Session::set("adminlogin",true);
			Session::set("adminUser",$value['$adminUser']);
			Session::set("adminid",$value['$adminid']);
			header("Location:index.php");
		}else{
			$msg = "<span class='error'>Usernname Or Password Not Matched!</span>";
			return $msg;
		}
  		}
  	 }
  	
  	}
	


?>