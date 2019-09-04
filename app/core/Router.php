<?php
	
	namespace app\core;
	
	use app\config\Dev;

	class Router
	{
		protected $routes = [];
		// хранит данные, какой вызвать контроллер и экшн
		protected $params = [];


		protected $argUri = [];

		private $foundRoute = false;

		public function __construct()
		{
			// debug($_GET);
			// debug($_GET['route']); // хранится uri
			// debug($_GET['arg_name']); // e.g. page = 123 

			// получаем список роутов
			$routesList = require 'app/config/Routes.php';

			// записываем путь в uri
			$routeUri = trim($_GET['route'], '/');

			// перебираем роуты и ищем совпадение с введеным uri
			// записываем параметры (controller, action)
			foreach ($routesList as $key => $value) {
				if($routeUri == $key) {
					$this->params = $value;
					// debug($this->params);
					$this->foundRoute = true;
				}
			}
			if($this->foundRoute) {
				$this->run();
			}
			else {
				debug('wrong url');
			}
		}

		// задаем контроллер и экшн, вызываем контроллер
		public function run()
		{
			$path = 'app\controllers\\' . ucfirst($this->params['controller'] . 'Controller');
			if(class_exists($path)) {
				$controller = new $path($this->params);
				$action = $this->params['action'] . 'Action';
				debug($action);
				if(method_exists($path, $action)) {
					if(isset($this->params['page'])) {
						$controller->$action($this->params['page']);
					}
					else {
						$controller->$action();
					}
				}
				else {
					echo "Action is not found: " . $action;
				}
			}
			else {
				echo "Class not found: " . $path;
			}
		}

	}
?>