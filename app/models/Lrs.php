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

    public function Statements($id)
    {
        $sql = "SELECT lrs_client.login, lrs_statements.verb, lrs_statements.activity, lrs_statements.content
                FROM lrs 
                JOIN lrs_statements  ON lrs.id = lrs_statements.lrs_id JOIN lrs_client
                ON lrs_statements.lrs_client_id = lrs_client.id
                WHERE lrs_statements.lrs_id = " . $id;
        return $this->db->query($sql);
    }
}