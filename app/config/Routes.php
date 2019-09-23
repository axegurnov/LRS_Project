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


            'api/lrs/statements' => [
                'name' => 'api_lrs_statements',
                'controller' => 'LrsStatementsApi',
                'action' => 'index',
            ],

            'api/lrs/state' => [
                'name' => 'api_lrs_state',
                'controller' => 'LrsStateApi',
                'action' => 'index',
            ],

            //new routes

            //вывод информации по одной lrs
            'lrs/{id:\d+}/view' => [
                'name' => 'lrs',
                'controller' => 'lrs',
                'action' => 'lrsShow'
            ],

            //create новой lrs
            'lrs/create'  => [
                'name' => 'lrs_view_create',
                'controller' => 'lrs',
                'action' => 'lrsViewUpdate'
            ],

            //create view информации lrs
            'lrs/create/view'  => [
                'name' => 'lrs_view_create_new',
                'controller' => 'lrs',
                'action' => 'lrsUpdate'
            ],

            //обновление информации lrs view
            'lrs/{id:\d+}/update' => [
                'name' => 'lrs_view_update',
                'controller' => 'lrs',
                'action' => 'lrsViewUpdate'
            ],

            //обновление информации lrs
            'lrs/{id:\d+}/update/view'  => [
                'name' => 'lrs_update',
                'controller' => 'lrs',
                'action' => 'lrsUpdate'
            ],



            //удаление lrs
            'lrs/{id:\d+}/delete'  => [
                'name' => 'lrs_delete',
                'controller' => 'lrs',
                'action' => 'lrsDel'
            ],

            //вывод lrs state
            'lrs/{id:\d+}/state' => [
                'name' => 'lrs_state',
                'controller' => 'lrsState',
                'action' => 'lrsStateShow'
            ],

            //вывод lrs statements
            'lrs/{id:\d+}/statements' => [
                'name' => 'lrs_statements',
                'controller' => 'lrs',
                'action' => 'lrsStatements'
            ],

            //создание нового клиента lrs
            'lrs/client/add' => [
                'name' => 'lrs_client_add',
                'controller' => 'lrsClient',
                'action' => 'clientUpdateView'
            ],

            //обновление информации клиента lrs
            'lrs/create/add/view'  => [
                'name' => 'lrs_client_create_new',
                'controller' => 'lrsClient',
                'action' => 'clientUpdate'
            ],

            //обновление информации клиента lrs
            'lrs/client/{id:\d+}/update' => [
                'name' => 'lrs_client_view_update',
                'controller' => 'lrsClient',
                'action' => 'clientUpdateView'
            ],

            //обновление информации клиента lrs
            'lrs/client/{id:\d+}/update/view' => [
                'name' => 'lrs_client_update',
                'controller' => 'lrsClient',
                'action' => 'clientUpdate'
            ],

            //удаление клиента lrs
            'lrs/client/{id:\d+}/delete' => [
                'name' => 'lrs_client_delete',
                'controller' => 'lrsClient',
                'action' => 'clientDel'
            ],

            //создание user
            'user/view/create' => [
                'name' => 'user_view_create',
                'controller' => 'user',
                'action' => 'userViewUpdate'
            ],

            //обновление user update
            'user/{id:\d+}/update' => [
                'name' => 'user_view_update',
                'controller' => 'user',
                'action' => 'userViewUpdate'
            ],

            //del user
            'user/{id:\d+}/delete' => [
                'name' => 'user_delete',
                'controller' => 'user',
                'action' => 'userDel'
            ],
        ];
    }
}
?>