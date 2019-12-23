<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class c_rekomendasi extends CI_Controller 
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model(array('m_login', 'm_admin', 'm_rekomendasi'));	
    }
    function index() 
	{
		$this->load->view('v_rekomendasi');
    }
    function kriteria()
    {
        $data['kriteria'] = $this->m_rekomendasi->tampilkanKriteria()->result();
        $this->load->view('v_kriteria', $data);
    }
    function simpanKriteria()
    {
        $nama = $this->input->post('nama');
        $data = array(
            'jenisKriteria' => $nama, 
            'statusKriteria' => 1,
        );
        $this->m_admin->simpanData($data, 'kriteria');
        echo json_encode($data);
    }
    function editKriteria(){
        $id=$this->input->get('id');
        $data=$this->m_rekomendasi->getKriteria($id);
        echo json_encode($data);
    }
    function alternatif()
    {
        $data['siswa'] = $this->m_rekomendasi->getSiswa()->result();
        $data['alternatif'] = $this->m_rekomendasi->tampilkanAlternatif()->result();
        $this->load->view('v_alternatif', $data);
    }
    function simpanAlternatif()
    {
        $siswa = $this->input->post('siswa');
        $nama = $this->input->post('alternatif');
        $data = array(
            'namaAlternatif' => $nama, 
            'idSiswa' => $siswa,
            'statusAlternatif' => 1,
        );
        $this->m_admin->simpanData($data, 'alternatif');
        echo json_encode($data);
    }
}
?>