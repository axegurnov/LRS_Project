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
    private static $DB_HOST = 'localhost';
    private static $DB_USER = 'root';
    private static $DB_PASS = '123';
    private static $DB_BASE = 'lrs';

    protected $db;

    private static $_instance = null;

    private function __construct()
    {
        $this->db = new mysqli(self::$DB_HOST, self::$DB_USER, self::$DB_PASS,self::$DB_BASE) or die ('error');
    }

    public static function getInstance(){
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