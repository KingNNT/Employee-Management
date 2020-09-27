<?php
class Database
{
    private static $connection = null;

    public function __construct()
    {
        self::connect();
    }

    private static function connect()
    {
        self::$connection = new mysqli(DB['host'], DB['username'], DB['password'], DB['database']);

        mysqli_set_charset(self::$connection, "utf8");
        if (self::$connection->connect_error) {
            die("Connection failed: " . $self::$connection->connect_error);
        }
    }

    public static function queryOne($sql)
    {
        $query = self::$connection->query($sql);

        if (is_object($query)) {
            if ($query->num_rows > 0) {
                while ($row = $query->fetch_object()) {
                    $data[] = $row;
                }
                return $data[0];
            }
        } else {
            return false;
        }
    }

    public static function query($sql)
    {
        $query = self::$connection->query($sql);

        if (is_object($query)) {
            if ($query->num_rows > 0) {
                while ($row = $query->fetch_object()) {
                    $data[] = $row;
                }
                /* $data is an array*/
                return $data;
            }
        } else {
            return false;
        }
    }

    public static function lastId()
    {
        return self::$connection->insert_id;
    }

    public static function create($table, $data)
    {
        if (is_array($data)) {
            $dataKey = implode(',', array_keys($data));
            $dataValue = [];
            foreach ($data as $value) {
                $dataValue[] = "'$value'";
            }
            $dataValue = implode(',', $dataValue);
            $sql = "INSERT INTO $table($dataKey) VALUES ($dataValue) ";

            return self::$connection->query($sql);
        } else {
            return false;
        }
    }

    public static function read($field, $table)
    {
        if (is_array($field)) {
            foreach ($field as $value) {
                $arrField[] = "$value";
            }
            $arrField = implode(',', $arrField);
            $sql = "SELECT $arrField FROM $table";

            return self::$connection->query($sql);
        }
    }

    public static function update($table, $data, $id)
    {
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                $dataUpdate[] = "$key = '$value'";
            }

            $dataUpdate = implode(',', $dataUpdate);

            $sql = "UPDATE $table SET $dataUpdate WHERE id = '$id'";

            return self::$connection->query($sql);
        } else {
            return false;
        }
    }

    public static function delete($table, $id)
    {
        $sql = "DELETE FROM $table WHERE id = '$id'";

        return self::$connection->query($sql);
    }

    /*
        Function  find return a list object
    */
    public function find($table, $field, $value)
    {
        $sql = "SELECT * FROM $table WHERE $field = '$value'";

        $dataTable = self::$connection->query($sql);

        $data = [];
        if ($dataTable->num_rows > 0) {
            while ($row = $dataTable->fetch_object()) {
                array_push($data, $row);
            }
 
            return $data;
        } else {
            return false;
        }
    }

    // public function findBanner($table, $status)
    // {
    //     $sql = "SELECT * FROM $table WHERE trang_thai = '$status'";
    //     $dataTable = $this->connection->query($sql);
    //     if ($dataTable->num_rows > 0) {
    //         while ($row = $dataTable->fetch_object()) {
    //             $data = $row;
    //         }
    //     } else {
    //         $data = 'ID Không tồn tại !';
    //     }
    //     return $data;
    // }

    // public function all($table)
    // {
    //     $sql = "SELECT * FROM $table";
    //     $dataTable = $this->connection->query($sql);
    //     $data = [];
    //     if ($dataTable->num_rows > 0) {
    //         while ($row = $dataTable->fetch_object()) {
    //             $data[] = $row;
    //         }
    //     } else {
    //         $data = 'Không có bản ghi nào !';
    //     }
    //     return $data;
    // }

    // public function CountRecord($table, $where = [])
    // {
    //     if (empty($where)) {
    //         $sql = "SELECT count(id) as count FROM $table";
    //         $dataTable = $this->connection->query($sql);
    //         if ($dataTable->num_rows > 0) {
    //             while ($row = $dataTable->fetch_object()) {
    //                 $data = $row;
    //             }
    //         } else {
    //             $data = 'ID Không tồn tại !';
    //         }
    //     } else {
    //         foreach ($where as $key => $value) {
    //             $where = $key .= " = $value ";
    //         }

    //         $sql = "SELECT count(id) as count FROM $table Where $where ";
    //         $dataTable = $this->connection->query($sql);
    //         if ($dataTable->num_rows > 0) {
    //             while ($row = $dataTable->fetch_object()) {
    //                 $data = $row;
    //             }
    //         } else {
    //             $data = 'ID Không tồn tại !';
    //         }
    //     }

    //     return $data;
    // }

    // public function CountRecordLike($table, $where = [])
    // {
    //     foreach ($where as $key => $value) {
    //         $where = $key .= " LIKE '$value' ";
    //     }

    //     $sql = "SELECT count(id) as count FROM $table Where $where ";
    //     $dataTable = $this->connection->query($sql);
    //     if ($dataTable->num_rows > 0) {
    //         while ($row = $dataTable->fetch_object()) {
    //             $data = $row;
    //         }
    //     } else {
    //         $data = 'ID Không tồn tại !';
    //     }

    //     return $data;
    // }
    // public function getInsertID()
    // {
    //     return $this->connection->insert_id;
    // }
}
