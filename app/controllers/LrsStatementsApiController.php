<?php

namespace app\controllers;

class LrsStatementsApiController extends Api
{
    public function createAction()
    {
        $fillData = $this->getData();
        if (!empty($fillData)) {
            $this->model->setValues($fillData);
            $this->model->addRecord();
            return $this->response('Object was created', 200);
        }
        $this->response('Failed create', 404);
    }

    public function updateAction()
    {
        if (!empty($_GET['id'])) {
            $record = $this->getRecord($_GET['id']);
        }
        if (!$record) {
            return $this->response('Record wasnt found', 404);
        }
        $fillData = $this->getData();

        if (!empty($_GET['id'])) {
            $this->model->setValues($fillData);
            $this->model->updateRecord($_GET['id']);
            return $this->response('Record was updated', 200);
        }
        $this->response('Failed update', 404);
    }

    private function getData()
    {
        $data = $this->convertFromJson($this->requestBody);
        $data_field = [];
        // создаем асоциативный массив, заполненный столбцами таблицы [key => value]
        $tables = $this->model->getFields($this->model->table)['array'];
        foreach ($data as $key => $value) {
            foreach ($value as $v) {
                if ($key == 'actor') {
                    $agent = $this->model->getClientLoginById($v);
                    foreach ($agent as $login) {
                        $data_field['lrs_client_id'] = $login['id'];
                    }
                }
                if ($key == 'verb') {
                    $data_field['verb_id'] = $v;
                }
                if ($key == 'object') {
                    $data_field['activity_id'] = $v;
                }
                if ($key == 'lrs') {
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
        return $toFillData;
    }
}

?>