<?php
namespace app\controllers;

use app\core\Controller;

class LrsStateController extends Controller 
{
	
    public function lrsStateShowAction($params){
        if(empty($params['view'])) {
            $id = 1;
        } else {
            $id = $params['view'];
        }

        $states = $this->model->innerJoin($id);


        $predictor = "id=".$id;

        $lrss= $this->model->getValueTable("lrs",$predictor);
        
        $vars =[
            'title' => 'LRS '.$id,
            'lrs' => $lrss,
            'states' => $states
        ];
        $this->view->generate('lrs/state.tlp',$vars);
    }

}

?>
