<?php  
class m_jadwalGuru extends CI_Model
{
    function kelas()
    {
        return $this->db->query("SELECT DISTINCT ketKelas FROM `kelas`"); 
    }
    function jurusan()
    {
        return $this->db->query("SELECT DISTINCT jurusanKelas FROM `kelas`");
    }
    function ketKelas()
    {
        return $this->db->query("SELECT DISTINCT ketKelas FROM `kelas`");
    }
    function jadwalNama()
    {
        return $this->db->query("SELECT DISTINCT jadwal.nomorInduk, user.namaUser, user.jenisKelamin, matapelajaran.namaMapel 
        FROM jadwal 
        JOIN user ON jadwal.nomorInduk = user.nomorInduk 
        JOIN matapelajaran ON matapelajaran.idMapel = jadwal.idMapel");
    }
    function getJumlah()
    {
        return $this->db->query("SELECT * FROM `jadwal`");
    }
    function hasilKelas($nomorInduk, $keterangan, $jurusanKls)
    {
        return $this->db->query("SELECT jadwal.idKelas FROM jadwal JOIN kelas ON kelas.idKelas = jadwal.idKelas
        WHERE jadwal.nomorInduk = '".$nomorInduk."' AND kelas.ketKelas='".$keterangan."' AND kelas.jurusanKelas='".$jurusanKls."'");
    }
    function jadwalSiswa($id)
    {
        return $this->db->query("SELECT * FROM `jadwal` JOIN kelas ON kelas.idKelas = jadwal.idKelas
        JOIN matapelajaran ON matapelajaran.idMapel = jadwal.idMapel
        JOIN user ON user.nomorInduk = jadwal.nomorInduk
        WHERE kelas.idKelas = '".$id."' ORDER BY jadwal.jamMulai ASC");
    }
}
?>