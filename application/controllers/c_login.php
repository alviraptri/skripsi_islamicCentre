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
        $this->load->view('v_masukAdmin');
    }

    //nampilin view lupa kata sandi
    function lupaKataSandi()
    {
        $this->load->view('v_lupaKataSandi');
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

        $cek = $this->m_login->cek("user", $where)->num_rows();
        $a = $this->m_login->Select($where, 'user')->result();

        if($cek>0){
            foreach($a as $list){
                $nama = $list->namaUser;
                $nip = $list->nomorInduk;
                $role = $list->userRole;
                $gambar = $list->gambar;
            };
            $data_Session = array(
                'namaUser' => $nama,
                'nomorInduk' => $nip,
                'userRole' => $role,
                'gambar' => $gambar
            );
            $this->session->set_userdata($data_Session);
            if($role == 'Admin'){
                redirect('c_admin/index');
            }
            elseif ($role == 'Guru') {
                redirect('c_guru/index');
            }
            elseif ($role == 'Siswa') {
                redirect('c_siswa/index');
            }
            elseif ($role == 'Wali Kelas') {
                redirect('c_waliKelas/index');
            }
            elseif ($role == 'Wali Murid') {
                redirect('c_waliMurid/index');
            }
        }
        else{
            echo '<script language="javascript">';
            echo 'alert("Nomor Induk dan Kata Sandi yang anda masukkan salah1")';
            echo '</script>';
        }
    }

    //minta permintaan nomor induk
    function kirim()
    {
        $nomorInduk = $this->input->post('uname');
        $where = array(
            'nomorInduk' => $nomorInduk
        );

        $cek = $this->m_login->cek("user", $where)->num_rows();
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
            redirect('c_login/konfirmasi');
        }
        else{
            echo "Nomor Induk dan Password yang anda masukkan salah!";
        }
    }

    //update kata sandi
    function kataSandiBaru()
    {
        $passConf = $this->input->post('passConf');
        $passBaru = $this->input->post('passBaru');

        if ($passBaru == $passConf) {
            $data = array(
                'passUser' => md5($passConf)
            );
            $where = array('nomorInduk' => $this->session->nomorInduk);
            $this->m_login->updatePass($where, $data, 'user');
            $this->session->sess_destroy();
            redirect('c_login/admin');
        }
        else {
            echo '<script language="javascript">';
            echo 'alert("Password yang anda masukkan tidak sama")';
            echo '</script>';
        }
        
    }

    //konfirmasi password
    function konfirmasi()
    {
        $this->load->view('v_konfirmasiKataSandi');
    }

    //keluar
    function keluarAdmin()
    {
        $this->session->sess_destroy();
        redirect('c_login/admin');
    }
}
?>