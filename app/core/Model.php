<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 02.09.19
 * Time: 18:07
 */

namespace app\core;

use app\lib\DataBase;

class Model
{
    public $db;

    protected $table = '';
    protected $fieldsInsert = [];
    protected $errors = [];

    public function __construct()
    {
        $this->db = DataBase::getInstance();
    }

    public function migration()
    {

        //create table users
        $this->db->query("create table users (id int not null,
                              login varchar (20) not null,
                              password varchar (100) not null,
                              name varchar (20) not null,
                              email varchar (50) not null,
                              primary key (id)
                        )");
        //create table lrs
        $this->db->query("create table lrs (id int not null,
                              name varchar (100) not null,
                              description varchar (200) not null,
                              primary key (id)
                              )");
        //create table lrs_client
        $this->db->query("create table lrs_client (id int not null,
                              login varchar (20) not null,
                              password varchar (200) not null,
                              primary key (id)
                              )");

        //create table lrs_statements
        $this->db->query("create table lrs_statements (id int not null,
                              actor varchar (20) not null,
                              verb varchar (200) not null,
                              activity varchar (200) not null,
                              content varchar (200) not null,
                              primary key (id)
                              )");

        //create table lrs_state
        $this->db->query("create table lrs_state (id int not null,
                              key varchar (200) not null,
                              value varchar (200) not null,
                              primary key (id)
                              )");





    }

}