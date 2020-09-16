<?php
require_once("./autoload/autoload.php");
class employeeModel
{
    public function __construct()
    {
    }
    /* CRUD */
    public static function create()
    {
        /*
            $_POST: mm/dd/yyyy
        */
        $condition = isset($_POST['username']) &&
                isset($_POST['password']) &&
                isset($_POST['name']) &&
                isset($_POST['address']) &&
                isset($_POST['birthday']) &&
                isset($_POST['level']);
                
        if ($condition) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $name = $_POST['name'];
            $address = $_POST['address'];
            $birthday = formatDate($_POST['birthday']);
            $level = $_POST['level'];
            
            $result = Auth::signup($username, $password, $name, $address, $birthday, $level);
            if ($result === false) {
                return false;
            }
            
            HTTP::sendResponse(200, "Create Account Successful");
        } else {
            HTTP::sendResponse(500, "Don't have Request");
        }
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
                    print_r(json_encode($arrData));
                }
            }
        } else {
            HTTP::sendResponse(500, "Don't have Request");
        }
    }

    public static function update()
    {
        $condition = isset($_POST['username']) &&
                isset($_POST['level']) &&
                isset($_POST['name']) &&
                isset($_POST['address']) &&
                isset($_POST['birthday']);
                
        if ($condition) {
            $username = $_POST['username'];
            $name = $_POST['name'];
            $level = $_POST['level'];
            $name = $_POST['name'];
            $address = $_POST['address'];
            $birthday = formatDate($_POST['birthday']);
            

            $data = array(
                    'name' => $name,
                    'level' => $level,
                    'name' => $name,
                    'address' => $address,
                    'birthday' => $birthday
                );

            $result = Database::update(self::$table, $data, $username);
            echo $result;
        } else {
            echo "No Data";
        }
    }

    public static function delete()
    {
        if (isset($_POST['username'])) {
            $username = $_POST['username'];
            $result = Database::delete(self::$table, $username);
            echo $result;
        } else {
            echo "No Data";
        }
    }
}
