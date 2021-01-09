<?php
// ini_set('display_errors',1);
// error_reporting(E_ALL);

class MNG_Customer{

	public function __construct(){
		$this->db_connect = new Main_db;
		$this->db_connect->Connect_db();
	}

	public function GetCustomer($param = null){
		$sql = "
		SELECT phone_number, firstname, lastname, id_card, id
		FROM tbl_customer
		WHERE phone_number = '".$param['phone_number']."'";

		$data = $this->db_connect->Select_db($sql);

		if($data && count($data) > 0){
			$items = array();
			foreach ($data as $value ) {
				$get_item = array(
					'id' => $value['id'],
					'firstname' =>  $value['firstname'],
					'lastname' => $value['lastname'],
					'phone_number' => $value['phone_number'],
					'id_card' => $value['id_card']
				);
				$items['items'][] = $get_item;
			}

			$response = array(
				'status' => 200,
				'data' => $items
			);
		}
		else if(count($data) == 0){
			$response = array(
				'status' => 404,
				'err_msg' => 'Customer not found'
			);
		}
		else{
			$response = array(
				'status' => 500,
				'err_msg' => 'Get customer error'
			);
		}
		return $response;
	}

	public function UpdateCustomer($param = null){

		if(!empty($param['firstname']) && !empty($param['lastname']) && !empty($param['id_card']) && !empty($param['phone_number'])){
			$create_new_customer = true;
			$get_customer_id = '';
			$arr = array();
			$arr['firstname'] = $param['firstname'];
			$arr['lastname'] = $param['lastname'];
			$arr['id_card'] = $param['id_card'];
			$arr['phone_number'] = $param['phone_number'];

			$check_cus_data = $this->GetCustomer($arr);

			if($check_cus_data['status'] == 200){
				foreach ($check_cus_data['data']['items'] as $value) {
					if($value['firstname'] == $arr['firstname'] && $value['lastname'] == $arr['lastname'] && $value['id_card'] == $arr['id_card']){
						$create_new_customer = false;
						$get_customer_id = $value['id'];
						break;
					}
				}

				if($create_new_customer){
					$result_create_customer = $this->db_connect->Insert_db($arr,"tbl_customer");

					if($result_create_customer){
						$response = array(
							'status' => 200,
							'last_id' => $result_create_customer['last_id']
						);
					}else{
						$response = array(
							'status' => 500,
							'err_msg' => 'Cannot create customer'
						);
					}
				}else{
					$response = array(
						'status' => 200,
						'last_id' => $get_customer_id,
						'err_msg' => 'Customer information had dupicated'
					);
				}

			}
			else if($check_cus_data['status'] == 404){
				$result_create_customer = $this->db_connect->Insert_db($arr,"tbl_customer");

				if($result_create_customer){
					$response = array(
						'status' => 200,
						'last_id' => $result_create_customer['last_id']
					);
				}else{
					$response = array(
						'status' => 500,
						'err_msg' => 'Cannot create customer'
					);
				}
			}
			else{

				$response = array(
					'status' => 500,
					'err_msg' => 'Cannot get customer'
				);
			}
		}else{
			$response = array(
				'status' => 500,
				'err_msg' => 'Please fill all customer information'
			);
		}
		return $response;
	}
}

?>