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
		tbl_transport.note,
		tbl_transport.timestamp,
		tbl_transaction.receiver_desc,
		tbl_transaction.sender_desc ,
		tbl_product.shipping_type,
		tbl_product.tracking_code,
		tbl_product.create_date,
		tbl_product.weight,
		tbl_product.price 
		FROM tbl_transport
		LEFT JOIN tbl_transaction
		ON tbl_transport.id = tbl_transaction.id
		LEFT JOIN tbl_product
		ON tbl_product.id = tbl_transaction.product_id
		WHERE tbl_transport.product_id = '".$param['product_id']."'";

		$data = $this->db_connect->Select_db($sql);

		if($data){
			$items = array();
			foreach ($data as $value ) {
				$get_item = array(
					'status' =>  $value['status'],
					'timestamp' => $value['timestamp'],
					'note' => $value['note']
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
		$file_name='';

		if(isset($param['product_id']) && $param['product_id'] !== ''){
			$arr_transport['product_id'] = $param['product_id'];
		}
		if(isset($param['status']) && $param['status'] !== ''){
			$arr_transport['status'] = $param['status'];
		}
		if(isset($param['note']) && $param['note'] !== ''){
			$arr_transport['note'] = $param['note'];
		}else{
			$arr_transport['note'] = null;
		}
		if(isset($param['image_signature']) && $param['image_signature'] !== ''){
			$img = str_replace('data:image/png;base64,', '', $param['image_signature']);
			$img = str_replace(' ', '+', $img);
			$data = base64_decode($img);
			$file_name = uniqid().'_product'.$param['product_id'].'.png';
			$file = '../../assets/signature/'.$file_name;
			$success = file_put_contents($file, $data);

			if(!$success){
				$response = array(
					'status' => 999,
					'err_msg' => 'Cannot save signature'
				);
				exit();
			}
		}

		$result_transport = $this->db_connect->Insert_db($arr_transport,"tbl_transport");

		if($result_transport['status']){
			$arr_update_product_status = array();
			$arr_update_product_status['id'] = $param['product_id'];
			$arr_update_product_status['status'] = $param['status'];
			if($file_name !== '' && $success){
				$arr_update_product_status['image_signature'] = $file_name;
			}
			$key = array("id");
			$result_update_product = $this->db_connect->Update_db($arr_update_product_status, $key, "tbl_product");
			if($result_update_product){
				$response = array(
					'status' => 200
				);
			}else{
				$response = array(
					'status' => 500,
					'err_msg' => 'Cannot update product status'
				);
			}
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