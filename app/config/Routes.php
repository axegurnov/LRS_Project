<?php
namespace app\config;
class Routes
{
    public function getRoutes()
    {
        return [
            '' => [
              'controller' => '?',
              'action' => '?'
            ],
             
          'login' => [
              'controller' => 'user',
              'action' => 'auth'
            ],
            
            'users'=>[
                'controller' => 'user',
                'action' => 'usersList'
            ],
            'user/add' => [
                'controller' => 'user',
                'action' => 'add',
            ],
            'user/update' => [
                'controller' => 'user',
                'action' => 'update',
            ],
            'user/delete' => [
                'controller' => 'user',
                'action' => 'delete',
            ],

            'lrs/list' => [
                'controller' => 'lrs',
                'action' => 'lrsList'
            ],
            'lrs' => [
                'controller' => 'lrs',
                'action' => 'lrsShow'
            ],
            'lrs/add'  => [
                'controller' => 'lrs',
                'action' => 'lrsAdd'
            ],

            'lrs/client/add' => [
                'controller' => 'lrsClient',
                'action' => 'clientAdd'
            ],
            'lrs/client/delete' => [
                'controller' => 'lrsClient',
                'action' => 'clientDel'
            ]
        ];
    }
}
