<?php
require_once "./autoload/autoload.php";
$error = "";
if (Auth::isLogin() !== false) {
    Redirect::url("index.php");
} else {
    if (Input::hasPost('login')) {

        $id = Input::post('id');
        $password = md5(Input::post('password'));

        $sql = "SELECT * FROM employee WHERE id = $id AND password = '$password'";

        // $data is a object
        $data = $DB->query($sql);

        if ($data !== false) {
            if (is_object($data)) {
                Session::set('id', $data->id);
                Session::set('level', $data->level);
                Session::set('name', $data->name);
                Redirect::url('index.php');
            }
        } else {
            $error = "Sai tên đăng nhập hoặc mật khẩu";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Đăng nhập hệ thống</title>

    <!--    Bootstrap 4 CDN -->

    <!--    CSS Bootstrap   -->
    <link rel="stylesheet" href="<?echo PUBLIC_URI . "node_modules/bootstrap/dist/css/bootstrap.min.css"?>" crossorigin="anonymous" />
    <!--    JS Bootstrap   -->
    <script src="<?echo PUBLIC_URI . "node_modules/jquery/dist/jquery.min.js"?>" crossorigin="anonymous"></script>
    <script src="<?echo PUBLIC_URI . "node_modules/popper.js/dist/umd/popper.min.js"?>" crossorigin="anonymous"></script>
    <script src="<?echo PUBLIC_URI . "node_modules/bootstrap/dist/js/bootstrap.min.js"?>" crossorigin="anonymous"></script>

        <link rel="stylesheet" href="<?echo PUBLIC_URI . "css/dist/styles.css"?>">
</head>

<body>
    <div class="wraper">
        <div class="title">
            <h1>HR</h1><span class="text-primary bg-dark p-2 rounded font-italic"> Manager</span>
        </div>
        <div class="form-top">
            <div class="left">
                <h3>Đăng nhập hệ thống</h3>
                <p>Hệ thống quản lý nhân viên - HRM</p>
            </div>
            <div class="right">
                <img src="./public/images/HRManager.jpg" alt="icon">
            </div>
        </div>
        <div class="form-bottom">
            <form method="POST">
                <div class="input-box">
                    <input type="text" name="id" required autocomplete="none">
                    <label for="">ID</label>
                </div>
                <div class="input-box">
                    <input type="password" name="password" required>
                    <label for="">Password</label>
                </div>
                <input type="submit" name="login" class="login login-submit" value="Login">
            </form>
            <?echo $error?>
            <a href="#">Forgot Password</a>
        </div>
    </div>

</body>

</html>
