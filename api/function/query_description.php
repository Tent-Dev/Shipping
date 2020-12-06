<?php
// ini_set('display_errors',1);
// error_reporting(E_ALL);

include("../main_class/connect_db.php");
include("../main_class/auth.php");
include("../main_class/tracking.php");

$mysql = new Main_db;
$auth = new Auth;
$tracking = new Tracking;

$mysql->Connect_db();
$mysql->SetCharacter();
$cmd = isset($_POST["command"]) ? $_POST["command"] : "";

if ($cmd != "") {

	if ($cmd == "tracking") {
		$permission = $auth->AuthPermission();
		if($permission['permission']){
			$result = $tracking->TrackingCode($_POST["tracking_code"]);
		}else{
			$result = array('status' => 500, 'err_msg' => $permission['msg']);
		}
		echo json_encode($result);
		$mysql->Close_db();
		exit();
	}

}
?>