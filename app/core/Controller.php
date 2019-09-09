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

	}

	public function __construct($route)
	{
		$this->route = $route;
		$this->view = View::getInstance();
		$this->model = $this->getModel($route['controller']);
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
		$this->beforeAction();
		$page = 0;
		if (isset($_GET["page"])) {
			$page = $_GET["page"];
		}
		$this->convertToJson($this->model->index($page));
	}

	//ADD
	public function addAction()
	{
		$this->beforeAction();
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
		$this->beforeAction();
		$id = 0;
		if (isset($_GET["id"])) {
			$id = $_GET["id"];
		}
		$this->convertToJson($this->model->delete($id));
	}

	//EDITGET
	public function editgetAction()
	{
		$this->beforeAction();
		$id = 0;
		if (isset($_GET["id"])) {
			$id = $_GET["id"];
		}
		$this->convertToJson($this->model->editget($id));
	}

	//EDITPUT
	public function updateAction()
	{
		$this->beforeAction();
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

	public function logout()
    {
        unset($_SESSION);
    }
}
?>