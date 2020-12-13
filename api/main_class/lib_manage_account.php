<?php
// ini_set('display_errors',1);
// error_reporting(E_ALL);

class MNG_Account{

	public function __construct(){
		$this->db_connect = new Main_db;
		$this->db_connect->Connect_db();
	}

	public function CreateAccount($param = null){
		include("validate.php");

		$validate = new Validate;
		$firstName = $param['firstname'];
		$lastName = $param['lastname'];
		$username = $param['username'];
		$password = $param['password'];
		$confirm_password = $param['confirm_password'];
		$username_duplicate = $validate->Check_same('tbl_member','username',$username);
		if(empty($firstName) || empty($lastName) || empty($username) || empty($password) || empty($confirm_password)){
			$response = array(
				'status' => 999,
				'err_msg' => 'Cannot create account. Plase fill all data.'
			);
			return $response;
			exit();
		}
		if($password == $confirm_password){
			if($username_duplicate['status'] == 200){
				$arr = array( 
					"username"=> $username,
					"password"=> password_hash($password, PASSWORD_BCRYPT, array('cost'=>12)),
					"firstname"=> $firstName,
					"lastname"=> $lastName
				);
				$result = $this->db_connect->Insert_db($arr,"tbl_member");
				if($result){
					$response = array(
						'status' => 200
					);
				}else{
					$response = array(
						'status' => 500,
						'err_msg' => 'Cannot create account'
					);
				}
			}else{
				$response = $username_duplicate;
			}
		}else{
			$response = array(
				'status' => 999,
				'err_msg' => 'Can not create account. Password and Confirm password not match.'
			);
		}
		
		return $response;
	}

	public function UpdateAccount($param = null){

		$arr = array();

		if(isset($param['member_id']) && $param['member_id'] !== ''){
			$arr['id'] = $param['member_id'];
		}

		if(isset($param['firstname']) && $param['firstname'] !== '' ){
			$arr['firstname'] = $param['firstname'];
		}

		if(isset($param['lastname']) && $param['lastname'] !== ''){
			$arr['lastname'] = $param['lastname'];
		}

		if(isset($param['member_type']) && $param['member_type'] !== ''){
			$arr['member_type'] = $param['member_type'];
		}

		if(isset($param['password']) && $param['password'] !== ''){
			if(isset($param['confirm_password']) && $param['confirm_password'] !== '' && (($param['password'] == $param['confirm_password']))){
				$arr['password'] = password_hash($param['password'], PASSWORD_BCRYPT, array('cost'=>12));
			}else{
				$response = array(
					'status' => 999,
					'err_msg' => 'Can not update account. Password and Confirm password not match.'
				);
				return $response;
				exit();
			}
		}

		$key = array("id");
		$result = $this->db_connect->Update_db($arr, $key, "tbl_member");

		if($result){
			$response = array(
				'status' => 200
			);
		}else{
			$response = array(
				'status' => 500,
				'err_msg' => 'Can not update account'
			);
		}
		return $response;
	}
}

?>