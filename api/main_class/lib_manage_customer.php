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

		if($data){
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
		else{
			$response = array(
				'status' => 404,
				'err_msg' => 'Customer not found'
			);
		}
		return $response;
	}
}

?>