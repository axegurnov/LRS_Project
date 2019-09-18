<?php
namespace app\controllers;

use app\core\Controller;

class UserController extends InheritanceController {


    //protected $nameModel = 'users';

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
            'pages' => $pagination['pages']
        ];
        $this->view->generate('user/index.tlp', $vars);

    }

	//форма авторизации и попытка залогиниться
	public function authAction()
	{
        if (!empty($_SESSION["auth"])) {
            return $this->redirect("/lrs/list");
        }
		if (isset($_POST["loginButton"])) {
			$login = $this->filterVar($_POST['login']);
    		$password = $_POST["password"];
			$this->model->validAuth($login, $password);
			if (!isset($_SESSION["errors"])) {
				return $this->redirect("/lrs/list");
			}
		}
		$this->view->generate('user/auth.tlp');
	}

	public function userViewUpdateAction()
    {
        $userInfo = '';
        if (isset($_POST['id'])) {
            $str = "id=".$_POST['id'];
            $userInfo = $this->model->select($str);
        }
        $vars = [
            'title' => 'User form',
            'data_field' => $userInfo
        ];
        $this->view->generate('user/update.tlp',$vars);
    }

	public function userUpdateAction()
	{
        $id = $_POST['id'];
        $login = $this->filterVar($_POST['login']);
        $data_field = $_POST;
        array_pop($data_field);

        if (!empty($_POST['id'])) {
           $errors = $this->model->setValues($data_field);
           if(!$errors){
            $password = $this->hashPassword($_POST['password']);
            $this->model->setValue('password',$password);
            $this->model->updateRecord($id);

            $this->redirect('../users');
           }
           else {
               $userInfo = $data_field;
               $vars = [
                   'title' => 'User form',
                   'errors'=> $errors,
                   'data_field' => $userInfo
               ];
              $this->view->generate('user/update.tlp',$vars);
           }
            unset ($errors);
        }
        elseif (empty($_POST['id'])) {
            $errors = $this->model->setValues($data_field);
            if(!$errors) {
                $password = $this->hashPassword($_POST['password']);
                $this->model->setValue('password',$password);
                $this->model->addRecord();
                $this->redirect('../users');
            }
            else{
                $userInfo = $data_field;
                $vars = [
                    'title' => 'User form',
                    'errors'=> $errors,
                    'data_field' => $userInfo
                ];
              $this->view->generate('user/update.tlp',$vars);
            }
            unset ($_SESSION['errors']);
        }

	}

    public function userDelAction()
    {
        $id = $_POST['id'];
        $this->model->dropRecord($id);
        $this->redirect('/users');
    }

	//разлогирование и выход на экран авторизации
	public function exitAction()
	{
		$this->model->exit();
		$this->redirect("/login");
	}
}
?>
