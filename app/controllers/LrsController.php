<?php
namespace app\controllers;

use app\core\Controller;

class LrsController extends Controller {

    protected $nameModel = 'lrs';
    protected $table = 'lrs';

    public function lrsListAction($params)
    {
        $limit = 3;
        if (empty($params['page'])) {
            $params['page'] = 1;
        };
        $offset = ($params['page'] - 1) * $limit;
        $lrs = $this->model->pagination($offset, $limit, $this->table);
        $count_id = $this->model->countId();
        $ttl = $count_id[0];
        $pages = ceil($ttl / $limit);
        $vars = [
            'title' => 'LRS List',
            'lrsr' => $lrs,
            'pages' => $pages
        ];
        $this->view->generate('lrs/list.tlp',$vars);
    }

    public function lrsShowAction($params){
        if(empty($params['view'])) $params['view']=1;
        $predictor = "lrs_id=".$params['view'];
        $lrs_id = "id=".$params['view'];
        $clients = $this->model->getValueTable("lrs_client",$predictor);
        $lrs = $lrs = $this->model->select($lrs_id);
        $vars =[
            'title' => 'LRS '.$params['view'],
            'lrs' => $lrs,
            'clients' => $clients
        ];
        $this->view->generate('lrs/view.tlp',$vars);
    }

    public function lrsDelAction()
    {
        $id = $_POST['id'];
        $this->model->dropRecord($id);
        $this->redirect('../lrs/list');
    }

    public function lrsViewUpdateAction()
    {
        $lrs = '';
        if (isset($_POST['id'])) {
            $str = "id=".$_POST['id'];
            $lrs = $this->model->select($str);
        }
        $vars = [
            'title' => 'LRS form',
            'data_field' => $lrs
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
        if (!empty($_POST['id'])) {
            $this->model->setValues($data_field);
            $this->model->updateRecord($id);
            $this->redirect('../lrs/list');
        } elseif (empty($_POST['id'])) {
            $this->model->setValues($data_field);
            $this->model->addRecord();
            $this->redirect('../lrs/list');
        }
    }

}