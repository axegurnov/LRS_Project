<?php
namespace app\controllers;

use app\core\Controller;
use app\core\Model;
use app\core\View;

class LrsController extends Controller {

    protected $nameModel = 'lrs';

    public function lrsListAction(){
        $fields = "*";
        $this->model = $this->getModel($this->nameModel);
        $lrs = $this->model->getAllRecords($fields);
        $vars = [
            'title' => 'LRS List',
            'lrsr' => $lrs
        ];
        $this->view->generate('lrs/list.tlp',$vars);
    }
}

?>