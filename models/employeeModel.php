<?php
require_once("./autoload/autoload.php");
class employeeModel
{
    private static $table = "employee";
    public function __construct()
    {
    }
    /* CRUD */
    public static function create()
    {
        /*
            $_POST: mm/dd/yyyy
        */
        $condition = isset($_POST['id']) &&
                isset($_POST['password']) &&
                isset($_POST['level']) &&
                isset($_POST['name']) &&
                isset($_POST['address']) &&
                isset($_POST['birthday']);
                
        if ($condition) {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $password = md5($_POST['password']);
            $level = $_POST['level'];
            $name = $_POST['name'];
            $address = $_POST['address'];
            $birthday = formatDate($_POST['birthday']);
            

            $data = array(
                    'id' => $id,
                    'name' => $name,
                    'password' => $password,
                    'level' => $level,
                    'name' => $name,
                    'address' => $address,
                    'birthday' => $birthday
                );
            $DB = new Database();
            $result = $DB->create(self::$table, $data);
            echo $result;
        } else {
            echo "No Data";
        }
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

    public static function update()
    {
        $condition = isset($_POST['id']) &&
                isset($_POST['level']) &&
                isset($_POST['name']) &&
                isset($_POST['address']) &&
                isset($_POST['birthday']);
                
        if ($condition) {
            $id = $_POST['id'];
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
        } else {
            $data = "No Data";
        }
        $DB = new Database();
        $result = $DB->update(self::$table, $data, $id);
        echo $result;
    }

    public static function delete()
    {
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            $DB = new Database();
            $result = $DB->delete(self::$table, $id);
            echo $result;
        } else {
            echo "No Data";
        }
    }
}
