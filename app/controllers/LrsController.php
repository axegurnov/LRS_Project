<?php
namespace app\controllers;

use app\core\Controller;
use app\core\Model;
use app\core\View;

class LrsController extends Controller {

    private $table = 'lrs';

    function lrsListAction(){

        $this->model = $this->getModel($this->table);
        $users = $this->model->getFields($this->table);
        $r="name";
        $table='lrs';
        $fields = $this->model->getAllRecords("name");

echo $this->table;
        print_r($fields);

    }

}

?>