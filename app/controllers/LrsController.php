<?php

namespace app\controllers;

use app\core\Controller;

class LrsController extends InheritanceController
{
    public function lrsListAction($params)
    {
        $limit = 3;
        $count_id = $this->model->countId();
        $pagination = $this->pagination($params, $limit, $count_id);
        $lrs = $this->model->pagination($pagination['offset'], $limit);
        $vars = [
            'title' => 'Lrs List',
            'lrsr' => $lrs,
            'limit' => $limit,
            'pages' => $pagination['pages'],
        ];
        $this->view->generate('lrs/list.tlp', $vars);
    }

    public function lrsShowAction($params)
    {
        $statements = $this->model->statements($params['id']);
        $predictor = "lrs_id=" . $params['id'];
        $lrs_id = "id=" . $params['id'];
        $clients = $this->model->getValueTable("lrs_client", $predictor);
        $lrs = $this->model->select($lrs_id);
        $vars = [
            'title' => 'LRS ' . $params['id'],
            'lrs' => $lrs,
            'clients' => $clients,
            'statements' => $this->convertToJson($statements),
        ];
        $this->view->generate('lrs/view.tlp', $vars);
    }

    public function lrsDelAction($params)
    {
        $id = $params['id'];
        $this->model->dropRecord($id);
        $this->redirect(route("lrs_list"));
    }

    public function lrsViewUpdateAction($params)
    {
        $lrs = '';
        if (isset($params['id'])) {
            $str = "id=" . $params['id'];
            $lrs = $this->model->select($str);
        }
        $vars = [
            'title' => 'LRS form',
            'data_field' => $lrs,
            'params' => $params,
        ];
        $this->view->generate('lrs/update.tlp', $vars);
    }

    public function lrsUpdateAction($params)
    {
        $id = $_POST['id'];
        $data_field = [
            'name' => $_POST['name'],
            'description' => $_POST['description'],
        ];
        if (!empty($_POST['id'])) {
            $errors = $this->model->setValues($data_field);
            if (!$errors) {
                $this->model->setValues($data_field);
                $this->model->updateRecord($id);
                $this->redirect(route("lrs_list"));
            } else {
                $vars = [
                    'title' => 'LRS form',
                    'params' => $params,
                    'errors' => $errors,
                    'data_field' => $data_field,
                ];
                $this->view->generate('lrs/update.tlp', $vars);
            }
            unset ($errors);
        } else if (empty($_POST['id'])) {
            $errors = $this->model->setValues($data_field);
            if (!$errors) {
                $this->model->setValues($data_field);
                $this->model->addRecord();
                $this->redirect(route("lrs_list"));
            } else {
                $vars = [
                    'title' => 'LRS form',
                    'errors' => $errors,
                    'params' => $params,
                    'data_field' => $data_field,
                ];
                $this->view->generate('lrs/update.tlp', $vars);
                unset ($errors);
            }
        }
    }

    public function lrsStatementsAction($params)
    {
        $lrs = '';
        if (empty($params['id'])) {
            $id = 1;
        } else {
            $id = $params['id'];
        }
        $statements = $this->model->statements($id);
        $predictor = "id=" . $id;
        $lrss = $this->model->getValueTable("lrs", $predictor);
        foreach ($lrss as $lrs2) {
            $lrs = $lrs2;
        }
        $statementsJson = [];
        foreach ($statements as $statement) {
            $statementsJson[] = $statement;
        }
        $vars = [
            'title' => 'LRS ' . $params['id'],
            'statements' => $statements,
            'statementsJson' => $statementsJson,
            'lrs' => $lrs,
        ];
        $this->view->generate('lrs/statements.tlp', $vars);
    }
}
