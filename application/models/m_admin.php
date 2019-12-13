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

    function kodePegawai()
	{
        $this->db->select('RIGHT(user.nomorInduk,4) as kode',false);
        $this->db->not_like('user.userRole', 'Siswa');
        $this->db->not_like('user.userRole', 'Wali Murid');
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
		$kodeMax = str_pad($kode,4,'0',STR_PAD_LEFT);
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
    function tugasGuru()
    {
        $query = $this->db->query('SELECT DISTINCT jadwal.nomorInduk, jadwal.idMapel, user.nomorInduk, user.namaUser, 
        matapelajaran.idMapel, matapelajaran.namaMapel 
        FROM jadwal 
        JOIN user ON user.nomorInduk = jadwal.nomorInduk 
        JOIN matapelajaran ON matapelajaran.idMapel = jadwal.idMapel');
        
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
        $query = $this->db->query('SELECT matapelajaran.idMapel, matapelajaran.namaMapel, matapelajaran.statusMapel, 
        tahunajaran.idTahunAjaran, tahunajaran.tahunAjaran 
        FROM matapelajaran 
        INNER JOIN tahunajaran ON tahunajaran.idTahunAjaran = matapelajaran.idTahunAjaran 
        WHERE matapelajaran.idMapel="'.$idMapel.'"');

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
    function simpanMulti($data)
    {
            $result = array();
            for($i = 0; $i <= count($data); $i++) {
                $result[] = array(
                    'idInfo' => "",
                    'idSiswa' => $_POST['idSiswa'][$i],
                    'jumlah' => $_POST['jumlah'][$i],
                    'statusInfo' => "1",
                );
            }
            $this->db->insert_batch('informasispp', $result);
    }
    function getDataInfo($idKelas)
    {
        $this->db->select('datasiswa.idSiswa, datasiswa.idKelas, datasiswa.nomorInduk, datasiswa.statusSiswa, 
        kelas.idKelas,user.nomorInduk, user.namaUser, informasispp.idSiswa, informasispp.jumlah, informasispp.idInfo, informasispp.statusInfo')
        ->from('datasiswa')
        ->join('kelas', 'kelas.idKelas = dataSiswa.idKelas', 'inner')
        ->join('user', 'user.nomorInduk = dataSiswa.nomorInduk', 'inner')
        ->join('informasispp', 'informasispp.idSiswa = datasiswa.idSiswa')
        ->where('datasiswa.idKelas = "'.$idKelas.'" AND informasispp.statusInfo = 1');
        return $this->db->get();
    }
    function statusInfo($idInfo){
        $hasil = $this->db->query("UPDATE informasispp SET statusInfo = '0' WHERE idInfo = '".$idInfo."'");
        return $hasil;
        // $idInfo = $this->input->post('idInfo');

        // $this->db->set('statusInfo', 0);
        // $this->db->where('idInfo', $idInfo);
        // $result = $this->db->update('informasispp');
        // return $result;
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
    function getTanggal($id)
    {
        $query = $this->db->query('SELECT DISTINCT tanggal FROM absensi WHERE idJadwal = "'.$id.'"');
        return $query;
    }

    function getAbsensi($id)
    {
        $query = $this->db->query('SELECT absensi.idSiswa, absensi.idJadwal, absensi.absen, datasiswa.idSiswa, datasiswa.nomorInduk, user.nomorInduk, user.namaUser, 
        datasiswa.idKelas, kelas.idKelas, kelas.ketKelas, kelas.jurusanKelas, kelas.nomorKelas, absensi.tanggal, absensi.idAbsen 
        FROM datasiswa 
        JOIN absensi ON absensi.idSiswa = datasiswa.idSiswa 
        JOIN user ON user.nomorInduk = datasiswa.nomorInduk 
        JOIN kelas ON kelas.idKelas = datasiswa.idKelas 
        WHERE absensi.tanggal = "'.$id.'"');
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
        $this->db->select('jadwal.idJadwal, jadwal.nomorInduk, jadwal.idMapel,jadwal.idKelas ,matapelajaran.idMapel, matapelajaran.namaMapel, kelas.idKelas, kelas.ketKelas, 
        kelas.jurusanKelas, kelas.nomorKelas')
        ->from('jadwal')
        ->join('matapelajaran', 'matapelajaran.idMapel = jadwal.idMapel', 'inner')
        ->join('kelas', 'kelas.idKelas = jadwal.idKelas', 'inner')
        ->where('jadwal.idMapel = "'.$idMapel.'"');

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
        ->where('datasiswa.idKelas = "'.$idKelas.'"');
        return $this->db->get();
    }
    function simpanAbsen($result, $table)
    {
        
        $this->db->insert($table, $result);
    
        
    }

    //jadwal ujian
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
    function getJadwalUjian($where)
    {
        $this->db->select('jadwalujian.idJadwalUjian, jadwalujian.idTahunAjaran, jadwalujian.idMapel, jadwalujian.hari, 
        jadwalujian.jamMulai, jadwalujian.jamSelesai, matapelajaran.idMapel, matapelajaran.namaMapel, matapelajaran.jenisMapel')
        ->from('jadwalUjian')
        ->join('matapelajaran', 'matapelajaran.idMapel = jadwalujian.idMapel')
        ->where($where);
        return $this->db->get(); 

        // $this->db->select('jadwalujian.idJadwalUjian, jadwalujian.idTahunAjaran, jadwalujian.idMapel, jadwalujian.hari, 
        // jadwalujian.jamMulai, jadwalujian.jamSelesai, matapelajaran.idMapel, matapelajaran.namaMapel, matapelajaran.jenisMapel')
        // ->from('jadwalujian')
        // ->join('matapelajaran', 'matapelajaran.idMapel = jadwalujian.idMapel', 'inner')
        // ->where('jadwalujian.idTahunAjaran = "'.$idTA.'"');
        // return $this->db->get();
    }
    function jadwalUjian($idTA)
	{
		$this->db->select('jadwalujian.idJadwalUjian, jadwalujian.idTahunAjaran, jadwalujian.idMapel, jadwalujian.hari, 
        jadwalujian.jamMulai, jadwalujian.jamSelesai, matapelajaran.idMapel, matapelajaran.namaMapel, matapelajaran.jenisMapel')
        ->from('jadwalujian')
        ->join('matapelajaran', 'matapelajaran.idMapel = jadwalujian.idMapel', 'inner')
        ->where('jadwalujian.idTahunAjaran = "'.$idTA.'"');
        return $this->db->get();
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
    function pengawas($idTA)
    {
        $query = $this->db->query("SELECT jadwalujian.idTahunAjaran, jadwalujian.idJadwalUjian, jadwalpengawas.idJadwalUjian, jadwalpengawas.idKelas, 
        jadwalpengawas.nomorInduk, user.nomorInduk, user.namaUser, kelas.idKelas, kelas.ketKelas, kelas.jurusanKelas, kelas.nomorKelas, kelas.nomorKelas, 
        kelas.nomorKelas 
        FROM jadwalpengawas 
        JOIN jadwalujian ON jadwalujian.idJadwalUjian = jadwalpengawas.idJadwalUjian 
        JOIN user ON user.nomorInduk = jadwalpengawas.nomorInduk 
        JOIN kelas ON kelas.idKelas = jadwalpengawas.idKelas 
        WHERE jadwalujian.idTahunAjaran = '".$idTA."'");
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
        $query = $this->db->query("SELECT catatan_walikelas.idCatatan, catatan_walikelas.idSiswa, catatan_walikelas.catatan, 
        datasiswa.idSiswa, datasiswa.idKelas 
        FROM datasiswa 
        JOIN catatan_walikelas ON catatan_walikelas.idSiswa = datasiswa.idSiswa 
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
}

?>