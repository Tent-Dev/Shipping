<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
include("../main_class/connect_db.php");
include("../main_class/auth.php");
$mysql = new Main_db;
$auth = new Auth;
$mysql->Connect_db(); //เชื่อมต่อdb
$mysql->SetCharacter();
$cmd = isset($_POST["command"]) ? $_POST["command"] : "";

if ($cmd != "") {

	//Signup
	if ($cmd == "signup") {
		$firstName = $_POST['Fname'];
		$lastName = $_POST['Lname'];
		$username = $_POST['user'];
		$password = $_POST['pass'];
		$confirm_password = $_POST['Conpass'];
		$oldpassword =  $_POST['oldpassword'];
		$has_same_username = $mysql->Check_same('tbl_member','member_username',$username);
		if(!$has_same_username){
			$arr = array( 
				"member_username"=> $username,
				"member_password"=> password_hash($password, PASSWORD_BCRYPT, array('cost'=>12)),
				"member_firstname"=> $firstName,
				"member_lastname"=> $lastName
				);
			$mysql->Insert_db($arr,"tbl_member"); //Check echo >>>> arr,ชื่อtable(พว่งหับ $tableName ใน Class_db.php)
			$check = array('check' => 1);
			
		}else{
			$check = array('check' => 0);
		}
		echo json_encode($check);
		exit();
		$mysql->Close_db();
	}
	//login
	if ($cmd == "login") {
		$username = $_POST['user'];
		$password = $_POST['pass'];
		$result = $auth->AuthLogin($username);

		if(password_verify($password,$result['member_password'])){
			session_start();
		    $_SESSION['getUsername'] = $result['member_username'];
			$_SESSION['getId'] = $result['member_id'];
			$_SESSION['getPassword'] = $result['member_password'];
			$check = 1;
		}
		else{
			$check = 0;
		}
		echo json_encode($check_login = array('check' => $check ));
		$mysql->Close_db();
	}

	//logout
	if ($cmd == "logout") {
		session_start() ;
		session_destroy();
	}

}
?>