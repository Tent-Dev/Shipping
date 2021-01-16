<?php
// ini_set('display_errors',1);
// error_reporting(E_ALL);

include("../main_class/connect_db.php");
include("../main_class/auth.php");
include("../main_class/lib_manage_transaction.php");
include("../main_class/tools.php");

$mysql = new Main_db;
$auth = new Auth;
$tools = new Tools;
$mng_transaction = new MNG_Transaction;

$mysql->Connect_db();
$mysql->SetCharacter();
$cmd = isset($_POST["command"]) ? $_POST["command"] : "";

if ($cmd != "") {

	if ($cmd == "get_transaction") {
		$permission = $auth->AuthPermission();
		if($permission['permission']){
			$result = $mng_transaction->GetTransaction($_POST);
		}else{
			$result = array('status' => 500, 'err_msg' => $permission['msg']);
		}
		echo json_encode($result);
		$mysql->Close_db();
		exit();
	}

	if ($cmd == "get_transactionById") {
		$permission = $auth->AuthPermission();
		if($permission['permission']){
			$result = $mng_transaction->GetTransactionById($_POST);
		}else{
			$result = array('status' => 500, 'err_msg' => $permission['msg']);
		}
		echo json_encode($result);
		$mysql->Close_db();
		exit();
	}

	if ($cmd == "get_transactionDesc") {
		$permission = $auth->AuthPermission();
		if($permission['permission']){
			$result = $mng_transaction->GetTransactionDescription($_POST);
		}else{
			$result = array('status' => 500, 'err_msg' => $permission['msg']);
		}
		echo json_encode($result);
		$mysql->Close_db();
		exit();
	}

}
?>