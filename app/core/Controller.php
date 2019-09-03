<?php
namespace app\core;
use app\core\View;
use app\core\Model;

abstract class Controller {

	protected $model = null;
	protected $view = null;
	protected $route = null;
	protected $table = null;

	public function __construct($route) {
		$this->route = $route;
		$this->view = View::getInstance($route);
		$this->model = $this->getModel($route["controller"]);
	}

	//автоподключение модели
	private function getModel($nameModel) {
		$path = "app\models\\" . ucfirst($nameModel);
		if (class_exists($path)) {
			return $path::getInstance();
		}
	}

	//LIST users
	public function index() {
		$page = 0;
		if (isset($_GET["page"])) {
			$page = htmlspecialchars(urldecode(trim($_GET["page"])), ENT_QUOTES | ENT_HTML401);
		}
		$this->convert($this->model->index($this->table, $page));
	}

	//ADD user
	public function add() {
		$vars = [];
		if (count($_GET) > 1) {
			array_shift($_GET);
			foreach ($_GET as $key => $value) {
				$_GET[$key] = htmlspecialchars(urldecode(trim($value)), ENT_QUOTES | ENT_HTML401);
			}
			$vars = $_GET;
		}
		$this->convert($this->model->add($this->table, $vars));
	}

	//DELETE user
	public function delete() {
		$id = 0;
		if (isset($_GET["id"])) {
			$id = htmlspecialchars(urldecode(trim($_GET["id"])), ENT_QUOTES | ENT_HTML401);
		}
		$this->convert($this->model->delete($this->table, $id));
	}

	//EDITGET user
	public function editget() {
		$id = 0;
		if (isset($_GET["id"])) {
			$id = htmlspecialchars(urldecode(trim($_GET["id"])), ENT_QUOTES | ENT_HTML401);
		}
		$this->convert($this->model->editget($this->table, $id));
	}

	//EDITPUT user
	public function editput() {
		$id = 0;
		$vars = [];
		if (isset($_GET["id"]) && (count($_GET) > 2)) {
			array_shift($_GET);
			foreach ($_GET as $key => $value) {
				$_GET[$key] = htmlspecialchars(urldecode(trim($value)), ENT_QUOTES | ENT_HTML401);
			}
			$id = array_shift($_GET);
			$vars = $_GET;
		}
		$this->convert($this->model->editput($this->table, $id, $vars));
	}

	//преобразование к формату json
	public function convert($array) {
		$array = json_encode($array);
		echo $array;
	}
}
?>