<?php
require_once "./autoload/autoload.php";

if (LOGIN_REQUIREMENT === true) {
    if (Auth::isLogin() === false) {
        Redirect::url("login.php");
    }
} else {
    require_once("./views/homeView.php");
}
