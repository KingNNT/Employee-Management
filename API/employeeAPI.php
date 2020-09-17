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
            case 'search':
                $result = employeeModel::search();
                if ($result !== false) {
                    HTTP::sendResponse(200, $result, "json");
                } else {
                    HTTP::sendResponse(500, "Don't have Request");
                }
                break;
            default:
                echo "Invalid Action: " . $_POST['action'];
                break;
        }
    } else {
        echo "Don't Have Request Post Action";
    }
