<?php
    
    namespace app\config;

    class Autoload
    {
        public function __construct()
        {
            spl_autoload_register(function ($class) {
            $path = str_replace('\\','/',$class.'.php');
            if (file_exists($path)){
                require $path;
            }
            });
        }
    }

?>