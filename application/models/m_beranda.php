<?php  
class m_beranda extends CI_Model
{
    function hitungSiswa()
    {
        $query = $this->db->query('SELECT * FROM dataSiswa WHERE statusSiswa = 1');
        if($query->num_rows()>0)
        {
            return $query->num_rows();
        }
        else {
            return 0;
        } 
    }

    function hitungGuru()
    {
        $query = $this->db->query("SELECT nomorInduk, namaUser FROM user WHERE userRole NOT LIKE '%Admin%' AND userRole NOT LIKE '%Wali Murid%' AND 
        userRole NOT LIKE '%Siswa%'");
        if($query->num_rows()>0)
        {
            return $query->num_rows();
        }
        else {
            return 0;
        }
    }

    function hitungKls()
    {
        $query = $this->db->query("SELECT * FROM `kelas`");
        if($query->num_rows()>0)
        {
            return $query->num_rows();
        }
        else {
            return 0;
        }
    }

    function getKetKelas()
    {
        return $this->db->query("SELECT DISTINCT ketKelas FROM `kelas` WHERE statuskelas = 1");
    }

    function getJurusan($ket)
    {
        return $this->db->query("SELECT DISTINCT jurusanKelas FROM `kelas` WHERE statuskelas = 1 AND ketKelas = '".$ket."'");
    }

    function getNilaiSiswa($jurusan)
    {
        return $this->db->query("SELECT DISTINCT * FROM `dataSiswa` JOIN kelas ON datasiswa.idKelas = kelas.idKelas 
        JOIN user ON user.nomorInduk = datasiswa.nomorInduk
        JOIN bukunilai ON bukunilai.idSiswa = datasiswa.idSiswa
        WHERE kelas.jurusanKelas = '".$jurusan."'");
    }
}