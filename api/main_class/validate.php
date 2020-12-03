<?php
require "connect_db.php";
$mysql = new Main_db;
$mysql->Connect_db();
$mysql->SetCharacter();

class Validate{
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
		$count = $mysql->numRows($sql);
		if($count >0){
			$result = true;
		}else{
			$result = false;
		}
		return $result;
	}
}
?>