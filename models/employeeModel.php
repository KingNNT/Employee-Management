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
            return true;
        } else {
            return -1;
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
        $condition = isset($_POST['id']) &&
                isset($_POST['name']) &&
                isset($_POST['address']) &&
                isset($_POST['birthday']) &&
                isset($_POST['level']);
                
        if ($condition) {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $address = $_POST['address'];
            $birthday = formatDate($_POST['birthday']);
            $level = $_POST['level'];

            $data = array(
                    'id' => $id,
                    'name' => $name,
                    'address' => $address,
                    'birthday' => $birthday,
                    'level' => $level,
                );
            $table = "information";
            $result = Database::update($table, $data, $id);
            if ($result === false) {
                return false;
            } else {
                return true;
            }
        } else {
            return -1;
        }
    }

    public static function delete()
    {
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            $table = "information";
            $result = Database::delete($table, $id);
            if ($result === false) {
                return false;
            } else {
                return true;
            }
        } else {
            return -1;
        }
    }

    public static function search()
    {
        if (isset($_POST['id'])) {
            $table = "information";
            $field = "id";
            $value = $_POST['id'];

            $result = Database::find($table, $field, $value);
            if ($result !== false) {
                if (is_object($result)) {
                    $result = json_encode($result);
                    return $result;
                } else {
                    return false;
                }
            }
        } else {
            return -1;
        }
    }
}
