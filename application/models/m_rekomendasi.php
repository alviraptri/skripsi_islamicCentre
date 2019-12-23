<?php  
class m_rekomendasi extends CI_Model
{
    function tampilkanKriteria()
    {
        $query = $this->db->query("SELECT * FROM `kriteria`WHERE statusKriteria = 1");
        return $query;
    }
    function getKriteria($id){
        $hsl=$this->db->query("SELECT * FROM kriteria WHERE idKriteria='$id'");
        if($hsl->num_rows()>0){
            foreach ($hsl->result() as $data) {
                $hasil=array(
                    'idKriteria' => $data->idKriteria,
                    'jenisKriteria' => $data->jenisKriteria,
                    'nilaiKriteria' => $data->nilaiKriteria,
                    'statusKriteria' => $data->statusKriteria,
                    );
            }
        }
        return $hasil;
    }
    function getSiswa()
    {
        $query = $this->db->query("SELECT datasiswa.idSiswa, datasiswa.nomorInduk, user.nomorInduk, user.namaUser
        FROM datasiswa
        JOIN user ON datasiswa.nomorInduk = user.nomorInduk");
        return $query;
    }
    function tampilkanAlternatif()
    {
        $query = $this->db->query("SELECT alternatif.idAlternatif, alternatif.namaAlternatif, alternatif.idSiswa, alternatif.statusAlternatif, datasiswa.idSiswa, 
        datasiswa.nomorInduk, user.nomorInduk, user.namaUser 
        FROM datasiswa 
        JOIN alternatif ON alternatif.idSiswa = datasiswa.idSiswa 
        JOIN user ON user.nomorInduk = datasiswa.nomorInduk 
        WHERE alternatif.statusAlternatif = 1");
        return $query;
    }
}