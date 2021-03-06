<?php
// ini_set('display_errors',1);
// error_reporting(E_ALL);

class MNG_Transaction{

	public function __construct(){
		$this->db_connect = new Main_db;
		$this->tools = new Tools;
		$this->db_connect->Connect_db();
	}

	public function GetTransactionById($param = null){
		$sql = "SELECT transaction_id FROM tbl_transaction WHERE id = '".$param['id']."'";
		$data = $this->db_connect->Select_db_one($sql);

		if($data){
			$get_trans = $this->GetTransactionDescription($data);

			if($get_trans['status'] == 200){
				$response = array(
					'status' => 200,
					'data' => $get_trans['data']
				);
			}else{
				$response = array(
					'status' => 404,
					'err_msg' => 'Can not find Transaction'
				);
			}
		}
		else{
			$response = array(
				'status' => 404,
				'err_msg' => 'Can not find Transaction'
			);
		}

		return $response;
	}

	public function GetTransaction($param = null){

		$per_page = 10;
		$page = 1;
		if(isset($param['page']) && $param['page'] != ''){
			$page = $param['page'];
		}
		
		$start_page = $this->tools->PaginationSetpage($per_page,$page);
		$sql = "

		SELECT tbl_transaction.transaction_id,
		tbl_transaction.receiver_desc,
		tbl_transaction.sender_desc ,
		tbl_transaction.employee_id,
		tbl_customer.firstname,
		tbl_customer.lastname,
		tbl_product.shipping_type,
		tbl_product.tracking_code,
		tbl_product.create_date,
		tbl_product.weight,
		tbl_product.price,
		tbl_member.firstname as employee_fname,
		tbl_member.lastname as employee_lname 
		FROM tbl_transaction
		JOIN tbl_customer
		ON tbl_customer.id = tbl_transaction.customer_id
		JOIN tbl_product
		ON tbl_product.id = tbl_transaction.product_id
		LEFT JOIN tbl_member
		ON tbl_transaction.employee_id = tbl_member.id";

		$sql_limit = " ORDER BY tbl_transaction.id DESC ";
		if($mode == ''){
			$sql_limit .= " LIMIT ".$start_page." , ".$per_page."";
		}
		
		$sql_where = " WHERE tbl_transaction.active_status = 'T'";

		if(isset($param['transaction_id'])){
			$sql_where .= ($sql_where != "") ? " AND " : " WHERE ";
			$sql_where .= " tbl_transaction.transaction_id = '".$param['transaction_id']."' ";
		}
		
		if(isset($param['startdate']) && $param['startdate'] != "" && isset($param['enddate']) && $param['enddate'] != ""){
			$sql_where .= ($sql_where != "") ? " AND " : " WHERE ";
			if($param['startdate'] === $param['enddate']) {
				$sql_where .= " tbl_transaction.create_date LIKE '".$param['startdate']."%' ";
			}
			else {
				$sql_where .= " tbl_transaction.create_date BETWEEN '".$param['startdate']."' AND '".$param['enddate']."' ";
			}
		}

		if(isset($param['keyword']) && $param['keyword'] != ""){
			$sql_where .= ($sql_where != "") ? " AND " : " WHERE ";
			$sql_where .= " CONCAT(tbl_transaction.transaction_id, tbl_customer.firstname, tbl_customer.lastname) LIKE '%".$param['keyword']."%' ";
		}

		if(isset($param['group']) && $param['group'] != "") {
			$sql_where .= " GROUP BY tbl_transaction.transaction_id ";
		}

		$sql_query = $sql . $sql_where. $sql_limit;
		$sql_count = $sql . $sql_where;

		$data = $this->db_connect->Select_db($sql_query);

		$rowcount = $this->db_connect->numRows($sql_count);
		$total_pages = ceil($rowcount / $per_page);

		if($data){
			$data_final = array();
			$items = array();
			foreach ($data as $value) {
				$get_item = array(
					'receiver_desc' =>  json_decode($value['receiver_desc']),
					'sender_desc' => json_decode($value['sender_desc']),
					'shipping_type' => $value['shipping_type'],
					'tracking_code' => $value['tracking_code'],
					'weight' => round($value['weight'], 2),
					'price' => round($value['price'], 2),
					'transaction_id' => $value['transaction_id'],
					'create_date' => $value['create_date'],
					'customer_firstname' => $value['firstname'],
					'customer_lastname' => $value['lastname'],
					'employee_id' => $value['employee_id'],
					'employee_fname' => $value['employee_fname'],
					'employee_lname' => $value['employee_lname']
				);
				$items[] = $get_item;

			}
			$data_final['total_pages'] = $total_pages;
			$data_final['data'] = $items;
			$response = array(
				'status' => 200,
				'data' => $data_final
			);
			
		}else{
			$response = array(
				'status' => 404,
				'err_msg' => 'Transaction not found'
			);
		}
		return $response;
	}

	public function GetTransactionDashboard($param = null){
		
		$sql ="
		SELECT Distinct tbl_transaction.transaction_id, tbl_map_transaction.total_price 
		FROM tbl_transaction 
		JOIN tbl_map_transaction 
		ON tbl_transaction.transaction_id = tbl_map_transaction.transaction_id ";

		$sql_where = " WHERE tbl_transaction.active_status = 'T'";

		if(isset($param['startdate']) && $param['startdate'] != "" && isset($param['enddate']) && $param['enddate'] != ""){
			$sql_where .= ($sql_where != "") ? " AND " : " WHERE ";
			if($param['startdate'] === $param['enddate']) {
				$sql_where .= " tbl_transaction.create_date LIKE '".$param['startdate']."%' ";
			}
			else {
				$sql_where .= " tbl_transaction.create_date BETWEEN '".$param['startdate']."' AND '".$param['enddate']."' ";
			}
		}

		$sql_count = $sql . $sql_where;

		$data = $this->db_connect->Select_db($sql_count);

		if($data){
			$data_final = array();
			$items = array();
			foreach ($data as $value) {
				$get_item = array(
					'transaction_id' => $value['transaction_id'],
					'price' => $value['total_price']
				);
				$items[] = $get_item;
			}
			
			$data_final['data'] = $items;
			$response = array(
				'status' => 200,
				'data' => $data_final
			);
		}else{
			$response = array(
				'status' => 404,
				'err_msg' => 'Transaction not found'
			);
		}

		return $response;
	}

	public function GetTransactionDescription($param = null){

		$sql = "
		SELECT tbl_transaction.transaction_id,
		tbl_transaction.receiver_desc,
		tbl_transaction.employee_id,
		tbl_transaction.create_date as trans_create_date,
		tbl_transaction.sender_desc ,
		tbl_customer.firstname,
		tbl_customer.lastname,
		tbl_product.shipping_type,
		tbl_product.tracking_code,
		tbl_product.create_date,
		tbl_product.weight,
		tbl_product.price ,
		tbl_member.firstname as employee_fname,
		tbl_member.lastname as employee_lname,
		tbl_map_transaction.total_price,
		tbl_map_transaction.get_price,
		tbl_map_transaction.change_price 
		FROM tbl_transaction
		JOIN tbl_customer
		ON tbl_customer.id = tbl_transaction.customer_id
		JOIN tbl_product
		ON tbl_product.id = tbl_transaction.product_id
		JOIN tbl_map_transaction
		ON tbl_map_transaction.transaction_id = tbl_transaction.transaction_id
		LEFT JOIN tbl_member
		ON tbl_transaction.employee_id = tbl_member.id";


		$sql_where = " WHERE tbl_product.active_status = 'T' ";

		if(isset($param['transaction_id'])){
			$sql_where .= ($sql_where != "") ? " AND " : " WHERE ";
			$sql_where .= " tbl_transaction.transaction_id = '".$param['transaction_id']."' ";
		}


		$sql_query = $sql . $sql_where;

		$data = $this->db_connect->Select_db($sql_query);


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
					'transaction_id' => $value['transaction_id'],
					'create_date' => $value['create_date'],
					'customer_firstname' => $value['firstname']
				);
				$items['data'][] = $get_item;

			}

			$items['transaction_id'] = $value['transaction_id'];
			$items['transaction_create_date'] = $value['trans_create_date'];
			$items['employee_id'] = $value['employee_id'];
			$items['employee_fname'] = $value['employee_fname'];
			$items['employee_lname'] = $value['employee_lname'];
			$items['total_price'] =  $value['total_price'];
			$items['get_price'] = $value['get_price'];
			$items['change_price'] = $value['change_price'];
			
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

	public function GetTransactionHistory($param = null){
		$per_page = 10;
		$page = 1;
		if(isset($param['page']) && $param['page'] != ''){
			$page = $param['page'];
		}
		if(isset($param['mode']) && $param['mode'] != ''){
			$mode = $param['mode'];
		}else{
			$mode = '';
		}
		$start_page = $this->tools->PaginationSetpage($per_page,$page);

		$sql = "
		SELECT tbl_transaction.transaction_id,
		tbl_transaction.receiver_desc,
		tbl_transaction.sender_desc ,
		tbl_customer.firstname,
		tbl_customer.lastname,
		tbl_product.id,
		tbl_product.shipping_type,
		tbl_product.tracking_code,
		tbl_product.create_date,
		tbl_product.weight,
		tbl_product.active_status,
		tbl_product.price 
		FROM tbl_transaction
		JOIN tbl_customer
		ON tbl_customer.id = tbl_transaction.customer_id
		JOIN tbl_product
		ON tbl_product.id = tbl_transaction.product_id";

		$sql_limit = " ORDER BY tbl_transaction.id DESC ";
		if($mode == ''){
			$sql_limit .= " LIMIT ".$start_page." , ".$per_page."";
		}
		$sql_where = "";

		if(isset($param['transaction_id'])){
			$sql_where .= ($sql_where != "") ? " AND " : " WHERE ";
			$sql_where .= " tbl_transaction.transaction_id = '".$param['transaction_id']."' ";
		}

		if(isset($param['keyword'])) {
			$sql_where .= ($sql_where != "") ? " AND " : " WHERE ";
			$sql_where .= " CONCAT(tbl_product.tracking_code, tbl_customer.firstname, tbl_customer.lastname) LIKE '%".$param['keyword']."%' ";
		}

		if(isset($param['active_status'])) {
			$sql_where .= ($sql_where != "") ? " AND " : " WHERE ";
			$sql_where .= " tbl_product.active_status = 'T' ";
		}
		
		$sql_query = $sql . $sql_where. $sql_limit;
		$sql_count = $sql . $sql_where;

		$data = $this->db_connect->Select_db($sql_query);

		$rowcount = $this->db_connect->numRows($sql_count);
		$total_pages = ceil($rowcount / $per_page);

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
					'transaction_id' => $value['transaction_id'],
					'id' => $value['id'],
					'create_date' => $value['create_date'],
					'customer_firstname' => $value['firstname'],
					'customer_lastname' => $value['lastname'],
					'active_status' => $value['active_status']
				);
				$items['data'][] = $get_item;

			}

			$items['total_pages'] = $total_pages;
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