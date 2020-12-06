<?php
// ini_set('display_errors',1);
// error_reporting(E_ALL);

include("../lib/php-jwt-master/src/JWT.php");

use \Firebase\JWT\JWT;

class Auth{

	public function __construct(){
		$this->db_connect = new Main_db;
		$this->db_core = $this->db_connect->Core_db();
		$this->db_connect->Connect_db();
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
				$session_id = $this->GenerateSession();
				$encypt_session = password_hash($session_id, PASSWORD_BCRYPT, array('cost'=>12));

				$arr = array(
					"id"=> $member_id,
					"session_id"=> $encypt_session
				);
				$key = array("id");
				$save_session_id = $this->db_connect->Update_db($arr, $key, "tbl_member");

				if($save_session_id){
					$data = array(
						'member_id' => $member_id,
						'member_username' => $member_username,
						'member_firstname' => $member_firstname,
						'member_lastname' => $member_lastname,
						'signin_time' => date("Y-m-d H:i:s"),
						'session_id' => $session_id
					);
					//$jwt_auth->JWT_Create($data);

					session_start();
					$_SESSION['getUsername'] = $member_username;
					$_SESSION['getId'] = $member_id;
					$_SESSION['session_id'] = $session_id;

					$response = array(
						'status' => 200,
						'data' => $data
					);
				}else{
					$response = array(
						'status' => 400,
						'err_msg' => 'Cannot create session'
					);
				}
				
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

	function GenerateSession(){
		$length = 30;    
		$ran = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'),1,$length);
		return $ran;
	}
}

class JWT_Auth{

	public function JWT_Create($data){
		$key = "example_key";

		$data['exp'] = 1460046010;
		$payload = $data;

		$jwt = JWT::encode($payload, $key);
		//$decoded = JWT::decode($jwt, $key, array('HS256'));

		//print_r($jwt);

		// JWT::$leeway = 60; // $leeway in seconds
		// $decoded = JWT::decode($jwt, $key, array('HS256'));
	}
}
?>