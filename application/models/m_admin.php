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
        $this->db->select('matapelajaran.idMapel, matapelajaran.namaMapel, matapelajaran.statusMapel, tahunajaran.idTahunAjaran, tahunajaran.tahunAjaran')
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
        $this->db->select('jadwal.idJadwal, jadwal.nomorInduk, jadwal.idMapel,jadwal.idKelas ,matapelajaran.idMapel, matapelajaran.namaMapel, kelas.idKelas, kelas.ketKelas, 
        kelas.jurusanKelas, kelas.nomorKelas')
        ->from('jadwal')
        ->join('matapelajaran', 'matapelajaran.idMapel = jadwal.idMapel', 'inner')
        ->join('kelas', 'kelas.idKelas = jadwal.idKelas', 'inner')
        ->where('jadwal.nomorInduk = "'.$nomorInduk.'"');

        return $this->db->get();
    }
    function getKetNilai($where)
    {
        $this->db->select('idKetNilai, idMapel, nilaiSatu, nilaiDua, nilaiUts, nilaiUas')
        ->from('ketnilai')
        ->where($where);
        return $this->db->get();
    }
    function editKetNilai($id)
    {
        $hasil = $this->db->query('SELECT ketnilai.idKetNilai, ketnilai.nomorInduk, ketnilai.idMapel, ketnilai.nilaiSatu, ketnilai.nilaiDua, ketnilai.nilaiUts, ketnilai.nilaiUas, 
        matapelajaran.idMapel, matapelajaran.namaMapel, user.nomorInduk, user.namaUser 
        FROM ketnilai 
        INNER JOIN matapelajaran ON matapelajaran.idMapel = ketnilai.idMapel 
        INNER JOIN user on user.nomorInduk = ketnilai.nomorInduk 
        WHERE ketnilai.idKetNilai = "'.$id.'"');
        if($hasil->num_rows()>0){
            foreach ($hasil->result() as $data) {
                $hasil=array(
                    'idKetNilai' => $data->idKetNilai,
                    'namaUser' => $data->namaUser,
                    'namaMapel' => $data->namaMapel,
                    'nilaiSatu' => $data->nilaiSatu,
                    'nilaiDua' => $data->nilaiDua,
                    'nilaiUts' => $data->nilaiUts,
                    'nilaiUas' => $data->nilaiUas,
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
    function getNama($idKelas)
    {
        $this->db->select('datasiswa.idSiswa, datasiswa.idKelas, datasiswa.nomorInduk, user.nomorInduk, user.namaUser')
        ->from('datasiswa')
        ->join('user', 'user.nomorInduk = datasiswa.nomorInduk', 'inner')
        ->where('datasiswa.idKelas = "'.$idKelas.'"');
        return $this->db->get();
    }
    function simpanAbsen($data)
    {
        $result = array();
        for($i=0 ; $i<=count($data); $i++){
            $result[] = array(
                'idAbsen' => ""   ,
                'idSiswa' => $_POST['idSiswa'][$i],
                'idJadwal' => $_POST['idJadwal'][$i],
                'tanggal' => $_POST['tgl'][$i],
                'absen' => $_POST['cek'][$i],
                'statusAbsen' => '1',
            );
        }
        $this->db->insert_batch('absensi', $result);
    }

    function getJadwal($idKelas)
    {
        $this->db->select('jadwal.idJadwal, jadwal.idKelas, jadwal.idMapel')
        ->from('jadwal')
        ->where('jadwal.idKelas = "'.$idKelas.'"');
        return $this->db->get();
    }
}

?>