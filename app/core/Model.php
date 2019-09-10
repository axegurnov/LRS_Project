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

    public static function getInstance($nameModel)
    {
        $path = 'app\models\\' . $nameModel;
        if (self::$_instance == null) {
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
        $sql = "UPDATE $table SET $columns WHERE id= $id";
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
        $sql = "INSERT INTO $table ($columns) VALUES ($holders)";
        return $sql;
    }


    public function getFields($table)
    {
        $fields = array();
        $sql = "SELECT `COLUMN_NAME` 
        FROM `INFORMATION_SCHEMA`.`COLUMNS` 
        WHERE `TABLE_SCHEMA`='lrs'
        AND `TABLE_NAME`= '" . $table . "';";

        $result = $this->db->query($sql);
        $rows = mysqli_num_rows($result);
        $i = 0;
        $fieldsStr = '';
        while ($i != $rows) {
            $row = mysqli_fetch_row($result);
            $fields[$i] = $row[0];
            if ($i == 0) {
                $fieldsStr = "$row[0]";
            } else {
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
            return $this->params = mysqli_fetch_array($object);
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
        foreach ($data as $value) {
            htmlspecialchars(urldecode(trim($value)), ENT_QUOTES | ENT_HTML401);
        }
        return $this->params_changed = $data;
    }

    public function updateRecord($id)
    {
        $sql = self::buildUpdateSql($this->params_changed, $this->table, $id);
        $object = $this->db->query($sql);
    }

    public function addRecord()
    {
        $sql = self::buildInsertSql($this->params_changed, $this->table);
        $object = $this->db->query($sql);
    }

    public function dropRecord($id)
    {
        $sql = "DELETE FROM $this->table WHERE id=$id";
        $object = $this->db->query($sql);

    }

    public function pagination($startForm, $limit)
    {
        $rsResult = $this->db->query("SELECT * FROM lrs ORDER BY id asc LIMIT $startForm, $limit");
        return $rsResult;
    }

    public function countId()
    {
        $countId = $this->db->query("SELECT COUNT(id) from {$this->table}")->fetch_row();
        return $countId;
    }

    public function Validate($data)
    {
        $error = array();
        $pattern = "/^[а-яА-ЯёЁa-zA-Z]+$/";
        $email_pattern = "/^[a-z0-9_.\-]+$/i";
        $desc_pattern = "/^[а-яА-ЯёЁa-zA-Z0-9 ]+$/";

        foreach ($data as $key => $value) {
            $value = trim($value);
            if (empty($value)) {
                $error[$key] = "Значение $key не введено!";
            }
        }

        if ($error)
        {
            return $error;
        }
        else
        {
            function check_length($value = "", $min, $max)
            {
                $result = (mb_strlen($value) >= $min && mb_strlen($value) < $max);
                return $result;
            }


            if (isset($data['login'])) {
                $login = !preg_match($email_pattern, trim($data['login']));

                if ($login) {
                    $error['login'] = "Некорректно введен login. Допустимо использовать только латинские буквы, цифры,
знак подчеркивания («_»), точку («.»), минус («-»)";
                }

            }

            if (isset($data['password'])) {
                $min = 8;
                $max = 25;
                if (!check_length(trim($data['password']), $min, $max)) {
                    $error['password'] = "Пароль должен содержать от восьми до двадцати пяти символов!";
                }
            } else {
                if (isset($data['name'])) {
                    $name = !preg_match($pattern, trim($data['name']));
                    if ($name) {
                        $error['name'] = "Имя введено неверно. Допустимо использвать только латинские буквы и/или кириллицу";
                    }
                    $num_words = explode(" ", trim($data['name']));
                    if (sizeof($num_words) > 1) {
                        $error['name'] = $error['name'] . " Имя должно состоять из одного слова";
                    }

                }
            }
            if (isset($data['second_name'])) {
                $name = !preg_match($pattern, trim($data['name']));
                if ($name) {
                    $error['second_name'] = "Фамилия введена неверно. Допустимо использвать только латинские буквы и/или кириллицу";
                }
                $num_words = explode(" ", trim($data['name']));
                if (sizeof($num_words) > 1) {
                    $error['second_name'] = $error['second_name'] . " Фамилия должна состоять из одного слова";
                }

            }

            if (isset($data['email'])) {
                if (strpbrk("@", $data['email'])) //Проверка на наличие символа @
                {
                    // email разделяется по символу @ на две части, которые по отдельности проверяются регулярным выражением
                    $partsOfEmail = explode("@", trim($data['email']));
                    $partOne = !preg_match($email_pattern, $partsOfEmail[0]);
                    $partTwo = !preg_match($email_pattern, $partsOfEmail[1]);

                    if (($partOne) || ($partTwo)) {
                        $error['email'] = "Некорректно введен email. Допустимо использовать только латинские буквы, цифры,
знак подчеркивания («_»), точку («.»), минус («-»)";
                    }
                } else {
                    $error['email'] = "Email должен содержать знак : @ ";
                }
            }

            if (isset($data['description'])) {
                $description = !preg_match($desc_pattern, trim($data['description']));
                if ($description) {
                    $error['description'] = "Имя должно состоять из трех слов";
                }
            }

            return $error;

        }
    }

}
