<?php
require_once "./autoload/autoload.php";

if (Auth::isLogin() != false) {
    Redirect::url("index.php");
} else {
    if (Input::hasPost('login')) {

        $email = Input::post('email');
        $password = md5(Input::post('password'));

        $sql = "SELECT * FROM khachhang WHERE email = '$email' && password = '$password'";

        $data = $DB->query($sql);

        if (is_array($data)) {

            Session::put('customer', $data);
            Redirect::url('');
        }

        $error = "Sai tên đăng nhập hoặc mật khẩu";
    }
}

// $title = "Đăng nhập ";
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
