<?php


namespace app\controllers;

class LrsStatementsApiController extends Api
{
    protected $nameModel = 'LrsStatements';

    private $id = '';
    private $verb = '';
    private $activity = '';
    private $content = '';
    private $lrs_id = '';
    private $lrs_client_id = '';

    public function indexAction($args = null)
    {
        if($args) {
            $this->args = $args;
        }
        $this->getAction($this->args);

        if(method_exists($this, $this->action)) {
            return $this->{$this->action}();
        } else {
            $this->convertToJson('Method Not Allowed', 405);
        }
    }

    public function viewAction()
    {
        if(!empty($this->args['id'])) {
            $str = 'id = ' . $this->args['id'];
            $this->response($this->model->select($str), 200);
        } else {
            $msg = [
                'message' => 'id arg not found',
            ];
            $this->response($msg, 404);
        }
    }

    public function showAllAction()
    {
       $this->response($this->model->getAllRecords(), 200);
    }

    public function createAction()
    {
        if(!empty($_POST['id'])) {
            $this->id = $_POST['id'];
        }

        if( !empty($_POST['verb']) &&
            !empty($_POST['activity']) &&
            !empty($_POST['content']) &&
            !empty($_POST['lrs_id']) &&
            !empty($_POST['lrs_client_id'])) {
                $this->verb = $_POST['verb'];
                $this->activity = $_POST['activity'];
                $this->content = $_POST['content'];
                $this->lrs_id = $_POST['lrs_id'];
                $this->lrs_client_id = $_POST['lrs_client_id'];
        }
        $data_field = [
            'verb' => $this->verb,
            'activity ' => $this->content,
            'content ' => $this->content,
            'lrs_id' => $this->lrs_id,
            'lrs_client_id' => $this->lrs_client_id,
        ];

        if (!empty($this->id)) {
            $this->model->setValues($data_field);
            $this->model->updateRecord($this->id);
        } elseif (empty($this->id)) {
            $this->model->setValues($data_field);
            $this->model->addRecord();
        }
    }

    public function deleteAction()
    {
        parse_str(file_get_contents('php://input'), $_DELETE);
        if(!empty($_DELETE['id'])) {
            $id = $_DELETE['id'];
            return $this->response($this->model->dropRecord($id), 200);
        }
        $msg = [
            'message' => 'wrong id',
        ];
        $this->response($msg, 404);
    }

    public function updateAction()
    {
        parse_str(file_get_contents('php://input'), $_PUT);
        var_dump($_PUT);

    }


}