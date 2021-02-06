<?php
// ini_set('display_errors',1);
// error_reporting(E_ALL);

include("../main_class/connect_db.php");
include("../main_class/auth.php");
include("../main_class/lib_export_summary.php");

$mysql = new Main_db;
$auth = new Auth;
$mng_print_summary = new MNG_ExportSummary;

$mysql->Connect_db();
$mysql->SetCharacter();
$cmd = isset($_POST["command"]) ? $_POST["command"] : "";

if ($cmd != "") {

	if ($cmd == "export_summary") {
		$permission = $auth->AuthPermission();
		if($permission['permission']){
			$result = $mng_print_summary->ExportSummary($_POST);
		}else{
			$result = array('status' => 500, 'err_msg' => $permission['msg'], 'err_code' => $permission['err_code']);
		}
		echo json_encode($result);
		$mysql->Close_db();
		exit();
	}
}
?>