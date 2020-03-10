<?php  
class m_admin extends CI_Model
{

    function thnAjaran()
    {
        $this->db->select('idTahunAjaran, tahunAjaran, statusTahunAjaran')
        ->from('tahunajaran')
        ->where('statusTahunAjaran = 1');
        return $this->db->get();
    }
    function cekGuru($idMapel)
    {
        return $this->db->query("SELECT DISTINCT idMapel, nomorInduk FROM jadwal WHERE idMapel = '".$idMapel."'");
    }
    function jadwalUjianMapel($idMapel)
    {
        return $this->db->query("SELECT idJadwalUjian FROM `jadwalujian`WHERE idMapel = '".$idMapel."'");
    }

    function profil()
    {
        $this->db->select('nomorInduk, userRole, namaUser, ttlUser, emailUser, noTelp, alamatUser, 
        jenisKelamin, gambar, statusUser')
        ->from('user')
        ->where('userRole = "Admin"')
        ->where('nomorInduk = "'.$this->session->nomorInduk.'"');
        return $this->db->get();
    }

    function simpanData($data, $table)
    {
        $this->db->insert($table, $data);
    }
    function statusData($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
    function updateData($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table,$data);
    }
    function editData($where, $table)
    {
        return $this->db->get_where($table, $where);
    }
    function cek($where, $table)
    {
        return $this->db->get_where($table, $where);
    }
    function kodePegawai()
	{
        $this->db->select('RIGHT(user.nomorInduk,4) as kode',false);
        $this->db->not_like('user.userRole', 'Siswa');
        $this->db->not_like('user.userRole', 'Wali Murid');
		$this->db->order_by('nomorInduk','DESC');
		$this->db->limit(1);
		$query = $this->db->get('user');
		if($query->num_rows()>0){
			$data = $query->row();
			$kode = intval($data->kode)+1;
		}
		else{
			$kode=1;
		}
		$kodeMax = str_pad($kode,3,'0',STR_PAD_LEFT);
		$kodeJadi = "NIP".$kodeMax;
		return $kodeJadi;
	}
    
    function kodeMurid()
	{
        $this->db->select('RIGHT(user.nomorInduk,10) as kode',false)
        ->where('user.userRole = "Siswa"');
		$this->db->order_by('nomorInduk','DESC');
		$this->db->limit(1);
		$query = $this->db->get('user');
		if($query->num_rows()<>0){
			$data = $query->row();
			$kode = intval($data->kode)+1;
		}
		else{
			$kode=1;
		}
		$kodeMax = str_pad($kode,10,'0',STR_PAD_LEFT);
		$kodeJadi = $kodeMax;
		return $kodeJadi;
    }

    //jadwal
    function jadwalGuru()
    {
        $query = $this->db->query("SELECT nomorInduk, namaUser FROM user WHERE userRole NOT LIKE '%Admin%' AND userRole NOT LIKE '%Wali Murid%' AND 
        userRole NOT LIKE '%Siswa%' AND statusUser = 1");

        return $query;
    }
    function tampilkanDataJadwal()
    {
        $this->db->select('jadwal.idJadwal, jadwal.idKelas, jadwal.idTahunAjaran, jadwal.nomorInduk, jadwal.idMapel, jadwal.hari, jadwal.jamMulai, 
        jadwal.jamSelesai, jadwal.statusJadwal, kelas.idKelas, kelas.ketKelas, kelas.jurusanKelas, kelas.nomorKelas, 
        tahunajaran.idTahunAjaran, tahunajaran.tahunAjaran, user.nomorInduk, user.namaUser, matapelajaran.idMapel, 
        matapelajaran.namaMapel')
        ->from('jadwal')
        ->join('kelas', 'kelas.idKelas = jadwal.idKelas', 'inner')
        ->join('tahunajaran', 'tahunajaran.idTahunAjaran = jadwal.idTahunAjaran', 'inner')
        ->join('user', 'user.nomorInduk = jadwal.nomorInduk', 'inner')
        ->join('matapelajaran', 'matapelajaran.idMapel = jadwal.idMapel')
        ->where('jadwal.statusJadwal = 1');

        return $this->db->get();
    }
    function editJadwal($idJadwal)
    {
        $this->db->select('jadwal.idJadwal, jadwal.idKelas, jadwal.idTahunAjaran, jadwal.nomorInduk, jadwal.idMapel, jadwal.hari, jadwal.jamMulai, 
        jadwal.jamSelesai, jadwal.statusJadwal, kelas.idKelas, kelas.ketKelas, kelas.jurusanKelas, kelas.nomorKelas, 
        tahunajaran.idTahunAjaran, tahunajaran.tahunAjaran, user.nomorInduk, user.namaUser, matapelajaran.idMapel, 
        matapelajaran.namaMapel')
        ->from('jadwal')
        ->join('kelas', 'kelas.idKelas = jadwal.idKelas', 'inner')
        ->join('tahunajaran', 'tahunajaran.idTahunAjaran = jadwal.idTahunAjaran', 'inner')
        ->join('user', 'user.nomorInduk = jadwal.nomorInduk', 'inner')
        ->join('matapelajaran', 'matapelajaran.idMapel = jadwal.idMapel')
        ->where('jadwal.idJadwal = "'.$idJadwal.'"');

        return $this->db->get();
    }
    
    //Guru
    function tampilkanDataPegawai($where)
    {
        return $this->db->get_where('user', $where);
    }
    function guru()
    {
        return $this->db->get('user');
    }
    function tugasGuru($idTA)
    {
        $query = $this->db->query('SELECT DISTINCT jadwal.nomorInduk, jadwal.idMapel, user.nomorInduk, user.namaUser, 
        matapelajaran.idMapel, matapelajaran.namaMapel 
        FROM jadwal 
        JOIN user ON user.nomorInduk = jadwal.nomorInduk 
        JOIN matapelajaran ON matapelajaran.idMapel = jadwal.idMapel
        WHERE jadwal.idTahunAjaran = "'.$idTA.'"');
        
        return $query;
    }

    //wali murid
    function tampilkanDataWaliMurid()
    {
        $this->db->select('user.nomorInduk, user.namaUser, user.ttlUser, user.emailUser, user.noTelp, 
        user.alamatUser, user.jenisKelamin, walimurid.nomorInduk, walimurid.statusWaliMurid,
        walimurid.keterangan, user.gambar')
        ->from('walimurid')
        ->join('user', 'user.nomorInduk = walimurid.nomorInduk')
        ->where('walimurid.statusWaliMurid = 1');

        return $this->db->get();
    }
    function editWaliMurid($idWaliMurid)
    {
        $this->db->select('user.nomorInduk, user.namaUser, user.ttlUser, user.emailUser, user.noTelp, 
        user.alamatUser, user.jenisKelamin, walimurid.nomorInduk, walimurid.statusWaliMurid,
        walimurid.keterangan, user.gambar')
        ->from('walimurid')
        ->join('user', 'user.nomorInduk = walimurid.nomorInduk')
        ->where('walimurid.nomorInduk = "'.$idWaliMurid.'"');

        return $this->db->get_where();
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
        ->join('tahunAjaran', 'tahunAjaran.idTahunAjaran = dataSiswa.idTahunAjaran')
        ->where('dataSiswa.statusSiswa = 1');

        return $this->db->get();
    }
    function editSiswa($idSiswa)
    {
        $query = $this->db->query('SELECT user.nomorInduk, user.namaUser, user.ttlUser, user.emailUser, user.noTelp, 
        user.alamatUser, user.jenisKelamin, datasiswa.nomorInduk, datasiswa.idKelas, datasiswa.idTahunAjaran, 
        datasiswa.statusSiswa, kelas.idKelas, kelas.ketKelas, kelas.jurusanKelas, tahunajaran.idTahunAjaran, 
        tahunajaran.tahunAjaran, kelas.nomorKelas, user.gambar
        FROM `dataSiswa` 
        INNER JOIN user ON user.nomorInduk = datasiswa.nomorInduk 
        INNER JOIN kelas ON kelas.idKelas = datasiswa.idKelas 
        INNER JOIN tahunajaran ON tahunajaran.idTahunAjaran = datasiswa.idTahunAjaran 
        WHERE datasiswa.nomorInduk="'.$idSiswa.'"');
        return $query;
    }
    function selectSiswa($where, $table)
    {
        return $this->db->get_where($table, $where);
    }
    function getId($nomorInduk)
    {
        $query = $this->db->query('SELECT walimurid.idWaliMurid, walimurid.idSiswa, walimurid.nomorInduk, 
        walimurid.statusWaliMurid, datasiswa.idSiswa, datasiswa.nomorInduk, user.nomorInduk, 
        user.statusUser 
        FROM walimurid 
        INNER JOIN datasiswa ON datasiswa.idSiswa = walimurid.idSiswa 
        INNER JOIN user ON user.nomorInduk = walimurid.nomorInduk 
        WHERE datasiswa.nomorInduk = "'.$nomorInduk.'"');
        return $query;
    }

    //Mata Pelajaran
    function tampilkanDataMapel()
    {
        $this->db->select('matapelajaran.idMapel, matapelajaran.namaMapel, matapelajaran.jenisMapel, matapelajaran.statusMapel, tahunajaran.idTahunAjaran, tahunajaran.tahunAjaran')
        ->from('matapelajaran')
        ->join('tahunajaran', 'tahunajaran.idTahunAjaran = matapelajaran.idTahunAjaran')
        ->where('matapelajaran.statusMapel = 1');

        return $this->db->get();
    }
    function editMapel($idMapel)
    {
        $query = $this->db->query('SELECT matapelajaran.idMapel, matapelajaran.namaMapel, matapelajaran.statusMapel, matapelajaran.jenisMapel, 
        tahunajaran.idTahunAjaran, tahunajaran.tahunAjaran 
        FROM matapelajaran 
        INNER JOIN tahunajaran ON tahunajaran.idTahunAjaran = matapelajaran.idTahunAjaran 
        WHERE matapelajaran.idMapel="'.$idMapel.'"');

        return $query;
    }
    function jenisMapel()
    {
        $query = $this->db->query("SELECT DISTINCT jenisMapel from matapelajaran");
        return $query;
    }
    function mapel()
    {
        return $this->db->get('matapelajaran');
    }

    //kelas
    function kelas()
    {
        $this->db->select('idKelas, ketKelas, jurusanKelas, nomorKelas, statusKelas')
        ->from('kelas')
        ->where('statusKelas = 1');

        return $this->db->get();
    }
    function editKelas($idKelas)
    {
        $query = $this->db->query('SELECT * FROM `kelas` WHERE idKelas = "'.$idKelas.'"');
        return $query;
    }

    //ajax
    
    //info
    function getSiswa($idKelas)
    {
        $this->db->select('datasiswa.idSiswa, datasiswa.idKelas, datasiswa.nomorInduk, datasiswa.statusSiswa, kelas.idKelas,user.nomorInduk, user.namaUser')
        ->from('datasiswa')
        ->join('kelas', 'kelas.idKelas = dataSiswa.idKelas', 'inner')
        ->join('user', 'user.nomorInduk = dataSiswa.nomorInduk', 'inner')
        ->where('datasiswa.idKelas = "'.$idKelas.'"');
        return $this->db->get();
    }
    function simpanMulti($result, $table)
    { 
            $this->db->insert($table, $result);
    }
    function getDataInfo($idKelas)
    {
        $this->db->select('datasiswa.idSiswa, datasiswa.idKelas, datasiswa.nomorInduk, datasiswa.statusSiswa, 
        kelas.idKelas,user.nomorInduk, user.namaUser, informasispp.idSiswa, informasispp.jumlah, informasispp.idInfo, informasispp.statusInfo')
        ->from('datasiswa')
        ->join('kelas', 'kelas.idKelas = dataSiswa.idKelas', 'inner')
        ->join('user', 'user.nomorInduk = dataSiswa.nomorInduk', 'inner')
        ->join('informasispp', 'informasispp.idSiswa = datasiswa.idSiswa')
        ->where('datasiswa.idKelas = "'.$idKelas.'"');
        return $this->db->get();
    }
    function statusInfo($idInfo){
        $hasil = $this->db->query("UPDATE informasispp SET statusInfo = '0' WHERE idInfo = '".$idInfo."'");
        return $hasil;
    }

    //ketnilai
    function getMapel($nomorInduk)
    {
        $query = $this->db->query('SELECT DISTINCT jadwal.idMapel,matapelajaran.idMapel, matapelajaran.namaMapel, jadwal.nomorInduk, jadwal.idJadwal, kelas.idKelas, 
        jadwal.idKelas, kelas.ketKelas, kelas.jurusanKelas, kelas.nomorKelas 
        FROM jadwal 
        JOIN matapelajaran ON matapelajaran.idMapel = jadwal.idMapel 
        JOIN kelas ON kelas.idKelas = jadwal.idKelas 
        WHERE jadwal.nomorInduk ="'.$nomorInduk.'"');
        return $query;
    }
    function getMataPelajaran($nomorInduk)
    {
        return $this->db->query('SELECT DISTINCT matapelajaran.namaMapel, matapelajaran.idMapel FROM jadwal JOIN matapelajaran ON matapelajaran.idMapel = jadwal.idMapel
        WHERE jadwal.nomorInduk = "'.$nomorInduk.'"');
    }
    function getTanggal($id)
    {
        $query = $this->db->query('SELECT DISTINCT tanggal FROM absensi WHERE idMapel = "'.$id.'"');
        return $query;
    }
    function klsAbsen($tgl, $mapel, $guru)
    {
        $query=$this->db->query("SELECT DISTINCT absensi.idJadwal, absensi.tanggal, jadwal.idJadwal, jadwal.idKelas, kelas.idKelas, kelas.ketKelas, kelas.jurusanKelas, 
        kelas.ketKelas, kelas.nomorKelas
        FROM jadwal
        JOIN absensi ON absensi.idJadwal = jadwal.idJadwal
        JOIN kelas ON kelas.idKelas = jadwal.idKelas
        WHERE absensi.tanggal = '".$tgl."' AND absensi.nomorInduk = '".$guru."' AND absensi.idMapel = '".$mapel."'");
        return $query;
    }
    function getNamaCatatan($id)
    {
        return $this->db->query("SELECT * FROM `datasiswa` JOIN user ON user.nomorInduk = datasiswa.nomorInduk WHERE idKelas ='".$id."'");
    }
    function getAbsensi($id, $tgl)
    {
        $query = $this->db->query('SELECT absensi.idSiswa, absensi.idJadwal, absensi.absen, datasiswa.idSiswa, datasiswa.nomorInduk, user.nomorInduk, user.namaUser, 
        datasiswa.idKelas, kelas.idKelas, kelas.ketKelas, kelas.jurusanKelas, kelas.nomorKelas, absensi.tanggal, absensi.idAbsen 
        FROM datasiswa 
        JOIN absensi ON absensi.idSiswa = datasiswa.idSiswa 
        JOIN user ON user.nomorInduk = datasiswa.nomorInduk 
        JOIN kelas ON kelas.idKelas = datasiswa.idKelas 
        WHERE absensi.idJadwal = "'.$id.'" AND absensi.tanggal = "'.$tgl.'"');
        // $query = $this->db->query('SELECT absensi.idSiswa, absensi.idJadwal, absensi.absen, datasiswa.idSiswa, datasiswa.nomorInduk, user.nomorInduk, user.namaUser, 
        // datasiswa.idKelas, kelas.idKelas, kelas.ketKelas, kelas.jurusanKelas, kelas.nomorKelas, absensi.tanggal, absensi.idAbsen 
        // FROM datasiswa 
        // JOIN absensi ON absensi.idSiswa = datasiswa.idSiswa 
        // JOIN user ON user.nomorInduk = datasiswa.nomorInduk 
        // JOIN kelas ON kelas.idKelas = datasiswa.idKelas 
        // WHERE absensi.idJadwal = "'.$id.'"');
        return $query;
    }

    function getKetNilai($where)
    {
        $this->db->select('idKetNilai, idTahunAjaran, bobotSekolah, bobotGuru')
        ->from('ketnilai')
        ->where($where);
        return $this->db->get();
    }
    function editKetNilai($id)
    {
        $hasil = $this->db->query('SELECT ketnilai.idKetNilai, ketnilai.idTahunAjaran, ketnilai.bobotSekolah, ketnilai.bobotGuru, 
        tahunajaran.idTahunAjaran, tahunajaran.tahunAjaran 
        FROM ketnilai 
        JOIN tahunajaran ON tahunajaran.idTahunAjaran = ketnilai.idTahunAjaran 
        WHERE ketnilai.idKetNilai = "'.$id.'"');
        if($hasil->num_rows()>0){
            foreach ($hasil->result() as $data) {
                $hasil=array(
                    'idKetNilai' => $data->idKetNilai,
                    'tahunAjaran' => $data->tahunAjaran,
                    'bobotSekolah' => $data->bobotSekolah,
                    'bobotGuru' => $data->bobotGuru,
                );
            }
        }
        return $hasil;
    }

    function getKelas($idMapel)
    {
        $this->db->distinct()
        ->select('jadwal.nomorInduk, jadwal.idMapel,jadwal.idKelas ,matapelajaran.idMapel, matapelajaran.namaMapel, kelas.idKelas, kelas.ketKelas, 
        kelas.jurusanKelas, kelas.nomorKelas')
        ->from('jadwal')
        ->join('matapelajaran', 'matapelajaran.idMapel = jadwal.idMapel', 'inner')
        ->join('kelas', 'kelas.idKelas = jadwal.idKelas', 'inner')
        ->where('jadwal.idMapel = "'.$idMapel.'"')
        ->order_by('kelas.idKelas', 'ASC');

        return $this->db->get();
    }

    //absensi
    function editAbsensi($id)
    {
        $query = $this->db->query('SELECT absensi.tanggal, absensi.idAbsen, absensi.idSiswa, absensi.absen, datasiswa.idSiswa, datasiswa.nomorInduk, 
        user.namaUser, user.nomorInduk, datasiswa.idKelas, kelas.idKelas, kelas.ketKelas, kelas.jurusanKelas, kelas.nomorKelas
        FROM datasiswa 
        JOIN absensi ON absensi.idSiswa = datasiswa.idSiswa 
        JOIN user ON user.nomorInduk = datasiswa.nomorInduk 
        JOIN kelas ON kelas.idKelas = datasiswa.idKelas
        WHERE absensi.idAbsen = "'.$id.'"');
        return $query;
    }
    function getNama($idKelas)
    {
        $this->db->select('datasiswa.idSiswa, datasiswa.idKelas, datasiswa.nomorInduk, user.nomorInduk, user.namaUser')
        ->from('datasiswa')
        ->join('user', 'user.nomorInduk = datasiswa.nomorInduk', 'inner')
        ->where('datasiswa.idKelas = "'.$idKelas.'"')
        ->where('datasiswa.statusSiswa = "1"');
        return $this->db->get();
    }
    function simpanAbsen($result, $table)
    {
        
        $this->db->insert($table, $result);
    
        
    }

    //jadwal ujian
    function getHari($ta)
    {
        return $this->db->query('SELECT DISTINCT hari FROM `jadwalujian` WHERE idTahunAjaran = "'.$ta.'"');
    }
    function getJadwal($idKelas, $idMapel)
    {
        $this->db->select('jadwal.idJadwal, jadwal.idKelas, jadwal.idMapel')
        ->from('jadwal')
        ->where('jadwal.idKelas = "'.$idKelas.'" AND jadwal.idMapel = "'.$idMapel.'"');
        return $this->db->get();
    }
    function jadwalMapel($tahunAjaran)
    {
        $query = $this->db->query('SELECT matapelajaran.idMapel, matapelajaran.namaMapel, matapelajaran.idTahunAjaran FROM matapelajaran WHERE matapelajaran.idTahunAjaran = "'.$tahunAjaran.'"');
        return $query;
    }
    function jamMulai()
    {
        $query = $this->db->query("SELECT DISTINCT jamMulai FROM jadwalujian");

        return $query;
    }
    function jamSelesai()
    {
        $query = $this->db->query("SELECT DISTINCT jamSelesai FROM jadwalujian");

        return $query;
    }
    function getJadwalUjian($jenis)
    {
        $query = $this->db->query("SELECT jadwalujian.idJadwalUjian, jadwalujian.idTahunAjaran, jadwalujian.idMapel, jadwalujian.hari, 
        jadwalujian.jamMulai, jadwalujian.jamSelesai, matapelajaran.idMapel, matapelajaran.namaMapel, matapelajaran.jenisMapel
        FROM jadwalujian
        JOIN matapelajaran ON jadwalujian.idMapel = matapelajaran.idMapel
        WHERE matapelajaran.jenisMapel = '".$jenis."'");

        return $query;

        // $this->db->select('jadwalujian.idJadwalUjian, jadwalujian.idTahunAjaran, jadwalujian.idMapel, jadwalujian.hari, 
        // jadwalujian.jamMulai, jadwalujian.jamSelesai, matapelajaran.idMapel, matapelajaran.namaMapel, matapelajaran.jenisMapel')
        // ->from('jadwalUjian')
        // ->join('matapelajaran', 'matapelajaran.idMapel = jadwalujian.idMapel')
        // ->where($where);
        // return $this->db->get(); 

        // $this->db->select('jadwalujian.idJadwalUjian, jadwalujian.idTahunAjaran, jadwalujian.idMapel, jadwalujian.hari, 
        // jadwalujian.jamMulai, jadwalujian.jamSelesai, matapelajaran.idMapel, matapelajaran.namaMapel, matapelajaran.jenisMapel')
        // ->from('jadwalujian')
        // ->join('matapelajaran', 'matapelajaran.idMapel = jadwalujian.idMapel', 'inner')
        // ->where('jadwalujian.idTahunAjaran = "'.$idTA.'"');
        // return $this->db->get();
    }
    function getJadwalUmum()
    {
        $query = $this->db->query("SELECT jadwalujian.idJadwalUjian, jadwalujian.idTahunAjaran, jadwalujian.idMapel, jadwalujian.hari, 
        jadwalujian.jamMulai, jadwalujian.jamSelesai, matapelajaran.idMapel, matapelajaran.namaMapel, matapelajaran.jenisMapel
        FROM jadwalujian
        JOIN matapelajaran ON jadwalujian.idMapel = matapelajaran.idMapel
        WHERE matapelajaran.jenisMapel = 'Umum'");

        return $query;
    }
    function getAllJadwal()
    {
        $query = $this->db->query("SELECT jadwalujian.idJadwalUjian, jadwalujian.idTahunAjaran, jadwalujian.idMapel, jadwalujian.hari, 
        jadwalujian.jamMulai, jadwalujian.jamSelesai, matapelajaran.idMapel, matapelajaran.namaMapel, matapelajaran.jenisMapel
        FROM jadwalujian
        JOIN matapelajaran ON jadwalujian.idMapel = matapelajaran.idMapel");

        return $query;
    }
    function jadwalUjian($idTA)
	{
		$this->db->select('jadwalujian.idJadwalUjian, jadwalujian.idTahunAjaran, jadwalujian.idMapel, jadwalujian.hari, 
        jadwalujian.tanggal, jadwalujian.jamMulai, jadwalujian.jamSelesai, matapelajaran.idMapel, matapelajaran.namaMapel, matapelajaran.jenisMapel')
        ->from('jadwalujian')
        ->join('matapelajaran', 'matapelajaran.idMapel = jadwalujian.idMapel', 'inner')
        ->order_by('jamMulai', 'ASC')
        ->where('jadwalujian.idTahunAjaran = "'.$idTA.'"');
        return $this->db->get();
    }
    function jadwalUjianHari($idTA, $hari)
    {
        // $this->db->select('jadwalujian.idJadwalUjian, jadwalujian.idTahunAjaran, jadwalujian.idMapel, jadwalujian.hari, 
        // jadwalujian.jamMulai, jadwalujian.jamSelesai, matapelajaran.idMapel, matapelajaran.namaMapel, matapelajaran.jenisMapel')
        // ->from('jadwalujian')
        // ->join('matapelajaran', 'matapelajaran.idMapel = jadwalujian.idMapel', 'inner')
        // ->where($where);
        // return $this->db->get();
        $query = $this->db->query("SELECT jadwalujian.idJadwalUjian, jadwalujian.idTahunAjaran, jadwalujian.idMapel, jadwalujian.hari, 
        jadwalujian.jamMulai, jadwalujian.jamSelesai, matapelajaran.idMapel, matapelajaran.namaMapel, matapelajaran.jenisMapel 
        FROM jadwalujian 
        JOIN matapelajaran ON matapelajaran.idMapel = jadwalujian.idMapel 
        WHERE jadwalujian.idTahunAjaran = '".$idTA."' AND jadwalujian.hari = '".$hari."'");
        return $query;
    }
    function getIPA($idTA)
    {
        $this->db->select('matapelajaran.idMapel, matapelajaran.idTahunAjaran, matapelajaran.namaMapel, matapelajaran.jenisMapel')
        ->from('matapelajaran')
        ->where('idTahunAjaran = "'.$idTA.'" AND jenisMapel = "IPA"');
        return $this->db->get();
    }
    function getIPS($idTA)
    {
        $this->db->select('matapelajaran.idMapel, matapelajaran.idTahunAjaran, matapelajaran.namaMapel, matapelajaran.jenisMapel')
        ->from('matapelajaran')
        ->where('idTahunAjaran = "'.$idTA.'" AND jenisMapel = "IPS"');
        return $this->db->get();
    }
    function getdataMapel()
    {
        $query = $this->db->query('SELECT DISTINCT hari, jamMulai, jamSelesai FROM jadwalujian');
        return $query;
    }
    function dataMapel($where)
    {
        $this->db->select('jadwalujian.idJadwalUjian, jadwalujian.idTahunAjaran, jadwalujian.idMapel, jadwalujian.hari, 
        jadwalujian.jamMulai, jadwalujian.jamSelesai, matapelajaran.idMapel, matapelajaran.namaMapel, matapelajaran.jenisMapel')
        ->from('jadwalujian')
        ->join('matapelajaran', 'matapelajaran.idMapel = jadwalujian.idMapel', 'inner')
        ->where($where);
        return $this->db->get();
    }
    function editJadwalUjian($id)
    {
        $hasil = $this->db->query('SELECT jadwalujian.idJadwalUjian, jadwalujian.idTahunAjaran, jadwalujian.idMapel, jadwalujian.hari, 
        jadwalujian.jamMulai, jadwalujian.jamSelesai, matapelajaran.idMapel, matapelajaran.namaMapel, matapelajaran.jenisMapel,
        tahunajaran.idTahunAjaran, tahunajaran.tahunAjaran 
        FROM jadwalujian 
        JOIN matapelajaran ON matapelajaran.idMapel = jadwalujian.idMapel 
        JOIN tahunajaran ON tahunajaran.idTahunAjaran = jadwalujian.idTahunAjaran
        WHERE jadwalujian.idJadwalUjian = "'.$id.'"');
        if($hasil->num_rows()>0){
            foreach ($hasil->result() as $data) {
                $hasil=array(
                    'idJadwalUjian' => $data->idJadwalUjian,
                    'hari' => $data->hari,
                    'jamMulai' => $data->jamMulai,
                    'jamSelesai' => $data->jamSelesai,
                    'namaMapel' => $data->namaMapel,
                    'tahunAjaran' => $data->tahunAjaran,
                    'idMapel' => $data->idMapel,
                    'idTahunAjaran' => $data->idTahunAjaran,
                    'jenisMapel' => $data->jenisMapel,
                );
            }
        }
        return $hasil;
    }
    function getKls($idTA)
    {
        $this->db->select('kelas.idKelas, kelas.idTahunAjaran, kelas.ketKelas, kelas.jurusanKelas, kelas.nomorKelas, kelas.statusKelas')
        ->from('kelas')
        ->where('kelas.idTahunAjaran = "'.$idTA.'" AND kelas.statusKelas = "1"');
        return $this->db->get();
    }
    function dataSiswa($id)
    {
        $this->db->select('datasiswa.idSiswa, datasiswa.nomorInduk, datasiswa.idKelas, datasiswa.idTahunAjaran, user.nomorInduk, 
        user.namaUser')
        ->from('datasiswa')
        ->join('user', 'user.nomorInduk = datasiswa.nomorInduk', 'inner')
        ->where('datasiswa.idKelas = "'.$id.'"');
        return $this->db->get();
    }
    function infoSiswa($id)
    {
        $this->db->select('datasiswa.idSiswa, datasiswa.nomorInduk, datasiswa.idKelas, datasiswa.idTahunAjaran, kelas.idKelas, 
        kelas.ketKelas, kelas.jurusanKelas, kelas.nomorKelas, user.nomorInduk, user.namaUser, user.gambar')
        ->from('datasiswa')
        ->join('kelas', 'datasiswa.idKelas = kelas.idKelas', 'inner')
        ->join('user', 'user.nomorInduk = datasiswa.nomorInduk', 'inner')
        ->where('datasiswa.nomorInduk = "'.$id.'"');
        return $this->db->get();
    }
    function getJadwalNgawas($idTA)
    {
        $this->db->select('jadwalujian.idJadwalUjian, jadwalujian.idTahunAjaran, jadwalujian.idMapel, jadwalujian.hari, 
        jadwalujian.jamMulai, jadwalujian.jamSelesai, matapelajaran.idMapel, matapelajaran.namaMapel, matapelajaran.jenisMapel')
        ->from('jadwalujian')
        ->join('matapelajaran', 'matapelajaran.idMapel = jadwalujian.idMapel', 'inner')
        ->where('jadwalujian.idTahunAjaran = "'.$idTA.'"');
        return $this->db->get();
    }
    function simpanJP($data)
    {
            $result = array();
            for($i = 0; $i <= count($data); $i++) {
                $result[] = array(
                    'idJadwalPengawas' => "",
                    'idJadwalUjian' => $_POST['jadwal'][$i],
                    'idKelas' => $_POST['guru'][$i],
                    'nomorInduk' => $_POST['kelas'][$i],
                );
            }
            $this->db->insert_batch('jadwalpengawas', $result);
    }
    function ngawasMapel($jamMulai)
    {
        $query = $this->db->query("SELECT jadwalujian.idJadwalUjian, jadwalujian.idMapel, jadwalujian.jamMulai, matapelajaran.idMapel, 
        matapelajaran.namaMapel 
        FROM jadwalujian 
        JOIN matapelajaran ON jadwalujian.idMapel = matapelajaran.idMapel 
        WHERE jadwalujian.jamMulai = '".$jamMulai."'");
        return $query;
    }
    function ngawasHari($idTA)
    {
        $query = $this->db->query("SELECT DISTINCT hari FROM jadwalujian WHERE idTahunAjaran = '".$idTA."'");
        return $query;
    }
    function ngawasJam($hari)
    {
        $query = $this->db->query("SELECT DISTINCT jamMulai, jamSelesai FROM jadwalujian WHERE hari = '".$hari."'");
        return $query;
    }
    function tambahNgawas($id)
    {
        $query = $this->db->query("SELECT * FROM jadwalpengawas WHERE idJadwalUjian = '".$id."'");
        return $query;
    }
    function pengawas($idTA, $idKls) 
    {
        $query = $this->db->query("SELECT jadwalujian.idTahunAjaran, jadwalujian.idJadwalUjian, jadwalpengawas.idJadwalUjian, jadwalpengawas.idKelas, 
        jadwalpengawas.nomorInduk, user.nomorInduk, user.namaUser, kelas.idKelas, kelas.ketKelas, kelas.jurusanKelas, kelas.nomorKelas, kelas.nomorKelas, 
        kelas.nomorKelas 
        FROM jadwalpengawas 
        JOIN jadwalujian ON jadwalujian.idJadwalUjian = jadwalpengawas.idJadwalUjian 
        JOIN user ON user.nomorInduk = jadwalpengawas.nomorInduk 
        JOIN kelas ON kelas.idKelas = jadwalpengawas.idKelas 
        WHERE jadwalujian.idTahunAjaran = '".$idTA."' AND jadwalPengawas.idKelas = '".$idKls."'");
        return $query;
    }
    function pengembanganDiri()
    {
        $query = $this->db->query("SELECT * FROM `kompetensinilai`");
        return $query;
    }
    function getWKelas($nomorInduk)
    {
        $query = $this->db->query("SELECT walikelas.idKelas, kelas.idKelas, kelas.ketKelas, kelas.jurusanKelas, kelas.nomorKelas, 
        walikelas.nomorInduk 
        FROM walikelas 
        JOIN kelas ON kelas.idKelas = walikelas.idKelas 
        WHERE walikelas.nomorInduk = '".$nomorInduk."'");

        return $query;
    }
    function viewNama($idKelas)
    {
        $query = $this->db->query("SELECT datasiswa.idSiswa, datasiswa.nomorInduk, datasiswa.idKelas, user.nomorInduk, user.namaUser 
        FROM datasiswa
        JOIN user ON user.nomorInduk = datasiswa.nomorInduk 
        WHERE datasiswa.idKelas = '".$idKelas."'");
        return $query;
    }
    function viewCatatan($idKelas)
    {
        $query = $this->db->query("SELECT * FROM `datasiswa` 
        JOIN catatan_walikelas ON datasiswa.idSiswa = catatan_walikelas.idSiswa 
        JOIN user ON user.nomorInduk = datasiswa.nomorInduk 
        WHERE datasiswa.idKelas = '".$idKelas."'");
        return $query;
    }
    function addSiswa($id)
    {
        $query = $this->db->query("SELECT datasiswa.idSiswa, datasiswa.nomorInduk, user.namaUser, user.nomorInduk 
        FROM datasiswa 
        JOIN user ON user.nomorInduk = datasiswa.nomorInduk 
        WHERE datasiswa.idSiswa = '".$id."'");
        return $query;
    }
    function getEditSiswa($id)
    {
        $query = $this->db->query("SELECT catatan_walikelas.idSiswa, catatan_walikelas.catatan, datasiswa.idSiswa, datasiswa.nomorInduk, 
        user.nomorInduk, user.namaUser 
        FROM datasiswa 
        JOIN catatan_walikelas ON catatan_walikelas.idSiswa = datasiswa.idSiswa 
        JOIN user ON user.nomorInduk = datasiswa.nomorInduk 
        WHERE catatan_walikelas.idSiswa = '".$id."'");
        return $query;
    }
    function getEditEkskul($id)
    {
        return $this->db->query("SELECT * FROM datasiswa 
        JOIN ekskul_siswa ON ekskul_siswa.idSiswa = datasiswa.idSiswa 
        JOIN user ON user.nomorInduk = datasiswa.nomorInduk 
        WHERE ekskul_siswa.idEkskul = '".$id."'");
    }
    function viewEkskul($idKelas)
    {
        $query = $this->db->query("SELECT ekskul_siswa.idEkskul, ekskul_siswa.idEkskul, ekskul_siswa.namaEkskul, ekskul_siswa.predikat, 
        ekskul_siswa.ketEkskul, datasiswa.idSiswa, datasiswa.nomorInduk, user.nomorInduk, user.namaUser, datasiswa.idKelas 
        FROM datasiswa 
        JOIN ekskul_siswa ON ekskul_siswa.idSiswa = datasiswa.idSiswa 
        JOIN user ON datasiswa.nomorInduk = user.nomorInduk 
        WHERE datasiswa.idKelas = '".$idKelas."'");
        return $query;
    }
    function viewStatus($id)
    {
        $query = $this->db->query("SELECT * FROM `ekskul_siswa` WHERE idSiswa = '".$id."'");
        return $query;
    }

    //buku nilai
    function getMapelNilai($nomorInduk)
    {
        $query = $this->db->query("SELECT DISTINCT jadwal.nomorInduk, matapelajaran.idMapel, matapelajaran.namaMapel 
        FROM jadwal 
        JOIN matapelajaran ON matapelajaran.idMapel = jadwal.idMapel 
        WHERE jadwal.nomorInduk = '".$nomorInduk."'");
        return $query;
    }
    function simpanNilai($result, $table)
    {
        $this->db->insert($table, $result);   
    }
    function getJnsNilai($id)
    {
        $query = $this->db->query("SELECT DISTINCT jenisNilai FROM bukunilai WHERE idKelas = '".$id."'");
        return $query;
    }
    function getTglNilai($jenis)
    {
        $query = $this->db->query("SELECT DISTINCT tanggal FROM bukunilai WHERE jenisNilai = '".$jenis."'");
        return $query;
    }
    function getNilaiSiswa($where)
    {
        $this->db->select('bukunilai.idSiswa,bukunilai.idKelas, bukunilai.tanggal, bukunilai.nilai, datasiswa.idSiswa, datasiswa.nomorInduk, user.nomorInduk, 
        user.namaUser, kelas.idKelas, kelas.ketKelas, kelas.jurusanKelas, kelas.nomorKelas, datasiswa.idKelas, bukunilai.idBukuNilai')
        ->from('datasiswa')
        ->join('bukunilai', 'bukunilai.idSiswa = datasiswa.idSiswa')
        ->join('user', 'user.nomorInduk = datasiswa.nomorInduk')
        ->join('kelas', 'kelas.idKelas = datasiswa.idKelas')
        ->where($where);

        return $this->db->get();
    }
    function editBukuNilai($id)
    {
        return $this->db->query('SELECT bukunilai.idSiswa,bukunilai.idKelas, bukunilai.tanggal, bukunilai.nilai, datasiswa.idSiswa, datasiswa.nomorInduk, user.nomorInduk, 
        user.namaUser, kelas.idKelas, kelas.ketKelas, kelas.jurusanKelas, kelas.nomorKelas, datasiswa.idKelas, bukunilai.idBukuNilai 
        FROM datasiswa 
        JOIN bukunilai ON bukunilai.idSiswa = datasiswa.idSiswa
        JOIN user ON user.nomorInduk = datasiswa.nomorInduk
        JOIN kelas ON kelas.idKelas = datasiswa.idKelas
        WHERE bukunilai.idBukuNilai = "'.$id.'"');
    }
    function getNamaSiswa($id)
    {
        $query = $this->db->query("SELECT datasiswa.idSiswa, datasiswa.nomorInduk, datasiswa.idKelas, user.nomorInduk, user.namaUser 
        FROM datasiswa 
        JOIN user ON user.nomorInduk = datasiswa.nomorInduk 
        WHERE idKelas = '".$id."'");

        return $query;
    }
    function viewRapor()
    {
        $query = $this->db->query("SELECT datasiswa.idSiswa, datasiswa.nomorInduk, datasiswa.idKelas, user.nomorInduk, user.namaUser, kelas.idKelas, kelas.nomorKelas, 
        kelas.jurusanKelas, kelas.ketKelas, datasiswa.statusSiswa
        FROM datasiswa 
        JOIN user ON user.nomorInduk = datasiswa.nomorInduk 
        JOIN kelas ON kelas.idKelas = datasiswa.idKelas
        WHERE datasiswa.statusSiswa = 1
        ORDER BY datasiswa.nomorInduk ASC");

        return $query;
    }
    function getJurusan($idKls)
    {
        $query = $this->db->query("SELECT jurusanKelas FROM kelas WHERE idKelas = '".$idKls."'");

        return $query;
    }
    function absenMapel($nomorInduk)
    {
        $query = $this->db->query("SELECT DISTINCT jadwal.nomorInduk, jadwal.idMapel, user.nomorInduk, user.namaUser, matapelajaran.idMapel, matapelajaran.namaMapel 
        FROM `jadwal`
        JOIN user ON jadwal.nomorInduk = user.nomorInduk
        JOIN matapelajaran ON jadwal.idMapel = matapelajaran.idMapel
        WHERE jadwal.nomorInduk = '".$nomorInduk."'");
        return $query;
    }
    function modalUjian($id)
    {
        $this->db->select('jadwalujian.idJadwalUjian, jadwalujian.idTahunAjaran, jadwalujian.idMapel, jadwalujian.hari, 
        jadwalujian.jamMulai, jadwalujian.jamSelesai, matapelajaran.idMapel, matapelajaran.namaMapel, matapelajaran.jenisMapel')
        ->from('jadwalujian')
        ->join('matapelajaran', 'matapelajaran.idMapel = jadwalujian.idMapel', 'inner')
        ->where('jadwalUjian.idJadwalUjian = "'.$id.'"');
        return $this->db->get();
    }
    function klsIPA()
    {
        return $this->db->query('SELECT * FROM `kelas` WHERE jurusanKelas = "IPA"');
    }
    function klsIPS()
    {
        return $this->db->query('SELECT * FROM kelas WHERE jurusanKelas = "IPS"');
    }
    function pengawasSimpan($result, $table)
    {
        $this->db->insert($table, $result);
    }
    function cekPengawas()
    {
        return $this->db->query("SELECT * FROM `jadwalpengawas`");
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