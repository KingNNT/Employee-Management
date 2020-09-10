<?php
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
<!-- <div class="popupContainer" id="popup">
                    <h2>Thông báo</h2>
                    <p>Cập nhật thông tin thành công!!!</p>
                    <a href="#" onclick='popupEvent()'>Đóng</a>
            </div> -->

<?php
require_once("./layouts/page/footer.php");
?>