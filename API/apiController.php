<?php
class apiController
{
    public function __construct()
    {
    }

    public static function checkRequest()
    {
        if (Input::hasRequest('category')) {
            $category = Input::request('category');
            switch ($category) {
                case 'employee': {
                    require_once("./controllers/employeeController.php");
                    break;
                }
                case 'job': {
                    if (Input::hasRequest('id')) {
                        require_once("./controllers/jobController.php");
                    } else {
                        echo "Don't have ID parameter";
                    }
                break;
                }
                
                default:
                    echo "Don't Have Category";
                    break;
            }
        }
    }
}
