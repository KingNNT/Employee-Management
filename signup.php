<?php
require_once "./autoload/autoload.php";


$error = "";
$title = "Sign Up - " . APP_NAME;


if (Input::hasPost("signUp")) {
    $password = Input::post('password');
    $passwordConfirm = Input::post('passwordConfirm');

    if ($password === $passwordConfirm) {
        Session::destroy();
        $username = Input::post('username');
        $password = md5(Input::post('password'));

        $name = Input::post('name');
        $address = Input::post('address');
        $birthday = formatDate(Input::post('birthday'));
        $position = Input::post('position');

        $result = Auth::signUp($username, $password, $name, $address, $birthday, $position);
    } else {
        $error = "Please Check Again";
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
                <h3>Đăng Kí Tài Khoản</h3>
                <p>Hệ thống quản lý nhân viên - HRM</p>
            </div>
            <div class="right">
                <img src="./public/images/HRManager.jpg" alt="icon">
            </div>
        </div>
        <div class="form-bottom">
            <form method="POST" id="formSubmit">
                <div class="input-box">
                    <input type="text" name="username" required autocomplete="none">
                    <label for="">ID</label>
                </div>
                <div class="input-box">
                    <input type="password" name="password" id="password">
                    <label for="">Password</label>
				</div>
				<div class="input-box">
                    <input type="password" name="passwordConfirm">
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
                    <input type="text" name="birthday" id="datepicker" required autocomplete="none">
                    <label for="">Birhday</label>
				</div>
				
				<div class="input-box">
                    <input type="text" name="position" required autocomplete="none">
                    <label for="">Position</label>
                </div>
                <div class="mt-2">
                    <?php echo $error ?>
                </div>
                <input type="submit" name="signUp" class="login login-submit" id="btnSignUp" value="Sign Up"></input>
            </form>
        </div>
    </div>

    <!-- <script type="text/javascript" src="<?echo PUBLIC_URI . "node_modules/Propeller/dist/propeller.min.js"?>"></script>
    <script type="text/javascript" src="<?echo PUBLIC_URI . "node_modules/datetimepicker/dist/DateTimePicker.min.js"?>"></script>
    <script type="text/javascript" src="<?echo PUBLIC_URI . "node_modules/datetimepicker/dist/DateTimePicker.min.css"?>"></script>
    <script src="<?echo PUBLIC_URI . "js/dateTimePicker.js"?>"></script> -->

    <!-- <script src="<?echo PUBLIC_URI . "js/signup/checkPassword.js"?>" crossorigin="anonymous"></script> -->
    <!-- <script src="<?echo PUBLIC_URI . "node_modules/jquery-validation/dist/jquery.validate.min.js"?>" crossorigin="anonymous"></script> -->

</body>

</html>
