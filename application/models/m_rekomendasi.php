<?php
class m_rekomendasi extends CI_Model
{
    function tampilkanKriteria()
    {
        $query = $this->db->query("SELECT * FROM `kriteria`WHERE statusKriteria = 1");
        return $query;
    }
    function getKriteria($id) 
    {
        $hsl = $this->db->query("SELECT * FROM kriteria WHERE idKriteria='$id'");
        if ($hsl->num_rows() > 0) {
            foreach ($hsl->result() as $data) {
                $hasil = array(
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
    function perbandinganKrit()
    {
        $query = $this->db->query("SELECT * FROM kriteria ORDER BY idKriteria");
        return $query;
    }
    function getJumlahKriteria()
    {
        $query = $this->db->query("SELECT * FROM kriteria");
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }
    function simpanPerbandinganKrit($kriteria1, $kriteria2, $nilai)
    {
        $getId  = "SELECT idKriteria FROM kriteria ORDER BY id";

        $listID = $getId->idKriteria;

        $id_kriteria1 = $listID[($kriteria1)];
        $id_kriteria2 = $listID[($kriteria2)];

        $query = $this->db->query("INSERT INTO perbandingan_kriteria (kriteria_satu, kriteria_dua, bobotKriteria) VALUES ($id_kriteria1,$id_kriteria2,$nilai)");

        return $query;
    }
    function getKriteriaSatu()
    {
        $query = $this->db->query("SELECT perbandingan_kriteria.kriteria_satu, perbandingan_kriteria.kriteria_dua, perbandingan_kriteria.bobotKriteria, kriteria.idKriteria, kriteria.jenisKriteria
        FROM perbandingan_kriteria
        JOIN kriteria ON kriteria.idKriteria = perbandingan_kriteria.kriteria_satu");
        return $query;
    }
    // menampilkan nilai IR
    function getNilaiIR($jmlKriteria) {
        $query = $this->db->query("SELECT nilai FROM ir WHERE jumlah='".$jmlKriteria."'");
        // foreach ($query as $idk) {
        //     $ir = $idk->nilai;
        // }
        // return $ir;
        return $query;
    }
    function namaSiswa()
    {
        $query = $this->db->query("SELECT DISTINCT datasiswa.idSiswa, datasiswa.nomorInduk, datasiswa.idKelas, alternatif.idSiswa, 
        kelas.idKelas, user.nomorInduk, kelas.ketKelas, kelas.jurusanKelas, kelas.nomorKelas, user.namaUser FROM datasiswa
        JOIN alternatif ON alternatif.idSiswa = datasiswa.idSiswa
        JOIN kelas ON kelas.idKelas = datasiswa.idKelas
        JOIN user ON user.nomorInduk = datasiswa.nomorInduk
        WHERE alternatif.statusAlternatif = 1");
        return $query;
    }
    function perbandinganAlternatif($id)
    {
        $query = $this->db->query("SELECT idAlternatif, namaAlternatif, idSiswa FROM `alternatif` WHERE idSiswa = '".$id."'");
        return $query;
    }
    function getJumlahAlternatif($id)
    {
        $query = $this->db->query("SELECT idAlternatif, namaAlternatif, idSiswa FROM `alternatif` WHERE idSiswa = '".$id."'");
        if($query->num_rows()>0){
            return $query->num_rows();
        }
        else {
            return 0;
        }
    }
    function getNamaKriteria()
    {
        $query = $this->db->query("SELECT jenisKriteria, idKriteria FROM `kriteria` ORDER BY idKriteria");
        return $query;
    }
    function perbandinganAlt()
    {
        $query = $this->db->query("SELECT * FROM alternatif ORDER BY idAlternatif");
        return $query;
    }
    function getAlternatifPV($id_alternatif,$id_kriteria)
    {
        $query = $this->db->query("SELECT nilaiHA FROM pv_alternatif WHERE idAlternatif = '".$id_alternatif."' AND idKriteria = '".$id_kriteria."'");
        return $query;
    }
    function getKriteriaPV($id_kriteria)
    {
        $query = $this->db->query("SELECT nilaiPvKrit FROM pv_kriteria WHERE idKriteria = '".$id_kriteria."'");
        return $query;
    }
    function lihatRanking()
    {
        $query = $this->db->query("SELECT * FROM rankingrekomendasi 
        JOIN alternatif ON alternatif.idAlternatif = rankingrekomendasi.idAlternatif
        ORDER BY hasilAkhir DESC");
        return $query;
    }
}
