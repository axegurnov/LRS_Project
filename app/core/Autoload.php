<?php

    // если существует файл по следующему пути, подключить его
    spl_autoload_register(function ($class) {
        $path = str_replace('\\','/',$class.'.php');
          $test = "../".$path;
        if (file_exists($test)){
          // echo "Путь";echo "<br>";
          // echo $path;echo "<br>";
          // echo "Класс";echo "<br>";
          // echo $class;
          // echo "<br>";
          //echo "Тест";echo "<br>";
          //echo $test;
        //  echo "<br>";echo "<br>";
            require $test;
        }
    });


    // spl_autoload_register(function ($class) {
    //     $path = 'app\controllers\\' . ucfirst($class . 'Controller');
    //     if (class_exists($path)){
    //         require $path;
    //     }
    // });

?>
