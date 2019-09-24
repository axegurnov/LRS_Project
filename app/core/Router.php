<?php

namespace app\core;

use app\config\Dev;
use app\config\Routes;

class Router
{
    // хранит данные, какой вызвать контроллер и экшн
    public $params = [];
    //хранит текущий uri
    public $routeUri;
    //хранит аргументы (гет запроса)
    public $argUri = [];
    //хратит все роуты с параметрами
    public $routes = [];
    //хранит метод
    public $method = '';

    public function __construct()
    {
        // получаем список роутов
        $routesList = Routes::getRoutes();
        // хранится uri
        $this->routeUri = trim(@array_shift($_GET), '/');

        // записываем аргументы (гет запроса)
        $this->argUri = $_GET;

        //записываем метод
        $this->method = $_SERVER['REQUEST_METHOD'];

        //добавляем pattern к ротуам
        foreach ($routesList as $key => $val) {
            $this->add($key, $val);
        }
        //ищем совпадения
        $this->match();
    }

    public function add($route, $params)
    {
        //выполняем поиск и замену параметров uri по регулярному выражению
        $route = preg_replace('/{([a-z]+):([^\}]+)}/', '(?P<\1>\2)', $route);
        //добавляем pattern к роутам
        $route = '#^' . $route . '$#';
        //добавлям параметры к роутам
        $this->routes[$route] = $params;
    }

    public function match()
    {
        foreach ($this->routes as $route => $params) {
            //ищем совпадения по pattern'у
            if (preg_match($route, $this->routeUri, $matches)) {
                //резбираем совпадения
                foreach ($matches as $key => $match) {
                    //ищем текстовый параметр key
                    if (is_string($key)) {
                        //если число, добавляем в match
                        if (is_numeric($match)) {
                            $match = (int)$match;
                        }
                        //найденый параметр добавляем в массив argUri
                        $this->argUri[$key] = $match;
                    }
                }
                //добавляем название контроллера и экшна в params
                $this->params = $params;
                //если api добавляем actions
                if (preg_match('/(api)/', $this->routeUri, $matches)) {
                    switch ($this->method) {
                        case 'GET':
                            if (!empty($this->argUri)) {
                                $this->params['action'] = 'view';
                                break;
                            }
                            $this->params['action'] = 'showAll';
                            break;
                        case 'POST':
                            $this->params['action'] = 'create';
                            break;
                        case 'PUT':
                            $this->params['action'] = 'update';
                            break;
                        case 'DELETE':
                            $this->params['action'] = 'delete';
                            break;
                        default:
                            return NULL;
                    }
                }
                return $this->run();
            }
        }
        //если не было сопадений по pattern'у
        if (empty($matches)) {
            $this->params['controller'] = "error";
            $this->params['action'] = "notFound";
            return $this->run();
        }
    }

    // задаем контроллер и экшн, вызываем контроллер
    public function run()
    {
        //debug($this->params);
        // $this->params содержит название контроллера и экшна
        $path = 'app\controllers\\' . ucfirst($this->params['controller'] . 'Controller');
        // если класс объявлен, создаем контроллер, передав в него параметры
        if (class_exists($path)) {
            $controller = new $path($this->params);
            $action = $this->params['action'] . 'Action';
            if (method_exists($path, $action)) {
                if (!isset($this->argUri)) { // если аргументы не заданы, вызываем экшн контроллера
                    $controller->$action();
                } else { // передаем в экшн, массив аргументов для последующей обработки
                    $controller->$action($this->argUri);
                }
            } else {
                echo "Action is not found: " . $action;
            }
        } else {
            echo "Class not found: " . $path;
        }
    }
}

?>