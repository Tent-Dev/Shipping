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

}

?>