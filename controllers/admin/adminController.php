<?php
        
class adminController
{
    public function __construct()
    {
        self::checkAuth();
    }
    public static function checkAuth()
    {
        if (!Auth::isAdmin()) {
            Redirect::url("index.php");
        }
    }
    public static function search()
    {
        if (isset($_GET["id"])) {
            $id = $_GET["id"];

            Session::set("searchID", $id);
            $response = employeeModel::search($id);
                        
            if ($response !== false) {
                return $response;
            /* $response is a object */
            } else {
                return false;
            }
        }
    }
    
    
    public static function edit()
    {
        $_POST["id"] = Session::get("searchID");
        $resultEdit = employeeModel::update();
    }
    
    public static function remove()
    {
        $_POST["id"] = Session::get("searchID");
        $resultRemove = employeeModel::delete();
    }
}
