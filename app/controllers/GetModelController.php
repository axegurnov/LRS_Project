<?php
namespace app\controllers;

use app\core\Controller;

abstract class GetModelController extends Controller
{

	public function __construct($route)
	{
		parent::__construct($route);
		$this->model = $this->getModel(str_replace('Api', '', $this->route['controller']));
	}
}

?>