<?php

    // если существует файл по следующему пути, подключить его
    spl_autoload_register(function ($class) {
        $path = str_replace('\\','/',$class.'.php');
        if (file_exists($path)){
            require $path;
        }
    });


    // spl_autoload_register(function ($class) {
    //     $path = 'app\controllers\\' . ucfirst($class . 'Controller');
    //     if (class_exists($path)){
    //         require $path;
    //     }
    // });

?>