<?php
ini_set('display_errors', 1);
error_reporting(1);

function debug($str)
{
    echo "<pre>";
    var_dump($str);
    echo "</pre>";
    exit;
}

?>