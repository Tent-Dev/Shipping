<?php
// ini_set('display_errors',1);
// error_reporting(E_ALL);

include("../main_class/connect_db.php");
include("../main_class/auth.php");
include("../main_class/lib_manage_sender.php");

$mysql = new Main_db;
$auth = new Auth;
$mng_sender = new MNG_Sender;

$mysql->Connect_db();
$mysql->SetCharacter();
$cmd = isset($_POST["command"]) ? $_POST["command"] : "";

if ($cmd != "") {

	if ($cmd == "get_sender") {
		$permission = $auth->AuthPermission();
		if($permission['permission']){
			$result = $mng_sender->GetSender($_POST);
		}else{
			$result = array('status' => 500, 'err_msg' => $permission['msg']);
		}
		echo json_encode($result);
		$mysql->Close_db();
		exit();
	}

	if ($cmd == "update_sender") {
		$permission = $auth->AuthPermission();
		if($permission['permission']){
			$result = $mng_sender->UpdateSender($_POST);
		}else{
			$result = array('status' => 500, 'err_msg' => $permission['msg']);
		}
		echo json_encode($result);
		$mysql->Close_db();
		exit();
	}
}
?>