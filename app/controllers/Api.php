<?php


namespace app\controllers;

use app\core\Controller;

class Api extends Controller
{
    protected $nameModel = '';
    protected $action = '';
    protected $requestMethod = '';
    protected $args = null;

    public function __construct($route)
    {
        header('Content-type: application/json');
        $this->route = $route;
        //$this->action = $route['action'];
        $this->model = $this->getModel($this->nameModel);
        $this->requestMethod = $_SERVER['REQUEST_METHOD'];
    }

    protected function getAction($args = null)
    {
        $method = $this->requestMethod;
        switch ($method) {
            case 'GET':
                if($args){
                    return $this->action = 'viewAction';
                } else {
                    return $this->action = 'showAllAction';
                }
                break;
            case 'POST':
                return $this->action = 'createAction';
                break;
            case 'PUT':
                return $this->action = 'updateAction';
                break;
            case 'DELETE':
                return $this->action = 'deleteAction';
                break;
            default:
                return null;
        }
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