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
		$get_last_customer_id = "";
		$get_last_product_id = "";
		$arr_customer = array( 
			"firstname" => $param['firstname'],
			"lastname" => $param['lastname'],
			"address" => $param['address'],
		);

		$result_customer = $this->db_connect->Insert_db($arr_customer,"tbl_customer");

		if($result_customer['status']){
			$get_last_customer_id = $result_customer['last_id'];
			$tracking_code = $this->GenerateTrackingCode();
			$arr_customer = array( 
				"shipping_type" => $param['shipping_type'],
				"weight" => $param['weight'],
				"price" => $param['price'],
				"tracking_code" => $tracking_code,
				"status" => 'waiting'
			);

			$result_product = $this->db_connect->Insert_db($arr_customer,"tbl_product");

			if($result_product['status']){
				$get_last_product_id = $result_product['last_id'];
				$trans_id = $this->GenerateTransactionId();

				$arr_customer = array( 
					"transaction_id" => $trans_id,
					"customer_id" => $get_last_customer_id,
					"product_id" => $get_last_product_id,
					"receiver_desc" => $param['receiver_desc'],
				);

				$result_transaction = $this->db_connect->Insert_db($arr_customer,"tbl_transaction");
				
				if($result_transaction['status']){
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
		$trans_id = time();
		return $trans_id;
	}

	public function GenerateTrackingCode(){

		$ran1 = substr(str_shuffle('0123456789'),1,3);
		$ran2 = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,1);
		$ran3 = substr(str_shuffle('0123456789'),1,4);
		$ran4 = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,2);
		$ran5 = substr(str_shuffle('0123456789'),1,1);
		$tracking_code = "SH".$ran1.$ran2.$ran3.$ran4.$ran5;

		return $tracking_code;
	}
}

?>