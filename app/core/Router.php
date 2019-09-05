<?php
    
    namespace app\core;
    
    use app\config\Dev;
    use app\config\Routes;

    class Router
    {
        // хранит данные, какой вызвать контроллер и экшн
        public $params = [];
        //хранит аргументы (гет запроса)
        public $argUri = [];

        public function __construct()
        {
            // получаем список роутов
            $routesList = Routes::getRoutes();
            // debug($routesList);

            // controller/action
            $routeUri = trim(@array_shift($_GET), '/');
            // записываем аргументы (гет запроса)
            $this->argUri = $_GET;
            // debug($_GET);
            // debug($_GET['route']); // хранится uri
            // debug($_GET['arg_name']); // e.g. page = 123 
            
            // перебираем роуты и ищем совпадение с введеным uri
            // записываем параметры (controller, action)
            $foundRoute = false;
            foreach ($routesList as $key => $value) {
                if($routeUri == $key) {
                    $this->params = $value;
                    $foundRoute = true;
                    $this->run();
                    // break;
                    // debug($this->params);
                }
            }
            if(!$foundRoute) {
                include($_SERVER['DOCUMENT_ROOT'] . '/app/views/404.php');
            }
        }

        // задаем контроллер и экшн, вызываем контроллер
        public function run()
        {
            // $this->params содержит название контроллера и экшна
            $path = 'app\controllers\\' . ucfirst($this->params['controller'] . 'Controller');
            // если класс объявлен, создаем контроллер, передав в него параметры
            if(class_exists($path)) {
                $controller = new $path($this->params);
                $action = $this->params['action'] . 'Action';
                if(method_exists($path, $action)) {
                    if(!isset($this->argUri)) { // если аргументы не заданы, вызываем экшн контроллера
                        $controller->$action();
                    }
                    else { // передаем в экшн, массив аргументов для последующей обработки
                        $controller->$action($this->argUri);
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
