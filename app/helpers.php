<?php
//формирование пути по имени роута
function route($name)
{
    $routesList = app\config\Routes::getRoutes();

    foreach ($routesList as $key => $value) {
        if ($name == $value['name']) {
            return "/" . $key;
        }
    }
}

?>