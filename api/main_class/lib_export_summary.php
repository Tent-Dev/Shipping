<?php
// ini_set('display_errors',1);
// error_reporting(E_ALL);
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class MNG_ExportSummary{

	public function __construct(){
		$this->db_connect = new Main_db;
		$this->db_connect->Connect_db();
	}

	public function ExportSummary($param = null){
		$sql =
		"
		SELECT tbl_product.tracking_code,
		tbl_product.status,
		tbl_product.create_date,
		tbl_product.weight,
		tbl_product.price,
		tbl_product.product_type,
		tbl_product.shipper_id,
		tbl_product.cod_price,
		tbl_product.active_status,
		tbl_transaction.receiver_desc,
		tbl_transaction.sender_desc,
		tbl_transaction.employee_id,
		tbl_map_transaction.total_price,
		CONCAT(tbl_member.firstname,' ', tbl_member.lastname) as employee_name
		FROM tbl_product
		JOIN tbl_transaction
		ON tbl_product.id = tbl_transaction.product_id 
		LEFT JOIN tbl_member
		ON tbl_transaction.employee_id = tbl_member.id
		JOIN tbl_map_transaction
		ON tbl_transaction.transaction_id = tbl_map_transaction.transaction_id
		";

		$sql_where = "";

		if(isset($param['status'])){
			$sql_where .= ($sql_where != "") ? " AND " : " WHERE ";
			$sql_where .= " tbl_product.status = '".$param['status']."' ";
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

		if(isset($param['company']) && $param['company'] !== ''){
			$sql_where .= ($sql_where != "") ? " AND " : " WHERE ";
			$sql_where .= " tbl_member.company_id = '".$param['company']."' ";
		}

		$sql_query = $sql . $sql_where;

		$data_result = $this->db_connect->Select_db($sql_query);

		if($data_result){
			$all_item = array();
			foreach ($data_result as $data) {
				$active_status = 'ไม่พบสถานะ';
				$status_item = 'ไม่พบสถานะ';
				$product_type = 'ไม่พบประเภทพัสดุ';
				$receiver_data = json_decode($data['receiver_desc'], true);
				$sender_data = json_decode($data['sender_desc'], true);

				if(isset($data['active_status'])){
					if($data['active_status'] == 'T'){
						$active_status = 'ปกติ';
					}else{
						$active_status = 'ถูกลบออกจากระบบ';
					}

					if($data['status'] == 'waiting'){
						$status_item = 'พัสดุถูกนำเข้าระบบแล้ว';
					}else if($data['status'] == 'sending'){
						$status_item = 'พัสดุกำลังถูกส่งไปยังผู้รับ';
					}else if($data['status'] == 'success'){
						$status_item = 'พัสดุถูกส่งถึงมือผู้รับเรียบร้อย';
					}else if($data['status'] == 'return_distribution_center'){
						$status_item = 'พัสดุถูกตีกลับ';
					}
				}
				
				if(isset($data['product_type'])){
					if($data['product_type'] == 'none'){
						$product_type = 'ไม่มี';
					}else if($data['product_type'] == 'doc'){
						$product_type = 'เอกสาร';
					}else if($data['product_type'] == 'dried_food'){
						$product_type = 'อาหารแห้ง';
					}else if($data['product_type'] == 'wares'){
						$product_type = 'ของใช้';
					}else if($data['product_type'] == 'it'){
						$product_type = 'อุปกรณ์ไอที';
					}else if($data['product_type'] == 'clothes'){
						$product_type = 'เสื้อผ้า';
					}else if($data['product_type'] == 'entertainment'){
						$product_type = 'สื่อบันเทิง';
					}else if($data['product_type'] == 'cars'){
						$product_type = 'อะไหล่รถยนต์';
					}else if($data['product_type'] == 'shoes_bags'){
						$product_type = 'รองเท้า/กระเป๋า';
					}else if($data['product_type'] == 'cosmetics'){
						$product_type = 'เครื่องสำอาง';
					}else if($data['product_type'] == 'furniture'){
						$product_type = 'เฟอร์นิเจอร์';
					}else if($data['product_type'] == 'fruits'){
						$product_type = 'ผลไม้';
					}else if($data['product_type'] == 'others'){
						$product_type = 'อื่นๆ';
					}
				}
				

				$get_item = array(
					$data['create_date'],
					$data['tracking_code'],
					$sender_data['firstname'].' '.$sender_data['lastname'],
					$sender_data['phone_number'],
					$sender_data['address'].' '.$sender_data['area'].' '.$sender_data['district'].' '.$sender_data['province'].' '.$sender_data['postal'],
					$sender_data['area'],
					$sender_data['postal'],
					$receiver_data['firstname'].' '.$receiver_data['lastname'],
					$receiver_data['phone_number'],
					$receiver_data['address'].' '.$receiver_data['area'].' '.$receiver_data['district'].' '.$receiver_data['province'].' '.$receiver_data['postal'],
					$receiver_data['area'],
					$receiver_data['postal'],
					$product_type,
					$data['weight'],
					$data['cod_price'],
					$data['price'],
					$status_item,
					$active_status,
					$data['employee_name'].' (EMID: '.$data['employee_id'].')'
				);
				$all_item[] = $get_item;
			}

			$result = $this->ProcessXlsxFile($all_item);

			if($result){
				$response = array(
					'status' => 200,
					'url' => $result
				);
			}else{
				$response = array(
					'status' => 500,
					'err_msg' => 'Can not export excel file'
				);
			}
		}else{
			$response = array(
				'status' => 404,
				'err_msg' => 'Product not found'
			);
		}

		return $response;
	}

	public function ProcessXlsxFile($data = null){
		if($data){
			require '../../vendor/autoload.php';

			$spreadsheet = new Spreadsheet();
			$sheet = $spreadsheet->getActiveSheet();

			$sheet->setCellValue('A1', 'เวลารับพัสดุ');
			$sheet->setCellValue('B1', 'เลขพัสดุ');

			$sheet->setCellValue('C1', 'ผู้ส่ง');
			$sheet->setCellValue('D1', 'เบอร์โทรศัพท์ผู้ส่ง');
			$sheet->setCellValue('E1', 'ที่อยู่ผู้ส่งโดยระเอียด');
			$sheet->setCellValue('F1', 'ชื่อเขต');
			$sheet->setCellValue('G1', 'รหัสไปรษณีย์');

			$sheet->setCellValue('H1', 'ผู้รับ');
			$sheet->setCellValue('I1', 'เบอร์โทรศัพท์ผู้รับ');
			$sheet->setCellValue('J1', 'ที่อยู่ผู้รับโดยระเอียด');
			$sheet->setCellValue('K1', 'ชื่อเขต');
			$sheet->setCellValue('L1', 'รหัสไปรษณีย์');

			$sheet->setCellValue('M1', 'ประเภทพัสดุ');
			$sheet->setCellValue('N1', 'น้ำหนัก');
			$sheet->setCellValue('O1', 'เก็บเงินปลายทาง');
			$sheet->setCellValue('P1', 'ค่าบริการรวมสุทธิ');
			$sheet->setCellValue('Q1', 'สถานะพัสดุ');
			$sheet->setCellValue('R1', 'สถานะรายการ');
			$sheet->setCellValue('S1', 'พนักงานนำเข้าระบบ');

			$sheet->fromArray($data, null, 'A2');

			$sheet->getStyle('A1:R1')->getFont()->setBold(true);

			// foreach(range('A','Q') as $columnID) {
			// 	$sheet->getColumnDimension($columnID)->setAutoSize(true);
			// }

			// header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			// header('Content-Disposition: attachment;filename="summary_export.xlsx"');
			// header('Cache-Control: max-age=0');

			$writer = new Xlsx($spreadsheet);

			$file_path = 'export/summary_export.xlsx';

			$writer->save('../../'.$file_path);

			return BASE_URL.$file_path;
		}
	}
}
?>