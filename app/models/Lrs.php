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

    public function Statements($id)
    {
        $sql = "SELECT lrs.id,lrs_client.login, lrs_statements.verb, lrs_statements.activity, lrs_statements.content
                FROM lrs 
                JOIN lrs_statements  ON lrs.id = lrs_statements.lrs_id JOIN lrs_client
                ON lrs_statements.lrs_client_id = lrs_client.id
                WHERE lrs_statements.lrs_id = " . $id;
        return $this->db->query($sql);
    }
    public function innerJoins($data)
    {
        $sql = "SELECT".$data['fields']."FROM".$data['first_table']." a
                JOIN ".$data['second_table']." b
                ON".$data['join_predictor']."
                WHERE".$data['predictor'];
        return $this->db->query($sql);
    }



}
?>