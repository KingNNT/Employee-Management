<?php
echo "SS=" . $_SESSION['id'] . "|";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./public/style.css">
    <link rel="stylesheet" href="./public/css/styleHoso.css">
    <link rel="stylesheet" type="text/css" href="./public/css/stylePopup.css">
    <link rel="stylesheet" href="./public/css/styleTailieu.css">
    <link rel="stylesheet" href="./public/css/styleBaigiang.css">
    <link rel="stylesheet" href="./public/css/styleUpload.css">
    <link rel="stylesheet" href="./public/css/styleProfile.css">
    <link rel="stylesheet" href="./public/css/styleThanhTich.css">
    <link rel="stylesheet" href="./public/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/80f3cb30b3.js"></script>

    <!-- GG Font -->
    <link href="https://fonts.googleapis.com/css2?family=Chonburi&display=swap" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
    <title>Quản lí Nhân Viên</title>
</head>

<body>
    <div class="header">
        <div class="animateTitle">
            <h1>Quản lí hồ sơ</h1>
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

            <div class="formInfo">

                <?php
                echo  '<span style="font-weight:bold;">Xin chào, ' . $_SESSION['hoten'] . ' </span>';
                ?>

                <a title="Thông tin người dùng" href="#" onclick="loadFormInfo()">
                    <img style="cursor: pointer;" src="./public/images/down1.png">
                </a>
                <ul id="contentInfo">
                    <li>
                        <img src="./public/images/man.png" style="width: 40px; margin-bottom:10px;">
                        <br>
                        <a class="btnInfo" href="hoso.php">Thông tin cá nhân</a>
                    </li>
                    <li>
                        <img src="./public/images/logout.png" style="width: 40px;  margin-bottom:10px;">
                        <br>
                        <a class="btnLogout" href="./lopout.php">Đăng xuất</a>
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
                    <img src="./public/images/icon.png" alt="">
                </div>
                <ul class="lists">
                    <li class="active"><a href="index.php"><img src="./public/images/house.png" alt=""> Trang chủ</a></li>
                    <li>
                        <a href="#"><img src="./public/images/man.png"> Hồ sơ</a>
                        <ul>
                            <li><a href="hoso.php"><img src=""><img src="./public/images/man.png" alt="">Thông tin hồ sơ</a></li>
                            <li><a href="thanhtichcanhan.php"><img src=""><img src="./public/images/google-docs.png" alt="">Thành tích cá nhân</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="tailieu.php"><img src="./public/images/documents.png" alt=""> Tài liệu</a>
                        <ul>
                            <li><a href="myupload.php"><img src="./public/images/google-docs.png"> Tài liệu của tôi</a></li>
                            <li><a href="baigiang.php"><img src="./public/images/google-docs.png"> Bài giảng</a></li>
                            <li><a href="giaotrinh.php"><img src="./public/images/google-docs.png"> Giáo trình</a></li>
                            <li><a href="decuong.php"><img src="./public/images/google-docs.png"> Đề cương</a></li>
                            <li><a href="lichgiangday.php"><img src="./public/images/google-docs.png"> Lịch giảng dạy</a></li>
                            <li><a href="detainckh.php"><img src="./public/images/google-docs.png"> Đề tài NCKH</a></li>
                        </ul>
                    </li>
                    <li><a href="upload.php"><img src="./public/images/google-docs.png"> Upload</a></li>
                    <li><a href="timkiem.php"><img src="./public/images/loupe.png" alt=""> Tìm kiếm</a></li>
                    <li>
                        <a href="logout.php"><img src="./public/images/gear.png" alt=""> Đăng xuất </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- content -->
        <div class="containerMain" id="container">