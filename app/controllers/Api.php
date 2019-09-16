<?php
namespace app\controllers;

use app\core\Controller;

class Api extends GetModelController
{
    protected $nameModel = '';
    protected $args = null;

    protected function getAction()
    {
        $method = $_SERVER['REQUEST_METHOD']; // get put post delete
        switch ($method) {
            case 'GET':
                if($this->args){
                    return 'viewAction';
                }
                return 'showAllAction';
            case 'POST':
                return 'createAction';
            case 'PUT':
                return 'updateAction';
            case 'DELETE':
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
        $this->convertToJson('Method Not Allowed', 405);
    }

    public function viewAction()
    {
        if(!empty($this->args['id'])) {
            $str = 'id = ' . $this->args['id'];
            $record = $this->model->select($str);
            if($record) {
                return $this->response($this->model->select($str), 200);
            }
            return $this->response('Record wasnt found', 404);
        }
        $this->response('id arg is empty or wrong', 404);
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
        parse_str(file_get_contents('php://input'), $_DELETE);
        if(!empty($_DELETE['id'])) {
            $str = 'id = ' . $_DELETE['id'];
            $record = $this->model->select($str);
            if($record) {
                $id = $_DELETE['id'];
                $this->model->dropRecord($id);
                return $this->response('Record was deleted', 200);
            } else {
                return $this->response('Record wasnt found', 404);
            }
        }
        $this->response('Failed delete', 404);
    }

    public function updateAction()
    {
        // записывает строку с переданными данными в массив $_PUT
        parse_str(file_get_contents('php://input'), $_PUT);
        $data_field = [];
        if(!empty($_PUT['id'])) {
            $data_field['id'] = $_PUT['id'];
            $str = 'id = ' . $_PUT['id'];
            $record = $this->model->select($str);
        }
        if(!$record) {
            return $this->response('Record wasnt found',404);
        }

        $tables = $this->model->getFields($this->model->table)['array'];
        // создаем асоциативный массив, заполненный столбцами таблицы [key => value]
        $data_field = [];
        foreach($_PUT as $key => $value) {
            $data_field[$key] = $value;
        }

        if (!empty($_PUT['id'])) {
            $this->model->setValues($data_field);
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