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
		$api = preg_match('/(Api)/', $this->route['controller']);
		if (($api == true)) {
			return 0;
		}
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

	protected function hashPassword($var)
    {
        return password_hash($var, PASSWORD_BCRYPT);
    }

    protected function encodeApiToken($var){
		return base64_encode($var);
	}

    protected function filterVar($var)
    {
        return filter_var($var, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);
    }

	//преобразование к формату json
	public function convertToJson($array)
	{
		return json_encode($array);
	}

	//преобразование к формату json
    public function convertFromJson($array)
    {
        return json_decode($array, true);
    }

	public function redirect($url)
	{
		header('Location: ' . $url, false);
	}
}
?>
