<?php
session_start();
include("../client_config/config.php");
include("../api/config.php");
if($_SESSION['SESSION_ID'] == ""){
    header("Location:../index.php");
    die();
}
if(isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > (SESSION_EXPIRE_MINUTE*60))){
    header("Location:../index.php");
    die();
}
?>