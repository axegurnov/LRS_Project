<?php
namespace app\controllers;

use app\core\Controller;

abstract class InheritanceController extends GetModelController {

    public function pagination($params, $limit, $count_id)
    {
        //debug($params['page']);
        if (empty($params['page'])) {
            $params['page'] = 1;
        };
        $offset = ($params['page'] - 1) * $limit;
        $ttl = $count_id[0];
        $pages = ceil($ttl / $limit);
        $vars = [
            'offset' => $offset,
            'pages' => $pages,
        ];
        return $vars;
    }

}