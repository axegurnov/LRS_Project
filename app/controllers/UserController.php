<?php
namespace app\controllers;

use app\core\Controller;

class UserController extends Controller {

    protected $modelName = 'User';

    public function authAction()
	{
		if (isset($_POST["loginButton"])) {
			$this->model->auth();
			if (!isset($_POST["errors"])) {
				$this->redirect("/lrs/list");
			}
		}
		if (isset($_POST["exit"])) {
			$this->model->exit();
			$this->redirect("/login");
		}
		$this->view->generate('user/auth.tlp'); 
	}

	public function addAction() 
	{
		/*

		if (isset($_POST["submitButton"])) {
			$nameModel = "user";
			$this->model = $this->getModel($nameModel);
			//$this->model->list();
		}

		*/
		$this->view->generate("user/reg.tlp"); 
	}
}
?>