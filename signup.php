<?php
require_once "./autoload/autoload.php";
Session::destroy();
$title = "Sign Up - " . APP_NAME;
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
                <h3>Đăng Kí Tài Khoản</h3>
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
				<div class="input-box">
                    <input type="password" name="password" required>
                    <label for="">Confirm Password</label>
				</div>
					<div class="input-box">
                    <input type="text" name="name" required autocomplete="none">
                    <label for="">Name</label>
				</div>
				<div class="input-box">
                    <input type="text" name="address" required autocomplete="none">
                    <label for="">Address</label>
				</div>
				<div class="input-box">
                    <input type="text" name="birthday" required autocomplete="none">
                    <label for="">Birhday</label>
				</div>
				
				<div class="input-box">
                    <input type="text" name="position" required autocomplete="none">
                    <label for="">Position</label>
                </div>
                <input type="submit" name="Sign Up" class="login login-submit" value="Sign Up">
            </form>
        </div>
    </div>
</body>

</html>
