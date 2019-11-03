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
}
?>