<?php
// ini_set('display_errors',1);
// error_reporting(E_ALL);

class Tracking{

	public function __construct(){
		$this->db_connect = new Main_db;
		$this->db_connect->Connect_db();
	}

	public function TrackingCode($tracking_code){

		$sql ="
		SELECT 
		tbl_product.id,
		tbl_product.shipping_type,
		tbl_product.tracking_code,
		tbl_product.create_date,
		tbl_product.shipper_id,
		tbl_transaction.transaction_id,
		tbl_transaction.id as 'trans_id',
		tbl_product.status,
		tbl_transport.timestamp 
		FROM tbl_product
		JOIN tbl_transaction
		ON tbl_transaction.product_id = tbl_product.id
		JOIN tbl_transport
		ON tbl_transport.product_id = tbl_transaction.id
		WHERE tbl_product.tracking_code = '".$tracking_code."'";

		$data = $this->db_connect->Select_db_one($sql);

		if($data){
			if($data['trans_id']){

				$sql_transport = "
				SELECT tbl_transaction.transaction_id,
				tbl_transport.id,
				tbl_transport.status,
				tbl_transport.timestamp,
				tbl_transport.note,
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
				WHERE tbl_transport.product_id = '".$data['trans_id']."'";
				
				$data_transport = $this->db_connect->Select_db($sql_transport);

				if($data_transport){
					foreach ($data_transport as $value ) {
						$get_item = array(
							'status' =>  $value['status'],
							'timestamp' => $value['timestamp'],
							'note' => $value['note']
						);
						$data['transport_history'][] = $get_item;
					}

					$response = array(
						'status' => 200,
						'data' => $data
					);
				}
				else{
					$response = array(
						'status' => 404,
						'err_msg' => 'Transport history not found'
					);
				}
			}else{
				$response = array(
					'status' => 404,
					'err_msg' => 'Transaction id not found'
				);
			}
		}else{
			$response = array(
				'status' => 404,
				'err_msg' => 'Tracking code not found'
			);
		}

		return $response;
	}
}

?>