<?php

namespace app\controllers;

use app\core\Controller;

class LrsClientController extends Controller
{


    public function clientUpdateViewAction()
    {
        $clients = '';
        $lrs_id = $_POST['lrs_id'];
        if (!empty($_POST['client_id'])) {
            $str = "id=" . $_POST['client_id'];
            $clients = $this->model->select($str);
        }


        $vars = [
            'title' => 'Client form',
            'data_field' => $clients,
            'lrs_id' => $lrs_id,
        ];

        $this->view->generate('lrs_client/update.tlp', $vars);
    }

    public function clientUpdateAction()
    {
        $lrs_id = $_POST['lrs_id'];
        $client_id = $_POST['client_id'] ?? "";

        $login = $this->filterVar($_POST['login']);
        $password = $this->hashPassword($_POST['password']);

        $data_field = [
            'lrs_id' => $lrs_id,
            'login' => $login,
            'password ' => $password,
            'description' => $_POST['description'],
        ];
        if (!empty($client_id)) {
            $this->model->setValues($data_field);
            $this->model->updateRecord($client_id);
            $this->redirect('/lrs/list');
        } elseif (empty($client_id)) {
            $this->model->setValues($data_field);
            $this->model->addRecord();
            $this->redirect('/lrs/list');
        }
    }

    public function clientDelAction()
    {
        $id = $_POST['client_id'];
        $this->model->dropRecord($id);
        $this->redirect('/lrs/list');
    }


}

?>