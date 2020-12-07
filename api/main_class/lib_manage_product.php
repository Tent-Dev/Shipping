<?php
// ini_set('display_errors',1);
// error_reporting(E_ALL);

class MNG_Product{

	public function __construct(){
		$this->db_connect = new Main_db;
		$this->db_connect->Connect_db();
	}

	public function GetProduct($status = null){

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

		if(isset($status)){
			$sql .= " WHERE tbl_product.status = ".$status." ";
		}

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
}

?>