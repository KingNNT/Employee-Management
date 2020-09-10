<?php
require_once("./autoload/autoload.php");

if (isset($_POST["login"])) {
    $id = $_POST["id"];
    $password = $_POST["password"];
    mysqli_real_escape_string($conn, $id);
    mysqli_real_escape_string($conn, $password);

    $sql = "SELECT * FROM employee WHERE id = '$id' AND password = '$password'";
    $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    $num_rows = mysqli_num_rows($query);

    if ($num_rows == 0) {
        echo "
            <div class='popupContainer' id='popuplogin'>
                <h2>Lỗi đăng nhập</h2>
                <p>Sai id hoặc password. <br> Vui lòng nhập lại!!!</p>
                <a  href=''>Đóng</a>
            </div>
            ";
    } else {
        $row = mysqli_fetch_array($query);

        $_SESSION['id'] = $row['id'];
        $_SESSION['password'] = $row['password'];
        $_SESSION['level'] = $row['level'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['address'] = $row['address'];
        $_SESSION['birthday'] = $row['birthday'];

        if ($_SESSION['level'] == "1")
            header('location: ' . BASE_URI . 'layouts/admin/index.php');
        else
            header('Location: ' . BASE_URI . 'index.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./public/css/styleLogin.css">
    <link rel="stylesheet" href="./public/css/stylePopup.css">
    <title>Đăng nhập hệ thống</title>
</head>

<body>


    <div class="wraper">
        <div class="title">
            <h1>VLUTE</h1><span style="font-weight: 100;font-size: 30px;"> Manager</span>
            <p></p>
        </div>
        <div class="form-top">
            <div class="left">
                <h3>Đăng nhập hệ thống</h3>
                <p>Hệ thống quản lý nhân viên - VLUTE</p>
            </div>
            <div class="right">
                <img src="./public/images/vlute_icon96.png" alt="">
            </div>
        </div>
        <div class="form-bottom">
            <form method="POST">
                <div class="input-box">
                    <input type="text" name="id" required autocomplete="none">
                    <label for="">Username</label>
                </div>
                <div class="input-box">
                    <input type="password" name="password" required>
                    <label for="">Password</label>
                </div>
                <!-- <input type="button" value="Đăng nhập"> -->
                <input type="submit" name="login" class="login login-submit" value="Login">
            </form>
            <a href="#">Quên mật khẩu?</a>
        </div>
    </div>

</body>

</html>