<?php
// ini_set('display_errors',1);
// error_reporting(E_ALL);

include("../main_class/connect_db.php");
include("../main_class/auth.php");
include("../main_class/lib_manage_product.php");
include("../main_class/tools.php");

$mysql = new Main_db;
$auth = new Auth;
$tools = new Tools;
$mng_product = new MNG_Product;

$mysql->Connect_db();
$mysql->SetCharacter();
$cmd = isset($_POST["command"]) ? $_POST["command"] : "";

if ($cmd != "") {

	if ($cmd == "get_product") {
		$permission = $auth->AuthPermission();
		if($permission['permission']){
			$result = $mng_product->GetProduct($_POST);
		}else{
			$result = array('status' => 500, 'err_msg' => $permission['msg'], 'err_code' => $permission['err_code']);
		}
		echo json_encode($result);
		$mysql->Close_db();
		exit();
	}

	if ($cmd == "get_product_desc") {
		$permission = $auth->AuthPermission();
		if($permission['permission']){
			$result = $mng_product->GetProductDescription($_POST);
		}else{
			$result = array('status' => 500, 'err_msg' => $permission['msg'], 'err_code' => $permission['err_code']);
		}
		echo json_encode($result);
		$mysql->Close_db();
		exit();
	}

	if ($cmd == "create_product") {
		$permission = $auth->AuthPermission();
		if($permission['permission']){
			$result = $mng_product->CreateProduct($_POST);
		}else{
			$result = array('status' => 500, 'err_msg' => $permission['msg'], 'err_code' => $permission['err_code']);
		}
		echo json_encode($result);
		$mysql->Close_db();
		exit();
	}

	if ($cmd == "create_order") {
		$permission = $auth->AuthPermission();
		if($permission['permission']){
			$result = $mng_product->CreateMapTransaction($_POST);
		}else{
			$result = array('status' => 500, 'err_msg' => $permission['msg'], 'err_code' => $permission['err_code']);
		}
		echo json_encode($result);
		$mysql->Close_db();
		exit();
	}

	if ($cmd == "update_product") {
		$permission = $auth->AuthPermission();
		if($permission['permission']){
			$result = $mng_product->UpdateProduct($_POST);
		}else{
			$result = array('status' => 500, 'err_msg' => $permission['msg'], 'err_code' => $permission['err_code']);
		}
		echo json_encode($result);
		$mysql->Close_db();
		exit();
	}

	if ($cmd == "delete_product") {
		$permission = $auth->AuthPermission();
		if($permission['permission']){
			$result = $mng_product->DeleteProduct($_POST);
		}else{
			$result = array('status' => 500, 'err_msg' => $permission['msg'], 'err_code' => $permission['err_code']);
		}
		echo json_encode($result);
		$mysql->Close_db();
		exit();
	}

	if ($cmd == "delete_product_from_db") {
		$permission = $auth->AuthPermission();
		if($permission['permission']){
			$result = $mng_product->DeleteProductFromDb($_POST);
		}else{
			$result = array('status' => 500, 'err_msg' => $permission['msg'], 'err_code' => $permission['err_code']);
		}
		echo json_encode($result);
		$mysql->Close_db();
		exit();
	}

	if ($cmd == "get_product_dashboard") {
		$permission = $auth->AuthPermission();
		if($permission['permission']){
			$result = $mng_product->GetProductDashboard($_POST);
		}else{
			$result = array('status' => 500, 'err_msg' => $permission['msg'], 'err_code' => $permission['err_code']);
		}
		echo json_encode($result);
		$mysql->Close_db();
		exit();
	}

}
?>