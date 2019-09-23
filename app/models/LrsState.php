<?php

namespace app\models;

use app\core\Model;

class LrsState extends Model
{
    public $table = 'lrs_state';

    public function innerJoin($id)
    {
        $sql = "SELECT a.login, b.id, b.state_key, b.value, b.activity
                FROM lrs_client a
                JOIN $this->table b
                ON a.id = b.lrs_client_id
                WHERE b.lrs_id = $id";
        return $this->db->query($sql);
    }

    public function stateActivityAgent($data){
        //$login = $data['agent']['login'];
        $act = $data['activityId'];
        $sql = "SELECT *
                FROM lrs_client cl
                JOIN $this->table st
                ON cl.id = st.lrs_client_id
                JOIN activity act 
                ON st.activity_id = act.id
                WHERE  st.activity_id ="."'$data[activityId]';";
       //debug($sql);
        return $this->db->query($sql);

    }
}

?>