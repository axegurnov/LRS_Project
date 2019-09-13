<?php
namespace app\controllers;

use app\core\Controller;

class GetModelController extends Controller
{

	public function __construct($route)
	{
		parent::__construct($route);
		$this->model = $this->getModel($this->route['controller']);
	}
}

?>