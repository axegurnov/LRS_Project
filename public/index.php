<?php
session_start();
require '../app/core/Dev.php';
require '../app/core/Autoload.php';
require '../app/helpers.php';

define('ROOT', dirname(__FILE__));

use app\core\Handler;

$handler = new Handler;

use app\core\Router;

$router = new Router;

?>