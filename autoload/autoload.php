<?php
session_start();

$loadHelper = [
	'Auth',
	'Database',
	'Function',
	'Input',
	'Redirect',
	'Session',
];

$posUrl =  strpos("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]", 'admin');

// if ($posUrl != null) {
// 	require_once("./vendor/autoload.php");
// } 

require_once('./config/Config.php');
foreach ($loadHelper as $item) {
	require_once("./helpers/$item.php");
}

$DB = new Database();
