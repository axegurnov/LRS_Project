<?php
namespace app\config;
class Routes
{
   static public function getRoutes()
    {
        return [
            '' => [
              'controller' => 'user',
              'action' => 'auth',
            ],

            'login' => [
              'controller' => 'user',
              'action' => 'auth'
            ],

            'users'=>[
                'controller' => 'user',
                'action' => 'index',
            ],

            'user/update' => [
                'controller' => 'user',
                'action' => 'userUpdate',
            ],

            'user/view/update' => [
                'controller' => 'user',
                'action' => 'userViewUpdate',
            ],

            'user/del' => [
                'controller' => 'user',
                'action' => 'userDel',
            ],

            'user/exit' => [
                'controller' => 'user',
                'action' => 'exit',
            ],

            'lrs/list' => [
                'controller' => 'lrs',
                'action' => 'lrsList',
            ],

            'lrs' => [
                'controller' => 'lrs',
                'action' => 'lrsShow'
            ],

            'lrs/del'  => [
                'controller' => 'lrs',
                'action' => 'lrsDel',
            ],

            'lrs/view/update'  => [
                'controller' => 'lrs',
                'action' => 'lrsViewUpdate',
            ],

            'lrs/update'  => [
                'controller' => 'lrs',
                'action' => 'lrsUpdate',
            ],

            'lrs/client/add' => [
                'controller' => 'lrsClient',
                'action' => 'clientAdd',
            ],

            'lrs/client/update' => [
                'controller' => 'lrsClient',
                'action' => 'clientUpdate',
            ],
            'lrs/client/view/update' => [
                'controller' => 'lrsClient',
                'action' => 'clientUpdateView',
            ],
            'lrs/client/delete' => [
                'controller' => 'lrsClient',
                'action' => 'clientDel',
            ],


            'api' => [
                'controller' => 'LrsStatementsApi',
                'action' => 'some',
            ],

        ];
    }
}
