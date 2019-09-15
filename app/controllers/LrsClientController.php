<?php

namespace app\controllers;

use app\core\Controller;


class LrsClientController extends Controller
{
  protected $nameModel = 'lrs_client';
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
        $data_field = $_POST;
        array_pop($data_field);
        if (!empty($client_id)) {

          $valid = $this->model->setValues($data_field);

          if($valid){
            $password = $this->hashPassword($_POST['password']);
            $this->model->setValue('password',$password);
            $this->model->updateRecord($client_id);
            $this->redirect('/lrs/list');

          }
          else {
            $vars = [
                'title' => 'Client form',
                'data_field' => $data_field,
                'lrs_id' => $lrs_id,
            ];

           $this->view->generate('lrs_client/update.tlp', $vars);
          }unset($_SESSION['errors']);
        } elseif (empty($client_id)) {

          $valid = $this->model->setValues($data_field);

          if($valid) {
              $password = $this->hashPassword($_POST['password']);
              $this->model->setValue('password',$password);
            $this->model->addRecord();
            $this->redirect('/lrs/list');
          }
          else {
            $vars = [
                'title' => 'Client form',
                'data_field' => $data_field,
                'lrs_id' => $lrs_id,
            ];
           $this->view->generate('lrs_client/update.tlp', $vars);

          }
          unset($_SESSION['errors']);

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
