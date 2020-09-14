<?php
require_once("./autoload/autoload.php");
class userModel
{
    public function __construct()
    {
    }
    public static function getEmployee()
    {
        $DB = new Database();
        $sql = "SELECT * FROM employee ";

        $data = $DB->query($sql);

        if ($data !== false) {
            if (is_array($data)) {
                print_r(json_encode($data));
            }
        }
    }
}
