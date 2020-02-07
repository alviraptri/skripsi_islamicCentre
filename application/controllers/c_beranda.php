<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class c_beranda extends CI_Controller 
{
    function __construct()
	{
		parent::__construct();
		$this->load->model(array('m_login', 'm_admin', 'm_beranda'));	
	} 

	function getJurusan()
	{
		$ket = $this->input->post('ket');
		$data = $this->m_beranda->getJurusan($ket)->result();
		echo json_encode($data);
	}
	
	function getNilaiSiswa()
	{
		$jurusan = $this->input->post('jurusan');
		$ket = $this->input->post('ket');
		$data = $this->m_beranda->getNilaiSiswa($jurusan, $ket)->result();
		echo json_encode($data);
	}

	function getMapel()
	{
		$kls = $this->input->post('kls');
		$data = $this->m_beranda->getMapel($kls)->result();
		echo json_encode($data);
	}

	function getHasilNilai()
	{
		$mapel = $this->input->post('mapel');
		$kls = $this->input->post('kls');
		$data = $this->m_beranda->getHasilNilai($mapel, $kls)->result();
		echo json_encode($data);
	}

	function getNamaSiswa()
	{
		$kls = $this->input->post('kls');
		$data = $this->m_beranda->getNamaSiswa($kls)->result();
		echo json_encode($data);
	}

	function getNilaiTerendah()
	{
		$kls = $this->input->post('kls');
		$data = $this->m_beranda->getNilaiTerendah($kls)->result();
		echo json_encode($data);
	}

	function getJenisAbsen()
	{
		$kls = $this->input->post('kls');
		$data = $this->m_beranda->getJenisAbsen($kls)->result();
		echo json_encode($data);
	}
	function getJmlhAbsen()
	{
		$kls = $this->input->post('kls');
		$absen = $this->input->post('absen');
		$data = $this->m_beranda->getJmlhAbsen($kls, $absen)->result();
		echo json_encode($data);
	}
	function getSiswa()
	{
		$kls = $this->input->post('kls');
		$data = $this->m_beranda->getSiswa($kls)->result();
		echo json_encode($data);
	}
	function getRekomendasi()
	{
		$id = $this->input->post("id");
		$data = $this->m_beranda->getRekomendasi($id)->result();
		echo json_encode($data);
	}
}
?>