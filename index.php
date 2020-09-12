<?php
require_once "./autoload/autoload.php";

if (Auth::isLogin() === false) {
    Redirect::url("login.php");
}

require_once "./layouts/page/header.php";
?>

<div class="content">

</div>


<?php
require_once "./layouts/page/footer.php";
?>