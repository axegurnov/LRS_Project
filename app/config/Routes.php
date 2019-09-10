<?php
namespace app\config;
class Routes
{
   static public function getRoutes()
    {
        return [
            '' => [
              'controller' => 'checkRoutes',
              'action' => 'checkRoutes',
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

            'lrs/client/delete' => [
                'controller' => 'lrsClient',
                'action' => 'clientDel',
            ],
        ];
    }
}
