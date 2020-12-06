<?php 
define('VERSION_NUMBER', 1);

require "../config.php";

class Main_db{
	var $db_host;
	var $db_user;
	var $db_pass;
	var $db_name;
	var $db_connection;

	public function __construct(){
		$this->db_host = DB_HOST;
		$this->db_user = DB_USERNAME;
		$this->db_pass = DB_PASSWORD;
		$this->db_name = DB_NAME;
	}

	public function Core_db(){
		$this->db_connection = mysqli_connect($this->db_host,$this->db_user,$this->db_pass,$this->db_name);

		return $this->db_connection;
	}

	public function Connect_db(){
		$this->db_connection = mysqli_connect($this->db_host,$this->db_user,$this->db_pass,$this->db_name);
		mysqli_set_charset($this->db_connection,"utf8"); //set utf8
	}

	public function SetCharacter(){
		$set_char1 = "SET character_set_results = utf8";
		$set_char2 = "SET character_set_client = utf8";
		$set_char3 = "SET character_set_connection = utf8";
		mysqli_query($this->db_connection,$set_char1);
		mysqli_query($this->db_connection,$set_char2);
		mysqli_query($this->db_connection,$set_char3);
	}

	public function Select_db($sql){
		$result = mysqli_query($this->db_connection,$sql);
		$array = array();

		while ($row = mysqli_fetch_array($result)) {
			array_push($array, $row);
		}
		mysqli_free_result($result);
		return $array;
	}

	public function Select_db_one($sql){
		$result = mysqli_query($this->db_connection,$sql);
		$query = mysqli_fetch_assoc($result);
		return $query;
	}

	public function numRows($query) {
		$result  = mysqli_query($this->db_connection, $query);
		$rowcount = mysqli_num_rows($result);
		return $rowcount;
	}

	public function Insert_db($arr,$tableName){
		$str = "INSERT INTO ".$tableName."(".implode(",", array_keys($arr)).")";
		$str2 = " VALUES('".implode("','",$arr)."')";
		$sql = $str.$str2;
		$result = mysqli_query($this->db_connection,$sql);
		return $result;
	}

	public function Update_db($arr,$key,$tableName){
		$sql = "UPDATE ".$tableName." SET ";
		$last_key = end(array_keys($arr));
		$last_arr = end($key);
		$where = " WHERE ";
		foreach ($arr as $k => $value) {
			$value = $this->quote($value);
			
			$sql.= $k." = '".$value."' ";

			if ($k != $last_key){
			$sql.=",";
		}
			if (in_array($k, $key)){
				$where.= $k." = '".$value."' ";

				if ($k != $last_arr){
					$where.= " AND ";

				}

			}
		}

		$result = mysqli_query($this->db_connection,$sql.$where);

		return $result;
	}

	//ป้องกันตัวอักษร
	public function quote($str){
		return $this->db_connection->real_escape_string($str);
	}
	public function Delete_db($sql){
		$result = mysqli_query($this->db_connection,$sql);
		return $result;
	}

	public function Close_db(){
		$result = mysqli_close($this->db_connection);
		return $result;
	}

///////////////////////////////////////////////////////////////////////

}
?>