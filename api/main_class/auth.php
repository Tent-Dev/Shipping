<?php

require "connect_db.php";
$mysql = new Main_db;
$mysql->Connect_db();
$mysql->SetCharacter();

class Auth{
	//login with Prepared statement
	public function AuthLogin($username){
		$sql = "SELECT member_id, member_username, member_password FROM tbl_member
			 	WHERE member_username = ?";
		$protect = mysqli_prepare($this->db_connection,$sql);
		mysqli_stmt_bind_param($protect, "s", $username);

		if(mysqli_stmt_execute($protect)){
			mysqli_stmt_bind_result($protect,$user_id, $user_username,$user_password);
			$result = mysqli_stmt_fetch($protect);
			$arr = array(
					'member_username' => $user_username,
					'member_id' => $user_id,
					'member_password' =>$user_password
			 		);
		}
		else{
		echo mysqli_stmt_error;
		}
		return $arr;
	}
}
?>