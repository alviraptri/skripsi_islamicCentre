<?php
class m_admin extends CI_Model
{
    function tampilkanDataGuru($where)
    {
        return $this->db->get_where('user', $where);
    }
    function editGuru($where, $table)
    {
        return $this->db->get_where($table, $where);
    }
    function updateGuru($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table,$data);
    }
    function statusGuru($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
    function simpanGuru($data, $table)
    {
        $this->db->insert($table, $data);
    }
}

?>