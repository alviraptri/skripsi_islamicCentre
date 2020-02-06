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
		$data = $this->m_beranda->getNilaiSiswa($jurusan)->result();
		echo json_encode($data);
	}
}
?>