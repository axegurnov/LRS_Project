<?php
namespace app\controllers;

use app\core\Controller;

class Api extends GetModelController
{
    protected $nameModel = '';
    protected $args = null;
    protected $requestBody = null;

    protected function getAction()
    {
        $method = $_SERVER['REQUEST_METHOD']; // get put post delete
        switch ($method) {
            case 'GET':
                if($this->args['id']){
                    return 'viewAction';
                }
                return 'showAllAction';
            case 'POST':
                return 'createAction';
            case 'PUT':
                parse_str(file_get_contents('php://input'), $this->requestBody);
                return 'updateAction';
            case 'DELETE':
                parse_str(file_get_contents('php://input'), $this->requestBody);
                return 'deleteAction';
            default:
                return null;
        }
    }

    public function indexAction($args = null)
    {
        if($args) {
            $this->args = $args;
        }
        $action = $this->getAction();

        if(method_exists($this, $action)) {
            return $this->{$action}();
        }
        $this->response('Method Not Allowed', 405);
    }

    public function viewAction()
    {
        $record = $this->getRecord($this->args['id']);
        if($record) {
            return $this->response($record, 200);
        }
        return $this->response('Record wasnt found', 404);
    }

    protected function showAllAction()
    {
        $records = $this->model->getAllRecords();
        if(!empty($records)) {
            return $this->response($records, 200);
        }
        if($records === null) {
            return $this->response('Something going wrong', 404);
        }
        $this->response('Table is empty', 404);
    }

    public function createAction()
    {
        // получаем названия столбцов в таблице
        $tables = $this->model->getFields($this->model->table)['array'];
        // создаем асоциативный массив, заполненный столбцами таблицы [key => value]
        $data_field = [];
        foreach($_POST as $key => $value) {
            if($key == 'id') {
                unset($_POST[$key]);
                continue;
            }
            $data_field[$key] = $value;
        }
        //  проверка если переданный столбец существует в таблице
        //  заносит в массив данные для добавления
        $toFillData = [];
        foreach($data_field as $key => $value) {
            foreach ($tables as $table) {
                if($key == $table) {
                    $toFillData[$key] = $value;
                }
            }
        }
        if (!empty($toFillData)) {
            $this->model->setValues($toFillData);
            $this->model->addRecord();
            return $this->response('Object was created',200);
        }
        $this->response('Failed create', 404);
    }

    public function deleteAction()
    {
        // записывает строку с переданными данными в массив $_DELETE
        $id = $this->requestBody['id'];
        if(!empty($id)) {
            $record = $this->getRecord($id);
            if($record) {
                $this->model->dropRecord($id);
                return $this->response('Record was deleted', 200);
            }
            return $this->response('Record wasnt found', 404);
        }
        $this->response('Failed delete', 404);
    }

    public function updateAction()
    {
        $_PUT = $this->requestBody;
        // записывает строку с переданными данными в массив $_PUT
        $data_field = [];
        if(!empty($_PUT['id'])) {
            $data_field['id'] = $_PUT['id'];
            $record = $this->getRecord($_PUT['id']);
        }
        if(!$record) {
            return $this->response('Record wasnt found',404);
        }
        // создаем асоциативный массив, заполненный столбцами таблицы [key => value]
        $tables = $this->model->getFields($this->model->table)['array'];
        foreach($_PUT as $key => $value) {
            $data_field[$key] = $value;
        }
        $toFillData = [];
        foreach($data_field as $key => $value) {
            foreach ($tables as $table) {
                if($key == $table) {
                    $toFillData[$key] = $value;
                }
            }
        }

        if (!empty($_PUT['id'])) {
            $this->model->setValues($toFillData);
            $this->model->updateRecord($_PUT['id']);
            return $this->response('Record was updated',200);
        }
        $this->response('Failed update',404);
    }

    protected function response($data, $status = 500)
    {
        header('Content-type: application/json');
        header("HTTP/1.1 " . $status . " " . $this->requestStatus($status));
        echo $this->convertToJson($data);
    }

    private function requestStatus($code)
    {
        $status = array(
            200 => 'OK',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            500 => 'Internal Server Error',
        );
        return ($status[$code]) ?? $status[500];
    }

    private function getRecord($id)
    {
        $str = 'id = ' . $id;
        return $this->model->select($str);
    }
}