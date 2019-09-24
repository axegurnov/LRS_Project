<?php

namespace app\controllers;

class LrsStateApiController extends Api
{


    public function createAction()
    {
        $data = $this->convertFromJson($this->requestBody);

        // получаем названия столбцов в таблице
        $tables = $this->model->getFields($this->model->table)['array'];

        // создаем асоциативный массив, заполненный столбцами таблицы [key => value]
        $data_field = [];
        foreach ($data as $key => $value) {
        	if($key == 'lrs') {
                $data_field['lrs_id'] = $value;
            }
            if($key == 'value') {
                $data_field['value'] = $value;
            }
        }
        if(isset($_GET['object'])) {
            $data_field['activity_id'] = $_GET['object'];
        }
        if(isset($_GET['actor'])) {
            $agent = $this->model->getClientLoginById($_GET['actor']);
            foreach($agent as $login) {
                $data_field['lrs_client_id'] = $login['id'];
            }
        }
        if(isset($_GET['stateId'])) {
            $data_field['state_key'] = $_GET['stateId'];
        }
        //debug($data_field);

        //  проверка если переданный столбец существует в таблице
        //  заносит в массив данные для добавления
        if (!empty($data_field)) {
            $this->model->setValues($data_field);
            $this->model->addRecord();
            return $this->response('Object was created', 200);
        }
        $this->response('Failed create', 404);
    }

    public function update1Action()
    {
        $data = $this->convertFromJson($this->requestBody);
        $data_field = [];
        if (!empty($_GET['id'])) {
            $data_field['id'] = $_GET['id'];
            $record = $this->getRecord($_GET['id']);
        }
        if (!$record) {
            return $this->response('Record wasnt found', 404);
        }
        // создаем асоциативный массив, заполненный столбцами таблицы [key => value]
        $tables = $this->model->getFields($this->model->table)['array'];
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
        $toFillData = [];
        foreach ($data_field as $key => $value) {
            foreach ($tables as $table) {
                if ($key == $table) {
                    $toFillData[$key] = $value;
                }
            }
        }

        if (!empty($_GET['id'])) {
            $this->model->setValues($toFillData);
            $this->model->updateRecord($_GET['id']);
            return $this->response('Record was updated', 200);
        }
        $this->response('Failed update', 404);
    }
}
?>