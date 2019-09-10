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
			$login = $_POST["login"];
    		$password = $_POST["password"];
			$this->model->validAuth($login, $password);
			if (!isset($_SESSION["errors"])) {
				return $this->redirect("/lrs/list");
			}
		}
		$this->view->generate('user/auth.tlp');
	}

	//функция для будущего users crud (создание нового пользователя) 
	public function userAddAction()
	{
		if (isset($_POST["submitButton"])) {
			//$nameModel = "user";
			//$this->model = $this->getModel($nameModel);
			//$this->model->list();
		}
		$this->view->generate("user/add.tlp");
	}

	//разлогирование и выход на экран авторизации
	public function exitAction() 
	{
		$this->model->exit();
		$this->redirect("/login");
	}
}
?>