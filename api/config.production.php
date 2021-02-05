<?php

//Database connect============

define("DB_HOST",'localhost');
define("DB_USERNAME",'id16031240_shippingdev');
define("DB_PASSWORD",'N@iShippingProd1');
define("DB_NAME",'id16031240_shipping_db');

define("AUTH_CHECK_SESSION", false);
date_default_timezone_set('Asia/Bangkok');
//SESSION Config==============

define("SESSION_EXPIRE_MINUTE",30);

//URL Config==============

define("BASE_URL", (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/');

?>