<?php
require_once("./login.php");
require_once("./layouts/page/header.php");
?>

<div class="content">
    <div class="box">
        <a href="hoso.php">
            <p class="title">Hồ sơ</p>
            <div class="imgBox">
                <img src="./public/images/avatar.png">
            </div>
        </a>

    </div>
    <div class="box">
        <a href="myupload.php">
            <p class="title">Tài liệu</p>
            <div class="imgBox">
                <img src="./public/images/google-docs.png">
            </div>
        </a>
    </div>
    <div class="box">
        <a href="timkiem.php">
            <p class="title">Tìm kiếm</p>
            <div class="imgBox">
                <img src="./public/images/loupe.png">
            </div>
        </a>
    </div>
</div>
<?php
require_once("./layouts/page/footer.php");
?>