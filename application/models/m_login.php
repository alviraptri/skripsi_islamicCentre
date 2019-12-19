<?php

class m_login extends CI_Model
{
    function cek($table, $where)
    {
        return $this->db->get_where($table, $where);
    }

    function Select($where, $table)
    {
        return $this->db->get_where($table, $where);
    }

    function updatePass($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table,$data);
    }
    function resetKey($email, $reset_key)
    {
        $this->db->where('emailUser', $email);
        $data = array('resetPass' => $reset_key,);
        $this->db->update('user', $data);
        if ($this->db->affected_rows()>0) {
            return TRUE;
        }
        else {
            return FALSE;
        }
    }
}
?>