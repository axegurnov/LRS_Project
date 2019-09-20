<?php
namespace app\models;


use app\core\Model;

class LrsStatements extends Model
{
    public $table = 'lrs_statements';

    public function statementsJoinClients($agent)
    {
        $sql = "SELECT st.id, st.verb, st.activity, st.content, st.lrs_id, st.lrs_client_id
                FROM lrs_statements st
                JOIN lrs_client cl
                ON cl.id = st.lrs_client_id
                WHERE cl.login = " . "'$agent[login]'";
        return $this->db->query($sql);
    }

}
?>