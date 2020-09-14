<?php
    require_once "./autoload/autoload.php";
    $loadAPIFile = [
        'getEmployee',
    ];

    foreach ($loadAPIFile as $item) {
        require_once("./API/$item.php");
    }
if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'getEmployees':
            userModel::getEmployees();

            break;
        
        default:
            echo "Invalid Action: " . $_GET['action'];
            break;
    }
} else {
    echo "No Action";
}
