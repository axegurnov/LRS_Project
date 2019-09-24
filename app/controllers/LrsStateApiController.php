<?php

namespace app\controllers;

class LrsStateApiController extends Api
{


    public function createAction()
    {
        $data = $this->convertFromJson($this->requestBody = file_get_contents('php://input'));
        //debug($data);

        // получаем названия столбцов в таблице
        $tables = $this->model->getFields($this->model->table)['array'];

        // создаем ассоциативный массив, заполненный столбцами таблицы [key => value]
        $data_field = [];
        $flag = 0;
        foreach ($data as $key => $value) {
            if ($key == 'lrs') {
                $data_field['lrs_id'] = $value;
                $flag++;
            }
            if ($key == 'value') {
                $data_field['value'] = $value;
                $flag++;
            }
        }
        if (isset($_GET['object'])) {
            $data_field['activity_id'] = $_GET['object'];
            $flag++;
        }
        if (isset($_GET['actor'])) {
            $agent = $this->model->getClientLoginById($_GET['actor']);
            foreach ($agent as $login) {
                $data_field['lrs_client_id'] = $login['id'];
            }
            $flag++;
        }
        if (isset($_GET['stateId'])) {
            $data_field['state_key'] = $_GET['stateId'];
            $flag++;
        }

        // проверка на наличие необходимых параметров
        if ($flag >= 5) {
            $this->model->setValues($data_field);
            $this->model->addRecord();
            return $this->response('Object was created', 200);
        }
        $this->response('Failed create', 404);
    }

    public function updateAction()
    {
        $data = $this->convertFromJson($this->requestBody);
        $data_field = [];
        $flag = 0;
        foreach ($data as $key => $value) {
            if ($key == 'id') {
                $id = $value;
                $record = $this->getRecord($id);
                $flag++;
            }
            if ($key == 'lrs') {
                $data_field['lrs_id'] = $value;
            }
            if ($key == 'value') {
                $data_field['value'] = $value;
            }
        }
        if (isset($_GET['object'])) {
            $data_field['activity_id'] = $_GET['object'];
        }
        if (isset($_GET['activityId'])) {
            $data_field['activity_id'] = $_GET['activityId'];
        }
        if (isset($_GET['actor'])) {
            $agent = $this->model->getClientLoginById($_GET['actor']);
            foreach ($agent as $login) {
                $data_field['lrs_client_id'] = $login['id'];
            }
        }
        if (isset($_GET['stateId'])) {
            $data_field['state_key'] = $_GET['stateId'];
        }

        if (!$record) {
            return $this->response('Record wasnt found', 404);
        }
        // создаем ассоциативный массив, заполненный столбцами таблицы [key => value]
        $tables = $this->model->getFields($this->model->table)['array'];
        $toFillData = [];
        foreach ($data_field as $key => $value) {
            foreach ($tables as $table) {
                if ($key == $table) {
                    $toFillData[$key] = $value;
                }
            }
        }

        if ($flag >= 1) {
            $this->model->setValues($toFillData);
            $this->model->updateRecord($id);
            return $this->response('Record was updated', 200);
        }
        $this->response('Failed update', 404);
    }
}

?>