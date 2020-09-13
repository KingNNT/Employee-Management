<?php
class RestfulAPI
{
    protected $method = '';
    protected $endpoint = '';
    protected $params = array();
    protected $file = null;

    public function __construct()
    {
        $this->_input();
        $this->_process_api();
    }

    private function _input()
    {
        header("Access-Control-Allow-Orgin: *");
        header("Access-Control-Allow-Methods: *");

        $this->params   = explode('/', trim($_SERVER['PATH_INFO'], '/'));
        $this->endpoint = array_shift($this->params);

        $method         = $_SERVER['REQUEST_METHOD'];
        $allow_method   = array('GET', 'POST', 'PUT', 'DELETE');

        if (in_array($method, $allow_method)) {
            $this->method = $method;
        }

        switch ($this->method) {
            case 'POST':
                $this->params = $_POST;
            break;

            case 'GET':
            break;

            case 'PUT':
                $this->file    = file_get_contents("php://input");
            break;

            case 'DELETE':
            break;

            default:
                $this->response(500, "Invalid Method");
            break;
        }
    }

    private function _process_api()
    {
        if (method_exists($this, $this->endpoint)) {
            $this->{$this->endpoint}();
        } else {
            $this->response(500, "Unknown endpoint");
        }
    }

    protected function response($status_code, $data = null)
    {
        header($this->_build_http_header_string($status_code));
        header("Content-Type: application/json");
        echo json_encode($data);
        die();
    }

    private function _build_http_header_string($status_code)
    {
        $status = array(
            200 => 'OK',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            500 => 'Internal Server Error'
        );
        return "HTTP/1.1 " . $status_code . " " . $status[$status_code];
    }
}
