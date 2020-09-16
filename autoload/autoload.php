<?php

$loadHelper = [
    'Auth',
    'Database',
    'Function',
    'HTTP',
    'Input',
    'Redirect',
    'RestfulAPI',
    'Session',
];
$loadConfig = [
    'Config',
    'Settings',
];

$posUrl =  strpos("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]", 'admin');

// if ($posUrl != null) {
// 	require_once("./vendor/autoload.php");
// }

foreach ($loadConfig as $item) {
    require_once("./config/$item.php");
}

foreach ($loadHelper as $item) {
    require_once("./helpers/$item.php");
}
$DB = new Database();
Session::start();
