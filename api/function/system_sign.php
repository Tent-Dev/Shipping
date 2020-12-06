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

	//Signup
	if ($cmd == "signup") {
		$firstName = $_POST['firstname'];
		$lastName = $_POST['lastname'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$confirm_password = $_POST['confirm_password'];
		$username_duplicate = $validate->Check_same('tbl_member','username',$username);
		if($username_duplicate['status'] == 200){
			$arr = array( 
				"username"=> $username,
				"password"=> password_hash($password, PASSWORD_BCRYPT, array('cost'=>12)),
				"firstname"=> $firstName,
				"lastname"=> $lastName
			);
			$mysql->Insert_db($arr,"tbl_member");
			$response = $username_duplicate;
			
		}else{
			$response = $username_duplicate;
		}
		echo json_encode($response);
		$mysql->Close_db();
		exit();
	}

	//login
	if ($cmd == "login") {
		$username = $_POST['username'];
		$password = $_POST['password'];
		$result = $auth->AuthLogin($username, $password);
		echo json_encode($result);
		$mysql->Close_db();
		exit();
	}

	//logout
	if ($cmd == "logout") {
		session_start();
		session_destroy();
	}

}
?>