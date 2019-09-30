<?php

class m_login extends CI_Model
{
    function selectLogin($table, $where)
    {
        return $this->db->get_where($table, $where);
    }

    function Select($where, $table)
    {
        return $this->db->get_where($table, $where);
    }
}
?>