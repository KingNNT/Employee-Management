<?php
require_once "./autoload/autoload.php";

Session::destroy();
Redirect::url("login.php");
