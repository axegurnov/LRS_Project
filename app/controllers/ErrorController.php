<?php

namespace app\controllers;

use app\core\Controller;
use app\core\View;

class ErrorController extends Controller
{
    public function __construct()
    {
        $this->view = View::getInstance();
    }

    public function notFoundAction()
    {
        $this->view->generate("errors/404.tlp");
        exit();
    }
}

?>