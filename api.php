<?php
    require_once "./autoload/autoload.php";
    $loadAPIFile = [
        'getEmployee',
    ];

    foreach ($loadAPIFile as $item) {
        require_once("./API/$item.php");
    }
