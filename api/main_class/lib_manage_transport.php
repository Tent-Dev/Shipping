<?php
// ini_set('display_errors',1);
// error_reporting(E_ALL);

class MNG_Transport{

	public function __construct(){
		$this->db_connect = new Main_db;
		$this->db_connect->Connect_db();
	}

	public function GetTransport($param = null){
		$sql = "
		SELECT tbl_transaction.transaction_id,
		tbl_transport.id,
		tbl_transport.status,
		tbl_transport.timestamp,
		tbl_transaction.receiver_desc,
		tbl_transaction.sender_desc ,
		tbl_product.shipping_type,
		tbl_product.tracking_code,
		tbl_product.create_date,
		tbl_product.weight,
		tbl_product.price 
		FROM tbl_transport
		JOIN tbl_transaction
		ON tbl_transport.id = tbl_transaction.id
		JOIN tbl_product
		ON tbl_product.id = tbl_transaction.product_id
		WHERE tbl_transport.trans_id = '".$param['transport_id']."'";

		$data = $this->db_connect->Select_db($sql);

		if($data){
			$items = array();
			foreach ($data as $value ) {
				$get_item = array(
					'status' =>  $value['status'],
					'tracking_code' => $value['tracking_code'],
					'shipping_type' => $value['shipping_type'],
					'timestamp' => $value['timestamp']
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
				'err_msg' => 'Transport not found'
			);
		}
		return $response;
	}

	public function CreateTransport($param = null){
		$arr_transport = array();

		if(isset($param['trans_id']) && $param['trans_id'] !== ''){
			$arr_transport['trans_id'] = $param['trans_id'];
		}
		if(isset($param['status']) && $param['status'] !== ''){
			$arr_transport['status'] = $param['status'];
		}

		$result_transport = $this->db_connect->Insert_db($arr_transport,"tbl_transport");

		if($result_transport['status']){
			$response = array(
				'status' => 200
			);
		}else{
			$response = array(
				'status' => 500,
				'err_msg' => 'Cannot create transport'
			);
		}

		return $response;
	}
}

?>