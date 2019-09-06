<?php

namespace app\core;
use app\core\Database;

class Model
{
    public $table = null;
    public $params = array();
    public $params_changed = array();

    public $db;
    private static $_instance = null;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public static function getInstance($nameModel) {
        $path = 'app\models\\' . $nameModel;
        if (self::$_instance == null) {
            self::$_instance = new $path();
        }
        return self::$_instance;
    }

    protected static function buildUpdateSql($data,$table,$id) {
        $columns = "";
        $holders = "";
        foreach ($data as $column => $value) {
            $columns .= ($columns == "") ? "" : ", ";
            $columns .= $column."=";
            $holders .= $holders;
            $columns .= "'".$value."'".$holders;

        }
        $sql = "UPDATE $table SET $columns WHERE id= $id";
        return $sql;

    }

    protected static function buildInsertSql($data,$table) {
        $columns = "";
        $holders = "";
        foreach ($data as $column => $value) {
            $columns .= ($columns == "") ? "" : ", ";
            $columns .= $column;
            $holders .= ($holders == "") ? "" : ", ";
            $holders .= "'".$value."'";
        }
        $sql = "INSERT INTO $table ($columns) VALUES ($holders)";
        return $sql;
    }


    public function getFields($table)
    {
        $fields = array();
        $sql = "SELECT `COLUMN_NAME` 
FROM `INFORMATION_SCHEMA`.`COLUMNS` 
WHERE `TABLE_SCHEMA`='lrs'
        AND `TABLE_NAME`= '".$table."';";

        $result = $this->db->query($sql);
        $rows = mysqli_num_rows($result);
        $i = 0;
        $fieldsStr = '';
        while ($i != $rows) {
            $row = mysqli_fetch_row($result);
            $fields[$i] = $row[0];
                if ($i==0)
                {
                    $fieldsStr = "$row[0]";
                }
                else
                {
                    $fieldsStr = "$fieldsStr".', '."$row[0]";
                }
                $i++;

            }
            $result = array('str'=>$fieldsStr,'array'=>$fields);
        return $this->params = $result;
    }

    public function getAllRecords($fields = '*')
    {
      $sql = "SELECT $fields FROM $this->table;";
        $object = $this->db->query($sql);
        $rows = mysqli_num_rows($object);
        $i = 0;
        $allRecords = array();
        while($i!= $rows){
            $row = mysqli_fetch_array($object,MYSQLI_ASSOC);
            $allRecords[$i] = $row;
            $i++;
        }
        return $this->params = $allRecords;

    }

    function select($fields = '*',$predictor = '')
    {
        $sql = "SELECT $fields FROM $this->table WHERE".$predictor.";";
        $object = $this->db->query($sql);
        return $this->params = mysqli_fetch_array($object);

    }


    public function getValue($item)
    {
        if(!empty($this->params)){
            return $this->params[$item];
        }
        else {
            echo 'Нет данных в записи!';
        }
    }

    public function setValue($item, $value)
    {
        $this->params_changed[$item] = $value;
        return $this->params[$item] = $value;

    }
    public function setValues($data)
    {
        foreach ($data as $value){
            htmlspecialchars(urldecode(trim($value)), ENT_QUOTES | ENT_HTML401);
        }

        return $this->params_changed = $data;

    }

    public function updateRecord($id)
    {
        $sql = self::buildUpdateSql($this->params_changed,$this->table,$id);
        $object = $this->db->query($sql);
    }

    public function addRecord()
    {
        $sql = self::buildInsertSql($this->params_changed,$this->table);

        $db = DataBase::getInstance();
        $object = $db->query($sql);

    }

    public function dropRecord($id)
    {
        $sql = "DELETE FROM $this->table WHERE id=$id";
        $object = $this->db->query($sql);

    }


}
