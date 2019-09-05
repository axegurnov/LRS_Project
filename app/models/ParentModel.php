<?php

namespace app\core;
use app\models\DataBase;

class ParentModel
{
    public $table = null;
    public $params = array();
    public $params_changed = array();

    protected static function buildUpdateSql($data,$table,$id) {
        $columns = "";
        $holders = "";
        foreach ($data as $column => $value) {
            $columns .= ($columns == "") ? "" : ", ";
            $columns .= $column."=";
            $holders .= $holders;
            $columns .= $value.$holders;

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
            $holders .= $value;
        }
        $sql = "INSERT INTO $table ($columns) VALUES ($holders)";
        return $sql;
    }


    public function getFields()
    {
        $fields = array();
        $sql = "SELECT `COLUMN_NAME` 
FROM `INFORMATION_SCHEMA`.`COLUMNS` 
WHERE `TABLE_SCHEMA`='lrs' //Добавить переменную с именем БД
        AND `TABLE_NAME`= $this->table";
        $db = DataBase::getInstance();

        $result = $db->query($sql);
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

    public function getAllRecords($fields)
    {
        $sql = "SELECT $fields FROM $this->table";
        $db = DataBase::getInstance();
        $object = $db->query($sql);
        //$object = mysqli_query($db,$sql);
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

    function select($id, $fields = '*')
    {
        $sql = "SELECT $fields FROM $this->table WHERE id= $id";
        $db = DataBase::getInstance();
        $object = $db->query($sql);
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

    public function updateRecord($id)
    {
        $sql = self::buildUpdateSql($this->params_changed,$this->table,$id);
        $db = DataBase::getInstance();
        $object = $db->query($sql);
    }

    public function addRecord()
    {
        $sql = self::buildInsertSql($this->params_changed,$this->table);
        $db = DataBase::getInstance();
        $object = $db->query($sql);

    }


}