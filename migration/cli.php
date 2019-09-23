<?php
define('ROOT', dirname(__FILE__));

$controller = new MigrationController;
//проверка существования параметров при старте программы
if (!isset($argv[1])) {
    $controller->errorCommandAction();
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
                    $controller->errorCommandAction();
                    break;
            }
        } else {
            $controller->createAction();
        }
        break;

    //заполнение таблиц
    case 'fill':
        if (isset($argv[2])) {
            switch ($argv[2]) {
                case 'table':
                    if (isset($argv[3])) {
                        $controller->issetArg("data/", $argv[3]);
                    } else {
                        $controller->fillAction();
                    }
                    break;
                default:
                    $controller->errorCommandAction();
                    break;
            }
        } else {
            $controller->fillAction();
        }
        break;

    //пересоздание таблиц (очистка от данных)
    case 'clear':
        if (isset($argv[2])) {
            switch ($argv[2]) {
                case 'table':
                    if (isset($argv[3])) {
                        $controller->issetArg("clear/", $argv[3]);
                    } else {
                        $controller->clearAction();
                    }
                    break;
                default:
                    $controller->errorCommandAction();
                    break;
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
                    $controller->errorCommandAction();
                    break;
            }
        } else {
            $controller->errorCommandAction();
        }
        break;

    //дополнительные персонализированные миграции, незапланированные заранее
    case 'edit':
        if (isset($argv[2]) && isset($argv[3])) {
            switch ($argv[2]) {
                case 'database':
                    $controller->editDatabaseAction($argv[3]);
                    break;
                case 'table':
                    $controller->editTableAction($argv[3]);
                    break;
                default:
                    $controller->errorCommandAction();
                    break;
            }
        } else {
            $controller->errorCommandAction();
        }
        break;

    //тестовый кейс
    case 'test':
        $controller->testAction($argv);
        break;
    default:
        $controller->errorCommandAction();
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
        $this->templateExecute("structure/", "*database*.sql", "database");
    }

    public function createTablesAction()
    {
        $this->templateExecute("structure/", "*table*.sql", "table");
    }

    public function fillAction()
    {
        $this->templateExecute("data/", "*table*.sql", "table");
    }

    public function clearAction()
    {
        $this->templateExecute("clear/", "*table*.sql", "table");
    }

    public function dropDatabaseAction()
    {
        $this->templateExecute("drop/", "*database*.sql", "database");
    }

    public function dropTablesAction()
    {
        $this->templateExecute("drop/", "*table*.sql", "table");
    }

    public function editDatabaseAction($sqlFile)
    {
        $this->templateExecute("edit/", $sqlFile, "database");
    }

    public function editTableAction($sqlFile)
    {
        $this->templateExecute("edit/", $sqlFile, "table");
    }

    public function templateExecute($sqlFolder, $expansion, $type)
    {
        //получение пути к файлу
        $path = $sqlFolder . $expansion;
        //поиск путей по шаблону
        $allFiles = glob($path);
        if ($allFiles == []) {
            //сообщение об отсутствии файлов, совпадающих с шаблоном
            $this->errorFindAction($path);
        } else {
            //выполнение кода для найденных файлов
            foreach ($allFiles as $file) {
                switch ($type) {
                    case 'database':
                        $command = sprintf('mysql -u%s -p%s -h%s <%s', $this->config['user'], $this->config['password'], $this->config['host'], $file);
                        break;
                    case 'table':
                        $command = sprintf('mysql -u%s -p%s -h%s -D%s <%s', $this->config['user'], $this->config['password'], $this->config['host'], $this->config['base'], $file);
                        break;
                }
                //выполнение команды
                shell_exec($command);
            }
        }
    }

    public function issetArg($sqlFolder, $var) {
        $this->templateExecute($sqlFolder, "*table_" . $var . ".sql", "table");
    }

    public function testAction($argv)
    {
        echo "Запущен тестовый блок\n";
        print_r($argv);
    }

    public function errorCommandAction()
    {
        exit("Ошибка параметра, воспользуйтесь справкой\n");
    }

    public function errorFindAction($path)
    {
        exit("Исполняемый файл " . ROOT . "/" . $path . " не найден\n");
    }
}
?>
