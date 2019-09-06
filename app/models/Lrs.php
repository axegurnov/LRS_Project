<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 05.09.19
 * Time: 12:25
 */

namespace app\models;
use app\core\Model;

class Lrs extends Model
{
    public $table = 'lrs';

    public function getList()
    {
        return $this->db->query("select * from " . $this->table);
    }
}