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
        <div class="animateTitle sticky-top">
            <h1>Quản Lý Nhân Viên</h1>
        </div>
        <div class="contentBox">
            <div class="imgBox">
                <img src="<?php echo PUBLIC_URI . 'images/HRManager.jpg' ?>">
                <h2>HR Manager</h2>
            </div>

            <div class="formInfo"><?php echo '<span class="font-weight-bold"> Xin chào, ' . Session::get('name') . '</span>'; ?></div>
        </div>
    </header>

    <!-- content -->
    <div class="containerMain" id="container">