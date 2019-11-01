<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class c_admin extends CI_Controller 
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('m_admin');	
	}
    function index() 
	{
		$this->load->view('v_berandaAdmin');
	}

	/* Menu:
	- Guru: 23-110
	- Siswa: 112-213
	- Gambar: 215-232
	- Mata Pelajaran: 234-288
	- Jadwal:  */

	//admin
	function admin()
	{
		$where = array('userRole' => 'Admin' );
		$data['dataAdmin'] = $this->m_admin->tampilkanDataGuru($where)->result();
		$this->load->view("v_dataAdmin", $data);
	}
	function editAdmin($idAdmin)
	{
		$where = array('nomorInduk' => $idAdmin);
		$data['editAdmin'] = $this->m_admin->editGuru($where,'user')->result();
		$this->load->view('v_editAdmin', $data);
	}
	function updateAdmin()
	{
		$noInduk = $this->input->post('nomorInduk');
		$nama = $this->input->post('nama');
		$ttl = $this->input->post('ttl');
		$email = $this->input->post('email');
		$noTelp = $this->input->post('noTelp');
		$alamat = $this->input->post('alamat');
		$jk = $this->input->post('jk');
		$userRole = $this->input->post('role');

		$tgl = date('Y-m-d', strtotime($ttl));

		$data = array(
			'nomorInduk' => $noInduk,
			'userRole' => $userRole,
			'namaUser' => $nama,
			'ttlUser' => $tgl,
			'emailUser' => $email,
			'noTelp' => $noTelp,
			'alamatUser' => $alamat,
			'jenisKelamin' => $jk 
		);
		$where = array('nomorInduk' => $noInduk);
		$this->m_admin->updateGuru($where, $data, 'user');
		redirect('c_admin/admin');
	}

	//Guru
	function guru()
	{
		$where = array('userRole' => 'Guru' );
		$data['dataGuru'] = $this->m_admin->tampilkanDataGuru($where)->result();
		$this->load->view("v_dataGuru", $data);
	}
	function editGuru($idGuru)
	{
		$where = array('nomorInduk' => $idGuru);
		$data['editGuru'] = $this->m_admin->editGuru($where,'user')->result();
		$this->load->view('v_editGuru', $data);
	}
	function updateGuru()
	{
		$noInduk = $this->input->post('nomorInduk');
		$nama = $this->input->post('nama');
		$ttl = $this->input->post('ttl');
		$email = $this->input->post('email');
		$noTelp = $this->input->post('noTelp');
		$alamat = $this->input->post('alamat');
		$jk = $this->input->post('jk');
		$userRole = $this->input->post('role');

		$tgl = date('Y-m-d', strtotime($ttl));

		$data = array(
			'nomorInduk' => $noInduk,
			'userRole' => $userRole,
			'namaUser' => $nama,
			'ttlUser' => $tgl,
			'emailUser' => $email,
			'noTelp' => $noTelp,
			'alamatUser' => $alamat,
			'jenisKelamin' => $jk 
		);
		$where = array('nomorInduk' => $noInduk);
		$this->m_admin->updateGuru($where, $data, 'user');
		redirect('c_admin/guru');
	}
	function statusGuru($nomorInduk)
	{
		$data = array('statusUser' => 0);
		$where = array('nomorInduk' => $nomorInduk);
		$this->m_admin->statusGuru($where, $data, 'user');
		redirect('c_admin/guru');
	}
	function tambahGuru()
	{
		$this->load->view("v_tambahGuru");
	}
	function simpanGuru()
	{
		$noInduk = $this->input->post('nomorInduk');
		$nama = $this->input->post('nama');
		$ttl = $this->input->post('ttl');
		$email = $this->input->post('email');
		$noTelp = $this->input->post('noTelp');
		$alamat = $this->input->post('alamat');
		$jk = $this->input->post('jk');
		$pass = $this->input->post('pass');
		$userRole = $this->input->post('role');
		$photo = $this->input->post('image');
		$photo = $this->_uploadImage();

		$tgl = date('Y-m-d', strtotime($ttl));

		$data = array(
			'nomorInduk' => $noInduk,
			'userRole' => $userRole,
			'namaUser' => $nama,
			'ttlUser' => $tgl,
			'emailUser' => $email,
			'noTelp' => $noTelp,
			'alamatUser' => $alamat,
			'jenisKelamin' => $jk,
			'passUser' => $pass,
			'gambar' => $photo,
			'statusUser' => 1 
		);

		$this->m_admin->simpanGuru($data, 'user');
		redirect('c_admin/guru');
	}
	function getKelas()
	{
		$data = $this->m_admin->getKelas()->result();
		echo json_encode($data);
	}

	//gambar
	function _uploadImage()
	{
		$config = array(
			'upload_path' => 'assets/inter/images/profil/',
			'allowed_types' => "gif|jpg|png|jpeg|pdf",
			'overwrite' => TRUE,
			'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
			'max_height' => "768",
			'max_width' => "1024"
		);
		
		$this->load->library('upload', $config);

		if($this->upload->do_upload('image')){
			return $this->upload->data('file_name');
        }
        
        return "default.jpg";
	}

	//siswa
	function siswa()
	{
		$data['siswa'] = $this->m_admin->tampilkanDataSiswa()->result();
		$this->load->view('v_dataSiswa', $data);
	}
	function editSiswa($idSiswa)
	{
		//$where = array('nomorInduk' => $idSiswa);
		$data['editSiswa'] = $this->m_admin->editSiswa($idSiswa)->result();
		$this->load->view('v_editSiswa', $data);
	}
	function updateSiswa()
	{
		$noInduk = $this->input->post('nomorInduk');
		$nama = $this->input->post('nama');
		$ttl = $this->input->post('ttl');
		$email = $this->input->post('email');
		$noTelp = $this->input->post('noTelp');
		$alamat = $this->input->post('alamat');
		$jk = $this->input->post('jk');
		$kelas = $this->input->post('kelas');
		$tahunAjaran = $this->input->post('tahunAjaran');

		$tgl = date('Y-m-d', strtotime($ttl));
		$where = array('nomorInduk' => $noInduk );

		$dataUser = array(
			'nomorInduk' => $noInduk,
			'namaUser' => $nama,
			'ttlUser' => $tgl,
			'emailUser' => $email,
			'noTelp' => $noTelp,
			'alamatUser' => $alamat,
			'jenisKelamin' => $jk 
		);
		
		$dataSiswa = array(
			'idKelas' => $kelas,
			'idTahunAjaran' => $tahunAjaran
		);
		$this->m_admin->updateSiswa($where, $dataUser, 'user');
		$this->m_admin->updateSiswa($where, $dataSiswa, 'datasiswa');
		redirect('c_admin/siswa');
	}
	function tambahSiswa()
	{
		$data['siswa'] = $this->m_admin->tampilkanDataSiswa()->result();
		$this->load->view("v_tambahSiswa", $data);
	}
	function simpanSiswa()
	{
		$noInduk = $this->input->post('nomorInduk');
		$nama = $this->input->post('nama');
		$ttl = $this->input->post('ttl');
		$email = $this->input->post('email');
		$noTelp = $this->input->post('noTelp');
		$alamat = $this->input->post('alamat');
		$jk = $this->input->post('jk');
		$kelas = $this->input->post('kelas');
		$tahunAjaran = $this->input->post('tahunAjaran');
		$status = $this->input->post('status');
		$pass = $this->input->post('pass');

		$tgl = date('Y-m-d', strtotime($ttl));

		$dataUser = array(
			'nomorInduk' => $noInduk,
			'userRole' => $status,
			'namaUser' => $nama,
			'ttlUser' => $tgl,
			'emailUser' => $email,
			'noTelp' => $noTelp,
			'alamatUser' => $alamat,
			'jenisKelamin' => $jk,
			'passUser' => md5($pass),
			'gambar' => "blabla.jpg",
			'statusUser' => '1' 
		);

		$dataSiswa = array(
			'idSiswa' => "",
			'nomorInduk' => $noInduk,
			'idKelas' => $kelas,
			'idTahunAjaran' => $tahunAjaran,
			'statusSiswa' => '1'
		);

		$this->m_admin->simpanSiswa($dataUser, 'user');
		$this->m_admin->simpanSiswa($dataSiswa, 'datasiswa');
		redirect('c_admin/siswa');
	}
	function statusSiswa($nomorInduk)
	{
		$dataSiswa = array('statusSiswa' => 0, );
		$dataUser = array('statusUser' => 0, );
		$where = array('nomorInduk' => $nomorInduk, );

		$this->m_admin->statusSiswa($where, $dataSiswa, 'dataSiswa');
		$this->m_admin->statusSiswa($where, $dataUser, 'user');
		redirect ('c_admin/siswa');
	}

	//mata pelajaran
	function tambahMapel()
	{
		$data['ta'] = $this->m_admin->thnAjaran()->result();
		$this->load->view('v_tambahMapel', $data);
	}
	function simpanMapel()
	{
		$mapel = $this->input->post('mapel');
		$thnajaran = $this->input->post('tahunAjaran');

		$data = array(
			'idMapel' => '',
			'idTahunAjaran' => $thnajaran,
			'namaMapel' => $mapel,
			'statusMapel' => '1'
		);

		$this->m_admin->simpanMapel($data, 'matapelajaran');
		redirect('c_admin/mapel');
	}
	function mapel()
	{
		$data['mapel'] = $this->m_admin->tampilkanDataMapel()->result();
		$this->load->view('v_dataMapel', $data);
	}
	function editMapel($idMapel)
	{
		$data['editMapel'] = $this->m_admin->editMapel($idMapel)->result();
		$this->load->view('v_editMapel', $data);
	}
	function updateMapel()
	{
		$idMapel = $this->input->post('idMapel');
		$mapel = $this->input->post('mapel');
		$tahunAjaran = $this->input->post('tahunAjaran');
		$where = array('idMapel' => $idMapel );

		$data = array(
			'idMapel' => $idMapel,
			'namaMapel' => $mapel,
			'idTahunAjaran' => $tahunAjaran,
		);

		$this->m_admin->updateMapel($where, $data, 'matapelajaran');
		redirect('c_admin/mapel');
	}
	function statusMapel($idMapel)
	{
		$data = array('statusMapel' => 0, );
		$where = array('idMapel' => $idMapel, );

		$this->m_admin->statusMapel($where, $data, 'matapelajaran');
		redirect ('c_admin/mapel');
	}

	//jadwal
	function tambahJadwal()
	{
		$data['kls'] = $this->m_admin->kelas()->result();
		$data['mapel'] = $this->m_admin->mapel()->result();
		$data['guru'] = $this->m_admin->guru()->result();
		$data['ta'] = $this->m_admin->thnAjaran()->result();
		$this->load->view('v_tambahJadwal', $data);
	}
	function simpanJadwal()
	{
		$idkelas = $this->input->post('kelas');
		$tahunAjaran = $this->input->post('tahunAjaran');
		$nomorInduk = $this->input->post('guru');
		$idMapel = $this->input->post('mapel');
		$hari = $this->input->post('hari');
		$jamMulai = $this->input->post('jamMulai');
		$jamSelesai = $this->input->post('jamSelesai');

		$data = array(
			'idJadwal' => "",
			'idKelas' => $idkelas,
			'idTahunAjaran' => $tahunAjaran,
			'nomorInduk' => $nomorInduk, 
			'idMapel' => $idMapel,
			'hari' => $hari,
			'jamMulai' => $jamMulai,
			'jamSelesai' => $jamSelesai,
			'statusJadwal' => 1
		);

		$this->m_admin->simpanJadwal($data, 'jadwal');
		redirect('c_admin/jadwal');
	}
	function jadwal()
	{
		$data['jadwal'] = $this->m_admin->tampilkanDataJadwal()->result();
		$this->load->view('v_dataJadwal', $data);
	}
	function editJadwal($idJadwal)
	{
		$data['kls'] = $this->m_admin->kelas()->result();
		$data['mapel'] = $this->m_admin->mapel()->result();
		$data['guru'] = $this->m_admin->guru()->result();
		$data['ta'] = $this->m_admin->thnAjaran()->result();
		$data['editJadwal'] = $this->m_admin->editJadwal($idJadwal)->result();
		$this->load->view('v_editJadwal', $data);
	}
	function updateJadwal()
	{
		$idJadwal = $this->input->post('idJadwal');
		$idkelas = $this->input->post('kelas');
		$tahunAjaran = $this->input->post('tahunAjaran');
		$nomorInduk = $this->input->post('guru');
		$idMapel = $this->input->post('mapel');
		$hari = $this->input->post('hari');
		$jamMulai = $this->input->post('jamMulai');
		$jamSelesai = $this->input->post('jamSelesai');

		$where = array('idJadwal' => $idJadwal );

		$data = array(
			'idJadwal' => "",
			'idKelas' => $idkelas,
			'idTahunAjaran' => $tahunAjaran,
			'nomorInduk' => $nomorInduk, 
			'idMapel' => $idMapel,
			'hari' => $hari,
			'jamMulai' => $jamMulai,
			'jamSelesai' => $jamSelesai,
			'statusJadwal' => 1
		);

		$this->m_admin->updateSiswa($where, $data, 'jadwal');
		redirect('c_admin/jadwal');
	}
	function statusJadwal($idJadwal)
	{
		$data = array('statusJadwal' => 0, );
		$where = array('idJadwal' => $idJadwal, );

		$this->m_admin->statusMapel($where, $data, 'jadwal');
		redirect ('c_admin/jadwal');
	}

	//tahun ajaran

	//kelas
	function tambahKelas()
	{
		$this->load->view('v_tambahKelas');
	}
	function simpanKelas()
	{
		$ketKelas = $this->input->post('ketKelas');
		$jurusanKelas = $this->input->post('jurusanKelas');
		$noKelas = $this->input->post('noKelas');

		$data = array(
			'idKelas' => "",
			'ketKelas' => $ketKelas,
			'jurusanKelas' => $jurusanKelas,
			'nomorKelas' => $noKelas,
			'statusKelas' => 1 
		);

		$this->m_admin->simpanKelas($data, 'kelas');
		redirect('c_admin/kelas');
	}
	function kelas()
	{
		$data['kls'] = $this->m_admin->kelas()->result();
		$this->load->view('v_dataKelas', $data);
	}
	function statusKelas($idKelas)
	{
		$data = array('statusKelas' => 0, );
		$where = array('idKelas' => $idKelas, );

		$this->m_admin->statusKelas($where, $data, 'kelas');
		redirect('c_admin/kelas');
	}
	function editKelas($idKelas)
	{
		$data['editKelas'] = $this->m_admin->editKelas($idKelas)->result();
		$this->load->view('v_editKelas', $data);
	}
	function updateKelas()
	{
		$idKelas = $this->input->post('idKelas');
		$ketKelas = $this->input->post('ketKelas');
		$jurusanKelas = $this->input->post('jurusanKelas');
		$noKelas = $this->input->post('noKelas');
		$where = array('idKelas' => $idKelas, );

		$data = array(
			'ketKelas' => $ketKelas,
			'jurusanKelas' => $jurusanKelas,
			'nomorKelas' => $noKelas,
			'statusKelas' => 1 
		);

		$this->m_admin->updateKelas($where, $data, 'kelas');
		redirect('c_admin/kelas');
	}
	



}
?>