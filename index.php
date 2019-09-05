<?php

require 'app/config/Dev.php';

use app\core\Model;
use app\core\Router;




spl_autoload_register(function ($class) {
    $path = str_replace('\\','/',$class.'.php');
    if (file_exists($path)){
        require $path;
    }
});


// $model = new Model();
// $model->migration();
    $router = new Router;

// $router->run();



?>
