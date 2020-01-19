<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class c_beranda extends CI_Controller 
{
    function __construct()
	{
		parent::__construct();
		$this->load->model(array('m_login', 'm_admin', 'm_beranda'));	
    }
}
?>