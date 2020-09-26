<?php
    $title = $error = "";
    require_once "./controllers/loginController.php";
    $responseLogin = loginController::index();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        <?php
            if ($title == "") {
                echo APP_NAME;
            } else {
                echo $title . " - " . APP_NAME;
            }
        ?>
    </title>

    <!--    Bootstrap 4 CDN -->

    <!--    CSS Bootstrap   -->
    <link rel="stylesheet" href="<?echo PUBLIC_URL . "node_modules/bootstrap/dist/css/bootstrap.min.css"?>" crossorigin="anonymous" />
    <!--    JS Bootstrap   -->
    <script src="<?echo PUBLIC_URL . "node_modules/jquery/dist/jquery.min.js"?>" crossorigin="anonymous"></script>
    <script src="<?echo PUBLIC_URL . "node_modules/popper.js/dist/umd/popper.min.js"?>" crossorigin="anonymous"></script>
    <script src="<?echo PUBLIC_URL . "node_modules/bootstrap/dist/js/bootstrap.min.js"?>" crossorigin="anonymous"></script>

        <link rel="stylesheet" href="<?echo PUBLIC_URL . "css/dist/styles.css"?>">
</head>

<body>
    <div class="wraper">
        <div class="title">
            <h1><?php echo APP['firstName'] ?></h1><span class="text-primary bg-dark p-2 rounded font-italic"><?php echo APP['lastName'] ?></span>
        </div>
        <div class="form-top">
            <div class="left">
                <h3>Đăng Nhập Hệ Thống</h3>
                <p><?echo APP['slogan']?></p>
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
                <input type="submit" name="login" class="login login-submit" value="Login">
            </form>
			<?php if ($responseLogin === false) :?>
				<div>
					<h6 class="text-danger">Username or password incorrect</h6>
				</div>
			<?php endif?>
            <div class="row d-flex justify-content-around text-center">
                <a href="#" class="text-warning">Forgot Password</a>
                <a href="./signup.php" class="font-weight-bold">Sign Up</a>
            </div>
        </div>
    </div>
</body>

</html>
