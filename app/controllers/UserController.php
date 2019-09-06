<?php
namespace app\controllers;

use app\core\Controller;
use app\core\Model;
use app\core\View;

class UserController extends Controller {
	
	public function authAction() {
		if (isset($_POST["loginButton"])) {
			$this->callModel();
			$this->model->auth();
			if (!isset($_POST["errors"])) {
				$this->redirect("/lrs/list");
			}
		}
		if (isset($_POST["exit"])) {
			$this->callModel();
			$this->model->exit();
			$this->redirect("/login");
		}
		$this->view->generate('user/auth.tlp'); 
	}

	public function addAction() {
		if (isset($_POST["submitButton"])) {
			$nameModel = "user";
			$this->model = $this->getModel($nameModel);
			//$this->model->list();
		}
		$this->view->generate("user/reg.tlp"); 
	}

	private function callModel() {
		$this->model = "user";
		$this->model = $this->getModel($this->model);
	} 
}
?>