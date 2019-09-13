<?php
namespace app\controllers;

use app\core\Controller;

class LrsController extends Controller {

    public function lrsListAction($params)
    {
        $limit = 3;
        if (empty($params['page'])) {
            $params['page'] = 1;
        };
        $offset = ($params['page'] - 1) * $limit;
        $lrs = $this->model->pagination($offset, $limit);
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

    public function lrsShowAction($params)
    {
        if(empty($params['view'])) {
            $id = 1;
        } else {
            $id = $params['view'];
        }

        $statements = $this->model->Statements($id);

        $predictor = "lrs_id=".$id;
        $lrs_id = "id=".$id;
        $clients = $this->model->getValueTable("lrs_client",$predictor);
        $lrs = $this->model->select($lrs_id);
        $vars =[
            'title' => 'LRS '.$id,
            'lrs' => $lrs,
            'clients' => $clients,
            'statements'=>$statements
        ];
        $this->view->generate('lrs/view.tlp',$vars);
    }

    public function lrsDelAction()
    {
        $id = $_POST['id'];
        $this->model->dropRecord($id);
        $this->redirect('/lrs/list');
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

            $valid = $this->model->setValues($data_field);
            if($valid) {
                $this->model->setValues($data_field);
                $this->model->updateRecord($id);
                $this->redirect('/lrs/list');
            }
            else{
                $vars = [
                    'title' => 'LRS form',
                    'data_field' => $data_field
                ];
                $this->view->generate('lrs/update.tlp',$vars);

            }
            unset ($_SESSION['errors']);

        } elseif (empty($_POST['id'])) {
            $valid = $this->model->setValues($data_field);
            if($valid) {
            $this->model->setValues($data_field);
            $this->model->addRecord();
            $this->redirect('/lrs/list');
            }
            else{
                $vars = [
                    'title' => 'LRS form',
                    'data_field' => $data_field
                ];
                $this->view->generate('lrs/update.tlp',$vars);

            }
        }
        unset ($_SESSION['errors']);
    }
}