<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 02.09.19
 * Time: 18:07
 */

namespace app\core\DataBase;



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

        //debug($this->db->errorDatabase());

    }

}