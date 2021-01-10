<?php
// ini_set('display_errors',1);
// error_reporting(E_ALL);

class MNG_Receiver{

	public function __construct(){
		$this->db_connect = new Main_db;
		$this->db_connect->Connect_db();
	}

	public function GetReceiver($param = null){
		$sql = "
		SELECT phone_number, firstname, lastname, address, id
		FROM tbl_receiver
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
				'err_msg' => 'Receiver not found'
			);
		}
		return $response;
	}

	public function UpdateReceiver($param = null){

		if(!empty($param['firstname']) && !empty($param['lastname']) && !empty($param['address']) && !empty($param['district']) && !empty($param['phone_number']) && !empty($param['area']) && !empty($param['province']) && !empty($param['postal'])){
			$create_new_receiver = true;
			//$get_customer_id = '';

			$arr = array();
			$receiver_arr = array();

			$receiver_arr['address'] = $param['address'];
			$receiver_arr['district'] = $param['district'];
			$receiver_arr['area'] = $param['area'];
			$receiver_arr['province'] = $param['province'];
			$receiver_arr['postal'] = $param['postal'];
			$receiver_arr['phone_number'] = $param['phone_number'];

			$arr['firstname'] = $param['firstname'];
			$arr['lastname'] = $param['lastname'];
			$arr['phone_number'] = $param['phone_number'];
			$arr['address'] = json_encode($receiver_arr, JSON_UNESCAPED_UNICODE);

			$check_receiver_data = $this->GetReceiver($arr);

			if($check_receiver_data['status'] == 200){
				foreach ($check_receiver_data['data']['items'] as $value) {
					if($value['firstname'] == $arr['firstname'] && $value['lastname'] == $arr['lastname'] && $value['phone_number'] == $arr['phone_number']){
						
						$receiver_address = json_decode(json_encode($value['address']), true);;
						
						if($receiver_address['address'] == $param['address'] && $receiver_address['district'] == $param['district'] && $receiver_address['area'] == $param['area'] && $receiver_address['province'] == $param['province'] && $receiver_address['postal'] == $param['postal'] && $receiver_address['phone_number'] == $param['phone_number']){
							$create_new_receiver = false;
							//$get_customer_id = $value['id'];
							break;
						}
					}
				}

				if($create_new_receiver){
					$result_create_receiver = $this->db_connect->Insert_db($arr,"tbl_recevier");

					if($result_create_receiver){
						$response = array(
							'status' => 200,
							//'last_id' => $result_create_receiver['last_id']
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
						//'last_id' => $get_customer_id,
						'err_msg' => 'Customer information had dupicated'
					);
				}

			}
			else if($check_receiver_data['status'] == 404){
				$result_create_receiver = $this->db_connect->Insert_db($arr,"tbl_receiver");

				if($result_create_receiver){
					$response = array(
						'status' => 200,
						//'last_id' => $result_create_customer['last_id']
					);
				}else{
					$response = array(
						'status' => 500,
						'err_msg' => 'Cannot create receiver'
					);
				}
			}
			else{

				$response = array(
					'status' => 500,
					'err_msg' => 'Cannot get receiver'
				);
			}
		}else{
			$response = array(
				'status' => 500,
				'err_msg' => 'Please fill all receiver information'
			);
		}
		return $response;
	}
}

?>