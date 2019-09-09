<?php
namespace app\core;

abstract class Controller
{
    protected $nameModel = null;
    protected $model = null;
	protected $view = null;
	protected $route = null;

	protected function beforeAction()
	{
		if (empty($_SESSION["auth"]) && ($this->route['controller'] != "user") && ($this->route['action'] != "auth")) {
			$this->view->generate("errors/403.tlp"); 
			exit();
        }
	}

	public function __construct($route)
	{
		$this->route = $route;
		$this->view = View::getInstance();
		$this->beforeAction();
		$this->model = $this->getModel($this->route['controller']);
	}

	//автоподключение модели
	public function getModel($name)
	{
        $path = 'app\models\\' . ucfirst($name);
        if(class_exists($path)) {
            return new $path;
        }
	}

	//LIST
	public function listAction()
	{
		$page = 0;
		if (isset($_GET["page"])) {
			$page = $_GET["page"];
		}
		$this->convertToJson($this->model->index($page));
	}

	//ADD
	public function addAction()
	{
		$vars = [];
		if (count($_GET) > 1) {
			array_shift($_GET);
			$vars = $_GET;
		}
		$this->convertToJson($this->model->add($vars));
	}

	//DELETE
	public function deleteAction()
	{
		$id = 0;
		if (isset($_GET["id"])) {
			$id = $_GET["id"];
		}
		$this->convertToJson($this->model->delete($id));
	}

	//EDITGET
	public function editgetAction()
	{
		$id = 0;
		if (isset($_GET["id"])) {
			$id = $_GET["id"];
		}
		$this->convertToJson($this->model->editget($id));
	}

	//EDITPUT
	public function updateAction()
	{
		$id = 0;
		$vars = [];
		if (isset($_GET["id"]) && (count($_GET) > 2)) {
			array_shift($_GET);
			$id = array_shift($_GET);
			$vars = $_GET;
		}
		$this->convertToJson($this->model->editput($id, $vars));
	}

	//преобразование к формату json
	public function convertToJson($array)
	{
		$array = json_encode($array);
		return $array;
	}

	public function redirect($url)
	{
		header('Location: ' . $url, false);
	}
}
?>