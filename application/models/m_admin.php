<?php
class m_admin extends CI_Model
{

    function thnAjaran()
    {
        return $this->db->get('tahunajaran');
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
    function guru()
    {
        return $this->db->get('user');
    }
    function getKelas()
    {
        return $this->db->get('kelas');
    }

    //Siswa
    function tampilkanDataSiswa()
    {
        $this->db->select('user.nomorInduk, user.namaUser, user.ttlUser, user.emailUser, user.noTelp, user.alamatUser, 
        user.jenisKelamin, dataSiswa.nomorInduk, dataSiswa.idKelas, dataSiswa.idTahunAjaran,
        dataSiswa.statusSiswa, kelas.idKelas, kelas.ketKelas, kelas.jurusanKelas, tahunAjaran.idTahunAjaran, 
        tahunAjaran.tahunAjaran, user.gambar, kelas.nomorKelas')
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
        tahunajaran.tahunAjaran, kelas.nomorKelas 
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
    function mapel()
    {
        return $this->db->get('matapelajaran');
    }

    //kelas
    function kelas()
    {
        return $this->db->get('kelas');
    }
    function simpanKelas($data, $table)
    {
        $this->db->insert($table, $data);
    }
    function statusKelas($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
    function editKelas($idKelas)
    {
        $query = $this->db->query('SELECT * FROM `kelas` WHERE idKelas = "'.$idKelas.'"');
        return $query;
    }
    function updateKelas($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table,$data);
    }

    //jadwal
    function simpanJadwal($data, $table)
    {
        $this->db->insert($table, $data);
    }
    function tampilkanDataJadwal()
    {
        $this->db->select('jadwal.idJadwal, jadwal.idKelas, jadwal.nomorInduk, jadwal.idMapel, jadwal.hari, jadwal.jamMulai, 
        jadwal.jamSelesai, jadwal.statusJadwal, kelas.idKelas, kelas.ketKelas, kelas.jurusanKelas, kelas.nomorKelas, 
        user.nomorInduk, user.userRole, user.namaUser, matapelajaran.idMapel, matapelajaran.namaMapel, 
        tahunajaran.idTahunAjaran, tahunajaran.tahunAjaran')
        ->from('jadwal')
        ->join('kelas', 'kelas.idKelas = jadwal.idKelas', 'inner')
        ->join('user', 'user.nomorInduk = jadwal.nomorInduk', 'inner' )
        ->join('matapelajaran', 'matapelajaran.idMapel = jadwal.idMapel', 'inner')
        ->join('tahunajaran', 'tahunajaran.idTahunAjaran = jadwal.idTahunAjaran');

        return $this->db->get();
    }
    function editJadwal($idJadwal)
    {
        $query = $this->db->query('SELECT jadwal.idJadwal, jadwal.idKelas, jadwal.nomorInduk, jadwal.idMapel, jadwal.hari, 
        jadwal.jamMulai, jadwal.jamSelesai, jadwal.statusJadwal, kelas.idKelas, kelas.ketKelas, kelas.jurusanKelas, 
        kelas.nomorKelas, user.nomorInduk, user.userRole, user.namaUser, matapelajaran.idMapel, matapelajaran.namaMapel, 
        tahunajaran.idTahunAjaran, tahunajaran.tahunAjaran 
        FROM `jadwal` 
        INNER JOIN kelas ON kelas.idKelas = jadwal.idKelas 
        INNER JOIN user ON user.nomorInduk = jadwal.nomorInduk 
        INNER JOIN matapelajaran ON matapelajaran.idMapel = jadwal.idMapel 
        INNER JOIN tahunajaran ON tahunajaran.idTahunAjaran = jadwal.idTahunAjaran
        WHERE jadwal.idMapel="'.$idJadwal.'"');
        return $query;
    }
}

?>