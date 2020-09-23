<?php
    require_once "./autoload/autoload.php";
    // $loadAPIFile = [
    //     'employeeAPI',
    // ];

    // foreach ($loadAPIFile as $item) {
    //     require_once("./API/$item.php");
    // }

    if (isset($_REQUEST['category'])) {
        switch ($_REQUEST['category']) {
            case 'employee': {
                require_once("./API/employeeAPI.php");
                break;
            }
            case 'job': {
                if (isset($_REQUEST['id'])) {
                    require_once("./API/jobAPI.php");
                } else {
                    echo "Don't have ID parameter";
                }
            break;
            }
            
            default:
                echo "Don't Have Category";
                break;
        }
    }
