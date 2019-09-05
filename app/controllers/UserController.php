<?php
namespace app\controllers;

use app\core\Controller;
use app\core\Model;
use app\core\View;


class UserController extends Controller {
	
	public function authAction() {
	    $vars = [
	        'title' => 'Auth'
        ];
		$this->view->generate('user/auth.tlp',$vars);
	}

	public function addAction() {
        $vars = [
            'title' => 'Add'
        ];
		$this->view->generate("user/reg.tlp",$vars);
	}
}
?>