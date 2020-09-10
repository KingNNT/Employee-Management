<?php
require_once("../../config/config.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo PUBLIC_URI . "style.css" ?>">
    <link rel="stylesheet" href="./style.css">
    <!-- <link rel="stylesheet" href="<?php echo PUBLIC_URI . "./css/styleHoso.css" ?>"> -->
    <!-- <link rel="stylesheet" type="text/css" href="<?php echo PUBLIC_URI . "./css/stylePopup.css" ?>"> -->
    <link rel="stylesheet" href="<?php echo PUBLIC_URI . "./css/styleTailieu.css" ?>">
    <!-- <link rel="stylesheet" href="<?php echo PUBLIC_URI . "./css/styleBaigiang.css" ?>"> -->
    <link rel="stylesheet" href="<?php echo PUBLIC_URI . "./css/styleUpload.css" ?>">
    <!-- <link rel=" stylesheet" href="<?php echo PUBLIC_URI . "./css/styleProfile.css" ?>"> -->

    <!-- CSS for ADMIN -->
    <link rel="stylesheet" href="<?php echo PUBLIC_URI . "./css/styleHoso.css" ?>">

    <link rel="stylesheet" href="<?php echo PUBLIC_URI . "./css/bootstrap.min.css" ?>">


    <script src="https://kit.fontawesome.com/80f3cb30b3.js"></script>

    <!-- Font Google -->
    <link href="https://fonts.googleapis.com/css2?family=Chonburi&display=swap" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
    <title>Admin</title>
</head>

<body>
    <div class="header">
        <div class="animateTitle">
            <h1>Admin Dashboard</h1>
        </div>
        <div class="contentBox">
            <div class="menuHambuger">
                <label for="checkMenu" class="menuBtn">
                    <div class="btnHambuger"></div>
                </label>
            </div>
            <div class="imgBox">
                <img src="<?php echo PUBLIC_URI . "/images/logo1.png" ?>">
                <h2>VLUTE</h2>
            </div>

            <div class="formInfo">

                <?php
                echo  '<span style="font-weight:bold;">Xin chào, ' . $_SESSION['hoten'] . ' </span>';
                ?>

                <a title="Thông tin người dùng" href="#" onclick="loadFormInfo()">
                    <img style="cursor: pointer;" src="<?php echo PUBLIC_URI . "/images/down1.png" ?>">
                </a>
                <ul id="contentInfo">
                    <li>
                        <img src="<?php echo PUBLIC_URI . "/images/man.png" ?>" style="width: 40px; margin-bottom:10px;">
                        <br>
                        <a class="btnInfo" href="hoso.php">Thông tin cá nhân</a>
                    </li>
                    <li>
                        <img src="<?php echo PUBLIC_URI . "/images/logout.png" ?>" style="width: 40px;  margin-bottom:10px;">
                        <br>
                        <a class="btnLogout" href="<?php echo BASE_URI . "logout.php" ?>">Đăng xuất</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- header end -->
    <div class="main">
        <div class="containerMenu">
            <input type="checkbox" name="checkMenu" id="checkMenu" checked>
            <div class="menuBar">
                <div class="imgBox">
                    <img src="<?php echo PUBLIC_URI . "images/icon.png" ?>" alt="">
                </div>
                <ul class="lists">
                    <li class="active">
                        <a href="index.php" style="font-size: 15px;" class="listItem"><img src="<?php echo PUBLIC_URI . "images/house.png" ?>" alt=""> Trang chủ</a>
                    </li>
                    <li>
                        <a href="hoso.php" style="font-size: 15px;" class="listItem"><img src="<?php echo PUBLIC_URI . "images/documents.png" ?>" alt=""> Hồ sơ</a>
                    </li>
                    <li>
                        <a href="qlnguoidung.php" style="font-size: 15px;" class="listItem"><img src="<?php echo PUBLIC_URI . "images/man.png" ?>"> QL Người dùng</a>
                        <ul>
                            <li><a href="qlnguoidung.php"> Danh sách người dùng</a></li>
                            <li><a href="ttnguoidung.php"> Thêm người dùng</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="qltailieu.php" style="font-size: 15px;" class="listItem"><img src="<?php echo PUBLIC_URI . "images/documents.png" ?>" alt=""> QL Tài liệu</a>
                    </li>
                    <li>
                        <a href="<?php echo BASE_URI . "logout.php" ?>" style="font-size: 15px;" class="listItem">
                            <img src="<?php echo PUBLIC_URI . "images/gear.png" ?>" alt="" />
                            Đăng xuất
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- content -->
        <div class="containerMain" id="container">