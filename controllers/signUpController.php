<?php
class signUpController
{
    public static function index($title = "")
    {
        $title = "Sign Up";
        
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
                if ($result == true) {
                    Redirect::url("login.php");
                    return true;
                } else {
                    return false;
                }
            } else {
                return -1;
            }
        }
    }
}
