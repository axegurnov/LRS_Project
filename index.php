<?php
session_start();

require 'app/core/Dev.php';
include 'app/core/Autoload.php';
require 'app/helpers.php';

use app\core\Router;
use app\controllers\MigrationController;

$router = new Router;

//$migration = MigrationController::migrationAction();

?>
