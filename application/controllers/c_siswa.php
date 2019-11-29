<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class c_siswa extends CI_Controller 
{
    function index() 
	{
		$this->load->view('v_hsiswa');
	}
}
?>