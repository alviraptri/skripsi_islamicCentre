<?php  
class m_rapor extends CI_Model
{
    function dataSiswa($id)
    {
        $query = $this->db->query("SELECT datasiswa.idSiswa, datasiswa.nomorInduk, datasiswa.idKelas, datasiswa.idTahunAjaran, user.nomorInduk, user.namaUser, 
        kelas.idKelas, kelas.ketKelas, kelas.nomorKelas, kelas.jurusanKelas, tahunajaran.idTahunAjaran, tahunajaran.tahunAjaran 
        FROM datasiswa 
        JOIN user ON user.nomorInduk = datasiswa.nomorInduk 
        JOIN kelas ON kelas.idKelas = datasiswa.idKelas 
        JOIN tahunajaran ON tahunajaran.idTahunAjaran = datasiswa.idTahunAjaran 
        WHERE datasiswa.idSiswa = '".$id."'"); 

        return $query;
    }

    function getId($id)
    {
        $query = $this->db->query("SELECT walikelas.idKelas, walikelas.nomorInduk, user.nomorInduk, user.namaUser, datasiswa.idSiswa, datasiswa.idKelas 
        FROM walikelas 
        JOIN datasiswa ON datasiswa.idKelas = walikelas.idKelas 
        JOIN user ON user.nomorInduk = walikelas.nomorInduk 
        WHERE datasiswa.idSiswa = '".$id."'");
        return $query;
    }

    function dataNilai($id)
    {
        return $this->db->query("SELECT * FROM `bukunilai` WHERE idSiswa = '".$id."'");
    }

    function dataBobot()
    {
        return $this->db->query("SELECT * FROM `ketnilai` WHERE idTahunAjaran = 1");
    }
}