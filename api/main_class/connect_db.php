<?php 
define('VERSION_NUMBER', 1);

require "../config.php";

class Main_db{
	var $db_host;
	var $db_user;
	var $db_pass;
	var $db_name;
	var $db_connection;

	public function Main_db(){
		$this->db_host = DB_HOST;
		$this->db_user = DB_USERNAME;
		$this->db_pass = DB_PASSWORD;
		$this->db_name = DB_NAME;
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

		while ($row = mysqli_fetch_array($result)) { //คืนค่ามา
			array_push($array, $row); //เพิ่ม value เข้าไปใน array ตำแหน่งท้ายสุด
		}
		mysqli_free_result($result);
		return $array;
	}

	public function Select_db_one($sql){
		$result = mysqli_query($this->db_connection,$sql);
		$query = mysqli_fetch_array($result);
		return $query;
	}

	public function numRows($query) {
        $result  = mysqli_query($this->db_connection, $query);
        $rowcount = mysqli_num_rows($result);
        return $rowcount;
    }

	public function Insert_db($arr,$tableName){
		$str = "INSERT INTO ".$tableName."(".implode(",", array_keys($arr)).")"; //implode แทรก string
		$str2 = " VALUES('".implode("','",$arr)."')";
		$sql = $str.$str2;
		//var_dump($sql);
		//echo $sql;
		$result = mysqli_query($this->db_connection,$sql);
		return $result;
	}

	public function Update_db($arr,$key,$tableName){
		$sql = "UPDATE ".$tableName." SET ";
		$last_key = end(array_keys($arr)); //end เลื่อน pointer ไปตำแหน่งท้ายสุดของ array, array_key ใช้คืนค่า key ทั้งหมดแบบ array โดย array ที่ได้จะมี key ตั้งแต่ 0 ขั้นไปตามลำดับ
		$last_arr = end($key);
		$where = " WHERE ";
		foreach ($arr as $k => $value) { //นำข้อมูลออกมาจากตัวแปลที่เป็นประเภท array โดยสามารถเรียกค่าได้ทั้ง $key และ $value ของ array
			$value = $this->quote($value);
			
			$sql.= $k." = '".$value."' ";

			if ($k != $last_key){ //เช็คว่า array ยังไม่ใช่ตัวสุดท้าย ให้ใส่เครื่องหมาย , ต่อท้าย เช่น 'field1','field2' จบ
				$sql.=",";
			}
			if (in_array($k, $key)){ //in_array ใช้ตรวจสอบว่ามีข้อมูลที่กำหนดใน array หรือไม่ ถ้ามีก็ใช้ AND ต่อ
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

	//สุ่มชุดตัวอักษร ทำ Session
	function ran(){
		$length = 15;    
		$ran = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$length);
		return $ran;
	}

}
?>