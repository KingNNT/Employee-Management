<?php
    require_once("./autoload/autoload.php");
    require_once("./models/employeeModel.php");
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'create': {
                $result = employeeModel::create();
                if ($result !== false) {
                    HTTP::sendResponse(200, "Create Account Successful");
                } else {
                    HTTP::sendResponse(500, "Don't have Request");
                }
                break;
            }

            case 'read': {
    require_once("./autoload/autoload.php");
    require_once("./models/employeeModel.php");
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'create': {
                $result = employeeModel::create();
                switch ($result) {
                    case true: {
                        HTTP::sendResponse(200, "Create Account Successful");
                        break;
                    }

                    case false: {
                        HTTP::sendResponse(500, "Create Account Failed");
                        break;
                    }

                    case -1: {
                        HTTP::sendResponse(500, "Don't have Request");
                        break;
                    }

                    default:{
                        HTTP::sendResponse(200, "Create Account Successful");
                        break;
                    }
                }
            }

            case 'read': {
                $result = employeeModel::read();
                switch ($result) {
                    case true: {
                        HTTP::sendResponse(200, json_encode($result), "json");
                        break;
                    }

                    case false: {
                        HTTP::sendResponse(500, "Read Account Failed");
                        break;
                    }

                    case -1: {
                        HTTP::sendResponse(500, "Don't have Request");
                        break;
                    }

                    default:{
                        HTTP::sendResponse(200, json_encode($result), "json");
                        break;
                    }
                }
                break;
            }

            case 'update': {
                $result = employeeModel::update();
                switch ($result) {
                    case true: {
                        HTTP::sendResponse(200, "Update Account Successful");
                        break;
                    }

                    case false: {
                        HTTP::sendResponse(500, "Update Account Failed");
                        break;
                    }

                    case -1: {
                        HTTP::sendResponse(500, "Don't have Request");
                        break;
                    }

                    default:{
                        HTTP::sendResponse(200, "Update Account Successful");
                        break;
                    }
                }
                break;

            }

            case 'delete': {
                $result = employeeModel::delete();
                switch ($result) {
                    case true: {
                        HTTP::sendResponse(200, "Delete Account Successful");
                        break;
                    }

                    case false: {
                        HTTP::sendResponse(500, "Delete Account Failed");
                        break;
                    }

                    case -1: {
                        HTTP::sendResponse(500, "Don't have Request");
                        break;
                    }

                    default:{
                        HTTP::sendResponse(200, "Delete Account Successful");
                        break;
                    }
                }

                break;

            }

            case 'search': {
                $result = employeeModel::search();
                    switch ($result) {
                    case true: {
                        HTTP::sendResponse(200, $result, "json");
                        break;
                    }

                    case false: {
                        HTTP::sendResponse(500, "Search Account Failed");
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

                break;
            }
 
            default: {
                echo "Invalid Action: " . $_POST['action'];
                break;
            }

        }
    } else {
        echo "Don't Have Request Post Action";
    }

            }

            case 'update':
                $result = employeeModel::update();
                if ($result !== false) {
                    HTTP::sendResponse(200, "Update Account Successful");
                } else {
                    HTTP::sendResponse(500, "Update is failed");
                }
                break;
            case 'delete':
                $result = employeeModel::delete();
                if ($result !== false) {
                    HTTP::sendResponse(200, "Delete Account Successful");
                } else {
                    HTTP::sendResponse(500, "Delete is failed");
                }
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
