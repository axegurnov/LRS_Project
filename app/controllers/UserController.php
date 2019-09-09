<?php
namespace app\controllers;

use app\core\Controller;
use app\core\Model;
use app\core\View;

class UserController extends Controller {
	
	//форма авторизации и попытка залогиниться
	public function authAction() 
	{
		if (isset($_POST["loginButton"])) {
			$login = $_POST["login"];
    		$password = $_POST["password"];
			$this->callModel();
			$this->model->validAuth($login, $password);
			if (!isset($_POST["errors"])) {
				return $this->redirect("/lrs/list");
			}
		}
		$this->view->generate('user/auth.tlp');
	}

	//функция для будущего users crud (создание нового пользователя) 
	public function addAction() 
	{
		if (isset($_POST["submitButton"])) {
			$nameModel = "user";
			$this->model = $this->getModel($nameModel);
			//$this->model->list();
		}
		$this->view->generate("user/reg.tlp"); 
	}

	//разлогирование и выход на экран авторизации
	public function exitAction() 
	{
		$this->callModel();
		$this->model->exit();
		$this->redirect("/login");
	}

	//вызов модели
	private function callModel() 
	{
		$this->model = "user";
		$this->model = $this->getModel($this->model);
	}
}
?>