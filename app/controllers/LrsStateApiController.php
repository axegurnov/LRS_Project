<?php

namespace app\controllers;

class LrsStateApiController extends Api
{
    public function updateAction()
    {
        $data = $this->convertFromJson($this->requestBody);
        //debug($data);
        $data_field = array();
        $tables = $this->model->getFields($this->model->table)['array'];
        if (!empty($_GET['id'])) {
            $record = $this->getRecord($_GET['id']);
            if (!$record) {
                return $this->response('Record wasnt found', 404);
            }
            $size_diff = sizeof($tables)-sizeof($data);
            $tables=array_flip($tables);
            $diff = array_intersect_key($tables,$data);
            debug($tables);
            if($diff != 0){
                return $this->response('Number of parameters set incorrectly', 404);
            }
            foreach ($data as $key => $value)
            {
               foreach($tables as $values){
                   if ($key == $values){

                   }
               }
            }

            $this->model->setValues($data);
            $this->model->updateRecord($_GET['stateId']);
            return $this->response('Record was updated', 200);
        }

        return $this->response('Failed update', 404);

    }

}
