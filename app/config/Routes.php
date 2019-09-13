<?php
namespace app\config;
class Routes
{
    static public function getRoutes()
    {
        return [
            '' => [
                'name' => 'home',
                'controller' => 'user',
                'action' => 'auth'
            ],

            'login' => [
                'name' => 'login',
                'controller' => 'user',
                'action' => 'auth'
            ],

            'users' => [
                'name' => 'users',
                'controller' => 'user',
                'action' => 'index'
            ],

            'user/update' => [
                'name' => 'user_update',
                'controller' => 'user',
                'action' => 'userUpdate'
            ],

            'user/view/update' => [
                'name' => 'user_view_update',
                'controller' => 'user',
                'action' => 'userViewUpdate'
            ],

            'user/del' => [
                'name' => 'user_del',
                'controller' => 'user',
                'action' => 'userDel'
            ],

            'user/exit' => [
                'name' => 'user_exit',
                'controller' => 'user',
                'action' => 'exit'
            ],

            'lrs/list' => [
                'name' => 'lrs_list',
                'controller' => 'lrs',
                'action' => 'lrsList'
            ],

            'lrs/state' => [
                'name' => 'lrs_state',
                'controller' => 'lrsState',
                'action' => 'lrsStateShow'
            ],

            'lrs/statements' => [
                'name' => 'lrs_statements',
                'controller' => 'lrs',
                'action' => 'lrsStatements'
            ],

            'lrs' => [
                'name' => 'lrs',
                'controller' => 'lrs',
                'action' => 'lrsShow'
            ],

            'lrs/del'  => [
                'name' => 'lrs_del',
                'controller' => 'lrs',
                'action' => 'lrsDel'
            ],

            'lrs/view/update'  => [
                'name' => 'lrs_view_update',
                'controller' => 'lrs',
                'action' => 'lrsViewUpdate'
            ],

            'lrs/update'  => [
                'name' => 'lrs_update',
                'controller' => 'lrs',
                'action' => 'lrsUpdate'
            ],

            'lrs/client/add' => [
                'name' => 'lrs_client_add',
                'controller' => 'lrsClient',
                'action' => 'clientAdd'
            ],

            'lrs/client/update' => [
                'name' => 'lrs_client_update',
                'controller' => 'lrsClient',
                'action' => 'clientUpdate'
            ],

            'lrs/client/view/update' => [
                'name' => 'lrs_client_view_update',
                'controller' => 'lrsClient',
                'action' => 'clientUpdateView'
            ],

            'lrs/client/delete' => [
                'name' => 'lrs_client_delete',
                'controller' => 'lrsClient',
                'action' => 'clientDel'
            ],

            'api/lrs/statements' => [
                'name' => 'api_lrs_statements',
                'controller' => 'LrsStatementsApi',
                'action' => 'index',
            ]
        ];
    }
}
?>