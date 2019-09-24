<?php
namespace app\controllers;

use app\core\Controller;

class UserController extends InheritanceController
{
    public function indexAction($params)
    {
        $limit = 3;
        $count_id = $this->model->countId();
        $pagination = $this->pagination($params, $limit, $count_id);
        $users = $this->model->pagination($pagination['offset'], $limit);
        $vars = [
            'title' => 'User',
            'users' => $users,
            'limit' => $limit,
            'params' => $params,
            'pages' => $pagination['pages'],
        ];
        $this->view->generate('user/index.tlp', $vars);
    }

    //форма авторизации и попытка залогиниться
    public function authAction()
    {
        $var = array();
        $errors = array();
        if (!empty($_SESSION["auth"])) {
            return $this->redirect(route("lrs_list"));
        }
        if (isset($_POST["loginButton"])) {
            $login = $this->filterVar($_POST['login']);
            $password = $_POST["password"];
            $errors = $this->model->validAuth($login, $password);
            $var = array('errors' => $errors);
            if (!isset($errors)) {
                return $this->redirect(route("lrs_list"));
            }
        }
        $this->view->generate('user/auth.tlp', $var);
    }

    public function userViewUpdateAction($params)
    {
        $userInfo = '';
        if (isset($params['id'])) {
            $str = "id=" . $params['id'];
            $userInfo = $this->model->select($str);
        }
        $vars = [
            'title' => 'User form',
            'data_field' => $userInfo,
            'params' => $params
        ];
        $this->view->generate('user/update.tlp', $vars);
    }

    public function userUpdateAction($params)
    {
        $id = $_POST['id'];
        $data_field = $_POST;
        array_pop($data_field);

        if (!empty($_POST['id'])) {
            $errors = $this->model->setValues($data_field);
            if (!$errors) {
                $password = $this->hashPassword($_POST['password']);
                $this->model->setValue('password', $password);
                $this->model->updateRecord($id);
                $this->redirect(route("users"));
            } else {
                $userInfo = $data_field;
                $vars = [
                    'title' => 'User form',
                    'errors' => $errors,
                    'data_field' => $userInfo,
                    'params' => $params
                ];
                $this->view->generate('user/update.tlp', $vars);
            }
            unset ($errors);
        } else if (empty($_POST['id'])) {
            $errors = $this->model->setValues($data_field);
            if (!$errors) {
                $password = $this->hashPassword($_POST['password']);
                $this->model->setValue('password', $password);
                $this->model->addRecord();
                $this->redirect(route("users"));
            } else {
                $userInfo = $data_field;
                $vars = [
                    'title' => 'User form',
                    'errors' => $errors,
                    'data_field' => $userInfo,
                ];
                $this->view->generate('user/update.tlp', $vars);
            }
            unset ($errors);
        }
    }

    public function userDelAction($params)
    {
        $id = $params['id'];
        $this->model->dropRecord($id);
        $this->redirect(route("users"));
    }

    //разлогирование и выход на экран авторизации
    public function exitAction()
    {
        $this->model->exit();
        $this->redirect(route("login"));
    }
}

?>
