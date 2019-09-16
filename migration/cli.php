<?php
namespace app\migration;

$controller = new MigrationController;
//Проверка существования параметра при старте программы
if (!isset($argv[1])) {
	$controller->errorPrint();
}
//Выполнение действия, в зависимости от параметра
switch ($argv[1]) {
	case 'create':
		$controller->abs();


		break;
	//Тестовый кейс
	case 'test':
		$controller->test();
		break;
	//Вывод используемых аргументов
	case 'print':
		$controller->printArgv($argv);
		break;
    default:

        break;
}

class MigrationController
{
	private $config = null;

	public function __construct()
	{
		$this->config = require_once(dirname(__FILE__) . '/../app/config/Database.php');
		var_dump(dirname(__FILE__) . '/../app/config/Database.php');
		//var_dump($this->config["host"]);
		$sqlFolder1 = 'data/';
		var_dump($sqlFolder1);
		$allFiles = glob($sqlFolder1 . '*.sql');
		var_dump($allFiles);
        foreach ($allFiles as $file) {
            $command = sprintf('mysql -u%s -p%s -h %s -D %s < %s', $this->config['user'], $this->config['password'], $this->config['host'], $this->config['base'], $file);
            shell_exec($command);
        }

	}

	public function printArgv($argv)
	{
		print_r($argv);
	}

	public static function migrationAction()
	{
        $config = require 'app/config/Database.php';
        //получаем реальный путь к миграциям
        $sqlFolder1 = realpath("migration"). '/';
        // Получаем список всех sql-файлов
        $allFiles = glob($sqlFolder1 . '*.sql');
        // Выполняем миграции
        foreach ($allFiles as $file) {
            $command = sprintf('mysql -u%s -p%s -h %s -D %s < %s', $config['user'], $config['password'], $config['host'], $config['base'], $file);
            shell_exec($command);
        }
	}

	public function test()
	{

	}

	public function errorPrint()
	{
		exit("Ошибка параметра, воспользуйтесь справкой\n");
	}
}
?>