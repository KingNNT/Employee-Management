<?php
    require_once("./autoload/autoload.php");
    require_once("./models/employeeModel.php");

    function sendMessage($result, $action)
    {
        switch ($result) {
            case true: {
                HTTP::sendResponse(200, "$action account successful");
                break;
            }

            case false: {
                HTTP::sendResponse(500, "$action account failed");
                break;
            }

            case -1: {
                HTTP::sendResponse(500, "Don't have Request");
                break;
            }

            default:{
                // HTTP::sendResponse(200, "$action Account Successful");
                break;
            }
        }
    }

    function sendData($result, $action)
    {
        $result = json_encode($result);
        switch ($result) {
            case false: {
                HTTP::sendResponse(500, "$action account failed");
                break;
            }

            case -1: {
                HTTP::sendResponse(500, "Don't have Request");
                break;
            }

            default:{
                HTTP::sendResponse(200, $result, "json");
                break;
            }
        }
    }

    /*  */

    if (isset($_REQUEST['action'])) {
        $action = $_REQUEST['action'];
        
        switch ($action) {
            case 'create': {
                $result = employeeModel::create();
                sendMessage($result, $action);
                break;
            }

            case 'read': {
                /* Method: GET */
                $result = employeeModel::read();
                sendData($result, $action);
                break;
            }

            case 'update': {
                $result = employeeModel::update();
                sendMessage($result, $action);
                break;
            }

            case 'delete': {
                $result = employeeModel::delete();
                sendMessage($result, $action);
                break;
            }

            case 'search': {
                $result = employeeModel::search();
                sendData($result, $action);
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
