<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class c_login extends CI_Controller{
    function __construct()
    {
        parent:: __construct();
        $this->load->model(array('m_login'));
        // $this->load->config('email');
        // $this->load->library('email');
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
        $this->load->view('v_lupa_password');
    }

    // function resetLink()
    // {

    //     $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');   
         
    //      if($this->form_validation->run()) {  
    //         $email = $this->input->post('email'); 
    //         $reset_key = random_string('alnum', 50);
    //         if ($this->m_login->resetKey($email, $reset_key)) {
    //             $this->load->library('email');
	// 			$config = array();
	// 			$config['charset'] = 'utf-8';
	// 			$config['useragent'] = 'Codeigniter';
	// 			$config['protocol']= "smtp";
	// 			$config['mailtype']= "html";
	// 			$config['smtp_host']= "ssl://smtp.gmail.com";//pengaturan smtp
	// 			$config['smtp_port']= "465";
	// 			$config['smtp_timeout']= "5";
	// 			$config['smtp_user']= "bjhxrene@gmail.com"; // isi dengan email kamu
	// 			$config['smtp_pass']= "2pmlopelopediudara"; // isi dengan password kamu
	// 			$config['crlf']="\r\n"; 
	// 			$config['newline']="\r\n"; 
	// 			$config['wordwrap'] = TRUE;
	// 			//memanggil library email dan set konfigurasi untuk pengiriman email
					
	// 			$this->email->initialize($config);
	// 			//konfigurasi pengiriman
	// 			$this->email->from($config['smtp_user']);
	// 			$this->email->to($this->input->post('email'));
	// 			$this->email->subject("Reset your password");
 
	// 			$message = "<p>Anda melakukan permintaan reset password</p>";
	// 			$message .= "<a href='".site_url('c_login/konfirmasi/'.$reset_key)."'>klik reset password</a>";
	// 			$this->email->message($message);
				
	// 			if($this->email->send())
	// 			{
	// 				echo "silahkan cek email <b>".$this->input->post('email').'</b> untuk melakukan reset password';
	// 			}else
	// 			{
	// 				echo "Berhasil melakukan registrasi, gagal mengirim verifikasi email";
	// 			}
				
	// 			echo "<br><br><a href='".site_url("c_login/index")."'>Kembali ke Menu Login</a>";
    //         }
    //         else {
    //             die("Email yang anda masukan belum terdaftar");
    //         }
    //      }
    //      else{
    //          echo 0;
    //          $this->load->view('v_lupaKataSandi');
    //      }  
    // }

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
                $password = $list->passUser;
                $role = $list->userRole; //bawa user rolenya 
                $gambar = $list->gambar;
            };
                $data_Session = array(
                    'namaUser' => $nama,
                    'nomorInduk' => $nip,
                    'passUser' => $password,
                    'userRole' => $role,
                    'gambar' => $gambar
                );
                $this->session->set_userdata($data_Session);
                if($role == 'Admin'){
                    redirect('c_admin/index');
                }
                elseif ($role == 'Guru') {
                    redirect('c_admin/index');
                }
                elseif ($role == 'Siswa') {
                    redirect('c_admin/index');
                }
                elseif ($role == 'Wali Kelas') {
                    redirect('c_admin/index');
                }
                elseif ($role == 'Wali Murid') {
                    redirect('c_admin/index');
                }
        }
        else{
            $this->session->set_flashdata('message', 'Nomor Induk dan Password yang anda masukkan tidak cocok');
            redirect('c_login/admin');
        }
    }

    //minta permintaan nomor induk
    // function kirim()
    // {
    //     $nomorInduk = $this->input->post('uname');
    //     $where = array(
    //         'nomorInduk' => $nomorInduk
    //     );

    //     $cek = $this->m_login->cek("user", $where)->num_rows();
    //     $a = $this->m_login->Select($where, 'user')->result();

    //     if($cek>0){
    //         foreach($a as $list){
    //             $nama = $list->namaUser;
    //             $nip = $list->nomorInduk;
    //         };
    //         $data_Session = array(
    //             'namaUser' => $nama,
    //             'nomorInduk' => $nip
    //         );
    //         $this->session->set_userdata($data_Session);
    //         redirect('c_login/konfirmasi');
    //     }
    //     else{
    //         echo "Nomor Induk dan Password yang anda masukkan salah!";
    //     }
    // }

    //update kata sandi
    // function kataSandiBaru()
    // {
    //     $passConf = $this->input->post('passConf');
    //     $passBaru = $this->input->post('passBaru');

    //     if ($passBaru == $passConf) {
    //         $data = array(
    //             'passUser' => md5($passConf)
    //         );
    //         $where = array('nomorInduk' => $this->session->nomorInduk);
    //         $this->m_login->updatePass($where, $data, 'user');
    //         $this->session->sess_destroy();
    //         redirect('c_login/admin');
    //     }
    //     else {
    //         echo '<script language="javascript">';
    //         echo 'alert("Password yang anda masukkan tidak sama")';
    //         echo '</script>';
    //     }
        
    // }

    //konfirmasi password
    // function konfirmasi()
    // {
    //     $this->load->view('v_konfirmasiKataSandi');
    // }

    //keluar
    function keluarAdmin()
    {
        $this->session->sess_destroy();
        redirect('c_login/admin');
    }

    //lupa password
    function lupa_password()
    {
        $email = $this->input->post('email');
        $clean = $this->security->xss_clean($email);
        $userInfo = $this->m_login->getUserInfoByEmail($clean);

        if (!$userInfo) {
            $this->session->set_flashdata('sukses', 'email salah, silahkan coba lagi');
            redirect('c_login/admin');
        }

        //buat token
        $id = $userInfo->nomorInduk;
        $token = $this->m_login->insertToken($id);
        $qstring = $this->base64_encode($token);
        $url = site_url().'/c_login/reset_password/token/'.$qstring;
        $link = '<a href = "'.$url.'">'.$url.'</a>';

        $message = '';
        $message .= '<strong> Hai, ada menerima email ini karena ada permintaan untuk memperbaharui password and. </strong><br>';
        $message .= '<strong> Silahkan Klik Link Ini:</strong>'. $link;

        echo $message;
        exit;
    }
    function reset_password()
    {
        $token = $this->base64_decode($this->uri->segment(4));
        $cleanToken = $this->security->xss_clean($token);
        $userInfo = $this->m_login->isTokenValid($cleanToken);

        // if (!$userInfo) {
        //     $this->session->set_flashdata('sukses', 'Token tidak valid atau kadaluarsa');
        //     redirect('c_login/admin');
        // }

        $passConf = $this->input->post('passConf');
        $passBaru = $this->input->post('passBaru');

        if ($passBaru == $passConf) {
            $data = array(
                'passUser' => md5($passConf)
            );
            $where = array('nomorInduk' => $this->session->nomorInduk);
            $this->m_login->updatePassword($where, $data, 'user');
            $this->session->sess_destroy();
            redirect('c_login/admin');
        }
        else {
            echo '<script language="javascript">';
            echo 'alert("Password yang anda masukkan tidak sama")';
            echo '</script>';
        }
    }

    function base64_encode($data)
    {
        return rtrim(strstr(base64_encode($data), '+/', '-_'), '=');
    }

    function base64_decode($data)
    {
        return base64_decode(str_pad(strstr($data, '-_', '+/'), strlen($data)%4, '=', STR_PAD_RIGHT));
    }
}
?>