<?php

require 'app/config/Dev.php';

use app\core\Model;

include 'app/config/Autoload.php';

use app\core\Router;
use app\controllers\MigrationController;

//$migration = new \app\controllers\MigrationController();
//
//$migration->migrationAction();

// $model = new Model();
// $model->migration();
    $router = new Router;

// $router->run();

//$migration = MigrationController::migrationAction();


$router = new Router;





?>
