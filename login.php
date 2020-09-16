<?php
require_once "./autoload/autoload.php";

$title = $title = "Login - " . APP_NAME;
$error = "";
if (Auth::isLogin() !== false) {
    Redirect::url("index.php");
} else {
    $id = Input::post('username');
    $password = md5(Input::post('password'));

    if (Auth::login($id, $password) === false) {
        $error = "Username and password incorrect";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?echo $title?></title>

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
                <h3>Đăng Nhập Hệ Thống</h3>
                <p>Hệ thống quản lý nhân viên - HRM</p>
            </div>
            <div class="right">
                <img src="./public/images/HRManager.jpg" alt="icon">
            </div>
        </div>
        <div class="form-bottom">
            <form method="POST">
                <div class="input-box">
                    <input type="text" name="username" required autocomplete="none">
                    <label for="">Username</label>
                </div>
                <div class="input-box">
                    <input type="password" name="password" required>
                    <label for="">Password</label>
                </div>
                <div>
                    <?php echo $error?>
                </div>
                <input type="submit" name="login" class="login login-submit" value="Login">
            </form>

            <div class="row d-flex justify-content-around text-center">
                <a href="#">Forgot Password</a>
                <a href="./signup.php" class="font-weight-bold">Sign Up</a>
            </div>
        </div>
    </div>
</body>

</html>
