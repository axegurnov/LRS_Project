<?php
session_start();
require '../app/core/Dev.php';
require '../app/core/Autoload.php';
require '../app/helpers.php';

define('ROOT', dirname(__FILE__));

set_exception_handler("exceptionHandler");
set_error_handler("errorHandler");

function exceptionHandler($exception) {
	echo "Неперехваченное исключение: " , $exception->getMessage(), "\n";
}

function errorHandler($errno, $errstr, $errfile, $errline)
{
/*
	var_dump($errno);
	echo "<br>";
	var_dump($errstr);
	echo "<br>";
	var_dump($errfile);
	echo "<br>";
	var_dump($errline);
	echo "<br>";
*/
/*
	if (!(error_reporting() & $errno)) {
		// Этот код ошибки не включен в error_reporting,
		// так что пусть обрабатываются стандартным обработчиком ошибок PHP
		return false;
	}
*/

	switch ($errno) {
		case E_USER_ERROR:
		echo "<b>Пользовательская ОШИБКА</b> [$errno] $errstr<br />\n";
		echo "  Фатальная ошибка в строке $errline файла $errfile";
		echo ", PHP " . PHP_VERSION . " (" . PHP_OS . ")<br />\n";
		echo "Завершение работы...<br />\n";
		exit(1);
		break;

		case E_USER_WARNING:
		echo "<b>Пользовательское ПРЕДУПРЕЖДЕНИЕ</b> [$errno] $errstr<br />\n";
		break;

		case E_USER_NOTICE:
		echo "<b>Пользовательское УВЕДОМЛЕНИЕ</b> [$errno] $errstr<br />\n";
		break;

		default:
		echo "Неперехваченная ошибка: [$errno] $errstr<br />\n";
		break;
	}

	/* Не запускаем внутренний обработчик ошибок PHP */
	return true;
}

// throw new Exception('Неперехваченное исключение');
// trigger_error("Не могу поделить на ноль", E_USER_ERROR);

use app\core\Router;

$router = new Router;

?>