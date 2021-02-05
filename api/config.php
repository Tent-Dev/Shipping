<?php

//Database connect============

define("DB_HOST",'localhost');
define("DB_USERNAME",'root');
define("DB_PASSWORD",'mysql');
define("DB_NAME",'shipping_db');

define("AUTH_CHECK_SESSION", false);
date_default_timezone_set('Asia/Bangkok');
//SESSION Config==============

define("SESSION_EXPIRE_MINUTE",30);

//URL Config==============

define("BASE_URL", (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/');
?>