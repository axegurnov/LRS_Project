<?php
namespace app\controllers;

use app\core\Controller;
use app\core\Model;
use app\core\View;

class LrsController extends Controller {

    protected $nameModel = 'lrs';



    public function lrsListAction(){

        $this->model = $this->getModel($this->nameModel);
        $users = $this->model->getFields($this->nameModel);

        print_r($users);
    }

}

?>