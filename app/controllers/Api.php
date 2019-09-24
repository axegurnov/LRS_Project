<?php

namespace app\controllers;

use app\core\Controller;

class Api extends GetModelController
{
    protected $nameModel = '';
    protected $args = NULL;
    protected $requestBody = NULL;

    protected $testRequestBody = ''; // временное хранение данных из тела запроса
    protected $testReqData = []; // хранит асоциативный массив key => value [["actor"] => "id"]

    protected function getAction()
    {
        $method = $_SERVER['REQUEST_METHOD']; // get put post delete
        switch ($method) {
            case 'GET':
                if (!empty($this->args)) {
                    return 'viewAction';
                }
                return 'showAllAction';
            case 'POST':
                $this->requestBody = file_get_contents('php://input');
                return 'createAction';
            case 'PUT':
                $this->requestBody = file_get_contents('php://input');
                return 'updateAction';
            case 'DELETE':
                $this->requestBody = file_get_contents('php://input');
                return 'deleteAction';
            default:
                return NULL;
        }
    }

    public function indexAction($args = NULL)
    {
        $api_token = NULL;
        if (isset($_SERVER['HTTP_AUTHORIZATION'])) {
            $this->args = $args;
            $temp = $_SERVER['HTTP_AUTHORIZATION'];
            $api_token = str_replace('Basic ', '', $temp);
        }
        $predictor = "api_token='" . $api_token . "'";
        $user = $this->model->getValueTableApi("lrs_client", $predictor);
        if (!empty($user)) {
            $action = $this->getAction();
        } else {
            return $this->response('401 Unauthorized', 401);
        }
        if (method_exists($this, $action)) {
            return $this->{$action}();
        }
        $this->convertToJson('Method Not Allowed', 405);
    }

    public function viewAction()
    {
        if (!empty($this->args)) {
            extract($this->args);
        }
        if (isset($agent)) {
           $agent = $this->args['agent'] = $this->convertFromJson($agent)['login'];

        }
        if (isset($id)) {
            $record = $this->getRecord($id);
        }
        if (isset($record)) {
            return $this->response($record, 200);
        }
        if (isset($verb)) {
            $predictor = "verb = '$verb'";
            $resp = $this->model->getMultipleByPredictor($predictor);
            if ($resp == null) {
                return $this->response('Not found');
            }
            return $this->response($resp, 200);
        }
        if (isset($since) && isset($until)) {
            $predictor = "create_date BETWEEN " . $since . " AND " . $until;
            $resp = $this->model->getMultipleByPredictor($predictor);
            if ($resp == null) {
                return $this->response('Not found');
            }
            return $this->response($resp, 200);
        }
        if (isset($offset) && isset($limit)) {
            $query = $this->model->pagination($offset, $limit);
            $resp = [];
            foreach ($query as $value) {
                $resp[] = $value;
            }
            if ($resp == null) {
                return $this->response('Not found');
            }
            return $this->response($resp, 200);
        }
        if (isset($activity)) {
            $predictor = "activity = '$activity'";
            return $this->response($this->model->getMultipleByPredictor($predictor), 200);
        }

        //TEST Activity/State GET Show
        if (isset($activityId) && isset($agent) && isset($stateId)) {
            $query = $this->model->showState($this->args);
            if (!isset($query)) {
                return $this->response('Not found');
            }
            //debug($query);
            $resp = [];
            foreach ($query as $value) {
                $resp[] = $value;
            }
            return $this->response($resp, 200);

        }
        //TEST Activity/State GET Index
        if (isset($activityId) && isset($agent)) {
            $query = $this->model->indexState($this->args);
            if (!isset($query)) {
                return $this->response('Not found');
            }
            //debug($query);
            $resp = [];
            foreach ($query as $value) {
                $resp[] = $value;
            }
            return $this->response($resp, 200);

        }

        if (isset($agent)) {
            $query = $this->model->statementsJoinClients($agent);
            $body = [];
            foreach($query as $value) {
                $body[] = $value;
            }
            if (empty($body)) {
                return $this->response('Not found');
            }
            $resp = [];
            foreach ($query as $value) {
                $resp[] = $value;
            }
            return $this->response($resp, 200);
        }
        return $this->response('Record wasnt found', 404);
    }

    protected function showAllAction()
    {
        $records = $this->model->getAllRecords();
        if (!empty($records)) {
            return $this->response($records, 200);
        }
        if ($records === NULL) {
            return $this->response('Something going wrong', 404);
        }
        $this->response('Table is empty', 404);
    }

    public function createAction()
    {
        $data = $this->convertFromJson($this->requestBody);
        // получаем названия столбцов в таблице
        $tables = $this->model->getFields($this->model->table)['array'];

        // создаем асоциативный массив, заполненный столбцами таблицы [key => value]
        $data_field = [];
        foreach ($data as $key => $value) {
            foreach($value as $v) {
                if($key == 'actor') {
                    $agent = $this->model->getClientLoginById($v);
                    foreach($agent as $login) {
                        $data_field['lrs_client_id'] = $login['id'];
                    }
                }
                if($key == 'verb') {
                    $data_field['verb_id'] = $v;
                }
                if($key == 'object') {
                    $data_field['activity_id'] = $v;
                }
                if($key == 'lrs') {
                    $data_field['lrs_id'] = $v;
                }
            }
        }
        //  проверка если переданный столбец существует в таблице
        //  заносит в массив данные для добавления
        $toFillData = [];
        foreach ($data_field as $key => $value) {
            foreach ($tables as $table) {
                if ($key == $table) {
                    $toFillData[$key] = $value;
                }
            }
        }
        if (!empty($toFillData)) {
            $this->model->setValues($toFillData);
            $this->model->addRecord();
            return $this->response('Object was created', 200);
        }
        $this->response('Failed create', 404);
    }


    public function deleteAction()
    {
        // записывает строку с переданными данными в массив $_DELETE
        if (!empty($this->args)) {
            extract($this->args);
        }
        if (isset($this->requestBody['id'])) {
            $id = $this->requestBody['id'];
        }
        if (!empty($id)) {
            $record = $this->getRecord($id);
            if ($record) {
                $this->model->dropRecord($id);
                return $this->response('Record was deleted', 200);
            }
            return $this->response('Record wasnt found', 404);
        }
        if (isset($this->args['stateId']) && isset($this->args['activityId'])) {
            $predictor = "id = " . "'$stateId' " . "AND activity_id = " . "'$activityId'";
            $record = $this->model->select($predictor);
            if ($record) {
                $this->model->deleteByPredict($predictor);
                return $this->response('Record was deleted', 200);
            }

        }
        $this->response('Failed delete', 404);
    }

    public function updateAction()
    {
        $_PUT = $this->requestBody;
        $data_field = [];
        if (!empty($_PUT['id'])) {
            $data_field['id'] = $_PUT['id'];
            $record = $this->getRecord($_PUT['id']);
        }
        if (!$record) {
            return $this->response('Record wasnt found', 404);
        }
        // создаем ассоциативный массив, заполненный столбцами таблицы [key => value]
        $tables = $this->model->getFields($this->model->table)['array'];
        foreach ($_PUT as $key => $value) {
            $data_field[$key] = $value;
        }
        $toFillData = [];
        foreach ($data_field as $key => $value) {
            foreach ($tables as $table) {
                if ($key == $table) {
                    $toFillData[$key] = $value;
                }
            }
        }
        if (!empty($_PUT['id'])) {
            $this->model->setValues($toFillData);
            $this->model->updateRecord($_PUT['id']);
            return $this->response('Record was updated', 200);
        }
        $this->response('Failed update', 404);
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
            401 => 'Unauthorized',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            500 => 'Internal Server Error',
        );
        return ($status[$code]) ?? $status[500];
    }

    protected function getRecord($id)
    {
        $str = 'id = ' . $id;
        return $this->model->select($str);
    }

    public function deleteByPredict($predictor)
    {
        $sql = "DELETE FROM $this->table WHERE " . $predictor;
        $this->db->query($sql);
    }

}