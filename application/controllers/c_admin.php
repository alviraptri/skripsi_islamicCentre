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
	- Guru: 20-99
	- Siswa: 102- */

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
			'jenisKelamin' => $jk,
			'passUser' => "",
			'statusUser' => 1 
		);

		$this->m_admin->simpanGuru($data, 'user');
		redirect('c_admin/guru');
	}

	//siswa
	function siswa()
	{
		$data['dataSiswa'] = $this->m_admin->tampilkanDataSiswa()->result();
		$this->load->view('v_dataSiswa', $data);
	}
	function getData()
	{
		$siswaId = $this->input->post('rowid');
		echo $siswaId;
		if(isset($siswaId) and !empty($siswaId)){
			$record = $this->m_admin->getData($siswaId);
			$output = '';
			foreach($record->result_array() as $row){
				$output = '
				<h4 class="text-center"> Detail Data Siswa </h4><br>
				<div class="row">
					<div class="col-lg-6">
						<table class="table table-bordered">
							<tr>
								<td><b>Nomor Induk</b></td>
								<td>'.$row["nomorInduk"].'</td>
							<tr>
							<tr>
								<td><b>Nama</b></td>
								<td>'.$row["namaUser"].'</td>
							<tr>
							<tr>
								<td><b>Tanggal Lahir</b></td>
								<td>'.$row["ttlUser"].'</td>
							<tr>
							<tr>
								<td><b>Email</b></td>
								<td>'.$row["emailUser"].'</td>
							<tr>
							<tr>
								<td><b>No. Hp</b></td>
								<td>'.$row["noTelp"].'</td>
							<tr>
							<tr>
								<td><b>Alamat</b></td>
								<td>'.$row["alamatUser"].'</td>
							<tr>
							<tr>
								<td><b>Jenis Kelamin</b></td>
								<td>'.$row["jenisKelamin"].'</td>
							<tr>
						</table>
					</div>
					<div class="col-lg-6">
						<table class="table table-bordered">
							<tr>
								<td><b>Kelas</b></td>
								<td>'.$row["ketKelas"].' '.$row["jurusanKelas"].'</td>
							<tr>
							<tr>
								<td><b>Tahun Ajaran</b></td>
								<td>'.$row["tahunAjaran"].'</td>
							<tr>
							<tr>
								<td><b>Status</b></td>
								<td>'.$row["statusSiswa"].'</td>
							<tr>
						</table>
					</div>';
			}
			echo $output;
			}
			else {
				echo '
				<center>
					<ul class="list-group">
						<li class="list-group-item">'.'Pilih Siswa'.'</li>
					</ul>
				</center>';
			}
		
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

	//mata pelajaran

	//jadwal

	//tahun ajaran

	//kelas



}
?>