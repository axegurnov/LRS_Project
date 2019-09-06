<?php
namespace app\controllers;

use app\core\Controller;

class LrsClientController extends Controller {
    
    protected $nameModel = 'lrsClient';

    public function __construct()
    {
        parent::__construct($this->route);
        $this->model = $this->getModel($this->nameModel);
    }

    public function clientAddAction()
    {
        // $this->model = $this->getModel($this->nameModel);
    }
}

?>