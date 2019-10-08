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

    //login siswa dan wali murid
    function login()
    {
        $nomorInduk = $this->input->post('uname');
        $pass = $this->input->post('pass');
        $where = array(
            'nomorInduk' => $nomorInduk,
            'passUser' => md5($pass)
        );

        $cek = $this->m_login->selectLogin("user", $where)->num_rows();
        $a = $this->m_login->Select($where, 'user')->result();
        if($cek>0){
            foreach($a as $list){
                $nama = $list->namaUser;
                $nip = $list->nomorInduk;
                $role = $list->userRole;
            };
            $data_Session = array(
                'namaUser' => $nama,
                'nomorInduk' => $nip,
                'userRole' => $role
            );
            $this->session->set_userdata($data_Session);
            if(strcmp($role, 'Wali Murid')){
                redirect('c_siswa/index');                
            }
            else{
                redirect('c_waliMurid/index');
            }
        }
        else{
            echo "Nomor Induk dan Password yang anda masukkan salah!";
        }
    }

    //login sekolah staff
    function staffLogin()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $where = array(
            'nomorInduk' => $username,
            'passUser' => md5($password)
        );

        $cek = $this->m_login->selectLogin("user", $where)->num_rows();
        $a = $this->m_login->Select($where, 'user')->result();
        if($cek>0){
            foreach($a as $list){
                $nama = $list->namaUser;
                $nip = $list->nomorInduk;
                $role = $list->userRole;
            };
            $data_Session = array(
                'namaUser' => $nama,
                'nomorInduk' => $nip,
                'userRole' => $role
            );
            $this->session->set_userdata($data_Session);
            redirect('c_admin/index');
            /*if(strcmp($role, 'Wali Kelas')){
                redirect('c_waliKelas/index');            
            }
            else if(strcmp($role, 'Guru')){
                redirect('c_guru/index');
            }
            else{
                redirect('c_waliKelas/index');
            }*/
        }
        else{
            echo "Nomor Induk dan Password yang anda masukkan salah!";
        }
    }
}
?>