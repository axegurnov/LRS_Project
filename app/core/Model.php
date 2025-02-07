<?php
namespace app\core;

use app\core\Database;
use app\core\Validation;

class Model
{
    public $table = NULL;
    public $params = array();
    public $params_changed = array();
    public $db;

    private static $_instance = NULL;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public static function getInstance($nameModel)
    {
        $path = 'app\models\\' . $nameModel;
        if (self::$_instance == NULL) {
            self::$_instance = new $path();
        }
        return self::$_instance;
    }

    protected static function buildUpdateSql($data, $table, $id)
    {
        $columns = "";
        $holders = "";
        foreach ($data as $column => $value) {
            $columns .= ($columns == "") ? "" : ", ";
            $columns .= $column . "=";
            $holders .= $holders;
            $columns .= "'" . $value . "'" . $holders;
        }
        $sql = "UPDATE $table SET $columns WHERE id= $id;";
        return $sql;
    }

    protected static function buildInsertSql($data, $table)
    {
        $columns = "";
        $holders = "";
        foreach ($data as $column => $value) {
            $columns .= ($columns == "") ? "" : ", ";
            $columns .= $column;
            $holders .= ($holders == "") ? "" : ", ";
            $holders .= "'" . $value . "'";
        }
        $sql = "INSERT INTO $table ($columns) VALUES ($holders);";
        return $sql;
    }


    public function getFields($table)
    {
        $config = require '../app/config/Database.php';
        $fields = array();
        $sql = "SELECT `COLUMN_NAME`
        FROM `INFORMATION_SCHEMA`.`COLUMNS`
        WHERE `TABLE_SCHEMA`='" . $config['base'] . "'AND `TABLE_NAME`= '" . $table . "';";

        $result = $this->db->query($sql);
        $rows = mysqli_num_rows($result);
        $i = 0;
        $fieldsStr = '';
        while ($i != $rows) {
            $row = mysqli_fetch_row($result);
            $fields[$i] = $row[0];
            if ($i == 0) {
                $fieldsStr = "$row[0]";
            }
            else {
                $fieldsStr = "$fieldsStr" . ', ' . "$row[0]";
            }
            $i++;
        }
        $result = array('str' => $fieldsStr, 'array' => $fields);
        return $this->params = $result;
    }

    public function getAllRecords($fields = '*')
    {
        $sql = "SELECT $fields FROM $this->table;";
        $object = $this->db->query($sql);
        $rows = mysqli_num_rows($object);
        $i = 0;
        $allRecords = array();
        while ($i != $rows) {
            $row = mysqli_fetch_array($object, MYSQLI_ASSOC);
            $allRecords[$i] = $row;
            $i++;
        }
        return $this->params = $allRecords;
    }


    function select($predictor, $fields = '*')
    {
        if ($predictor) {
            $sql = "SELECT $fields FROM $this->table WHERE " . $predictor . ";";
            $object = $this->db->query($sql);
            return $this->params = mysqli_fetch_array($object, MYSQLI_ASSOC);
        }
        echo "Отсутствует условие!";
    }

    function getMultipleByPredictor($predictor, $fields = '*')
    {
        if ($predictor) {
            $sql = "SELECT $fields FROM $this->table WHERE " . $predictor . ";";
            $object = $this->db->query($sql);
            $arr = NULL;
            foreach ($object as $key => $value) {
                $arr[$key] = $value;
            }
            return $arr;
        }
        echo "Отсутствует условие!";
    }

    public function getValue($item)
    {
        if (!empty($this->params)) {
            return $this->params[$item];
        }
        echo 'Нет данных в записи!';
    }

    public function setValue($item, $value)
    {
        $this->params_changed[$item] = $value;
        return $this->params[$item] = $value;
    }

    public function setValues($data)
    {
        $valid = Validation::Validate($data);
        if (empty($valid)) {
            foreach ($data as $value) {
                htmlspecialchars(urldecode(trim($value)), ENT_QUOTES | ENT_HTML401);
            }
            $this->params_changed = $data;
            return FALSE;
        }
        return $valid;
    }

    public function updateRecord($id)
    {
        $sql = self::buildUpdateSql($this->params_changed, $this->table, $id);
        $this->db->query($sql);
    }

    public function addRecord()
    {
        $sql = self::buildInsertSql($this->params_changed, $this->table);
        $this->db->query($sql);
    }

    public function dropRecord($id)
    {
        $sql = "DELETE FROM $this->table WHERE id=$id";
        $this->db->query($sql);
    }

    public function getValueTableApi($table, $predictor)
    {
        return $this->db->query("select * from $table where $predictor")->fetch_assoc();
    }

    public function getValueTable($table, $predictor)
    {
        return $this->db->query("select * from $table where $predictor");
    }

    public function pagination($offset, $limit)
    {
        return $this->db->query("SELECT * FROM $this->table ORDER BY id asc LIMIT $offset, $limit");
    }

    public function countId()
    {
        return $this->db->query("SELECT COUNT(id) from {$this->table}")->fetch_row();
    }
}

?>
