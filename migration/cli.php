<?php
define('ROOT', dirname(__FILE__));

$controller = new MigrationController;
//проверка существования параметров при старте программы
if (!isset($argv[1])) {
	$controller->errorPrintAction();
}
//выполнение действия, в зависимости от параметра
switch ($argv[1]) {
	//полная миграция (структура + заполнение)
	case 'migration':
		$controller->createAction();
		$controller->fillAction();
		break;

	//создание структуры
	case 'create':
		if (isset($argv[2])) {
			switch ($argv[2]) {
				case 'database':
					$controller->createDatabaseAction();
					break;
				case 'table':
					if (isset($argv[3])) {
						$controller->issetArg("structure/", $argv[3]);
					} else {
						$controller->createTablesAction();
					}
					break;
				default:
					$controller->errorPrintAction();
					break;
			}
		} else {
			$controller->createAction();
		}
		break;

	//заполнение таблиц
	case 'fill':
		if (isset($argv[2]) && ($argv[2] == 'table')) {
			if (isset($argv[3])) {
				$controller->issetArg("data/", $argv[3]);
			} else {
				$controller->errorPrintAction();
			}
		} else {
			$controller->fillAction();
		}
		break;

	//пересоздание таблиц (очистка от данных)
	case 'clear':
		if (isset($argv[2]) && ($argv[2] == 'table')) {
			if (isset($argv[3])) {
				$controller->issetArg("clear/", $argv[3]);
			} else {
				$controller->errorPrintAction();
			}
		} else {
			$controller->clearAction();
		}
		break;

	//удаление таблиц или всей базы данных
	case 'drop':
		if (isset($argv[2])) {
			switch ($argv[2]) {
				case 'database':
					$controller->dropDatabaseAction();
					break;
				case 'table':
					if (isset($argv[3])) {
						$controller->issetArg("drop/", $argv[3]);
					} else {
						$controller->dropTablesAction();
					}
					break;
				default:
					$controller->errorPrintAction();
					break;
			}
		} else {
			$controller->errorPrintAction();
		}
		break;


	//тестовый кейс
	case 'test':
		$controller->testAction($argv);
		break;
	default:
		$controller->errorPrintAction();
	break;
}



class MigrationController
{
	private $config = null;

	public function __construct()
	{
		$this->config = require_once(ROOT . '/../app/config/Database.php');
	}

	public function createAction()
	{
		$this->createDatabaseAction();
		$this->createTablesAction();
	}

	public function createDatabaseAction()
	{
		$this->templateExecute("structure/", "001*.sql", "database");
	}

	public function createTablesAction()
	{
		$this->templateExecute("structure/", "002*.sql", "table");
	}

	public function fillAction()
	{
		$this->templateExecute("data/", "002*.sql", "table");
	}

	public function clearAction()
	{
		$this->templateExecute("clear/", "002*.sql", "table");
	}

	public function dropDatabaseAction()
	{
		$this->templateExecute("drop/", "001*.sql", "database");
	}

	public function dropTablesAction()
	{
		$this->templateExecute("drop/", "002*.sql", "table");
	}

	public function templateExecute($sqlFolder, $expansion, $type)
	{
		$allFiles = glob($sqlFolder . $expansion);
		foreach ($allFiles as $file) {
			switch ($type) {
				case 'database':
					$command = sprintf('mysql -u%s -p%s -h%s <%s', $this->config['user'], $this->config['password'], $this->config['host'], $file);
					break;
				case 'table':
				    $command = sprintf('mysql -u%s -p%s -h%s -D%s <%s', $this->config['user'], $this->config['password'], $this->config['host'], $this->config['base'], $file);
					break;
			}
			shell_exec($command);
		}
	}

	public function issetArg($sqlFolder, $var) {
		switch ($var) {
			case 'lrs':
				$this->templateExecute($sqlFolder, "002*lrs.sql", "table");
				break;
			case 'lrs_client':
				$this->templateExecute($sqlFolder, "002*lrs_client.sql", "table");
				break;
			case 'lrs_state':
				$this->templateExecute($sqlFolder, "002*lrs_state.sql", "table");
				break;
			case 'lrs_statements':
				$this->templateExecute($sqlFolder, "002*lrs_statements.sql", "table");
				break;
			case 'users':
				$this->templateExecute($sqlFolder, "002*users.sql", "table");
				break;
			default:
				$this->errorPrintAction();
				break;
		}
	}

	public function testAction($argv)
	{
		echo "Запущен тестовый блок\n";
		print_r($argv);
	}

	public function errorPrintAction()
	{
		exit("Ошибка параметра, воспользуйтесь справкой\n");
	}
}
?>
