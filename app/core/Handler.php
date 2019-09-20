<?php
namespace app\core;

use app\core\View;

class Handler
{
    private $view = NULL;
    private $errno = NULL;
    private $errstr = NULL;
    private $errfile = NULL;
    private $errline = NULL;
    private $title = NULL;

    public function __construct()
    {
        set_exception_handler(array($this, "exceptionHandler"));
        set_error_handler(array($this, "errorHandler"));
    }

    public function exceptionHandler($exception)
    {
        $this->title = "Internal exception";
        $errors[] = "<b>Неперехваченное исключение: в файле " . $exception->getFile() . ", строка " . $exception->getLine() . "!</b><br> [" . $exception->getCode() . "] " . $exception->getMessage() . "<br>\n";
        $vars = $this->assignError($errors);
        return $this->hasError($vars);
    }

    public function errorHandler($errno, $errstr, $errfile, $errline)
    {
        $this->errno = $errno;
        $this->errstr = $errstr;
        $this->errfile = $errfile;
        $this->errline = $errline;

        $this->title = "Internal error";
        switch ($errno) {
            case E_ERROR:
                $errors[] = $this->generateError("Фатальная ошибка времени выполнения");
                break;
            case E_WARNING:
                $errors[] = $this->generateError("Предупреждение времени выполнения");
                break;
            case E_PARSE:
                $errors[] = $this->generateError("Ошибка на этапе компиляции");
                break;
            case E_NOTICE:
                $errors[] = $this->generateError("Уведомление времени выполнения");
                break;
            case E_CORE_ERROR:
                $errors[] = $this->generateError("Фатальная ошибка при запуске PHP");
                break;
            case E_CORE_WARNING:
                $errors[] = $this->generateError("Предупреждение при запуске PHP");
                break;
            case E_COMPILE_ERROR:
                $errors[] = $this->generateError("Фатальная ошибка на этапе компиляции");
                break;
            case E_COMPILE_WARNING:
                $errors[] = $this->generateError("Предупреждение на этапе компиляции");
                break;
            case E_USER_ERROR:
                $errors[] = $this->generateError("Пользовательская ошибка");
                break;
            case E_USER_WARNING:
                $errors[] = $this->generateError("Пользовательское предупреждение");
                break;
            case E_USER_NOTICE:
                $errors[] = $this->generateError("Пользовательское уведомление");
                break;
            case E_RECOVERABLE_ERROR:
                $errors[] = $this->generateError("Фатальная ошибка с возможностью обработки");
                break;
            case E_DEPRECATED:
                $errors[] = $this->generateError("Уведомление времени выполнения об использовании устаревших конструкций");
                break;
            case E_USER_DEPRECATED:
                $errors[] = $this->generateError("Уведомление времени выполнения об использовании устаревших конструкций, сгенерированное пользователем");
                break;
            default:
                $errors[] = $this->generateError("Неопределённая ошибка");
                break;
        }
        $vars = $this->assignError($errors);
        return $this->hasError($vars);

        // Не запускаем внутренний обработчик ошибок PHP
        //return true;
    }

    //генерация сообщения об ошибке
    private function generateError($message)
    {
        return "<b>$message в файле $this->errfile, строка $this->errline!</b><br> [$this->errno] $this->errstr<br>\n";
    }

    //формирование массива для вывода ошибки в шаблон
    private function assignError($errors)
    {
        return [
            'title' => $this->title,
            'errors' => $errors,
        ];
    }

    //вывод ошибки на экран с помощью шаблона
    private function hasError($vars)
    {
        $this->view = View::getInstance();
        return $this->view->generateHandle($vars);
    }

    //Способы вызвать ошибку или исключение внутри кода:
    // throw new Exception('Неперехваченное исключение');
    // trigger_error("Не могу поделить на ноль", E_USER_ERROR);
}

?>
