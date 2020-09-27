<?php
require_once("./autoload/autoload.php");
class employeeModel
{
    private static $id;
    private static $username;
    private static $password;
    private static $name;
    private static $address;
    private static $birthday;
    private static $level;

    public function __construct()
    {
        self::loadData();
    }

    public static function loadData()
    {
        self::$id = Input::request('id');
        self::$username = Input::post('username');
        self::$password = Input::post('password');
        self::$name = Input::post('name');
        self::$address = Input::post('address');
        if (Input::hasPost('birthday')) {
            self::$birthday = formatDate(Input::post('birthday'));
        }
        self::$level = Input::post('level');
    }
    /* CRUD */
    public static function create()
    {
        self::loadData();
        $result = Auth::signup(self::$username, self::$password, self::$name, self::$address, self::$birthday, self::$level);
        
        return $result !== false;
    }
    
    public static function read()
    {
        $field = array(
            'id',
            'name',
            'address',
            'birthday',
            'level',
        );

        $table = "information";
        $data = Database::read($field, $table);

        if ($data !== false) {
            if (is_object($data)) {
                if ($data->num_rows > 0) {
                    while ($row = $data->fetch_object()) {
                        $arrData[] = $row;
                    }
                    return $arrData;
                } else {
                    return false;
                }
            }
        } else {
            return -1;
        }
    }

    public static function update()
    {
        self::loadData();
        if (self::$id !== null) {
            $data = array(
                    'name' => self::$name,
                    'address' => self::$address,
                    'birthday' => self::$birthday,
                    'level' => self::$level,
                );
            $table = "information";
            $id = self::$id;

            $result = Database::update($table, $data, $id);

            return $result !== false;
        } else {
            return -1;
        }
    }

    public static function delete()
    {
        if (Input::hasGet('id')) {
            $table = "information";
            $id = Input::get('id');
            $result = Database::delete($table, $id);
            return $result !== false;
        } else {
            return -1;
        }
    }

    public static function search()
    {
        if (Input::hasGet('id')) {
            $table = "information";
            $field = "id";
            $value = Input::get('id');

            $result = Database::find($table, $field, $value);


            /* $result is an array*/
            if ($result !== false) {
                return $result[0];
            } else {
                return false;
            }
        } else {
            return -1;
        }
    }
}
