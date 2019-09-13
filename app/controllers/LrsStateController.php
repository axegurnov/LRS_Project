<?php
namespace app\controllers;

use app\core\Controller;

class LrsStateController extends GetModelController 
{
	
    public function lrsStateShowAction($params){
        $lrs ='';
        if(empty($params['view'])) {
            $id = 1;
        } else {
            $id = $params['view'];
        }

        $states = $this->model->innerJoin($id);


        $predictor = "id=".$id;

        $lrss= $this->model->getValueTable("lrs", $predictor);
        foreach ($lrss as $lrs2){
            $lrs = $lrs2;
        }

        $vars =[
            'title' => 'LRS '.$id,
            'lrs' => $lrs,
            'states' => $states
        ];
        $this->view->generate('lrs/state.tlp',$vars);
    }

}

?>
