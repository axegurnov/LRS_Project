<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 03.09.19
 * Time: 11:31
 */

//create table users
$this->db->query("create table if not exists users (id int not null AUTO_INCREMENT,
                              login varchar (20) not null,
                              password varchar (100) not null,
                              name varchar (20) not null,
                              email varchar (50) not null,
                              create_time varchar (50) null,
                              update_time varchar (50) null,
                              primary key (id)
                        )");



//create table lrs
$this->db->query("create table if not exists lrs (id int not null AUTO_INCREMENT,
                              name varchar (100) not null,
                              description varchar (200) not null,
                              create_time varchar (50) null,
                              update_time varchar (50) null,
                              primary key (id)
                              )");

//create table lrs_client
$this->db->query("create table if not exists lrs_client (id int not null AUTO_INCREMENT,
                              lrs_id int null,
                              login varchar (20) not null,
                              password varchar (200) not null,
                              description varchar (200) not null,
                              create_time varchar (50) null,
                              update_time varchar (50) null,
                              primary key (id)
                              )");

//create table lrs_statements
$this->db->query("create table if not exists lrs_statements (id int not null AUTO_INCREMENT,
                              actor varchar (20) not null,
                              verb varchar (200) not null,
                              activity varchar (200) not null,
                              content varchar (200) not null,
                              lrs_id int (200) not null,
                              lrs_client_id int (200) not null,
                              create_time varchar (50) null,
                              update_time varchar (50) null,
                              primary key (id)
                              )");

//create table lrs_state
$this->db->query("create table if not exists lrs_state (
                              id int not null AUTO_INCREMENT,
                              lrs_id int (100) not null,
                              lrs_client_id int (100) not null,
                              state_key varchar (100) not null,
                              value varchar (100) not null,
                              activity varchar (100) not null,
                              registration varchar (100) not null,
                              create_time varchar (50) null,
                              update_time varchar (50) null,
                              primary key (id)
                              )");

//seed users
$this->db->query("insert into users (login, password, name, email) value ('admin','123','alex','google@gmail.com')");
$this->db->query("insert into users (login, password, name, email) value ('admin2','1234','neron','gasd@gmail.com')");

//seed lrs
$this->db->query("insert into lrs (name, description) value ('Course 1','about course 1')");
$this->db->query("insert into lrs (name, description) value ('Course 2','about course 2')");
$this->db->query("insert into lrs (name, description) value ('Course 3','about course 3')");
$this->db->query("insert into lrs (name, description) value ('Course 4','about course 4')");

//seed lrs_client
$this->db->query("insert into lrs_client (lrs_id, login, password, description) value ('4','vasya','123','Vasya')");
$this->db->query("insert into lrs_client (lrs_id, login, password, description) value ('3','petya','123','Petya')");
$this->db->query("insert into lrs_client (lrs_id, login, password, description) value ('2','vova','123','Vova','1')");
$this->db->query("insert into lrs_client (lrs_id, login, password, description) value ('1','nastya','123','Nastya')");

//seed lrs_statements
$this->db->query("insert into lrs_statements (actor, verb, activity, content) value ('vasya','watching','video','video 1')");
$this->db->query("insert into lrs_statements (actor, verb, activity, content) value ('petya','read','course','course 1')");
$this->db->query("insert into lrs_statements (actor, verb, activity, content) value ('vova','complete','course','course 3')");
$this->db->query("insert into lrs_statements (actor, verb, activity, content) value ('nasya','open','course','course 2')");

//seed lrs_state
$this->db->query("insert into lrs_state (lrs_key, value) value ('var1','0')");
$this->db->query("insert into lrs_state (lrs_key, value) value ('var2','1')");