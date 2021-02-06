<?php
// ini_set('display_errors',1);
// error_reporting(E_ALL);

include("../main_class/connect_db.php");
include("../main_class/auth.php");
include("../main_class/lib_manage_receiver.php");

$mysql = new Main_db;
$auth = new Auth;
$mng_receiver = new MNG_Receiver;

$mysql->Connect_db();
$mysql->SetCharacter();
$cmd = isset($_POST["command"]) ? $_POST["command"] : "";

if ($cmd != "") {

	if ($cmd == "get_receiver") {
		$permission = $auth->AuthPermission();
		if($permission['permission']){
			$result = $mng_receiver->GetReceiver($_POST);
		}else{
			$result = array('status' => 500, 'err_msg' => $permission['msg'], 'err_code' => $permission['err_code']);
		}
		echo json_encode($result);
		$mysql->Close_db();
		exit();
	}

	if ($cmd == "update_receiver") {
		$permission = $auth->AuthPermission();
		if($permission['permission']){
			$result = $mng_receiver->UpdateReceiver($_POST);
		}else{
			$result = array('status' => 500, 'err_msg' => $permission['msg'], 'err_code' => $permission['err_code']);
		}
		echo json_encode($result);
		$mysql->Close_db();
		exit();
	}
}
?>