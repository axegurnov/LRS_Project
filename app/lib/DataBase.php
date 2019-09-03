<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 21.08.19
 * Time: 10:39
 */


namespace app\lib;

use mysqli;

class DataBase
{
    private $DB_HOST = 'localhost';
    private $DB_USER = 'root';
    private $DB_PASS = 'Narutovs';
    private $DB_BASE = 'lrs';

    protected $db;

    static private $_instance = null;

    private function __construct()
    {
        $this->db = new mysqli($this->DB_HOST, $this->DB_USER, $this->DB_PASS,$this->DB_BASE) or die ('error');
    }

    static public function getInstance(){
        if(self::$_instance === null){
            self::$_instance = new DataBase();
        }
        return self::$_instance;
    }

    public function query($sql)
    {
        return $this->db->query($sql);
    }

    public function errorDatabase()
    {
        return $this->db->error;
    }
}