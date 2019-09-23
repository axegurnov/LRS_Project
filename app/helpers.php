<?php
//формирование пути по имени роута
function route($name, $id = null)
{
    $routesList = app\config\Routes::getRoutes();

    foreach ($routesList as $key => $value) {
        if ($name == $value['name']) {
            $key = preg_replace('/{([a-z]+):([^\}]+)}/', $id, $key);
            return "/" . $key;
        }
    }
}

?>