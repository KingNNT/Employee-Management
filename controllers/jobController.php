<?php
    require_once("./autoload/autoload.php");
    require_once("./models/jobModel.php");

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
                HTTP::sendResponse(500, "$action job failed");
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
        jobModel::loadData();
        switch ($action) {
            case 'create': {
                $result = jobModel::create();
                sendMessage($result, $action);
                break;
            }

            case 'read': {
                /* Method: GET */
                $result = jobModel::read();
                sendData($result, $action);
                break;
            }

            case 'update': {
                $result = jobModel::update();
                sendMessage($result, $action);
                break;
            }

            case 'delete': {
                $result = jobModel::delete();
                sendMessage($result, $action);
                break;
            }

            case 'search': {
                /* Method: GET */
                $result = jobModel::search();
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
