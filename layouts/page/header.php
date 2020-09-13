<?php
require_once "./autoload/autoload.php";
Session::start();

$name = Session::get('name');
$imgLogout = PUBLIC_URI . 'images/logout.png';
$logout = BASE_URL . "logout.php";
$unLogin = <<<EOT
<li class="nav-item">
    <a class="nav-link" href="./login.php">
        Login <span class="sr-only">(current)</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="./signup.php">
        Signup <span class="sr-only">(current)</span>
    </a>
</li>
EOT;
$login = <<<EOT
<li class="nav-item" id="infoUser">
    <span> Xin chào 
        <a href="#">$name<a/>
    </span>
    <a href="./logout.php" class="ml-4">
        <img src="$imgLogout" alt="logout">
    </a>
</li>
EOT;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lí Nhân Viên</title>

    <link rel="stylesheet" href="<?echo PUBLIC_URI . 'css/dist/styles.css'?>">

    <!--    Bootstrap 4 CDN -->

    <!--    CSS Bootstrap   -->
    <link rel="stylesheet" href="<?echo PUBLIC_URI . 'node_modules/bootstrap/dist/css/bootstrap.min.css'?>" crossorigin="anonymous" />
    <!--    JS Bootstrap   -->
    <script src="<?echo PUBLIC_URI . 'node_modules/jquery/dist/jquery.min.js'?>" crossorigin="anonymous"></script>
    <script src="<?echo PUBLIC_URI . 'node_modules/popper.js/dist/umd/popper.min.js'?>" crossorigin="anonymous"></script>
    <script src="<?echo PUBLIC_URI . "node_modules/bootstrap/dist/js/bootstrap.min.js"?>" crossorigin="anonymous"></script>

    <!-- GG Font -->
    <link href="https://fonts.googleapis.com/css2?family=Chonburi&display=swap" rel="stylesheet">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light sticky-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="./index.php">
                    <img src="<?php echo PUBLIC_URI . 'images/HRManager.jpg'?>" alt="icon" />
                </a>
                
                <button 
                    class="navbar-toggler"
                    type="button"
                    data-toggle="collapse"
                    data-target="#navbarNav"
                    aria-controls="navbarNav"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
                >
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav mr-auto" id="left-side">
                        <li class="nav-item active">
                            <a class="nav-link" href="./index.php">Home <span class="sr-only">(current)</span></a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ml-auto" id="right-side">
                    <?php
                        if (Auth::isLogin() !== false) {
                            echo $login;
                        } else {
                            echo $unLogin;
                        }
                    ?>

                    </ul>
                </div>
            </div>
        </nav>
    </header>