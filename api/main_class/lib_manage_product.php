<?php
// ini_set('display_errors',1);
// error_reporting(E_ALL);

class MNG_Product{

	public function __construct(){
		$this->db_connect = new Main_db;
		$this->tools = new Tools;
		$this->db_connect->Connect_db();
	}

	public function GetProduct($param = null){
		$per_page = 10;
		$page = 1;
		if(isset($param['page']) && $param['page'] != ''){
			$page = $param['page'];
		}
		$start_page = $this->tools->PaginationSetpage($per_page,$page);
		
		$sql =
		"
		SELECT tbl_product.tracking_code,
		tbl_product.id,
		tbl_product.status,
		tbl_product.create_date,
		tbl_product.weight,
		tbl_product.price,
		tbl_product.payment_type,
		tbl_transaction.transaction_id,
		tbl_transaction.receiver_desc,
		tbl_transaction.sender_desc,
		CONCAT(tbl_member.firstname,' ', tbl_member.lastname) as shipper_name,
		CONCAT(tbl_receiver.firstname,' ', tbl_receiver.lastname) as receiver_name
		FROM tbl_product
		JOIN tbl_transaction
		ON tbl_product.id = tbl_transaction.product_id
		LEFT JOIN tbl_member
		ON tbl_product.shipper_id = tbl_member.id
		LEFT JOIN tbl_receiver
		ON tbl_transaction.customer_id = tbl_receiver.id
		";

		$sql_limit = " ORDER BY tbl_product.id DESC LIMIT ".$start_page." , ".$per_page."";

		$sql_where = "";

		if(isset($param['status']) && $param['status'] != ""){
			$sql_where .= ($sql_where != "") ? " AND " : " WHERE ";
			$sql_where .= " tbl_product.status = '".$param['status']."' ";
		}

		if(isset($param['tracking_code'])){
			$sql_where .= ($sql_where != "") ? " AND " : " WHERE ";
			$sql_where .= " tbl_product.tracking_code = '".$param['tracking_code']."' ";
		}

		if(isset($param['product_id'])){
			$sql_where .= ($sql_where != "") ? " AND " : " WHERE ";
			$sql_where .= " tbl_product.id = '".$param['product_id']."' ";
		}

		if(isset($param['startdate']) && $param['startdate'] != "" && isset($param['enddate']) && $param['enddate'] != ""){
			$sql_where .= ($sql_where != "") ? " AND " : " WHERE ";
			if($param['startdate'] === $param['enddate']) {
				$sql_where .= " tbl_product.create_date LIKE '".$param['startdate']."%' ";
			}
			else {
				$sql_where .= " tbl_product.create_date BETWEEN '".$param['startdate']."' AND '".$param['enddate']."' ";
			}
		}

		if(isset($param['keyword']) && $param['keyword'] != ""){
			$sql_where .= ($sql_where != "") ? " AND " : " WHERE ";
			$sql_where .= " CONCAT(tbl_product.tracking_code, tbl_receiver.firstname, tbl_receiver.lastname) LIKE '%".$param['keyword']."%' ";
		}

		if(isset($param['shipper']) && $param['shipper'] != ""){
			$sql_where .= ($sql_where != "") ? " AND " : " WHERE ";
			$sql_where .= " tbl_product.shipper_id = '".$param['shipper']."' ";
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
					'id' =>  $value['id'],
					'transaction_id' =>$value['transaction_id'],
					'tracking_code' => $value['tracking_code'],
					'status' => $value['status'],
					'create_date' => $value['create_date'],
					'receiver_desc' => json_decode($value['receiver_desc']),
					'sender_desc' => json_decode($value['sender_desc']),
					'weight' => round($value['weight'], 2),
					'price' => round($value['price'], 2),
					'payment_type' => $value['payment_type'],
					'shipper_name' => $value['shipper_name'],
					'receiver_name' => $value['receiver_name']
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
				'err_msg' => 'Product not found'
			);
		}

		return $response;
	}

	public function GetProductDescription($param = null){
		$sql =
		"
		SELECT tbl_product.tracking_code,
		tbl_product.id,
		tbl_product.status,
		tbl_product.create_date,
		tbl_product.weight,
		tbl_product.price,
		tbl_product.shipper_id,
		tbl_product.payment_type,
		tbl_transaction.transaction_id,
		tbl_transaction.receiver_desc,
		tbl_transaction.sender_desc,
		tbl_customer.firstname,
		tbl_customer.lastname,
		tbl_customer.id_card,
		tbl_customer.phone_number as customer_phone_number,
		CONCAT(tbl_member.firstname,' ', tbl_member.lastname) as shipper_name
		FROM tbl_product
		JOIN tbl_transaction
		ON tbl_product.id = tbl_transaction.product_id 
		JOIN tbl_customer
		ON tbl_transaction.customer_id = tbl_customer.id
		LEFT JOIN tbl_member
		ON tbl_product.shipper_id = tbl_member.id
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

		if(isset($param['product_id'])){
			$sql_where .= ($sql_where != "") ? " AND " : " WHERE ";
			$sql_where .= " tbl_product.id = '".$param['product_id']."' ";
		}

		$sql_query = $sql . $sql_where;

		$data = $this->db_connect->Select_db_one($sql_query);

		if($data){
			$customer_desc = array(
				'firstname' => $data['firstname'],
				'lastname' => $data['lastname'],
				'id_card' => $data['id_card'],
				'customer_phone_number' => $data['customer_phone_number']
			);

			$get_item = array(
				'id' =>  $data['id'],
				'transaction_id' =>$data['transaction_id'],
				'tracking_code' => $data['tracking_code'],
				'status' => $data['status'],
				'create_date' => $data['create_date'],
				'customer_desc' => $customer_desc,
				'receiver_desc' => json_decode($data['receiver_desc']),
				'sender_desc' => json_decode($data['sender_desc']),
				'weight' => round($data['weight'], 2),
				'price' => round($data['price'], 2),
				'payment_type' => $data['payment_type'],
				'shipper_name' => $data['shipper_name'],
				'shipper_id' => $data['shipper_id']
			);
			$response = array(
				'status' => 200,
				'data' => $get_item
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
		$receiver_save_phone = '';
		$sender_save_phone = '';
		$dumpmy_data = '{"firstname":"ชื่อคนทำรายการ","lastname":"นามสกุลคนทำรายการ","id_card":"1102002841486","customer_phone_number":"0819584848","item":[{"weight":1.5,"price":30,"shipping_type":"normal","payment_type":"normal","receiver_desc":{"firstname":"ชื่อคนรับ1","lastname":"นามสกุลคนรับ1","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786666"},"sender_desc":{"firstname":"ชื่อคนส่ง1","lastname":"นามสกุลคนส่ง1","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786666"}},{"weight":1.5,"price":30,"shipping_type":"normal","payment_type":"normal","receiver_desc":{"firstname":"ชื่อคนรับ2","lastname":"นามสกุลคนรับ2","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786666"},"sender_desc":{"firstname":"ชื่อคนส่ง2","lastname":"นามสกุลคนส่ง2","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786666"}}]}';

		$json_en = json_decode($param['create_data'], true);

		$ran_transac1 = substr(str_shuffle('0123456789'),1,2);
		$ran_transac2 = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,2);

		$arr_customer = array( 
			"firstname" => $json_en['firstname'],
			"lastname" => $json_en['lastname'],
			"id_card" => $json_en['id_card'],
			"phone_number" => $json_en['customer_phone_number']
		);
		$sql = 
		"SELECT * FROM tbl_customer WHERE phone_number = '".$json_en['customer_phone_number']."'";

		$check_phone = $this->db_connect->Select_db_one($sql);

		if($check_phone){
			$result_customer = array('status' => true, 'last_id' => $check_phone['id'] );
		}else{
			$result_customer = $this->db_connect->Insert_db($arr_customer,"tbl_customer");
		}

		if($result_customer['status']){
			foreach ($json_en['item'] as $value) {

				$get_last_customer_id = "";
				$get_last_product_id = "";

				$get_last_customer_id = $result_customer['last_id'];
				$tracking_code = $this->GenerateTrackingCode();
				$arr_customer = array( 
					"shipping_type" => $value['shipping_type'],
					"payment_type" => $value['payment_type'],
					"weight" => $value['weight'],
					"price" => $value['price'],
					"tracking_code" => $tracking_code,
					"status" => 'waiting'
				);

				$result_product = $this->db_connect->Insert_db($arr_customer,"tbl_product");

				if($result_product['status']){
					$get_last_product_id = $result_product['last_id'];
					$trans_id = strtotime("now").$ran_transac1.$ran_transac2;

					$arr_customer = array( 
						"transaction_id" => $trans_id,
						"employee_id" => $_SESSION['ID'],
						"customer_id" => $get_last_customer_id,
						"product_id" => $get_last_product_id,
						"sender_desc" =>  json_encode($value['sender_desc'], JSON_UNESCAPED_UNICODE),
						"receiver_desc" => json_encode($value['receiver_desc'], JSON_UNESCAPED_UNICODE)
					);

					$result_transaction = $this->db_connect->Insert_db($arr_customer,"tbl_transaction");

					if($result_transaction['status']){

						if($receiver_save_phone !== $value['receiver_desc']['phone_number']){
							$check_receiver_same = $this->CheckReceiverSame($value['receiver_desc']['phone_number'], $value['receiver_desc']);
							if(!$check_receiver_same){
								$arr_receiver = array( 
									"phone_number" => $value['receiver_desc']['phone_number'],
									"firstname" => $value['receiver_desc']['firstname'],
									"lastname" => $value['receiver_desc']['lastname'],
									"address" =>  json_encode($value['receiver_desc'], JSON_UNESCAPED_UNICODE),
								);

								$result_receiver = $this->db_connect->Insert_db($arr_receiver,"tbl_receiver");
							}
							$receiver_save_phone = $value['receiver_desc']['phone_number'];
						}

						if($sender_save_phone !== $value['sender_desc']['phone_number']){
							$check_sender_same = $this->CheckSenderSame($value['sender_desc']['phone_number'], $value['sender_desc']);
							if(!$check_sender_same){
								$arr_sender = array( 
									"phone_number" => $value['sender_desc']['phone_number'],
									"firstname" => $value['sender_desc']['firstname'],
									"lastname" => $value['sender_desc']['lastname'],
									"address" =>  json_encode($value['sender_desc'], JSON_UNESCAPED_UNICODE),
								);

								$result_sender = $this->db_connect->Insert_db($arr_sender,"tbl_sender");
							}
							$sender_save_phone = $value['sender_desc']['phone_number'];
						}
						
						$arr_customer = array( 
							"product_id" => $get_last_product_id,
							"status" => 'waiting',
						);

						$result_transport = $this->db_connect->Insert_db($arr_customer,"tbl_transport");

						if($result_transport['status']){
							$response = array(
								'status' => 200,
								'last_id' => $result_transaction['last_id']
							);
						}else{
							$response = array(
								'status' => 500,
								'err_msg' => 'Cannot create transport'
							);
						}
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
			}
		}else{
			$response = array(
				'status' => 500,
				'err_msg' => 'Cannot create customer'
			);
		}

		return $response;
	}

	public function UpdateProduct($param = null){
		$arr = array();
		$update_trans_arr = array();
		$receiver_arr = array();
		$sender_arr = array();
		$customer_arr = array();
		$update_receiver = false;
		$update_sender = false;
		$update_customer = false;
		$warn_msg = '';
		$warn_cus_msg = '';
		if(isset($param['product_id']) && $param['product_id'] !== ''){
			$arr['id'] = $param['product_id'];
			$update_trans_arr['product_id'] = $param['product_id'];
		}

		if(isset($param['shipper_id']) && $param['shipper_id'] !== ''){
			$arr['shipper_id'] = $param['shipper_id'];
		}

		if(isset($param['status']) && $param['status'] !== ''){
			$arr['status'] = $param['status'];
		}

		if(isset($param['price']) && $param['price'] !== ''){
			$arr['price'] = $param['price'];
		}

		if(isset($param['weight']) && $param['weight'] !== ''){
			$arr['weight'] = $param['weight'];
		}

		if(isset($param['payment_type']) && $param['payment_type'] !== ''){
			$arr['payment_type'] = $param['payment_type'];
		}

		if(!empty($param['customer_idcard']) && !empty($param['customer_firstname']) && !empty($param['customer_lastname']) && !empty($param['customer_phone_number'])){
			$customer_arr['firstname'] = $param['customer_firstname'];
			$customer_arr['lastname'] = $param['customer_lastname'];
			$customer_arr['id_card'] = $param['customer_idcard'];
			$customer_arr['phone_number'] = $param['customer_phone_number'];
			$update_customer = true;
			$update_customer_result = $this->UpdateCustomer($customer_arr);

			if($update_customer_result['status'] !== 200){
				$warn_cus_msg = ' Customer not update ('.$update_customer_result['err_msg'].')';
			}else{
				$update_trans_arr['customer_id'] = $update_customer_result['last_id'];
			}
		}

		if(!empty($param['receiver_firstname']) && !empty($param['receiver_lastname']) && !empty($param['receiver_address']) && !empty($param['receiver_district']) && !empty($param['receiver_phone_number']) && !empty($param['receiver_area']) && !empty($param['receiver_province']) && !empty($param['receiver_postal'])){
			
			$receiver_arr['firstname'] = $param['receiver_firstname'];
			$receiver_arr['lastname'] = $param['receiver_lastname'];
			$receiver_arr['address'] = $param['receiver_address'];
			$receiver_arr['district'] = $param['receiver_district'];
			$receiver_arr['area'] = $param['receiver_area'];
			$receiver_arr['province'] = $param['receiver_province'];
			$receiver_arr['postal'] = $param['receiver_postal'];
			$receiver_arr['phone_number'] = $param['receiver_phone_number'];

			$update_trans_arr['receiver_desc'] = $receiver_arr;
			$update_receiver = true;

			$update_receiver_result = $this->UpdateReceiver($receiver_arr);
			if($update_receiver_result['status'] !== 200){
				$warn_cus_msg .= ' Receiver not update ('.$update_receiver_result['err_msg'].')';
			}
			// else{
			// 	$update_trans_arr['customer_id'] = $update_customer_result['last_id'];
			// }
		}else{
			$update_trans_result['status'] = 'not_update';
		}

		if(!empty($param['sender_firstname']) && !empty($param['sender_lastname']) && !empty($param['sender_address']) && !empty($param['sender_district']) && !empty($param['sender_phone_number']) && !empty($param['sender_area']) && !empty($param['sender_province']) && !empty($param['sender_postal'])){
			
			$sender_arr['firstname'] = $param['sender_firstname'];
			$sender_arr['lastname'] = $param['sender_lastname'];
			$sender_arr['address'] = $param['sender_address'];
			$sender_arr['district'] = $param['sender_district'];
			$sender_arr['area'] = $param['sender_area'];
			$sender_arr['province'] = $param['sender_province'];
			$sender_arr['postal'] = $param['sender_postal'];
			$sender_arr['phone_number'] = $param['sender_phone_number'];

			$update_trans_arr['sender_desc'] = $sender_arr;
			$update_sender = true;

			$update_sender_result = $this->UpdateSender($sender_arr);
			if($update_sender_result['status'] !== 200){
				$warn_cus_msg .= ' Sender not update ('.$update_sender_result['err_msg'].')';
			}
			// else{
			// 	$update_trans_arr['customer_id'] = $update_customer_result['last_id'];
			// }
		}else{
			$update_trans_result['status'] = 'not_update';
		}

		if($update_receiver || $update_sender || $update_customer){
			$update_trans_result = $this->UpdateTransDesc($update_trans_arr);
		}else{
			$warn_msg = 'receiver and sender not update. If you want to update, plase fill all receiver or sender data.';
		}
		
		if($update_trans_result['status'] == 200 || $update_trans_result['status'] == 'not_update'){
			$key = array("id");
			$result = $this->db_connect->Update_db($arr, $key, "tbl_product");

			if($result){
				$response = array(
					'status' => 200,
					'warn_msg' => $warn_msg.$warn_cus_msg
				);
			}else{
				$response = array(
					'status' => 500,
					'err_msg' => 'Can not update product'
				);
			}
		}else{
			$response = array(
				'status' => 500,
				'err_msg' => 'receiver and sender not update'
			);
		}
		return $response;
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

	private function CheckReceiverSame($phone_number = null, $address = null){
		require_once("lib_manage_receiver.php");
		$mng_receiver = new MNG_Receiver();
		$result_check_receiver_same = false;

		if($phone_number !== null && $phone_number !== ''){
			$arr_send = array('phone_number' => $phone_number);
			$get_receiver = $mng_receiver->GetReceiver($arr_send);

			if($get_receiver['status'] == 200){
				foreach ($get_receiver['data']['items'] as $value) {
					$address_database = json_encode((array)$value['address']);
					$address_input = json_encode($address);

					if($address_database == $address_input){
						$result_check_receiver_same = true;
						break;
					}
				}
			}
		}else{
			$result_check_receiver_same = true;
		}
		return $result_check_receiver_same;
	}

	private function CheckSenderSame($phone_number = null, $address = null){
		require_once("lib_manage_sender.php");
		$mng_sender = new MNG_Sender();
		$result_check_sender_same = false;

		if($phone_number !== null && $phone_number !== ''){
			$arr_send = array('phone_number' => $phone_number);
			$get_sender = $mng_sender->GetSender($arr_send);

			if($get_sender['status'] == 200){
				foreach ($get_sender['data']['items'] as $value) {
					$address_database = json_encode((array)$value['address']);
					$address_input = json_encode($address);

					if($address_database == $address_input){
						$result_check_sender_same = true;
						break;
					}
				}
			}
		}else{
			$result_check_sender_same = true;
		}
		return $result_check_sender_same;
	}

	private function UpdateTransDesc($params = null){
		require_once('lib_manage_transaction.php');
		$mng_transaction = new MNG_Transaction();
		$result = $mng_transaction->UpdateTransaction($params);
		return $result;
	}

	private function UpdateCustomer($params = null){
		require_once('lib_manage_customer.php');
		$mng_customer = new MNG_Customer();
		$result = $mng_customer->UpdateCustomer($params);
		return $result;
	}

	private function UpdateReceiver($params = null){
		require_once('lib_manage_receiver.php');
		$mng_receiver = new MNG_Receiver();
		$result = $mng_receiver->UpdateReceiver($params);
		return $result;
	}

	private function UpdateSender($params = null){
		require_once('lib_manage_sender.php');
		$mng_sender = new MNG_Sender();
		$result = $mng_sender->UpdateSender($params);
		return $result;
	}
}

?>