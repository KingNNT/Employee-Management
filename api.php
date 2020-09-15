<?php
    require_once "./autoload/autoload.php";
    // $loadAPIFile = [
    //     'employeeAPI',
    // ];

    // foreach ($loadAPIFile as $item) {
    //     require_once("./API/$item.php");
    // }

    if (isset($_REQUEST['category'])) {
        if ($_REQUEST['category'] === "employee") {
            require_once("./API/employeeAPI.php");
        } else {
            echo "Don't Have Category";
        }
    }
