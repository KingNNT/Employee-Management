<?php
    require_once "./autoload/autoload.php";
    require_once "./models/employeeModel.php";

    if (Input::hasRequest('action')) {
        $action = Input::request('action');
        EmployeeModel::loadData();
        switch ($action) {
            case 'create': {
                $result = EmployeeModel::create();
                HTTP::sendMessage($result, $action);
                break;
            }

            case 'read': {
                /* Method: GET */
                $result = EmployeeModel::read();
                HTTP::sendData($result, $action);
                break;
            }

            case 'update': {
                $result = EmployeeModel::update();
                HTTP::sendMessage($result, $action);
                break;
            }

            case 'delete': {
                $result = EmployeeModel::delete();
                HTTP::sendMessage($result, $action);
                break;
            }

            case 'search': {
                $result = EmployeeModel::search();
                HTTP::sendData($result, $action);
                break;
            }

            default: {
                echo "Invalid Action: " . $_POST['action'];
                break;
            }
        }
    }
