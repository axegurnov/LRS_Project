<?php


namespace app\controllers;

class LrsStatementsApiController extends Api
{
    protected $nameModel = 'LrsStatements';

    private $verb = '';
    private $activity = '';
    private $content = '';
    private $lrs_id = '';
    private $lrs_client_id = '';

    public function indexAction($args = null)
    {
        if($args) {
            $this->args = $args;
            $this->getAction($this->args);
        } else {
            $this->getAction();
        }

        if(method_exists($this, $this->action)) {
            return $this->{$this->action}();
        }
        $this->convertToJson('Method Not Allowed', 405);
    }

    public function viewAction()
    {
        if(!empty($this->args['id'])) {
            $str = 'id = ' . $this->args['id'];
            return $this->response($this->model->select($str), 200);
        }
        $this->response('Statement wasnt found', 404);
    }

    public function showAllAction()
    {
        $records = $this->model->getAllRecords();
        if(!empty($records)) {
            return $this->response($records, 200);
        }
        if($records === null) {
            return $this->response('Something going wrong', 404);

        }
        $this->response('Table statements empty', 404);
    }

    public function createAction()
    {
        if( !empty($_POST['verb']) ||
            !empty($_POST['activity']) ||
            !empty($_POST['content']) ||
            !empty($_POST['lrs_id']) ||
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

        if (!empty($data_field)) {
            $this->model->setValues($data_field);
            $this->model->addRecord();
            return $this->response('Statement was created',200);
        }
        $this->response('Failed create', 404);

    }

    public function deleteAction()
    {
        parse_str(file_get_contents('php://input'), $_DELETE);
        if(!empty($_DELETE['id'])) {
            $id = $_DELETE['id'];
            return $this->response($this->model->dropRecord($id), 200);
        }
        $this->response('Failed delete', 404);
    }

    public function updateAction()
    {
        $data_field = [];
        parse_str(file_get_contents('php://input'), $_PUT);
        if(!empty($_PUT['id'])) {
            $data_field['id'] = $_PUT['id'];
            $str = 'id = ' . $_PUT['id'];
            $record = $this->model->select($str);
        }
        if(!$record) {
            return $this->response('Record wasnt found',404);
        }

        if(!empty($_PUT['verb'])) {
            $data_field['verb'] = $_PUT['verb'];
        }
        if(!empty($_PUT['activity'])) {
            $data_field['activity'] = $_PUT['activity'];
        }
        if(!empty($_PUT['content'])) {
            $data_field['content'] = $_PUT['content'];
        }
        if(!empty($_PUT['lrs_id'])) {
            $data_field['lrs_id'] = $_PUT['lrs_id'];
        }
        if(!empty($_PUT['lrs_client_id'])) {
            $data_field['lrs_client_id'] = $_PUT['lrs_client_id'];
        }

        if (!empty($_PUT['id'])) {
            $this->model->setValues($data_field);
            $this->model->updateRecord($_PUT['id']);
            return $this->response('Statement was updated',200);
        }
        $this->response('Failed update',404);
    }


}