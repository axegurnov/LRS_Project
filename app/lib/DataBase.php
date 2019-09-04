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
    protected $db;
    private static $_instance = null;

    private function __construct()
    {
        $config = require 'app/config/Database.php';
        $this->db = new mysqli($config['host'], $config['user'], $config['password'],$config['base']) or die ('error');
        //debug($this->db->error);
        require 'install/Migration.php';
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


}