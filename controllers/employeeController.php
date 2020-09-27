<?php
    require_once("./autoload/autoload.php");
    require_once("./models/employeeModel.php");

    if (Input::hasRequest('action')) {
        $action = Input::request('action');
        employeeModel::loadData();
        switch ($action) {
            case 'create': {
                $result = employeeModel::create();
                HTTP::sendMessage($result, $action);
                break;
            }

            case 'read': {
                /* Method: GET */
                $result = employeeModel::read();
                HTTP::sendData($result, $action);
                break;
            }

            case 'update': {
                $result = employeeModel::update();
                HTTP::sendMessage($result, $action);
                break;
            }

            case 'delete': {
                $result = employeeModel::delete();
                HTTP::sendMessage($result, $action);
                break;
            }

            case 'search': {
                $result = employeeModel::search();
                HTTP::sendData($result, $action);
                break;
            }

            default: {
                echo "Invalid Action: " . $_POST['action'];
                break;
            }
        }
    } else {
        HTTP::sendResponse(500, "Don't Have Request Post Action");
    }
