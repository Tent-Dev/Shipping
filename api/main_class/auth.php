<?php
ini_set('display_errors',1);
error_reporting(E_ALL);

include("../lib/php-jwt-master/src/JWT.php");

use \Firebase\JWT\JWT;

$mysql = new Main_db;
$mysql->Connect_db();
$mysql->SetCharacter();

class Auth{

	public function __construct(){
		$this->db_connect = new Main_db;
		$this->db_core = $this->db_connect->Core_db();
	}

	public function AuthLogin($username, $password){
		$jwt_auth = new JWT_Auth();
		$stmt = $this->db_core->prepare("SELECT id, firstname, lastname, username, password FROM tbl_member WHERE username = ?");
		$stmt->bind_param("s", $username);
		$stmt->execute();
		$stmt->bind_result($member_id, $member_firstname, $member_lastname, $member_username,$member_password);
		$result = $stmt->fetch();
		if($result){
			if(password_verify($password, $member_password)){
				$data = array(
					'member_id' => $member_id,
					'member_username' => $member_username,
					'member_firstname' => $member_firstname,
					'member_lastname' => $member_lastname,
					'signin_time' => date("Y-m-d H:i:s")
				);
				$jwt_auth->JWT_Create($data);
				$response = array(
					'status' => 200,
					'data' => $data
				);
			}else{
				$response = array(
					'status' => 400,
					'err_msg' => 'Password incorrect'
				);
			}
			
		}else{
			$response = array(
				'status' => 404,
				'err_msg' => 'Data not found'
			);
		}
		
		return $response;
	}
}

class JWT_Auth{

	public function JWT_Create($data){
		$key = "example_key";

		$data['exp'] = 1460046010;
		$payload = $data;

		$jwt = JWT::encode($payload, $key);
		//$decoded = JWT::decode($jwt, $key, array('HS256'));

		print_r($jwt);

		// JWT::$leeway = 60; // $leeway in seconds
		// $decoded = JWT::decode($jwt, $key, array('HS256'));
	}
}
?>