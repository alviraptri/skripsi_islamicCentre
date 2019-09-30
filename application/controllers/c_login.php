<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class c_login extends CI_Controller{
    function __construct()
    {
        parent:: __construct();
        $this->load->model(array('m_login'));
    }

    //nampilin view login siswa dan guru
    function index()
    {
        $this->load->view('welcome_message');
    }

    //nampilin view login admin
    function admin()
    {
        $this->load->view('loginAdmin');
    }

    //login 
    function login()
    {
        $nomorInduk = $this->input->post('uname');
        $pass = $this->input->post('pass');
        $where = array(
            'nomorInduk' => $nomorInduk,
            'passUser' => $pass
        );

        $cek = $this->m_login->selectLogin("user", $where)->num_rows();
        $a = $this->m_login->Select($where, 'user')->result();
        if($cek>0){
            foreach($a as $list){
                $nama = $list->namaUser;
                $nip = $list->nomorInduk;
            };
            $data_Session = array(
                'namaUser' => $nama,
                'nomorInduk' => $nip
            );
            $this->session->set_userdata($data_Session);
            redirect('c_siswa/index');
        }
        else{
            echo "Nomor Induk dan Password yang anda masukkan salah!";
        }
    }
}
?>