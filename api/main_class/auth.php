<?php
// ini_set('display_errors',1);
// error_reporting(E_ALL);
ob_start();
include("../lib/php-jwt-master/src/JWT.php");

use \Firebase\JWT\JWT;

class Auth{

	public function __construct(){
		$this->db_connect = new Main_db;
		$this->db_core = $this->db_connect->Core_db();
		$this->db_connect->Connect_db();
	}

	public function AuthPermission(){
		session_start();
		if(isset($_SESSION['SESSION_ID']) && isset($_SESSION['ID'])){
			$stmt = $this->db_core->prepare("SELECT session_id FROM tbl_member WHERE id = ?");
			$stmt->bind_param("s", $_SESSION['ID']);
			$stmt->execute();
			$stmt->bind_result($session_id);
			$result = $stmt->fetch();
			if($result){
				if(password_verify($_SESSION['SESSION_ID'], $session_id) || !AUTH_CHECK_SESSION){
					if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > (SESSION_EXPIRE_MINUTE*60))) {
						session_unset(); 
						session_destroy();
						$response = array(
							'permission' => false,
							'msg' => 'Session expired',
						);
					}else if(isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] <= (SESSION_EXPIRE_MINUTE*60))){
						$_SESSION['LAST_ACTIVITY'] = time();
						$response = array(
							'permission' => true,
							'msg' => 'Session enable',
						);
					}
					else{
						$response = array(
							'permission' => false,
							'msg' => 'Cannot find your last session activity',
						);
					}
				}else{
					$response = array(
						'permission' => false,
						'msg' => 'Session invalid',
					);
				}
			}else{
				$response = array(
					'permission' => false,
					'msg' => 'Cannot find your account',
				);
			}
		}
		else{
			$response = array(
				'permission' => false,
				'msg' => 'Cannot find your session',
			);
		}
		return $response;
	}

	public function AuthLogin($param = null){
		$jwt_auth = new JWT_Auth();
		$stmt = $this->db_core->prepare("SELECT id, firstname, lastname, username, password, member_type FROM tbl_member WHERE username = ?");
		$stmt->bind_param("s", $param['username']);
		$stmt->execute();
		$stmt->bind_result($member_id, $member_firstname, $member_lastname, $member_username,$member_password, $member_type);
		$result = $stmt->fetch();
		if($result){
			if(password_verify($param['password'], $member_password)){
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
						'member_type' => $member_type,
						'signin_time' => time(),
						'session_id' => $session_id
					);
					//$jwt_auth->JWT_Create($data);

					session_start();
					$_SESSION['USERNAME'] = $member_username;
					$_SESSION['ID'] = $member_id;
					$_SESSION['TYPE'] = $member_type;
					$_SESSION['SESSION_ID'] = $session_id;
					$_SESSION['LAST_ACTIVITY'] = time();

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