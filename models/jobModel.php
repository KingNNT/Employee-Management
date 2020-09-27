<?php
    require_once "./autoload/autoload.php";
    class jobModel
    {
        private static $id;
        private static $name;
        private static $expectedCompletionDate;
        private static $actualCompletionDate;
        private static $isDone;

        public function __construct()
        {
            self::loadData();
        }

        public function loadData()
        {
            self::$id = Input::request('id');
            self::$name = Input::request('name');

            if (Input::hasRequest('expectedCompletionDate')) {
                self::$expectedCompletionDate = formatDate(Input::request('expectedCompletionDate'));
            }
            if (Input::hasRequest('actualCompletionDate')) {
                self::$actualCompletionDate = formatDate(Input::request('actualCompletionDate'));
            }
            self::$isDone = Input::request('isDone');
        }
        
        /* CRUD */
        public static function create()
        {
            $data = array(
                    "id" => self::$id,
                    "name" => self::$name,
                    "expected_completion_date" => self::$expectedCompletionDate,
                    "actual_completion_date" => self::$actualCompletionDate,
                    "is_done" => self::$isDone,
                );

            $table = "job";
            
            $result = Database::create($table, $data);

            return $result !== false;
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
            $data = array(
                    "name" => $name,
                    "expected_completion_date" => $expectedCompletionDate,
                    "actual_completion_date" => $actualCompletionDate,
                    "is_done" => $isDone,
                );

            $table = "job";
            
            $result = Database::update($table, $data, $id);

            return $result !== false;
        }
        public static function delete()
        {
        }
        public static function search()
        {
            if (self::$id != null) {
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
