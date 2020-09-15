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
        $condition = isset($_POST['id']) &&
                isset($_POST['password']) &&
                isset($_POST['level']) &&
                isset($_POST['name']) &&
                isset($_POST['address']) &&
                isset($_POST['birthday']);
                
        if ($condition) {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $password = $_POST['password'];
            $level = $_POST['level'];
            $name = $_POST['name'];
            $address = $_POST['address'];
            $birthday = $_POST['birthday'];

            $data = array(
                    'id' => $id,
                    'name' => $name,
                    'password' => $password,
                    'level' => $level,
                    'name' => $name,
                    'address' => $address,
                    'birthday' => $birthday
                );
        } else {
            $data = "No Data";
        }
        print_r($data);
        // $DB::create("employee", $data);
    }
    public static function read()
    {
        $DB = new Database();
        $sql = "SELECT id, level, name, address, birthday FROM employee ";

        $data = $DB->query($sql);

        if ($data !== false) {
            if (is_array($data)) {
                print_r(json_encode($data));
            }
        }
    }
}
