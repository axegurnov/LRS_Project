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

    public function innerJoin($id)
    {
    	$sql = "SELECT a.login, b.id, b.state_key, b.value, b.activity
                FROM lrs_client a
                JOIN lrs_state b
                ON a.id = b.lrs_client_id
                WHERE b.lrs_id = " . $id;
        return $this->db->query($sql);
    }


}