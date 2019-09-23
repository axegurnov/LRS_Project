<?php

namespace app\models;

use app\core\Model;

class LrsStatements extends Model
{
    public $table = 'lrs_statements';

    public function statementsJoinClients($agent)
    {
        $sql = "SELECT st.id, verb.name, act.name, st.content, st.lrs_id, st.lrs_client_id
                FROM lrs_statements st
                JOIN lrs_client cl
                ON cl.id = st.lrs_client_id
                JOIN activity act 
                ON st.activity_id = act.id
                JOIN verb
                ON st.verb_id = verb.id
                WHERE cl.login = " . "'$agent[login]'";
        return $this->db->query($sql);
    }
}

?>