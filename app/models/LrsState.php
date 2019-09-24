<?php

namespace app\models;

use app\core\Model;

class LrsState extends Model
{
    public $table = 'lrs_state';

    public function innerJoin($id)
    {
        $sql = "SELECT a.login, b.id, b.state_key, b.value, act.name
                FROM lrs_client a
                JOIN $this->table b
                ON a.id = b.lrs_client_id
                JOIN activity act 
                ON b.activity_id = act.id
                WHERE b.lrs_id = $id";
        return $this->db->query($sql);
    }

    public function indexState($activityId,$agent){
        //debug($data['agent']);
        $sql = "SELECT *
                FROM lrs_client cl
                JOIN $this->table st
                ON cl.id = st.lrs_client_id
                JOIN activity act 
                ON st.activity_id = act.id
                WHERE  st.activity_id ="."'$activityId' AND cl.login = '$agent';";
       //debug($sql);
        return $this->db->query($sql);

    }

    public function showState($activityId,$agent,$stateId){
        $sql = "SELECT st.id,act.id,act.name,cl.login
                FROM lrs_client cl
                JOIN $this->table st
                ON cl.id = st.lrs_client_id
                JOIN activity act 
                ON st.activity_id = act.id
                WHERE  st.activity_id ="."'$activityId' AND cl.login = '$agent' AND st.id ="."'$stateId';";
        //debug($sql);
        return $this->db->query($sql);

    }

    public function deleteByPredict($predictor){
        $sql = "DELETE FROM $this->table WHERE ".$predictor;
        $this->db->query($sql);
    }

    public function getClientLoginById($login)
    {
        $sql = "SELECT id FROM lrs_client WHERE login='$login'";
        return $this->db->query($sql);
    }
}
?>