<?php

require 'app/lib/dev.php';

use app\core\Model;
//require 'app/core/Router.php';


spl_autoload_register(function ($class) {
    $path = str_replace('\\','/',$class.'.php');
    if (file_exists($path)){
        require $path;
    }
});


$model = new Model();
$model->migration();


?>
