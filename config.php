<?php


//DB接続に必要な情報
define('DSN','mysql:host=localhost;dbname=nowall_login;charset=utf8');
define('USER','testuser');
define('PASSWARD','9999');

//エラーレベルの設定
error_reporting(E_ALL & ~E_NOTICE);