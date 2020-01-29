<?php  
class m_jadwalGuru extends CI_Model
{
    function kelas()
    {
        return $this->db->query("SELECT DISTINCT ketKelas FROM `kelas`");
    }
    function jurusan()
    {
        return $this->db->query("SELECT jurusanKelas, nomorKelas FROM `kelas`");
    }
    function jadwalNama()
    {
        return $this->db->query("SELECT DISTINCT jadwal.nomorInduk, user.namaUser, user.jenisKelamin, matapelajaran.namaMapel FROM jadwal JOIN user ON jadwal.nomorInduk = user.nomorInduk JOIN matapelajaran ON matapelajaran.idMapel = jadwal.idMapel");
    }
}
?>