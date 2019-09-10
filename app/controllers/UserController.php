<?php
namespace app\controllers;

use app\core\Controller;

class UserController extends Controller {

    protected $nameModel = 'User';
    protected $table = 'users';

    public function indexAction($params)
    {
        $limit = 3;
        if (empty($params['page'])) {
            $params['page'] = 1;
        };
        $offset = ($params['page'] - 1) * $limit;
        $users = $this->model->pagination($offset, $limit, $this->table);
        $count_id = $this->model->countId();
        $ttl = $count_id[0];
        $pages = ceil($ttl / $limit);
        $vars = [
            'title' => 'User',
            'users' => $users,
            'pages' => $pages
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
        $password = $this->hashPassword($_POST['password']);
        $data_field = [
            'login' => $login,
            'name' => $_POST['name'],
            'second_name' => $_POST['second_name'],
            'email' => $_POST['email'],
            'password' => $password,
        ];

        if (!empty($_POST['id'])) {
            $this->model->setValues($data_field);
            $this->model->updateRecord($id);
            $this->redirect('../users');
        }
        elseif (empty($_POST['id'])) {
            $this->model->setValues($data_field);
            $this->model->addRecord();
            $this->redirect('../users');
        }
	}

    public function userDelAction()
    {
        $id = $_POST['id'];
        $this->model->dropRecord($id);
        $this->redirect('../users');
    }

	//разлогирование и выход на экран авторизации
	public function exitAction() 
	{
		$this->model->exit();
		$this->redirect("/login");
	}
}
?>