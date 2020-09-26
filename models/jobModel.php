<?php
    require_once "./autoload/autoload.php";
    class jobModel
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
            $condition = isset($_POST['id']) &&
                isset($_POST['name']) &&
                isset($_POST['expectedCompletionDate']) &&
                isset($_POST['actualCompletionDate']) &&
                isset($_POST['isDone']);
                
            if ($condition) {
                $id = $_POST['id'];
                $name = $_POST['name'];
                $expectedCompletionDate = formatDate($_POST['expectedCompletionDate']);
                $actualCompletionDate = formatDate($_POST['actualCompletionDate']);
                $isDone = $_POST['isDone'];

                $data = array(
                    "id" => $id,
                    "name" => $name,
                    "expected_completion_date" => $expectedCompletionDate,
                    "actual_completion_date" => $actualCompletionDate,
                    "is_done" => $isDone,
                );

                $table = "job";
            
                $result = Database::create($table, $data);
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
            'expected_completion_date',
            'actual_completion_date',
            'is_done',
        );
            $table = "job";
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
            /*
                $_POST: mm/dd/yyyy
            */
            $condition = isset($_POST['id']) &&
                isset($_POST['name']) &&
                isset($_POST['expectedCompletionDate']) &&
                isset($_POST['actualCompletionDate']) &&
                isset($_POST['isDone']);
                
            if ($condition) {
                $id = $_POST['id'];
                $name = $_POST['name'];
                $expectedCompletionDate = formatDate($_POST['expectedCompletionDate']);
                $actualCompletionDate = formatDate($_POST['actualCompletionDate']);
                $isDone = $_POST['isDone'];

                $data = array(
                    "name" => $name,
                    "expected_completion_date" => $expectedCompletionDate,
                    "actual_completion_date" => $actualCompletionDate,
                    "is_done" => $isDone,
                );

                $table = "job";
            
                $result = Database::update($table, $data, $id);
                if ($result === false) {
                    return false;
                }
                return true;
            } else {
                return -1;
            }
        }
        public static function delete()
        {
        }
        public static function search()
        {
            if (isset($_GET['id'])) {
                $table = "job";
                $field = "id";
                $value = $_GET['id'];

                $result = Database::find($table, $field, $value);
                /* $result is a array */
                if ($result !== false) {
                    return $result;
                }
            } else {
                return -1;
            }
        }
    }
