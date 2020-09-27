<?php
    require_once "./autoload/autoload.php";
    require_once "./models/jobModel.php";

    if (Input::hasRequest('action')) {
        $action = Input::request('action');
        jobModel::loadData();
        switch ($action) {
            case 'create': {
                $result = jobModel::create();
                HTTP::sendMessage($result, $action);
                break;
            }

            case 'read': {
                /* Method: GET */
                $result = jobModel::read();
                HTTP::sendData($result, $action);
                break;
            }

            case 'update': {
                $result = jobModel::update();
                HTTP::sendMessage($result, $action);
                break;
            }

            case 'delete': {
                $result = jobModel::delete();
                HTTP::sendMessage($result, $action);
                break;
            }

            case 'search': {
                /* Method: GET */
                $result = jobModel::search();
                HTTP::sendData($result, $action);
                break;
            }

            default: {
                echo "Invalid Action: " . $_POST['action'];
                break;
            }
        }
    }
