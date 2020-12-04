<?php
ini_set('display_errors',1);
error_reporting(E_ALL);

$mysql = new Main_db;
$mysql->Connect_db();
$mysql->SetCharacter();

class Auth{

	public function __construct(){
		$this->db_connect = new Main_db;
		$this->db_connect = $this->db_connect->Core_db();
	}

	public function AuthLogin($username){

		$stmt = $this->db_connect->prepare("SELECT id, firstname, lastname, username, password FROM tbl_member WHERE username = ?");
		$stmt->bind_param("s", $username);
		$stmt->execute();
		$stmt->bind_result($member_id, $member_firstname, $member_lastname, $member_username,$member_password);
		$result = $stmt->fetch();
		if($result){
			$data = array(
				'member_id' => $member_id,
				'member_username' => $member_username,
				'member_firstname' => $member_firstname,
				'member_lastname' => $member_lastname,
				'member_password' =>$member_password
			);
			$arr = array(
				'status' => 200,
				'data' => $data
			);
		}else{
			$arr = array(
				'status' => 404,
				'err_msg' => 'Data not found'
			 );
		}
		
		return $arr;
	}
}
?>