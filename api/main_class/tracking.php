<?php
// ini_set('display_errors',1);
// error_reporting(E_ALL);

class Tracking{

	public function __construct(){
		$this->db_connect = new Main_db;
		$this->db_connect->Connect_db();
	}

	public function TrackingCode($tracking_code){

		$sql =
		"SELECT * FROM tbl_product
		WHERE tracking_code = '".$tracking_code."'";

		$data = $this->db_connect->Select_db_one($sql);

		if($data){
			$response = array(
				'status' => 200,
				'data' => $data
			);
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