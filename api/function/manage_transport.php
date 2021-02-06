<?php
// ini_set('display_errors',1);
// error_reporting(E_ALL);

include("../main_class/connect_db.php");
include("../main_class/auth.php");
include("../main_class/lib_manage_transport.php");

$mysql = new Main_db;
$auth = new Auth;
$mng_transport = new MNG_Transport;

$mysql->Connect_db();
$mysql->SetCharacter();
$cmd = isset($_POST["command"]) ? $_POST["command"] : "";

if ($cmd != "") {

	if ($cmd == "get_transport") {
		$permission = $auth->AuthPermission();
		if($permission['permission']){
			$result = $mng_transport->GetTransport($_POST);
		}else{
			$result = array('status' => 500, 'err_msg' => $permission['msg'], 'err_code' => $permission['err_code']);
		}
		echo json_encode($result);
		$mysql->Close_db();
		exit();
	}
	else if ($cmd == "create_transport") {
		$permission = $auth->AuthPermission();
		if($permission['permission']){
			$result = $mng_transport->CreateTransport($_POST);
		}else{
			$result = array('status' => 500, 'err_msg' => $permission['msg'], 'err_code' => $permission['err_code']);
		}
		echo json_encode($result);
		$mysql->Close_db();
		exit();
	}

}
?>