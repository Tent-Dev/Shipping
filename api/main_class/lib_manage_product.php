<?php
// ini_set('display_errors',1);
// error_reporting(E_ALL);

class MNG_Product{

	public function __construct(){
		$this->db_connect = new Main_db;
		$this->db_connect->Connect_db();
	}

	public function GetProduct($param = null){

		$sql =
		"
		SELECT tbl_product.tracking_code,
		tbl_product.status,
		CONCAT(tbl_customer.firstname ,' ', tbl_customer.lastname) as sender_name,
		tbl_product.create_date,
		tbl_transaction.receiver_desc 
		FROM tbl_product
		JOIN tbl_transaction
		ON tbl_product.id = tbl_transaction.product_id
		JOIN tbl_customer
		ON tbl_customer.id = tbl_transaction.customer_id
		";

		$sql_where = "";

		if(isset($param['status'])){
			$sql_where .= ($sql_where != "") ? " AND " : " WHERE ";
			$sql_where .= " tbl_product.status = '".$param['status']."' ";
		}

		if(isset($param['tracking_code'])){
			$sql_where .= ($sql_where != "") ? " AND " : " WHERE ";
			$sql_where .= " tbl_product.tracking_code = '".$param['tracking_code']."' ";
		}

		$sql = $sql . $sql_where;


		$data = $this->db_connect->Select_db($sql);

		if($data){
			$response = array(
				'status' => 200,
				'data' => $data
			);
		}else{
			$response = array(
				'status' => 404,
				'err_msg' => 'Product not found'
			);
		}

		return $response;
	}

	public function CreateProduct($param = null){
		$arr_customer = array( 
			"firstname" => $param['firstname'],
			"lastname" => $param['lastname'],
			"address" => $param['address'],
		);

		$result_customer = $this->db_connect->Insert_db($arr_customer,"tbl_customer");

		if($result_customer){
			$tracking_code = $this->GenerateTrackingCode();
			$arr_customer = array( 
				"shipping_type" => $param['shipping_type'],
				"weight" => $param['weight'],
				"price" => $param['price'],
				"tracking_code" => $tracking_code,
				"status" => 'waiting'
			);

			$result_product = $this->db_connect->Insert_db($arr_customer,"tbl_product");

			if($result_product){

				$trans_id = $this->GenerateTransactionId();

				$arr_customer = array( 
					"transaction_id" => $trans_id,
					"customer_id" => $param['weight'],
					"product_id" => $param['price'],
					"receiver_desc" => $param['receiver_desc'],
				);

				$result_transaction = $this->db_connect->Insert_db($arr_customer,"tbl_transaction");
				
				if($result_transaction){
					$response = array(
						'status' => 200,
						'data' => $data
					);
				}else{
					$response = array(
						'status' => 500,
						'err_msg' => 'Cannot create transaction'
					);
				}
			}else{
				$response = array(
					'status' => 500,
					'err_msg' => 'Cannot create product'
				);
			}
		}else{
			$response = array(
				'status' => 500,
				'err_msg' => 'Cannot create customer'
			);
		}

		return $response;
	}

	public function GenerateTransactionId(){
		$trans_id = getdate();
		$trans_id = $trans_id[0];
		return $trans_id;
	}

	public function GenerateTrackingCode(){
		$tracking_code = getdate();
		$tracking_code = "SH".$tracking_code[0];
		return $tracking_code;
	}
}

?>