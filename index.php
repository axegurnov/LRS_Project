<?php
session_start();

require 'app/config/Dev.php';
include 'app/config/Autoload.php';

use app\core\Router;
use app\controllers\MigrationController;

$router = new Router;

//$migration = MigrationController::migrationAction();

?>
