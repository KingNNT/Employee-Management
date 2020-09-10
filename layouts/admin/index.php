<?php
require_once("./header.php");
require_once("./config/config.php");
?>

<div class="containerQlnguoidung">
    <div class="container-fluid">
        <div class="boxCount">
            <div class="box">
                <div class="contentLeft contentLeft1">
                    <h3>Tổng số người dùng</h3>
                </div>
                <div class="contentRight contentRight1">
                    <?php
                    $query = mysqli_query($conn, "SELECT COUNT(macanbo) as songuoi from user");
                    $row = mysqli_fetch_array($query);
                    echo "<h3>" . $row['songuoi'] . "</h3>";
                    ?>
                </div>
            </div>
            <div class="box">
                <div class="contentLeft contentLeft2">
                    <h3>Tổng số tài liệu</h3>
                </div>
                <div class="contentRight contentRight2">
                    <?php
                    $query = mysqli_query($conn, "SELECT COUNT(id) as sotailieu from uploads");
                    $row = mysqli_fetch_array($query);
                    echo "<h3>" . $row['sotailieu'] . "</h3>";
                    ?>
                </div>
            </div>
            <div class="box">
                <div class="contentLeft contentLeft3">
                    <h3>Tài liệu tải lên trong tuần</h3>
                </div>
                <div class="contentRight contentRight3">
                    <?php
                    $query = mysqli_query($conn, "SELECT COUNT(id) as tailieutrongtuan FROM uploads WHERE CURRENT_DATE - date(ngaydang) <= 7");
                    $row = mysqli_fetch_array($query);
                    echo "<h3>" . $row['tailieutrongtuan'] . "</h3>";
                    ?>
                </div>
            </div>
        </div>

        <div class="content">
            <div style="box-shadow: 0 5px 15px rgba(0,0,0,.3);" class="box">
                <a href="qlnguoidung.php">
                    <p class="title">Quản lí Người dùng</p>
                    <div class="imgBox" style="text-align: center;">
                        <img style="text-align: center;" src="<?php echo PUBLIC_URI . "images/avatar" ?>">
                    </div>
                </a>
            </div>
            <div style="box-shadow: 0 5px 15px rgba(0,0,0,.3);" class="box">
                <a href="qltailieu.php">
                    <p class="title">Quản lí Tài liệu</p>
                    <div class="imgBox">
                        <img src="../img/google-docs.png">
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<?php
require_once("./footer.php");
?>