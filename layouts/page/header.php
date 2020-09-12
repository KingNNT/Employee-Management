<?php
require_once "./autoload/autoload.php";
Session::start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lí Nhân Viên</title>

    <link rel="stylesheet" href="./public/style.css">
    <link rel="stylesheet" href="<?echo PUBLIC_URI . "css/dist/styles.css"?>">
    <link rel="stylesheet" href="./public/css/styleHoso.css">
    <link rel="stylesheet" type="text/css" href="./public/css/stylePopup.css">

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
    <div class="header">
        <div class="animateTitle sticky-top">
            <h1>Quản Lý Nhân Viên</h1>
        </div>
        <div class="contentBox">
            <div class="menuHambuger">
                <label for="checkMenu" class="menuBtn">
                    <div class="btnHambuger"></div>
                </label>
            </div>
            <div class="imgBox">
                <img src="./public/images/logo1.png">
                <h2>VLUTE</h2>
            </div>

            <div class="formInfo"><?php echo '<span class="font-weight-bold"> Xin chào, ' . Session::get('name') . '</span>'; ?></div>
        </div>
    </div>
    <!-- header end -->

    <!-- content -->
    <div class="containerMain" id="container">