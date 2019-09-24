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
                WHERE cl.login = " . "'$agent'";
        return $this->db->query($sql);
    }

    public function statementsJoinActivity($activity)
    {
        $sql = "SELECT st.id, verb.name, act.name, st.content, st.lrs_id, st.lrs_client_id
                FROM lrs_statements st
                JOIN lrs_client cl
                ON cl.id = st.lrs_client_id
                JOIN activity act 
                ON st.activity_id = act.id
                JOIN verb 
                ON st.verb_id = verb.id
                WHERE act.name = " . "'$activity'";
        return $this->db->query($sql);
    }

    public function statementsJoinVerb($verb)
    {
        $sql = "SELECT st.id, verb.name, v.name, st.content, st.lrs_id, st.lrs_client_id
                FROM lrs_statements st
                JOIN lrs_client cl
                ON cl.id = st.lrs_client_id
                JOIN verb v 
                ON st.verb_id = v.id
                JOIN verb 
                ON st.verb_id = verb.id
                WHERE v.name = " . "'$verb'";
        return $this->db->query($sql);
    }

    public function getClientLoginById($login)
    {
        $sql = "SELECT id FROM lrs_client WHERE login='$login'";
        return $this->db->query($sql);
    }
}

?>