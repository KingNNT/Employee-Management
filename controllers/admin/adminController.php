<?php
        
class AdminController
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
        if (Input::hasGet('idEmployee')) {
            $id = Input::get('idEmployee');

            Session::set("searchID", $id);
            $response = EmployeeModel::search();
                                    
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
        $resultEdit = EmployeeModel::update();
        return $resultEdit;
    }
    
    public static function remove()
    {
        $_POST["id"] = Session::get("searchID");
        $resultRemove = EmployeeModel::delete();
        return $resultRemove;
    }
}
