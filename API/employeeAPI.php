<?php
    require_once("./autoload/autoload.php");
    require_once("./models/employeeModel.php");
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'create':
                employeeModel::create();
                break;
            case 'read':
                employeeModel::read();
                break;
            case 'update':
                employeeModel::update();
                break;
            case 'delete':
                employeeModel::delete();
                break;
            default:
                echo "Invalid Action: " . $_POST['action'];
                break;
        }
    } else {
        echo "Don't Have Request Post Action";
    }
