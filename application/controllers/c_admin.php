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
		$photo = $this->input->post('photo');

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

		if(!empty($_FILES['photo']['name'])){
			$upload = $this->uploadFoto();
			$data['photo'] = $upload;
		}

		$this->m_admin->simpanGuru($data, 'user');
		redirect('c_admin/guru');
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

	//gambar
	private function uploadFoto()
	{
		$config['upload_path'] = 'assets/inter/images/profil/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['file_name'] = round(microtime(true)*1000);
		$config['overwrite'] = true;
		$config['max_size'] = 2048;

		$this->load->library('upload', $config);

		if(!$this->upload->do_upload('photo')){
			$this->session->set_flashdata('msg', $this->upload->display_errors('',''));
			redirect('c_admin/index');
		}

		return $this->upload->data('file_name');
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
		$this->load->view('v_tambahJadwal', $data);
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