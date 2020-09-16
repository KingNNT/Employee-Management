<?php

class Auth
{
    public static function isUser()
    {
        if (Session::get('level') !== "1") {
            return true;
        }
        return false;
    }

    public static function isAdmin()
    {
        if (Session::get('level') === "1") {
            return true;
        }
        return false;
    }
    public static function isLogin()
    {
        if (Session::get('id') !== "") {
            return Session::get('id');
        }
        return false;
    }

    public static function login($username, $password)
    {
        if (Input::hasPost('login')) {
            $sql = "SELECT * FROM account WHERE username = $username AND password = '$password'";

            // $data is a object
            $data = Database::queryOne($sql);

            if ($data == null) {
                return false;
            } else {
                if ($data !== false) {
                    if (is_object($data)) {
                        Session::set('id', $data->id);
                        Session::set('username', $data->username);

                        $table = "information";
                        $field = "id";
                        $value = $data->id;
                        $info = Database::find($table, $field, $value);

                        if ($info === false) {
                            return false;
                        } else {
                            Session::set('name', $info->name);
                            Session::set('address', $info->address);
                            Session::set('birthday', $info->birthday);
                            Session::set('level', $info->level);
                            Redirect::url('index.php');
                            return true;
                        }
                    }
                } else {
                    return false;
                }
            }
        }
    }

    public static function signup($username, $password, $name, $address, $birthday, $level)
    {
        $table = "account";
        $field = "username";
        $value = $username;
        $result = Database::find($table, $field, $value);
        if ($result === false) {
            return false;
        } else {
            $arrInfo = array(
                "name" => $name,
                "address" => $address,
                "birthday" => $birthday,
                "level" => $level,
            );
            $table = "infomation";

            $result = Database::create($table, $arrInfo);

            $sql = "SELECT id FROM $table ORDER BY id DESC LIMIT 1;";
            $result = Database::query($sql);
            $id =  $result[0]->id;

            $password = md5($password);
            $arrAccount = array(
            "id"=> $id,
            "username" => $username,
            "password" => $password
        );

            $table = "account";
            $result = Database::create($table, $arrAccount);
        }
    }
}
