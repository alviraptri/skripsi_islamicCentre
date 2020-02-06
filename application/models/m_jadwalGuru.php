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
    function jadwalPengawas()
	{
		$this->db->select('jadwalujian.idJadwalUjian, jadwalujian.idTahunAjaran, jadwalujian.idMapel, jadwalujian.hari, 
        jadwalujian.tanggal, jadwalujian.jamMulai, jadwalujian.jamSelesai, matapelajaran.idMapel, matapelajaran.namaMapel, matapelajaran.jenisMapel')
        ->from('jadwalujian')
        ->join('matapelajaran', 'matapelajaran.idMapel = jadwalujian.idMapel', 'inner')
        ->order_by('jamMulai', 'ASC');
        return $this->db->get();
    }
    function pengawas($id)
    {
        $query = $this->db->query("SELECT jadwalujian.idTahunAjaran, jadwalujian.idJadwalUjian, jadwalpengawas.idJadwalUjian, jadwalpengawas.idKelas, 
        jadwalpengawas.nomorInduk, user.nomorInduk, user.namaUser, kelas.idKelas, kelas.ketKelas, kelas.jurusanKelas, kelas.nomorKelas, kelas.nomorKelas, 
        kelas.nomorKelas 
        FROM jadwalpengawas 
        JOIN jadwalujian ON jadwalujian.idJadwalUjian = jadwalpengawas.idJadwalUjian 
        JOIN user ON user.nomorInduk = jadwalpengawas.nomorInduk 
        JOIN kelas ON kelas.idKelas = jadwalpengawas.idKelas 
        WHERE jadwalPengawas.idKelas = '".$id."'");
        return $query;
    }
    function tanggal()
    {
        return $this->db->query("SELECT DISTINCT tanggal FROM `jadwalujian`ORDER BY tanggal DESC LIMIT 1");
    }
    function jadwalUjian($id)
    {
        $this->db->select('jadwalujian.idJadwalUjian, jadwalujian.idTahunAjaran, jadwalujian.idMapel, jadwalujian.hari, 
        jadwalujian.tanggal, jadwalujian.jamMulai, jadwalujian.jamSelesai, matapelajaran.idMapel, matapelajaran.namaMapel, matapelajaran.jenisMapel')
        ->from('jadwalujian')
        ->join('matapelajaran', 'matapelajaran.idMapel = jadwalujian.idMapel', 'inner')
        ->order_by('jamMulai', 'ASC')
        ->where('jadwalUjian.idTahunAjaran = "'.$id.'"');
        return $this->db->get();
    }
}
?>