<?php
namespace app\controllers;

use app\core\Controller;
use app\core\Model;
use app\core\View;


class UserController extends Controller {
	
	public function authAction() {
		$this->view->generate('user/auth.tlp'); 
	}

	public function addAction() {
		$this->view->generate("user/reg.tlp"); 
	}
}
?>