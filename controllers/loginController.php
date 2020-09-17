<?php
class loginController
{
    public static function index(&$title = "")
    {
        $title = 'Login';
        if (Auth::isLogin() !== false) {
            Redirect::url("index.php");
        } else {
            if (Input::hasPost('login')) {
                $id = Input::post('username');
                $password = md5(Input::post('password'));

                if (Auth::login($id, $password) === false) {
                    return false;
                } else {
                    require_once("./views/loginView.php");
                    return true;
                }
            }
        }
    }
}
