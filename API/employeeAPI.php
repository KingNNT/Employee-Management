<?php
    require_once("./autoload/autoload.php");
    require_once("./models/employeeModel.php");
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'read':
                employeeModel::read();
                break;
            case 'create':
                employeeModel::create();
                break;
            
            default:
                echo "Invalid Action: " . $POST['action'];
                break;
        }
    } else {
        echo "No Action";
    }
