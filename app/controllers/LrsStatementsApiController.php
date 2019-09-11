<?php


namespace app\controllers;

class LrsStatementsApiController extends Api
{
    protected $nameModel = 'LrsStatements';

    public function someAction()
    {
        //debug($this->route);
        //debug($_SERVER);
        $arr = [
            'test1' => [
                '1var' => '1',
                '2var' => '2',
            ],
            'test2' => [
                '3var' => '3',
                '4var' => '4',
            ],
        ];

        $this->response($arr, 200);
    //    header('Content-type: application/json');
      //  echo $this->convertToJson($arr);
        //return $this->convertToJson($arr);
    }
}