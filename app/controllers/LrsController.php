<?php
namespace app\controllers;

use app\core\Controller;
use app\core\Model;
use app\core\View;

class LrsController extends Controller {

    protected $nameModel = 'lrs';

    public function __construct()
    {
        parent::__construct($this->route);
        $this->model = $this->getModel($this->nameModel);
    }

    public function lrsListAction()
    {
        $fields = "*";
        $lrs = $this->model->getAllRecords($fields);
        $vars = [
            'title' => 'LRS List',
            'lrsr' => $lrs
        ];
        $this->view->generate('lrs/list.tlp',$vars);
    }

    public function lrsDelAction()
    {
        $id = $_POST['id'];
        $this->model->dropRecord($id);
        $this->redirect('../lrs/list');
    }

    public function lrsViewUpdateAction()
    {
        $id = $_POST['id'];
        $str = "id=".$id;
        $data_field = $this->model->select($str);
        $vars = [
            'id' => $id,
            'data_field' => $data_field
        ];
        $this->view->generate('lrs/update.tlp',$vars);
    }

    public function lrsUpdateAction()
    {
        $id = $_POST['id'];
        $data_field = [
            'name' => $_POST['name'],
            'description' => $_POST['description'],
        ];
        $this->model->setValues($data_field);
        $this->model->updateRecord($id);
        $this->redirect('../lrs/list');
    }

}