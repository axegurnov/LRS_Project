<?php

namespace app\controllers;

use app\core\Controller;

class Api extends GetModelController
{
    protected $nameModel = '';
    protected $args = NULL;
    protected $requestBody = NULL;
    protected $action = NULL;

    protected $testRequestBody = ''; // временное хранение данных из тела запроса
    protected $testReqData = []; // хранит асоциативный массив key => value [["actor"] => "id"]

    public function __construct($route)
    {
        parent::__construct($route);
        //$this->requestBody = file_get_contents('php://input');
        $this->indexAction();
    }



    public function indexAction()
    {
        $api_token = NULL;
        if (isset($_SERVER['HTTP_AUTHORIZATION'])) {
            $temp = $_SERVER['HTTP_AUTHORIZATION'];
            $api_token = str_replace('Basic ', '', $temp);
        }
        $predictor = "api_token='" . $api_token . "'";
        $user = $this->model->getValueTableApi("lrs_client", $predictor);
        if (empty($user)) {
            return $this->response('401 Unauthorized', 401);
        }
        $this->convertToJson('Method Not Allowed', 405);
    }

    public function viewAction($args)
    {
        if (!empty($args)) {
            extract($args);
        }
        if (isset($agent)) {
           $agent = $args['agent'] = $this->convertFromJson($agent)['login'];

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
            $query = $this->model->indexState($args);
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
        return $this->response('Record was not found', 404);
    }

    public function showAllAction($args)
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


    public function deleteAction($args)
    {
        // записывает строку с переданными данными в массив $_DELETE
        if (!empty($args)) {
            extract($args);
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
        if (isset($args['stateId']) && isset($args['activityId'])) {
            $predictor = "id = " . "'$stateId' " . "AND activity_id = " . "'$activityId'";
            $record = $this->model->select($predictor);
            if ($record) {
                $this->model->deleteByPredict($predictor);
                return $this->response('Record was deleted', 200);
            }

        }
        $this->response('Failed delete', 404);
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