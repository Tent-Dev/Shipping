<?php
ini_set('display_errors',1);
error_reporting(E_ALL);

class Validate{

	public function __construct(){
		$this->db_connect = new Main_db;
		$this->db_core = $this->db_connect->Core_db();
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
		if($count == 0){
			$response = array(
					'status' => 200
				);
		}else{
			$response = array(
					'status' => 400,
					'err_msg' => 'Username duplicate'
				);
		}
		return $response;
	}
}
?>