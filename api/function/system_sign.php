<?php
// ini_set('display_errors',1);
// error_reporting(E_ALL);

include("../main_class/connect_db.php");
include("../main_class/auth.php");
include("../main_class/validate.php");

$mysql = new Main_db;
$auth = new Auth;
$validate = new Validate;

$mysql->Connect_db();
$mysql->SetCharacter();
$cmd = isset($_POST["command"]) ? $_POST["command"] : "";

if ($cmd != "") {

	//login
	if ($cmd == "login") {
		$result = $auth->AuthLogin($_POST);
		echo json_encode($result);
		$mysql->Close_db();
		exit();
	}

	//logout
	if ($cmd == "logout") {
		session_start();
		session_unset(); 
		session_destroy();
		echo json_encode($response = array('status' => 200 ));
		exit();
	}

}
?>