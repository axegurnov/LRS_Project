<?php
namespace app\core;

abstract class Controller
{
    protected $nameModel = NULL;
    protected $model = NULL;
    protected $view = NULL;
    protected $route = NULL;

    protected function beforeAction()
    {
        $api = preg_match('/(Api)/', $this->route['controller']);
        if (($api == TRUE)) {
            return 0;
        }
        if (empty($_SESSION["auth"]) && (($this->route['controller'] != "user") || ($this->route['action'] != "auth"))) {
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
        if (class_exists($path)) {
            return new $path;
        }
    }

    protected function hashPassword($var)
    {
        return password_hash($var, PASSWORD_BCRYPT);
    }

    protected function encodeApiToken($var)
    {
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

    //преобразование из формата json
    public function convertFromJson($array)
    {
        return json_decode($array, TRUE);
    }

    public function redirect($url)
    {
        header('Location: ' . $url, FALSE);
    }
}

?>
