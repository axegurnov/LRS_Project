<?php
namespace app\core;
use app\core\View;
use app\core\Model;

abstract class Controller
{

	protected $model = null;
	protected $view = null;
	protected $route = null;
	protected $table = null;

	protected function beforeAction()
	{

	}

	public function __construct($route)
	{
		$this->route = $route;
	}

	//автоподключение модели
	private function getModel($nameModel)
	{
		$path = "app\models\\" . ucfirst($nameModel);
		if (class_exists($path)) {
			return $path::getInstance();
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
		$this->convert($this->model->index($this->table, $page));
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
		$this->convert($this->model->add($this->table, $vars));
	}

	//DELETE
	public function deleteAction()
	{
		$this->beforeAction();
		$id = 0;
		if (isset($_GET["id"])) {
			$id = $_GET["id"];
		}
		$this->convert($this->model->delete($this->table, $id));
	}

	//EDITGET
	public function editgetAction()
	{
		$this->beforeAction();
		$id = 0;
		if (isset($_GET["id"])) {
			$id = $_GET["id"];
		}
		$this->convert($this->model->editget($this->table, $id));
	}

	//EDITPUT
	public function editputAction()
	{
		$this->beforeAction();
		$id = 0;
		$vars = [];
		if (isset($_GET["id"]) && (count($_GET) > 2)) {
			array_shift($_GET);
			$id = array_shift($_GET);
			$vars = $_GET;
		}
		$this->convert($this->model->editput($this->table, $id, $vars));
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