<?php
class m_admin extends CI_Model
{

    function thnAjaran()
    {
        return $this->db->get('tahunajaran');
    }
    function mapel()
    {
        return $this->db->get('matapelajara');
    }
    function kelas()
    {
        return $this->db->get('kelas');
    }
    
    //Guru
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

    //Siswa
    function tampilkanDataSiswa()
    {
        $this->db->select('user.nomorInduk, user.namaUser, user.ttlUser, user.emailUser, user.noTelp, user.alamatUser, 
        user.jenisKelamin, dataSiswa.nomorInduk, dataSiswa.idKelas, dataSiswa.idTahunAjaran,
        dataSiswa.statusSiswa, kelas.idKelas, kelas.ketKelas, kelas.jurusanKelas, tahunAjaran.idTahunAjaran, 
        tahunAjaran.tahunAjaran, user.gambar')
        ->from('dataSiswa')
        ->join('user', 'user.nomorInduk = dataSiswa.nomorInduk', 'inner')
        ->join('kelas', 'kelas.idKelas = dataSiswa.idKelas', 'inner' )
        ->join('tahunAjaran', 'tahunAjaran.idTahunAjaran = dataSiswa.idTahunAjaran');

        return $this->db->get();
    }
    function editSiswa($idSiswa)
    {
        $query = $this->db->query('SELECT user.nomorInduk, user.namaUser, user.ttlUser, user.emailUser, user.noTelp, 
        user.alamatUser, user.jenisKelamin, datasiswa.nomorInduk, datasiswa.idKelas, datasiswa.idTahunAjaran, 
        datasiswa.statusSiswa, kelas.idKelas, kelas.ketKelas, kelas.jurusanKelas, tahunajaran.idTahunAjaran, 
        tahunajaran.tahunAjaran 
        FROM `dataSiswa` 
        INNER JOIN user ON user.nomorInduk = datasiswa.nomorInduk 
        INNER JOIN kelas ON kelas.idKelas = datasiswa.idKelas 
        INNER JOIN tahunajaran ON tahunajaran.idTahunAjaran = datasiswa.idTahunAjaran 
        WHERE datasiswa.nomorInduk="'.$idSiswa.'"');
        return $query;
    }
    function updateSiswa($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table,$data);
    }
    function simpanSiswa($data, $table)
    {
        $this->db->insert($table, $data);
    }
    function statusSiswa($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    //Mata Pelajaran
    function tampilkanDataMapel()
    {
        $this->db->select('matapelajaran.idMapel, matapelajaran.namaMapel, matapelajaran.statusMapel, tahunajaran.idTahunAjaran, tahunajaran.tahunAjaran')
        ->from('matapelajaran')
        ->join('tahunajaran', 'tahunajaran.idTahunAjaran = matapelajaran.idTahunAjaran');

        return $this->db->get();
    }
    function simpanMapel($data, $table)
    {
        $this->db->insert($table, $data);
    }
    function editMapel($idMapel)
    {
        $query = $this->db->query('SELECT matapelajaran.idMapel, matapelajaran.namaMapel, matapelajaran.statusMapel, 
        tahunajaran.idTahunAjaran, tahunajaran.tahunAjaran 
        FROM matapelajaran 
        INNER JOIN tahunajaran ON tahunajaran.idTahunAjaran = matapelajaran.idTahunAjaran 
        WHERE matapelajaran.idMapel="'.$idMapel.'"');

        return $query;
    }
    function updateMapel($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table,$data);
    }
    function statusMapel($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
}

?>