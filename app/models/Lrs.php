<?php
namespace app\models;
use app\core\Model;

class Lrs extends Model
{
    public $table = 'lrs';

    public function statements($id)
    {
        $sql = "SELECT lrs.id, lrs_client.id, lrs_client.login, lrs_statements.verb, lrs_statements.activity, lrs_statements.content, lrs_statements.create_data
                FROM lrs 
                JOIN lrs_statements ON lrs.id = lrs_statements.lrs_id JOIN lrs_client
                ON lrs_statements.lrs_client_id = lrs_client.id
                WHERE lrs_statements.lrs_id = " . $id;

        return $this->db->query($sql);
    }
}
?>