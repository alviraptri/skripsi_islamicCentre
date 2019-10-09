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
		$this->load->view('v_hadmin');
	}

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



}
?>