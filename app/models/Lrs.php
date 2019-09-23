<?php
namespace app\models;
use app\core\Model;

class Lrs extends Model
{
    public $table = 'lrs';

    public function statements($id)
    {
        $sql = "SELECT lrs.id, cl.id, cl.login, verb.name as verb, act.name, st.content, st.create_date
                FROM lrs 
                JOIN lrs_statements st 
                ON lrs.id = st.lrs_id 
                JOIN lrs_client cl
                ON st.lrs_client_id = cl.id
                JOIN activity act 
                ON st.activity_id = act.id
                JOIN verb
                ON st.verb_id = verb.id
                WHERE st.lrs_id = " . $id;

        return $this->db->query($sql);
    }
}
?>