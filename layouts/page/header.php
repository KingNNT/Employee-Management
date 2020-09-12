<?php
require_once "./autoload/autoload.php";
Session::start();

$name = Session::get('name');
$icon = PUBLIC_URI . 'images/HRManager.jpg';
$imgLogout = PUBLIC_URI . 'images/logout.png';
$logout = BASE_URL . "logout.php";
$topBar = <<<EOT
<div class="contentBox row d-flex align-items-center text-light justify-content-between p-4 m-0">
    <div class="imgBox">
        <img src="$icon">
    </div>

    <div class="formInfo">
        <span class="font-weight-bold"> Xin chào $name</span>
        <a href="$logout">
            <img src="$imgLogout">
        </a>
    </div>
</div>
EOT;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lí Nhân Viên</title>

    <link rel="stylesheet" href="<?echo PUBLIC_URI . "css/dist/styles.css"?>">

    <!--    Bootstrap 4 CDN -->

    <!--    CSS Bootstrap   -->
    <link rel="stylesheet" href="<?echo PUBLIC_URI . "node_modules/bootstrap/dist/css/bootstrap.min.css"?>" crossorigin="anonymous" />
    <!--    JS Bootstrap   -->
    <script src="<?echo PUBLIC_URI . "node_modules/jquery/dist/jquery.min.js"?>" crossorigin="anonymous"></script>
    <script src="<?echo PUBLIC_URI . "node_modules/popper.js/dist/umd/popper.min.js"?>" crossorigin="anonymous"></script>
    <script src="<?echo PUBLIC_URI . "node_modules/bootstrap/dist/js/bootstrap.min.js"?>" crossorigin="anonymous"></script>

    <!-- GG Font -->
    <link href="https://fonts.googleapis.com/css2?family=Chonburi&display=swap" rel="stylesheet">
</head>

<body>
    <header>
        <div class="container-fluid p-0 m-0">
            <div class="sticky-top">
                <h1 class="bg-dark text-light text-center m-0 d-flex justify-content-center align-items-center">
                    HR Manager
                </h1>
            </div>
            <?php
                $arr = explode("/", $_SERVER['PHP_SELF']);
                $fileName = $arr[count($arr) - 1];
                if ($fileName == "index.php") {
                    echo $topBar;
                }
            ?>

        </div>

    </header>

    <!-- content -->
    <div class="containerMain" id="container">