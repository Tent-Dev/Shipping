<?php
// ini_set('display_errors',1);
// error_reporting(E_ALL);

include("../main_class/connect_db.php");
include("../main_class/auth.php");
include("../main_class/tools.php");
include("../main_class/lib_manage_account.php");

$mysql = new Main_db;
$auth = new Auth;
$mng_account = new MNG_Account;

$mysql->Connect_db();
$mysql->SetCharacter();
$cmd = isset($_POST["command"]) ? $_POST["command"] : "";

if ($cmd != "") {

	if ($cmd == "update_account") {
		$permission = $auth->AuthPermission();
		if($permission['permission']){
			$result = $mng_account->UpdateAccount($_POST);
		}else{
			$result = array('status' => 500, 'err_msg' => $permission['msg']);
		}
		echo json_encode($result);
		$mysql->Close_db();
		exit();
	}

	if ($cmd == "create_account") {
		$permission = $auth->AuthPermission();
		if($permission['permission']){
			$result = $mng_account->CreateAccount($_POST);
		}else{
			$result = array('status' => 500, 'err_msg' => $permission['msg']);
		}
		echo json_encode($result);
		$mysql->Close_db();
		exit();
	}

	if ($cmd == "get_account") {
		$permission = $auth->AuthPermission();
		if($permission['permission']){
			$result = $mng_account->GetAccount($_POST);
		}else{
			$result = array('status' => 500, 'err_msg' => $permission['msg']);
		}
		echo json_encode($result);
		$mysql->Close_db();
		exit();
	}

	if ($cmd == "get_account_desc") {
		$permission = $auth->AuthPermission();
		if($permission['permission']){
			$result = $mng_account->GetAccountDescription($_POST);
		}else{
			$result = array('status' => 500, 'err_msg' => $permission['msg']);
		}
		echo json_encode($result);
		$mysql->Close_db();
		exit();
	}

}
?>