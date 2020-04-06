<?php
 
  $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');

class Exam{
	
	private $db;
	private $fm;
	public function __construct(){
		$this->db = new Database();
		$this->fm = new Format();
	}
   
    public function getQueByOrder(){
    	$query = "SELECT * FROM question ORDER BY quesno ASC"; 
    	$result = $this->db->select($query); 
    	return $result;
    }

    public function delQuestion($quesno){
    	$tables = array("question","answer");
    	foreach($tables as $table){
    		$delquery = "DELETE FROM $table WHERE quesno='$quesno'";
    		$delData = $this->db->delete($delquery);
    	}
    	if ($delData) {
    		$msg = "<span class='success'>Data Delete Succesfully</span>";
    		return $msg;
    	}else{
    		$msg = "<span class='error'>Data Not Delete ...</span>";
    		return $msg;
    	}
    }

    public function getTotalRows(){
    	$query = "SELECT * FROM question";
    	$getresult = $this->db->select($query);
    	$total = $getresult->num_rows;
    	return $total;
    }

    public function addQuestion($data){
           $quesno = mysqli_real_escape_string($this->db->link,$data['quesno']);
           $ques = mysqli_real_escape_string($this->db->link,$data['ques']);
           $ans = array();
           $ans[1] = mysqli_real_escape_string($this->db->link,$data['ans1']);
           $ans[2] = mysqli_real_escape_string($this->db->link,$data['ans2']);
           $ans[3] = mysqli_real_escape_string($this->db->link,$data['ans3']);
           $ans[4] = mysqli_real_escape_string($this->db->link,$data['ans4']);
           $rightans = mysqli_real_escape_string($this->db->link,$data['rightans']);

           $query = "INSERT INTO question(quesno,ques) VALUES('$quesno','$ques')";
           $insert_row = $this->db->insert($query);
           if ($insert_row) {
           	 foreach($ans as $key=>$ansName){
                 if ($ansName != '') {
                 	if ($rightans == $key) {
                 		$rquery = "INSERT INTO  answer(quesno,rightans,ans) VALUES('$quesno','1','$ansName')";
                 	}else{
                 		$rquery = "INSERT INTO  answer(quesno,rightans,ans) VALUES('$quesno','0','$ansName')";
                 	}
                 	$insertrow = $this->db->insert($rquery);
                 	if ($insertrow) {
                 		continue;
                 	}else{
                 		die('Error...');
                 	}
                 }
           	 }
           	 $msg = "<span class='success'>Question add Succesfully</span>";
           	 return $msg;
           }
    }

    public function getQuestion(){
      $query = "SELECT * FROM question";
      $getdata = $this->db->select($query);
      $result = $getdata->fetch_assoc();
      return $result;
    }
   
    public function getQuestionByNumber($number){
      $query = "SELECT * FROM question WHERE quesno='$number'";
      $getdata = $this->db->select($query);
      $result = $getdata->fetch_assoc();
      return $result;
    }

    public function getAnswer($number){
       $query = "SELECT * FROM answer WHERE quesno='$number'";
      $getdata = $this->db->select($query);
      return $getdata;
    }


  	 }
  ?>