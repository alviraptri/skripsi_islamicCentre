<?php  
class m_beranda extends CI_Model
{
    function hitungSiswa()
    {
        $query = $this->db->query('SELECT * FROM dataSiswa');
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

    function absen()
    {
        $query = $this->db->query("SELECT tanggal, absen FROM absensi");
        return $query;
    }
}