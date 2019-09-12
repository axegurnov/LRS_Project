<?php
namespace app\models;
use app\core\Model;

class LrsState extends Model
{

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
?>