<?php
// ini_set('display_errors',1);
// error_reporting(E_ALL);

class MNG_Sender{

	public function __construct(){
		$this->db_connect = new Main_db;
		$this->db_connect->Connect_db();
	}

	public function GetSender($param = null){
		$sql = "
		SELECT phone_number, firstname, lastname, address , id
		FROM tbl_sender
		WHERE phone_number = '".$param['phone_number']."'";

		$data = $this->db_connect->Select_db($sql);

		if($data){
			$items = array();
			foreach ($data as $value ) {
				$get_item = array(
					'id' => $value['id'],
					'firstname' =>  $value['firstname'],
					'lastname' => $value['lastname'],
					'phone_number' => $value['phone_number'],
					'address' => json_decode($value['address'])
				);
				$items['items'][] = $get_item;
			}

			$response = array(
				'status' => 200,
				'data' => $items
			);
		}
		else{
			$response = array(
				'status' => 404,
				'err_msg' => 'Sender not found'
			);
		}
		return $response;
	}

	public function UpdateSender($param = null){

		if(!empty($param['firstname']) && !empty($param['lastname']) && !empty($param['address']) && !empty($param['district']) && !empty($param['phone_number']) && !empty($param['area']) && !empty($param['province']) && !empty($param['postal'])){
			$create_new_sender = true;
			//$get_customer_id = '';

			$arr = array();
			$sender_arr = array();

			$sender_arr['address'] = $param['address'];
			$sender_arr['district'] = $param['district'];
			$sender_arr['area'] = $param['area'];
			$sender_arr['province'] = $param['province'];
			$sender_arr['postal'] = $param['postal'];
			$sender_arr['phone_number'] = $param['phone_number'];

			$arr['firstname'] = $param['firstname'];
			$arr['lastname'] = $param['lastname'];
			$arr['phone_number'] = $param['phone_number'];
			$arr['address'] = json_encode($sender_arr, JSON_UNESCAPED_UNICODE);

			$check_sender_data = $this->GetSender($arr);

			if($check_sender_data['status'] == 200){
				foreach ($check_sender_data['data']['items'] as $value) {
					if($value['firstname'] == $arr['firstname'] && $value['lastname'] == $arr['lastname'] && $value['phone_number'] == $arr['phone_number']){
						
						$sender_address = json_decode(json_encode($value['address']), true);;
						
						if($sender_address['address'] == $param['address'] && $sender_address['district'] == $param['district'] && $sender_address['area'] == $param['area'] && $sender_address['province'] == $param['province'] && $sender_address['postal'] == $param['postal'] && $sender_address['phone_number'] == $param['phone_number']){
							$create_new_sender = false;
							//$get_customer_id = $value['id'];
							break;
						}
					}
				}

				if($create_new_sender){
					$result_create_sender = $this->db_connect->Insert_db($arr,"tbl_sender");

					if($result_create_sender){
						$response = array(
							'status' => 200,
							//'last_id' => $result_create_sender['last_id']
						);
					}else{
						$response = array(
							'status' => 500,
							'err_msg' => 'Cannot create sender'
						);
					}
				}else{
					$response = array(
						'status' => 200,
						//'last_id' => $get_customer_id,
						'err_msg' => 'Sender information had dupicated'
					);
				}

			}
			else if($check_sender_data['status'] == 404){
				$result_create_sender = $this->db_connect->Insert_db($arr,"tbl_sender");

				if($result_create_sender){
					$response = array(
						'status' => 200,
						//'last_id' => $result_create_customer['last_id']
					);
				}else{
					$response = array(
						'status' => 500,
						'err_msg' => 'Cannot create sender'
					);
				}
			}
			else{

				$response = array(
					'status' => 500,
					'err_msg' => 'Cannot get sender'
				);
			}
		}else{
			$response = array(
				'status' => 500,
				'err_msg' => 'Please fill all sender information'
			);
		}
		return $response;
	}
}

?>