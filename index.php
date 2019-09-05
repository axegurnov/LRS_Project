<?php

require 'app/config/Dev.php';
<<<<<<< HEAD
;
use app\core\Model;
=======
include 'app/config/Autoload.php';
>>>>>>> 7f34ae5f991fa2b650bf5c14e5703706d18a4898
use app\core\Router;
use app\controllers\MigrationController;

<<<<<<< HEAD
spl_autoload_register(function ($class) {
    $path = str_replace('\\','/',$class.'.php');
    if (file_exists($path)){
        require $path;
    }
});
//$migration = new \app\controllers\MigrationController();
//
//$migration->migrationAction();

// $model = new Model();
// $model->migration();
    $router = new Router;

// $router->run();
=======
//$migration = MigrationController::migrationAction();


$router = new Router;

>>>>>>> 7f34ae5f991fa2b650bf5c14e5703706d18a4898



?>
