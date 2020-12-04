<?php
require "connect_db.php";

class Validate{

	public function __construct(){
		$this->db_connect = new Main_db;
		$this->db_connect = $this->db_connect->Connect_db();
		$this->db_connect = $this->db_connect->SetCharacter();
	}
	// Does string contain letters?
	public function Check_letters($string){
	    return preg_match( '/[a-zA-Z]/', $string );
	}
	// Does string contain numbers?
	public function Check_numbers($string){
	    return preg_match( '/\d/', $string );
	}
	// Does string contain special characters?
	public function Check_special_chars($string){
	    return preg_match('/[^a-zA-Z\d]/', $string);
	}

	public function Check_same($tablename,$field,$value){
		$sql = "SELECT * FROM ".$tablename." WHERE ".$field." = '".$value."'";
		$count = $this->db_connect->numRows($sql);
		if($count >0){
			$result = true;
		}else{
			$result = false;
		}
		return $result;
	}
}
?>