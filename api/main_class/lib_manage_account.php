<?php
// ini_set('display_errors',1);
// error_reporting(E_ALL);

class MNG_Account{

	public function __construct(){
		$this->db_connect = new Main_db;
		$this->tools = new Tools;
		$this->db_core = $this->db_connect->Core_db();
		$this->db_connect->Connect_db();
	}

	public function CreateAccount($param = null){
		include("validate.php");

		$validate = new Validate;
		$firstName = $param['firstname'];
		$lastName = $param['lastname'];
		$username = $param['username'];
		$password = $param['password'];
		$member_type = $param['member_type'];
		$confirm_password = $param['confirm_password'];
		$username_duplicate = $validate->Check_same('tbl_member','username',$username);
		if(empty($firstName) || empty($lastName) || empty($username) || empty($password) || empty($confirm_password) || empty($member_type)){
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
					"lastname"=> $lastName,
					"member_type" => $member_type
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

	public function GetAccount($param = null){
		$per_page = 10;
		$page = 1;
		if(isset($param['page']) && $param['page'] != ''){
			$page = $param['page'];
		}
		$start_page = $this->tools->PaginationSetpage($per_page,$page);

		$sql = "SELECT id, firstname, lastname, member_type, username FROM tbl_member";
		$sql_limit = " ORDER BY id DESC LIMIT ".$start_page." , ".$per_page."";

		$sql_where = "";

		if(isset($param['member_type'])){
			$sql_where .= ($sql_where != "") ? " AND " : " WHERE ";
			$sql_where .= " tbl_product.status = '".$param['member_type']."' ";
		}

		if(isset($param['firstname'])){
			$sql_where .= ($sql_where != "") ? " AND " : " WHERE ";
			$sql_where .= " firstname = '".$param['firstname']."' ";
		}

		if(isset($param['username'])){
			$sql_where .= ($sql_where != "") ? " AND " : " WHERE ";
			$sql_where .= " username = '".$param['username']."' ";
		}

		$sql_query = $sql . $sql_where. $sql_limit;
		$sql_count = $sql . $sql_where;

		$data = $this->db_connect->Select_db($sql_query);

		$rowcount = $this->db_connect->numRows($sql_count);
		$total_pages = ceil($rowcount / $per_page);

		if($data){

			$data_final['total_pages'] = $total_pages;
			$data_final['data'] = $data;

			$response = array(
				'status' => 200,
				'data' => $data_final
			);
		}else{
			$response = array(
				'status' => 404,
				'err_msg' => 'Account not found'
			);
		}
		return $response;
	}

	public function GetAccountDescription($param = null){

		$sql = "SELECT id, firstname, lastname, member_type, username FROM tbl_member";

		$sql_where = "";

		if(isset($param['account_id'])){
			$sql_where .= ($sql_where != "") ? " AND " : " WHERE ";
			$sql_where .= " id = '".$param['account_id']."' ";
		}

		$sql_query = $sql . $sql_where;

		$data = $this->db_connect->Select_db_one($sql_query);

		if($data){
			$response = array(
				'status' => 200,
				'data' => $data
			);
		}else{
			$response = array(
				'status' => 404,
				'err_msg' => 'Account not found'
			);
		}
		return $response;
	}

	public function GetAccountForShipperList($param = null){

		$sql = "SELECT id, firstname, lastname, member_type, username FROM tbl_member";

		$sql_where = "";

		// if(isset($param['member_type'])){
		// 	$sql_where .= ($sql_where != "") ? " AND " : " WHERE ";
		// 	$sql_where .= " tbl_product.status = '".$param['member_type']."' ";
		// }

		// if(isset($param['firstname'])){
		// 	$sql_where .= ($sql_where != "") ? " AND " : " WHERE ";
		// 	$sql_where .= " firstname = '".$param['firstname']."' ";
		// }

		// if(isset($param['username'])){
		// 	$sql_where .= ($sql_where != "") ? " AND " : " WHERE ";
		// 	$sql_where .= " username = '".$param['username']."' ";
		// }

		$sql_query = $sql . $sql_where;

		$data = $this->db_connect->Select_db($sql_query);

		if($data){
			$response = array(
				'status' => 200,
				'data' => $data
			);
		}else{
			$response = array(
				'status' => 404,
				'err_msg' => 'Shipper not found'
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

		if((isset($param['old_password']) && $param['old_password'] !== '') && (isset($param['new_password']) && $param['new_password'] !== '')){
			$stmt = $this->db_core->prepare("SELECT id, password FROM tbl_member WHERE id = ?");
			$stmt->bind_param("s", $_SESSION['ID']);
			$stmt->execute();
			$stmt->bind_result($member_id, $current_password);
			$result = $stmt->fetch();
			if($result){
				if(password_verify($param['old_password'], $current_password)){
					if(isset($param['confirm_password']) && $param['confirm_password'] !== '' && (($param['new_password'] == $param['confirm_password']))){
						$arr['password'] = password_hash($param['new_password'], PASSWORD_BCRYPT, array('cost'=>12));
					}else{
						$response = array(
							'status' => 999,
							'err_msg' => 'Can not update account. Password and Confirm password not match.'
						);
						return $response;
						exit();
					}
				}else{
					$response = array(
						'status' => 1000,
						'err_msg' => 'Can not update account. Old password incorrect.'
					);
					return $response;
					exit();
				}
			}else{
				$response = array(
					'status' => 998,
					'err_msg' => 'Can not update account. Can not check current password.'
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