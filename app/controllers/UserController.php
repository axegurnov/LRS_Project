<?php
namespace app\controllers;

use app\core\Controller;
use app\core\Model;
use app\core\View;

class UserController extends Controller {
	
	public function authAction() {
		if (isset($_POST["login"])) {
			$nameModel = "user";
			$this->model = $this->getModel($nameModel);
			//$users = $this->model->getList();
		}
		$this->view->generate('user/auth.tlp'); 
	}

	public function addAction() {
		if (isset($_POST["submit"])) {
			$nameModel = "user";
			$this->model = $this->getModel($nameModel);

		}
		$this->view->generate("user/reg.tlp"); 
	}
}
?>