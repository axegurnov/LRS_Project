<?php
namespace app\controllers;

use app\core\Controller;

class LrsClientController extends GetModelController
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
        $errors = [];
        $lrs_id = $_POST['lrs_id'];
        $client_id = $_POST['client_id'] ?? "";
        $data_field = $_POST;
        array_pop($data_field);
        if (!empty($client_id)) {
            $errors = $this->model->setValues($data_field);
            if (!$errors) {
                $password = $this->hashPassword($_POST['password']);
                $this->model->setValue('password', $password);
                $this->model->updateRecord($client_id);
                $this->redirect(route("lrs_list"));
            }
            else {
                $vars = [
                    'title' => 'Client form',
                    'data_field' => $data_field,
                    'errors' => $errors,
                    'lrs_id' => $lrs_id,
                ];
                $this->view->generate('lrs_client/update.tlp', $vars);
                unset($errors);
            }
        }
        else if (empty($client_id)) {
            $errors = $this->model->setValues($data_field);
            if (!$errors) {
                $password = $this->hashPassword($_POST['password']);
                $api_token = $this->encodeApiToken($data_field['login'] . ':' . $data_field['password']);
                $this->model->setValue('password', $password);
                $this->model->setValue('api_token', $api_token);
                $this->model->addRecord();
                $this->redirect(route("lrs_list"));
            }
            else {
                $vars = [
                    'title' => 'Client form',
                    'data_field' => $data_field,
                    'errors' => $errors,
                    'lrs_id' => $lrs_id,
                ];
                $this->view->generate('lrs_client/update.tlp', $vars);
                unset($errors);
            }
        }
    }

    public function clientDelAction()
    {
        $id = $_POST['client_id'];
        $this->model->dropRecord($id);
        $this->redirect(route("lrs_list"));
    }
}

?>
