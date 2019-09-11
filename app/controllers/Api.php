<?php


namespace app\controllers;

use app\core\Controller;

class Api extends Controller
{
    protected $requestMethod = '';
    protected $nameModel = '';

    public function __construct($route)
    {
        header('Content-type: application/json');

        $this->route = $route;
        debug($this->route);

        $this->model = $this->getModel($this->nameModel);
        $this->requestMethod = $_SERVER['REQUEST_METHOD'];
    }

    protected function response($data, $status = 500)
    {
        header("HTTP/1.1 " . $status . " " . $this->requestStatus($status));
        echo $this->convertToJson($data);
    }

    private function requestStatus($code) {
        $status = array(
            200 => 'OK',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            500 => 'Internal Server Error',
        );
        return ($status[$code]) ?? $status[500];
    }



}