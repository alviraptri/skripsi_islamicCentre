<?php
class m_admin extends CI_Model
{
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
        user.jenisKelamin, dataSiswa.nomorInduk, dataSiswa.idKelas, dataSiswa.idWaliKelas, dataSiswa.idTahunAjaran,
        dataSiswa.statusSiswa, kelas.idKelas, kelas.ketKelas, kelas.jurusanKelas, waliKelas.nomorInduk, waliKelas.idWaliKelas,
        tahunAjaran.idTahunAjaran, tahunAjaran.tahunAjaran')
        ->from('dataSiswa')
        ->join('user', 'user.nomorInduk = dataSiswa.nomorInduk', 'inner')
        ->join('kelas', 'kelas.idKelas = dataSiswa.idKelas', 'inner' )
        ->join('waliKelas', 'waliKelas.idWaliKelas = dataSiswa.idWaliKelas', 'inner')
        ->join('tahunAjaran', 'tahunAjaran.idTahunAjaran = dataSiswa.idTahunAjaran');

        return $this->db->get();
    }
}

?>