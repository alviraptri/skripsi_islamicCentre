<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class c_admin extends CI_Controller 
{
    function index() 
	{
		$this->load->view('v_hadmin');
	}

	function guru()
	{
		$this->load->view('v_guruProfile');
	}
}
?>