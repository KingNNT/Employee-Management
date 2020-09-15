<?php
    require_once "./autoload/autoload.php";
    $loadAPIFile = [
        'employeeAPI',
    ];

    foreach ($loadAPIFile as $item) {
        require_once("./API/$item.php");
    }
if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'getEmployees':
            employeeModel::read();
            break;
        case 'createEmployee':
            employeeModel::create();
            break;
        
        default:
            echo "Invalid Action: " . $POST['action'];
            break;
    }
} else {
    echo "No Action";
}
