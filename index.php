<?php

require 'app/config/Dev.php';

use app\core\Model;

include 'app/config/Autoload.php';

use app\core\Router;
use app\controllers\MigrationController;

$router = new Router;

//$migration = MigrationController::migrationAction();

?>
