<?php
// ini_set('display_errors',1);
// error_reporting(E_ALL);

class MNG_Transaction{

	public function __construct(){
		$this->db_connect = new Main_db;
		$this->db_connect->Connect_db();
	}

	public function GetTransaction($param = null){
		$sql = "
		SELECT tbl_transaction.transaction_id,
		tbl_transaction.receiver_desc,
		tbl_transaction.sender_desc ,
		tbl_customer.firstname,
		tbl_customer.lastname,
		tbl_product.shipping_type,
		tbl_product.tracking_code,
		tbl_product.create_date,
		tbl_product.weight,
		tbl_product.price 
		FROM tbl_transaction
		JOIN tbl_customer
		ON tbl_customer.id = tbl_transaction.customer_id
		JOIN tbl_product
		ON tbl_product.id = tbl_transaction.product_id
		WHERE tbl_transaction.transaction_id = '".$param['transaction_id']."'";

		$data = $this->db_connect->Select_db($sql);

		if($data){
			$items = array();
			foreach ($data as $value) {
				$get_item = array(
					'receiver_desc' =>  json_decode($value['receiver_desc']),
					'sender_desc' => json_decode($value['sender_desc']),
					'shipping_type' => $value['shipping_type'],
					'tracking_code' => $value['tracking_code'],
					'weight' => round($value['weight'], 2),
					'price' => round($value['price'], 2),
				);
				$items['items'][] = $get_item;
				$items['transaction_id'] = $value['transaction_id'];
				$items['create_date'] = $value['create_date'];
				$items['firstname'] = $value['firstname'];
				$items['lastname'] = $value['lastname'];
			}

			$response = array(
				'status' => 200,
				'data' => $items
			);
		}else{
			$response = array(
				'status' => 404,
				'err_msg' => 'Transaction not found'
			);
		}
		return $response;
	}

	public function UpdateTransaction($param = null){
		$arr = array();
		$receiver_arr = array();
		$sender_arr = array();

		$arr['product_id'] = $param['product_id'];

		if(!empty($param['customer_id'])){
			$arr['customer_id'] = $param['customer_id'];
		}

		if(!empty($param['receiver_desc'])){
			$receiver_arr['firstname'] = $param['receiver_desc']['firstname'];
			$receiver_arr['lastname'] = $param['receiver_desc']['lastname'];
			$receiver_arr['address'] = $param['receiver_desc']['address'];
			$receiver_arr['district'] = $param['receiver_desc']['district'];
			$receiver_arr['area'] = $param['receiver_desc']['area'];
			$receiver_arr['province'] = $param['receiver_desc']['province'];
			$receiver_arr['postal'] = $param['receiver_desc']['postal'];
			$receiver_arr['phone_number'] = $param['receiver_desc']['phone_number'];
			
			$arr['receiver_desc'] = json_encode($receiver_arr, JSON_UNESCAPED_UNICODE);
		}

		if(!empty($param['sender_desc'])){
			$sender_arr['firstname'] = $param['sender_desc']['firstname'];
			$sender_arr['lastname'] = $param['sender_desc']['lastname'];
			$sender_arr['address'] = $param['sender_desc']['address'];
			$sender_arr['district'] = $param['sender_desc']['district'];
			$sender_arr['area'] = $param['sender_desc']['area'];
			$sender_arr['province'] = $param['sender_desc']['province'];
			$sender_arr['postal'] = $param['sender_desc']['postal'];
			$sender_arr['phone_number'] = $param['sender_desc']['phone_number'];

			$arr['sender_desc'] = json_encode($sender_arr, JSON_UNESCAPED_UNICODE);
		}

		$key = array("product_id");
		$result = $this->db_connect->Update_db($arr, $key, "tbl_transaction");
		if($result){
			$response = array(
				'status' => 200
			);
		}else{
			$response = array(
				'status' => 500,
				'err_msg' => 'Can not update transaction'
			);
		}
		return $response;
	}

}

?>