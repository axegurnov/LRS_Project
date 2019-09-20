<?php

namespace app\controllers;

use app\core\Controller;

class MigrationController extends Controller
{
    public static function migrationAction()
    {
        $config = require 'app/config/Database.php';
        //получаем реальный путь к миграциям
        $sqlFolder1 = realpath("migration") . '/';
        // Получаем список всех sql-файлов
        $allFiles = glob($sqlFolder1 . '*.sql');
        // Выполняем миграции
        foreach ($allFiles as $file) {
            $command = sprintf('mysql -u%s -p%s -h %s -D %s < %s', $config['user'], $config['password'], $config['host'], $config['base'], $file);
            shell_exec($command);
        }
    }
}

?>