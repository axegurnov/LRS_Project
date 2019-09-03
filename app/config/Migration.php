<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 03.09.19
 * Time: 11:31
 */


$DB_HOST = 'localhost';
$DB_USER = 'root';
$DB_PASS = '123';
$DB_BASE = 'lrs';

$db = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_BASE) or die ('error');

//create table users
$db->query("create table users (id int not null AUTO_INCREMENT,
                              login varchar (20) not null,
                              password varchar (100) not null,
                              name varchar (20) not null,
                              email varchar (50) not null,
                              primary key (id)
                        )");

//create table lrs
$db->query("create table lrs (id int not null AUTO_INCREMENT,
                              name varchar (100) not null,
                              description varchar (200) not null,
                              primary key (id)
                              )");
//create table lrs_client
$db->query("create table lrs_client (id int not null AUTO_INCREMENT,
                              login varchar (20) not null,
                              password varchar (200) not null,
                              lrs_id int null,
                              primary key (id)
                              )");

//create table lrs_statements
$db->query("create table lrs_statements (id int not null AUTO_INCREMENT,
                              actor varchar (20) not null,
                              verb varchar (200) not null,
                              activity varchar (200) not null,
                              content varchar (200) not null,
                              primary key (id)
                              )");

//create table lrs_state
$db->query("create table lrs_state (id int not null AUTO_INCREMENT ,
                              keyss varchar (100) not null ,
                              value varchar (100) not null ,
                              primary key (id))");

//seed users
$db->query("insert into users (login, password, name, email) value ('admin','123','alex','google@gmail.com')");
$db->query("insert into users (login, password, name, email) value ('admin2','1234','neron','gasd@gmail.com')");

//seed lrs
$db->query("insert into lrs (name, description) value ('Course 1','about course 1')");
$db->query("insert into lrs (name, description) value ('Course 2','about course 2')");
$db->query("insert into lrs (name, description) value ('Course 3','about course 3')");
$db->query("insert into lrs (name, description) value ('Course 4','about course 4')");

//seed lrs_client
$db->query("insert into lrs_client (login, password, lrs_id) value ('vasya','123','4')");
$db->query("insert into lrs_client (login, password, lrs_id) value ('petya','123','2')");
$db->query("insert into lrs_client (login, password, lrs_id) value ('vova','123','1')");
$db->query("insert into lrs_client (login, password, lrs_id) value ('nastya','123','3')");

//seed lrs_statements
$db->query("insert into lrs_statements (actor, verb, activity, content) value ('vasya','watching','video','video 1')");
$db->query("insert into lrs_statements (actor, verb, activity, content) value ('petya','read','course','course 1')");
$db->query("insert into lrs_statements (actor, verb, activity, content) value ('vova','complete','course','course 3')");
$db->query("insert into lrs_statements (actor, verb, activity, content) value ('nasya','open','course','course 2')");

//seed lrs_state
$db->query("insert into lrs_state (keyss, value) value ('g89r98g3','0')");
$db->query("insert into lrs_state (keyss, value) value ('sadfasdf','1')");