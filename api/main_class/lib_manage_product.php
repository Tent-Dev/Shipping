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
		tbl_product.create_date,
		tbl_transaction.receiver_desc ,
		tbl_transaction.sender_desc,
		CONCAT(tbl_member.firstname,' ', tbl_member.lastname) as shipper_name
		FROM tbl_product
		JOIN tbl_transaction
		ON tbl_product.id = tbl_transaction.product_id
		LEFT JOIN tbl_member
		ON tbl_product.shipper_id = tbl_member.id
		ORDER BY tbl_product.id
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

		$dumpmy_data = '{"firstname":"ชื่อคนทำรายการ","lastname":"นามสกุลคนทำรายการ","id_card":"1102002841486","item":[{"weight":1.5,"price":30,"shipping_type":"normal","receiver_desc":{"firstname":"ชื่อคนส่ง","lastname":"นามสกุลคนส่ง","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786666"},"sender_desc":{"firstname":"ชื่อคนรับ","lastname":"นามสกุลคนรับ","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786666"}},{"weight":1.5,"price":30,"shipping_type":"normal","receiver_desc":{"firstname":"ชื่อคนส่ง","lastname":"นามสกุลคนส่ง","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786666"},"sender_desc":{"firstname":"ชื่อคนรับ","lastname":"นามสกุลคนรับ","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786666"}}]}';

		$json_en = json_decode($dumpmy_data, true);

		$ran_transac1 = substr(str_shuffle('0123456789'),1,2);
		$ran_transac2 = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,2);

		$arr_customer = array( 
			"firstname" => $json_en['firstname'],
			"lastname" => $json_en['lastname'],
			"id_card" => $json_en['id_card']
		);
		$sql = 
		"SELECT * FROM tbl_customer WHERE id_card = '".$json_en['id_card']."'";

		$check_idcard = $this->db_connect->Select_db_one($sql);

		if($check_idcard){
			$result_customer = array('status' => true, 'last_id' => $check_idcard['id'] );
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
						"customer_id" => $get_last_customer_id,
						"product_id" => $get_last_product_id,
						"sender_desc" =>  json_encode($value['sender_desc'], JSON_UNESCAPED_UNICODE),
						"receiver_desc" => json_encode($value['receiver_desc'], JSON_UNESCAPED_UNICODE)
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
		$ran1 = substr(str_shuffle('0123456789'),1,2);
		$ran2 = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,2);
		$trans_id = strtotime("now").$ran1.$ran2;
		var_dump($trans_id);
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