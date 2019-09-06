<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 05.09.19
 * Time: 11:12
 */

namespace app\core;
use mysqli;

class Database
{
    protected $db;
    private static $_instance = null;

    private function __construct()
    {
        $config = require 'app/config/Database.php';
        $this->db = new mysqli($config['host'], $config['user'], $config['password'],$config['base']) or die ('error');
    }

    public static function getInstance() 
    {
        if(self::$_instance === null) {
            self::$_instance = new DataBase();
        }
        return self::$_instance;
    }

    public function query($sql)
    {
        return $this->db->query($sql);
    }

    public function __destruct() 
    {
        if ($this->db) {
            $this->db->close();
        }
    }
}