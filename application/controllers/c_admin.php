<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class c_admin extends CI_Controller 
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model(array('m_login', 'm_admin', 'm_beranda'));	
	}
    function index() 
	{
		$data['jmlhSiswa'] = $this->m_beranda->hitungSiswa();
		$data['jmlhGuru'] = $this->m_beranda->hitungGuru();
		$data['jmlhKls'] = $this->m_beranda->hitungKls();
		$absen = $this->m_beranda->absen()->result();
		foreach ($absen as $b) {
			$tanggal = $b->tanggal;
			$hasil = explode("-", $tanggal);
			$blnn = $hasil[1];
			$tgl = $hasil[2];
		}
		$this->load->view('v_berandaAdmin', $data);
	}

	/* Menu:
	- Admin: 25-71
	- Guru: 73-119
	- Wali Kelas: 122-173
	- Pegawai: 175-260
	- Siswa: 262-418
	- Wali Murid: 420-509
	- Gambar: 215-232
	- Mata Pelajaran: 234-288
	- Jadwal:  */

	//admin
	function admin()
	{
		$where = array('userRole' => 'Admin', 'statusUser' => '1');
		$data['dataAdmin'] = $this->m_admin->tampilkanDataPegawai($where)->result();
		$this->load->view("v_dataAdmin", $data);
	}
	function editAdmin($idAdmin)
	{
		$where = array('nomorInduk' => $idAdmin);
		$data['editAdmin'] = $this->m_admin->editData($where,'user')->result();
		$this->load->view('v_editAdmin', $data);
	}
	function updateAdmin()
	{
		$noInduk = $this->input->post('nomorInduk');
		$nama = $this->input->post('nama');
		$ttl = $this->input->post('ttl');
		$email = $this->input->post('email');
		$noTelp = $this->input->post('noTelp');
		$alamat = $this->input->post('alamat');
		$jk = $this->input->post('jk');
		$userRole = $this->input->post('role');

		$tgl = date('Y-m-d', strtotime($ttl));

		$config['upload_path'] = './assets/inter/images/profil';
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';

		$this->upload->initialize($config);
		if(!empty($_FILES['filefoto']['name'])){
			if ($this->upload->do_upload('filefoto')){
				$gbr = $this->upload->data();
				$config['image_library']='gd2';
                $config['source_image']='./assets/inter/images/profil'.$gbr['file_name'];
                $config['create_thumb']= FALSE;
                $config['maintain_ratio']= FALSE;
                $config['quality']= '50%';
                $config['width']= 600;
                $config['height']= 400;
				$config['new_image']= './assets/inter/images/profil'.$gbr['file_name'];
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();
				$gambar=$gbr['file_name'];
 
				$data = array(
					'nomorInduk' => $noInduk,
					'userRole' => $userRole,
					'namaUser' => $nama,
					'ttlUser' => $tgl,
					'emailUser' => $email,
					'noTelp' => $noTelp,
					'alamatUser' => $alamat,
					'jenisKelamin' => $jk,
					'gambar' => $gambar,
				);

				$data_Session = array(
					'namaUser' => $nama,
					'nomorInduk' => $noInduk,
					'userRole' => $userRole,
					'gambar' => $gambar
				);
				$this->session->set_userdata($data_Session);
			}
		}
		else{
            $data = array(
				'nomorInduk' => $noInduk,
				'userRole' => $userRole,
				'namaUser' => $nama,
				'ttlUser' => $tgl,
				'emailUser' => $email,
				'noTelp' => $noTelp,
				'alamatUser' => $alamat,
				'jenisKelamin' => $jk 
			);
		}
		$where = array('nomorInduk' => $noInduk);
		$this->m_admin->updateData($where, $data, 'user');
		redirect('c_admin/admin');
	}
	function statusAdmin($nomorInduk)
	{
		$data = array('statusUser' => 0);
		$where = array('nomorInduk' => $nomorInduk);
		$this->m_admin->statusData($where, $data, 'user');
		redirect('c_admin/admin');
	}

	//Guru
	function guru()
	{
		$where = array('userRole' => 'Guru', 'statusUser' => '1');
		$data['dataGuru'] = $this->m_admin->tampilkanDataPegawai($where)->result();
		$this->load->view("v_dataGuru", $data);
	}
	function editGuru($idGuru)
	{
		$where = array('nomorInduk' => $idGuru);
		$data['editGuru'] = $this->m_admin->editData($where,'user')->result();
		$this->load->view('v_editGuru', $data);
	}
	function updateGuru()
	{
		$noInduk = $this->input->post('nomorInduk');
		$nama = $this->input->post('nama');
		$ttl = $this->input->post('ttl');
		$email = $this->input->post('email');
		$noTelp = $this->input->post('noTelp');
		$alamat = $this->input->post('alamat');
		$jk = $this->input->post('jk');
		$userRole = $this->input->post('role');

		$tgl = date('Y-m-d', strtotime($ttl));

		$config['upload_path'] = './assets/inter/images/profil';
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';

		$this->upload->initialize($config);
		if(!empty($_FILES['filefoto']['name'])){
			if ($this->upload->do_upload('filefoto')){
				$gbr = $this->upload->data();
				$config['image_library']='gd2';
                $config['source_image']='./assets/inter/images/profil'.$gbr['file_name'];
                $config['create_thumb']= FALSE;
                $config['maintain_ratio']= FALSE;
                $config['quality']= '50%';
                $config['width']= 600;
                $config['height']= 400;
				$config['new_image']= './assets/inter/images/profil'.$gbr['file_name'];
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();
				$gambar=$gbr['file_name'];
 
				$data = array( 
					'nomorInduk' => $noInduk,
					'userRole' => $userRole,
					'namaUser' => $nama,
					'ttlUser' => $tgl,
					'emailUser' => $email,
					'noTelp' => $noTelp,
					'alamatUser' => $alamat,
					'jenisKelamin' => $jk,
					'gambar' => $gambar,
				);
			}
		}
		else{
            $data = array(
				'nomorInduk' => $noInduk,
				'userRole' => $userRole,
				'namaUser' => $nama,
				'ttlUser' => $tgl,
				'emailUser' => $email,
				'noTelp' => $noTelp,
				'alamatUser' => $alamat,
				'jenisKelamin' => $jk 
			);
		}
		$where = array('nomorInduk' => $noInduk);
		$this->m_admin->updateData($where, $data, 'user');
		redirect('c_admin/guru');
	}
	function statusGuru($nomorInduk)
	{
		$data = array('statusUser' => 0);
		$where = array('nomorInduk' => $nomorInduk);
		$this->m_admin->statusData($where, $data, 'user');
		redirect('c_admin/guru');
	}
	function tugasGuru()
	{
		$data['ta'] = $this->m_admin->thnAjaran()->result();
		$this->load->view('v_dataTugas', $data);
	}
	function getTugas()
	{
		$idTA = $this->input->post('idTA', TRUE);
		$data = $this->m_admin->tugasGuru($idTA)->result();
		echo json_encode($data);
	}
	
	//wali kelas
	function waliKelas()
	{
		$where = array('userRole' => 'Wali Kelas', 'statusUser' => '1');
		$data['dataWk'] = $this->m_admin->tampilkanDataPegawai($where)->result();
		$data['kls'] = $this->m_admin->kelas()->result();
		$this->load->view("v_dataWaliKelas", $data);
	}
	function editWaliKelas($idWaliKelas)
	{
		$where = array('nomorInduk' => $idWaliKelas);
		$data['kls'] = $this->m_admin->kelas()->result();
		$data['editWk'] = $this->m_admin->editData($where,'user')->result();
		$this->load->view('v_editWaliKelas', $data);
	}
	function updateWaliKelas()
	{
		$noInduk = $this->input->post('nomorInduk');
		$nama = $this->input->post('nama');
		$ttl = $this->input->post('ttl');
		$email = $this->input->post('email');
		$noTelp = $this->input->post('noTelp');
		$alamat = $this->input->post('alamat');
		$jk = $this->input->post('jk');
		$kelas = $this->input->post('kelas');
		$userRole = $this->input->post('role');

		$tgl = date('Y-m-d', strtotime($ttl));

		$config['upload_path'] = './assets/inter/images/profil';
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';

		$this->upload->initialize($config);

		if(!empty($_FILES['filefoto']['name'])){
			if ($this->upload->do_upload('filefoto')){
				$gbr = $this->upload->data();
				$config['image_library']='gd2';
                $config['source_image']='./assets/inter/images/profil'.$gbr['file_name'];
                $config['create_thumb']= FALSE;
                $config['maintain_ratio']= FALSE;
                $config['quality']= '50%';
                $config['width']= 600;
                $config['height']= 400;
				$config['new_image']= './assets/inter/images/profil'.$gbr['file_name'];
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();
				$gambar=$gbr['file_name'];
 
				$dataUser = array(
					'nomorInduk' => $noInduk,
					'userRole' => $userRole,
					'namaUser' => $nama,
					'ttlUser' => $tgl,
					'emailUser' => $email,
					'noTelp' => $noTelp,
					'alamatUser' => $alamat,
					'jenisKelamin' => $jk,
					'gambar' => $gambar, 
				);
		
				$dataWaliKelas = array(
					'idWaliKelas' => "",
					'nomorInduk' => $noInduk,
					'idKelas' => $kelas,
					'statusWaliKelas' => 1 
				);
			}
		}
		else{
            $dataUser = array(
				'nomorInduk' => $noInduk,
				'userRole' => $userRole,
				'namaUser' => $nama,
				'ttlUser' => $tgl,
				'emailUser' => $email,
				'noTelp' => $noTelp,
				'alamatUser' => $alamat,
				'jenisKelamin' => $jk 
			);
	
			$dataWaliKelas = array(
				'idWaliKelas' => "",
				'nomorInduk' => $noInduk,
				'idKelas' => $kelas,
				'statusWaliKelas' => 1 
			);
		}
		$where = array('nomorInduk' => $noInduk);
		$this->m_admin->updateData($where, $dataUser, 'user');
		$this->m_admin->updateData($where, $dataWaliKelas, 'walikelas');
		redirect('c_admin/waliKelas');
	}

	//pegawai
	function tambahPegawai()
	{
		$data['kls'] = $this->m_admin->kelas()->result();
		$data['kodeGuru'] = $this->m_admin->kodePegawai();
		$this->load->view("v_tambahPegawai", $data);
	}
	function simpanPegawai()
	{
		$noInduk = $this->input->post('nomorInduk');
		$nama = $this->input->post('nama');
		$ttl = $this->input->post('ttl');
		$email = $this->input->post('email');
		$noTelp = $this->input->post('noTelp');
		$alamat = $this->input->post('alamat');
		$jk = $this->input->post('jk');
		$pass = $this->input->post('pass');
		$userRole = $this->input->post('role');
		$kelas = $this->input->post('kelas');

		$tgl = date('Y-m-d', strtotime($ttl));

		$config['upload_path'] = './assets/inter/images/profil';
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';

		$cekData = array(
			'emailUser' => $email,
			'namaUser' => $nama,
			'userRole' => $userRole, 
		);
		$cek = $this->m_admin->cek($cekData, "user")->num_rows();
		if ($cek > 0) {
			echo "<script>alert('Data sudah tersimpan');</script>";
    		$data['kls'] = $this->m_admin->kelas()->result();
			$data['kodeGuru'] = $this->m_admin->kodePegawai();
			$this->load->view("v_tambahPegawai", $data);
		}
		else {
			$this->upload->initialize($config);
			if(!empty($_FILES['filefoto']['name'])){
				if ($this->upload->do_upload('filefoto')){
					$gbr = $this->upload->data();
					$config['image_library']='gd2';
					$config['source_image']='./assets/inter/images/profil'.$gbr['file_name'];
					$config['create_thumb']= FALSE;
					$config['maintain_ratio']= FALSE;
					$config['quality']= '50%';
					$config['width']= 600;
					$config['height']= 400;
					$config['new_image']= './assets/inter/images/profil'.$gbr['file_name'];
					$this->load->library('image_lib', $config);
					$this->image_lib->resize();
					$gambar=$gbr['file_name'];
	
					$data = array(
						'nomorInduk' => $noInduk,
						'userRole' => $userRole,
						'namaUser' => $nama,
						'ttlUser' => $tgl,
						'emailUser' => $email,
						'noTelp' => $noTelp,
						'alamatUser' => $alamat,
						'jenisKelamin' => $jk,
						'passUser' => md5($pass),
						'gambar' => $gambar,
						'statusUser' => 1 
					);
					
					$this->m_admin->simpanData($data, 'user');
					echo "Image berhasil diupload";
				}
			}
			else{
				echo "Image yang diupload kosong";
			}

			if($userRole == 'Wali Kelas'){
					$data = array(
						'idWaliKelas' => "",
						'nomorInduk' => $noInduk,
						'idKelas' => $kelas,
						'statusWaliKelas' => 1 
					);
		
					$this->m_admin->simpanData($data, 'walikelas');
			}
			if($userRole == 'Guru'){
				redirect('c_admin/guru');
			}
			elseif ($userRole == 'Admin') {
				redirect('c_admin/admin');
			}
			elseif ($userRole == 'Wali Kelas') {
				redirect('c_admin/waliKelas');
			}
		}
		
	}

	//siswa
	function siswa()
	{
		$data['siswa'] = $this->m_admin->tampilkanDataSiswa()->result();
		$this->load->view('v_dataSiswa', $data);
	}
	function editSiswa($idSiswa)
	{
		//$where = array('nomorInduk' => $idSiswa);
		$data['ta'] = $this->m_admin->thnAjaran()->result();
		$data['kls'] = $this->m_admin->kelas()->result();
		$data['editSiswa'] = $this->m_admin->editSiswa($idSiswa)->result();
		$this->load->view('v_editSiswa', $data);
	}
	function updateSiswa()
	{
		$noInduk = $this->input->post('nomorInduk');
		$nama = $this->input->post('nama');
		$ttl = $this->input->post('ttl');
		$email = $this->input->post('email');
		$noTelp = $this->input->post('noTelp');
		$alamat = $this->input->post('alamat');
		$jk = $this->input->post('jk');
		$kelas = $this->input->post('kelas');
		$tahunAjaran = $this->input->post('tahunAjaran');

		$tgl = date('Y-m-d', strtotime($ttl));
		$where = array('nomorInduk' => $noInduk );

		$config['upload_path'] = './assets/inter/images/profil';
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';

		$this->upload->initialize($config);
		if(!empty($_FILES['filefoto']['name'])){
			if ($this->upload->do_upload('filefoto')){
				$gbr = $this->upload->data();
				$config['image_library']='gd2';
                $config['source_image']='./assets/inter/images/profil'.$gbr['file_name'];
                $config['create_thumb']= FALSE;
                $config['maintain_ratio']= FALSE;
                $config['quality']= '50%';
                $config['width']= 600;
                $config['height']= 400;
				$config['new_image']= './assets/inter/images/profil'.$gbr['file_name'];
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();
				$gambar=$gbr['file_name'];

				$dataUser = array(
					'nomorInduk' => $noInduk,
					'namaUser' => $nama,
					'ttlUser' => $tgl,
					'emailUser' => $email,
					'noTelp' => $noTelp,
					'alamatUser' => $alamat,
					'jenisKelamin' => $jk,
					'gambar' => $gambar 
				);
				
				$dataSiswa = array(
					'idKelas' => $kelas,
					'idTahunAjaran' => $tahunAjaran
				);
			}
		}
		else {
			$dataUser = array(
				'nomorInduk' => $noInduk,
				'namaUser' => $nama,
				'ttlUser' => $tgl,
				'emailUser' => $email,
				'noTelp' => $noTelp,
				'alamatUser' => $alamat,
				'jenisKelamin' => $jk 
			);
			
			$dataSiswa = array(
				'idKelas' => $kelas,
				'idTahunAjaran' => $tahunAjaran
			);
		}
		$this->m_admin->updateData($where, $dataUser, 'user');
		$this->m_admin->updateData($where, $dataSiswa, 'datasiswa');
		redirect('c_admin/siswa');
	}
	function tambahSiswa()
	{
		$data['ta'] = $this->m_admin->thnAjaran()->result();
		$data['kls'] = $this->m_admin->kelas()->result();
		$data['kodeMurid'] = $this->m_admin->kodeMurid();
		$data['siswa'] = $this->m_admin->tampilkanDataSiswa()->result();
		$this->load->view("v_tambahSiswa", $data);
	}
	function simpanSiswa()
	{
		$noInduk = $this->input->post('nomorInduk');
		$nama = $this->input->post('nama');
		$ttl = $this->input->post('ttl');
		$email = $this->input->post('email');
		$noTelp = $this->input->post('noTelp');
		$alamat = $this->input->post('alamat');
		$jk = $this->input->post('jk');
		$kelas = $this->input->post('kelas');
		$tahunAjaran = $this->input->post('tahunAjaran');
		$status = $this->input->post('status');
		$pass = $this->input->post('pass');

		$tgl = date('Y-m-d', strtotime($ttl));

		$config['upload_path'] = './assets/inter/images/profil';
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';

		$cekEmail = array(
			'emailUser' => $email 
		);
		$cekKelas = array(
			'idKelas' => $kelas 
		);
		$emailCek = $this->m_admin->cek($cekEmail, "user")->num_rows();
		$kelasCek = $this->m_admin->cek($cekKelas, "dataSiswa")->num_rows();

		if($emailCek > 0 && $kelasCek > 0){
			echo "<script>alert('Data sudah tersimpan');</script>";
			$data['ta'] = $this->m_admin->thnAjaran()->result();
			$data['kls'] = $this->m_admin->kelas()->result();
			$data['kodeMurid'] = $this->m_admin->kodeMurid();
			$data['siswa'] = $this->m_admin->tampilkanDataSiswa()->result();
    		$this->load->view('v_tambahSiswa', $data);
		}
		else {
			$this->upload->initialize($config);
			if(!empty($_FILES['filefoto']['name'])){
				if ($this->upload->do_upload('filefoto')){
					$gbr = $this->upload->data();
					$config['image_library']='gd2';
					$config['source_image']='./assets/inter/images/profil'.$gbr['file_name'];
					$config['create_thumb']= FALSE;
					$config['maintain_ratio']= FALSE;
					$config['quality']= '50%';
					$config['width']= 600;
					$config['height']= 400;
					$config['new_image']= './assets/inter/images/profil'.$gbr['file_name'];
					$this->load->library('image_lib', $config);
					$this->image_lib->resize();
					$gambar=$gbr['file_name'];

					$dataUser = array(
						'nomorInduk' => $noInduk,
						'userRole' => $status,
						'namaUser' => $nama,
						'ttlUser' => $tgl,
						'emailUser' => $email,
						'noTelp' => $noTelp,
						'alamatUser' => $alamat,
						'jenisKelamin' => $jk,
						'passUser' => md5($pass),
						'gambar' => $gambar,
						'statusUser' => '1' 
					);

					$this->m_admin->simpanData($dataUser, 'user');
					echo "Image berhasil diupload";
				}
			}
			else{
				echo "Image yang diupload kosong";
			}

			$dataSiswa = array(
				'idSiswa' => "",
				'nomorInduk' => $noInduk,
				'idKelas' => $kelas,
				'idTahunAjaran' => $tahunAjaran,
				'statusSiswa' => '1'
			);

			$this->m_admin->simpanData($dataSiswa, 'datasiswa');
			redirect('c_admin/siswa');
		}
	}
	function statusSiswa($nomorInduk)
	{
		$dataSiswa = array('statusSiswa' => 0, );
		$dataUser = array('statusUser' => 0, );
		$where = array('nomorInduk' => $nomorInduk, );
		$this->m_admin->statusData($where, $dataSiswa, 'dataSiswa');
		$this->m_admin->statusData($where, $dataUser, 'user');

		$data = $this->m_admin->getId($nomorInduk)->result();
		foreach ($data as $list) {
			$idSiswa = $list->idSiswa;
			$statusWaliMurid = $list->statusWaliMurid;
			$indukWM = $list->nomorInduk;
			$statusUser = $list->statusUser;
		};
		$dataWM = array('statusWaliMurid' => 0);
		$dataUWM = array('statusUser' => 0);
		$where = array('nomorInduk' => $indukWM);
		$this->m_admin->statusData($where, $dataWM, 'walimurid');
		$this->m_admin->statusData($where, $dataUWM, 'user');
		redirect ('c_admin/siswa');
	}

	//wali murid
	function tambahWaliMurid()
	{
		$this->load->view("v_tambahWaliMurid");
	}
	function simpanWaliMurid()
	{
		$noInduk = $this->input->post('nomorInduk');
		$nama = $this->input->post('nama');
		$ttl = $this->input->post('ttl');
		$email = $this->input->post('email');
		$noTelp = $this->input->post('noTelp');
		$alamat = $this->input->post('alamat');
		$jk = $this->input->post('jk');
		$status = $this->input->post('status');
		$pass = $this->input->post('pass');
		$idSiswa = $this->input->post('idSiswa');
		$photo = $this->input->post('berkas');
		$keterangan = $this->input->post('keterangan');

		$tgl = date('Y-m-d', strtotime($ttl));

		$dataUser = array(
			'nomorInduk' => $noInduk,
			'userRole' => $status,
			'namaUser' => $nama,
			'ttlUser' => $tgl,
			'emailUser' => $email,
			'noTelp' => $noTelp,
			'alamatUser' => $alamat,
			'jenisKelamin' => $jk,
			'passUser' => md5($pass),
			'gambar' => $photo,
			'statusUser' => '1' 
		);

		$dataWM= array(
			'idWaliMurid' => "",
			'nomorInduk' => $noInduk,
			'keterangan' => $keterangan,
			'idSiswa' => $idSiswa,
			'statusWaliMurid' => '1'
		);

		$this->m_admin->simpanData($dataUser, 'user');
		$this->m_admin->simpanData($dataWM, 'walimurid');

		redirect('c_admin/siswa');
	}
	function waliMurid()
	{
		$data['waliMurid'] = $this->m_admin->tampilkanDataWaliMurid()->result();
		$this->load->view('v_dataWaliMurid', $data);
	}
	function editWaliMurid($idWaliMurid)
	{
		$data['editWM'] = $this->m_admin->editWaliMurid($idWaliMurid)->result();
		$this->load->view('v_editWaliMurid', $data);
	}
	function updateWM()
	{
		$noInduk = $this->input->post('nomorInduk');
		$nama = $this->input->post('nama');
		$ttl = $this->input->post('ttl');
		$email = $this->input->post('email');
		$noTelp = $this->input->post('noTelp');
		$alamat = $this->input->post('alamat');
		$jk = $this->input->post('jk');
		$ket = $this->input->post('ket');

		$tgl = date('Y-m-d', strtotime($ttl));
		$where = array('nomorInduk' => $noInduk );

		$dataUser = array(
			'nomorInduk' => $noInduk,
			'namaUser' => $nama,
			'ttlUser' => $tgl,
			'emailUser' => $email,
			'noTelp' => $noTelp,
			'alamatUser' => $alamat,
			'jenisKelamin' => $jk
		);

		$dataWM = array('keterangan' => $ket);

		$this->m_admin->updateData($where, $dataWM, 'walimurid');
		$this->m_admin->updateData($where, $dataUser, 'user');
		redirect('c_admin/waliMurid');
	}

	//mata pelajaran
	function tambahMapel()
	{
		$data['ta'] = $this->m_admin->thnAjaran()->result();
		$this->load->view('v_tambahMapel', $data);
	}
	function simpanMapel()
	{
		$mapel = $this->input->post('mapel');
		$thnajaran = $this->input->post('tahunAjaran');
		$jenisMapel = $this->input->post('jenisMapel');

		$cekData = array(
			'idTahunAjaran' => $thnajaran,
			'namaMapel' => $mapel,
			'jenisMapel'  => $jenisMapel
		);
		$cek = $this->m_admin->cek($cekData, "matapelajaran")->num_rows();
		if ($cek > 0) {
			echo "<script>alert('Data sudah tersimpan');</script>";
			$data['ta'] = $this->m_admin->thnAjaran()->result();
			$this->load->view('v_tambahMapel', $data);
		}
		else{
			$data = array(
				'idMapel' => '',
				'idTahunAjaran' => $thnajaran,
				'namaMapel' => $mapel,
				'jenisMapel' => $jenisMapel,
				'statusMapel' => '1'
			);

			$this->m_admin->simpanData($data, 'matapelajaran');
			redirect('c_admin/mapel');
		}
	}
	function mapel()
	{
		$data['mapel'] = $this->m_admin->tampilkanDataMapel()->result();
		$this->load->view('v_dataMapel', $data);
	}
	function editMapel($idMapel)
	{
		$data['ta'] = $this->m_admin->thnAjaran()->result();
		$data['jenis'] = $this->m_admin->jenisMapel()->result();
		$data['editMapel'] = $this->m_admin->editMapel($idMapel)->result();
		$this->load->view('v_editMapel', $data);
	}
	function updateMapel()
	{
		$idMapel = $this->input->post('idMapel');
		$mapel = $this->input->post('mapel');
		$tahunAjaran = $this->input->post('tahunAjaran');
		$jenisMapel = $this->input->post('jenisMapel');
		$where = array('idMapel' => $idMapel );

		$cekData = array(
			'idTahunAjaran' => $tahunAjaran,
			'namaMapel' => $mapel,
			'jenisMapel'  => $jenisMapel
		);
		$cek = $this->m_admin->cek($cekData, "matapelajaran")->num_rows();

		if ($cek > 0) {
			echo "<script>alert('Data sudah tersimpan');</script>";
			$data['ta'] = $this->m_admin->thnAjaran()->result();
			$data['jenis'] = $this->m_admin->jenisMapel()->result();
			$data['editMapel'] = $this->m_admin->editMapel($idMapel)->result();
			$this->load->view('v_editMapel', $data);
		}
		else {
			$data = array(
				'idMapel' => $idMapel,
				'namaMapel' => $mapel,
				'idTahunAjaran' => $tahunAjaran,
			);

			$this->m_admin->updateData($where, $data, 'matapelajaran');
			redirect('c_admin/mapel');
		}
	}
	function statusMapel($idMapel)
	{
		$data = array('statusMapel' => 0, );
		$where = array('idMapel' => $idMapel, );

		$this->m_admin->statusData($where, $data, 'matapelajaran');
		redirect ('c_admin/mapel');
	}

	//tahun ajaran
	function tambahThnAjaran()
	{
		$this->load->view('v_tambahThnAjaran');
	}
	function simpanThnAjaran()
	{
		$thnajaran = $this->input->post('thnAjaran');

		$cekData = array('tahunAjaran' => $thnajaran, );
		$cek = $this->m_admin->cek($cekData, 'tahunAjaran')->num_rows();

		if($cek > 0){
			
			echo "<script>alert('Data sudah tersimpan');</script>";
			$this->load->view('v_tambahThnAjaran');
		}
		else {
			$data = array(
				'idTahunAjaran' => "",
				'tahunAjaran' => $thnajaran,
				'statusTahunAjaran' => 1 
			);

			$this->m_admin->simpanData($data, 'tahunajaran');
			redirect('c_admin/tahunAjaran');
		}
	}
	function tahunAjaran()
	{
		$data['ta'] = $this->m_admin->thnAjaran()->result();
		$this->load->view('v_dataThnAjaran', $data);
	}
	function statusThnAjaran($idThnAjaran)
	{
		$data = array('statusTahunAjaran' => 0, );
		$where = array('idTahunAjaran' => $idThnAjaran, );

		$this->m_admin->statusData($where, $data, 'tahunajaran');
		redirect('c_admin/tahunAjaran');
	}

	//akun saya
	function profil()
	{
		$data['profil'] = $this->m_admin->profil()->result();
		$this->load->view('v_adminProfil', $data);
	}
	function gantiPass()
	{
		$this->load->view('v_gantiKataSandi');
	}
	function simpanKataSandi()
	{
		$ksLama = md5($this->input->post('ksLama'));
		$ksBaru = $this->input->post('ksBaru');
		$validasiKS = $this->input->post('validasiKS');

		$where = array(
            'nomorInduk' => $this->session->nomorInduk
		);
		
		$a = $this->m_login->Select($where, 'user')->result();

		foreach($a as $list){
			//$nip = $list->nomorInduk;
			$pass = $list->passUser;
		};

		if ($ksLama == $pass && $ksBaru == $validasiKS) {
			$data = array(
				'passUser' => md5($validasiKS)
			);

			$this->m_admin->updateData($where, $data, 'user');
			$this->session->sess_destroy();
			redirect('c_login/admin');
		}
		elseif ($ksLama == $pass && $ksBaru != $validasiKS) {
			redirect('c_admin/gantiPass');
		}
		else {
			redirect('c_admin/gantiPass');
		}
	}

	//kelas
	function tambahKelas()
	{
		$this->load->view('v_tambahKelas');
	}
	function simpanKelas()
	{
		$ketKelas = $this->input->post('ketKelas');
		$jurusanKelas = $this->input->post('jurusanKelas');
		$noKelas = $this->input->post('noKelas');

		$cekData = array(
			'ketKelas' => $ketKelas,
			'jurusanKelas' => $jurusanKelas,
			'nomorKelas' => $noKelas
		);

		$cek = $this->m_admin->cek($cekData, "kelas")->num_rows();
		if ($cek > 0) {
			echo "<script>alert('Data sudah tersimpan');</script>";
    		$this->load->view('v_tambahKelas');
		}
		else {
			$data = array(
				'idKelas' => "",
				'ketKelas' => $ketKelas,
				'jurusanKelas' => $jurusanKelas,
				'nomorKelas' => $noKelas,
				'statusKelas' => 1 
			);
			$this->m_admin->simpanData($data, 'kelas');
			redirect('c_admin/kelas');
		}
	}
	function kelas()
	{
		$data['kls'] = $this->m_admin->kelas()->result();
		$this->load->view('v_dataKelas', $data);
	}
	function statusKelas($idKelas)
	{
		$data = array('statusKelas' => 0, );
		$where = array('idKelas' => $idKelas, );

		$this->m_admin->statusData($where, $data, 'kelas');
		redirect('c_admin/kelas');
	}
	function editKelas($idKelas)
	{
		$data['editKelas'] = $this->m_admin->editKelas($idKelas)->result();
		$this->load->view('v_editKelas', $data);
	}
	function updateKelas()
	{
		$idKelas = $this->input->post('idKelas');
		$ketKelas = $this->input->post('ketKelas');
		$jurusanKelas = $this->input->post('jurusanKelas');
		$noKelas = $this->input->post('noKelas');

		$cekData = array(
			'ketKelas' => $ketKelas, 
			'jurusanKelas' => $jurusanKelas,
			'nomorKelas' => $noKelas
		);
		$cek = $this->m_admin->cek($cekData, "kelas")->num_rows();
		if ($cek > 0) {
			echo "<script>alert('Data sudah tersimpan');</script>";
			$data['editKelas'] = $this->m_admin->editKelas($idKelas)->result();
			$this->load->view('v_editKelas', $data);
		}
		else{
			$where = array('idKelas' => $idKelas, );

			$data = array(
				'ketKelas' => $ketKelas,
				'jurusanKelas' => $jurusanKelas,
				'nomorKelas' => $noKelas,
				'statusKelas' => 1 
			);

			$this->m_admin->updateData($where, $data, 'kelas');
			redirect('c_admin/kelas');
		}
	}

	//jadwal
	function tambahJadwal()
	{
		$data['guru'] = $this->m_admin->jadwalGuru()->result();
		$data['kls'] = $this->m_admin->kelas()->result();
		$data['ta'] = $this->m_admin->thnAjaran()->result();
		$data['mapel'] = $this->m_admin->tampilkanDataMapel()->result();
		$this->load->view('v_tambahJadwal', $data);
	}
	function simpanJadwal()
	{
		$hari = $this->input->post('hari');
		$jamMulai = $this->input->post('jamMulai');
		$jamSelesai = $this->input->post('jamSelesai');
		$mapel = $this->input->post('mapel');
		$guru = $this->input->post('guru');
		$kelas = $this->input->post('kls');
		$ta = $this->input->post('ta');

		$cekData = array(
			'idKelas' => $kelas,
			'idTahunAjaran' => $ta,
			'nomorInduk' => $guru,
			'idMapel' => $mapel,
			'hari' => $hari,
			'jamMulai' => $jamMulai,
			'jamSelesai' => $jamSelesai,
		);
		$cek = $this->m_admin->cek($cekData, "jadwal")->num_rows();
		if ($cek > 0) {
			echo "<script>alert('Data sudah tersimpan');</script>";
			$data['guru'] = $this->m_admin->jadwalGuru()->result();
			$data['kls'] = $this->m_admin->kelas()->result();
			$data['ta'] = $this->m_admin->thnAjaran()->result();
			$data['mapel'] = $this->m_admin->tampilkanDataMapel()->result();
			$this->load->view('v_tambahJadwal', $data);
		}
		else{
			$data = array(
				'idJadwal' => "",
				'idKelas' => $kelas,
				'idTahunAjaran' => $ta,
				'nomorInduk' => $guru,
				'idMapel' => $mapel,
				'hari' => $hari,
				'jamMulai' => $jamMulai,
				'jamSelesai' => $jamSelesai,
				'statusJadwal' => "1"
			);

			$this->m_admin->simpanData($data, 'jadwal');
			redirect('c_admin/jadwal');
		}
	}
	function jadwal()
	{
		$data['jadwal'] = $this->m_admin->tampilkanDataJadwal()->result();
		$this->load->view('v_dataJadwal', $data);
	}
	function statusJadwal($idJadwal)
	{
		$data = array('statusJadwal' => 0);
		$where = array('idJadwal' => $idJadwal);

		$this->m_admin->statusData($where, $data, 'jadwal');
		redirect('c_admin/jadwal');
	}
	function editJadwal($idJadwal)
	{
		$data['guru'] = $this->m_admin->jadwalGuru()->result();
		$data['kls'] = $this->m_admin->kelas()->result();
		$data['ta'] = $this->m_admin->thnAjaran()->result();
		$data['mapel'] = $this->m_admin->tampilkanDataMapel()->result();
		$data['editJadwal'] = $this->m_admin->editJadwal($idJadwal)->result();
		$this->load->view('v_editJadwal', $data);
	}
	function updateJadwal()
	{
		$idJadwal = $this->input->post('idJadwal');
		$hari = $this->input->post('hari');
		$jamMulai = $this->input->post('jamMulai');
		$jamSelesai = $this->input->post('jamSelesai');
		$mapel = $this->input->post('mapel');
		$guru = $this->input->post('guru');
		$kelas = $this->input->post('kls');
		$ta = $this->input->post('ta');

		$cekData = array(
			'idKelas' => $kelas,
			'idTahunAjaran' => $ta,
			'nomorInduk' => $guru,
			'idMapel' => $mapel,
			'hari' => $hari,
			'jamMulai' => $jamMulai,
			'jamSelesai' => $jamSelesai,
		);
		$cek = $this->m_admin->cek($cekData, "jadwal")->num_rows();
		if ($cek > 0) {
			echo "<script>alert('Data sudah tersimpan');</script>";
			$data['guru'] = $this->m_admin->jadwalGuru()->result();
			$data['kls'] = $this->m_admin->kelas()->result();
			$data['ta'] = $this->m_admin->thnAjaran()->result();
			$data['mapel'] = $this->m_admin->tampilkanDataMapel()->result();
			$data['editJadwal'] = $this->m_admin->editJadwal($idJadwal)->result();
			$this->load->view('v_editJadwal', $data);
		}
		else{
			$where = array('idJadwal' => $idJadwal, );
			$data = array(
				'idKelas' => $kelas,
				'idTahunAjaran' => $ta,
				'nomorInduk' => $guru,
				'idMapel' => $mapel,
				'hari' => $hari,
				'jamMulai' => $jamMulai,
				'jamSelesai' => $jamSelesai,
			);

			$this->m_admin->updateData($where, $data, 'jadwal');
			redirect('c_admin/jadwal');
		}
	}
	
	//informasi spp
	function tambahInfo()
	{
		$data['kls'] = $this->m_admin->kelas()->result();
		$this->load->view('v_tambahInfo', $data);
	}
	function getSiswa()
	{
		$idKelas = $this->input->post('idKelas', TRUE);
		$data = $this->m_admin->getSiswa($idKelas)->result();
		echo json_encode($data);
	}
	function simpanInfo()
	{
		$idSiswa = $this->input->post('idSiswa');
		$jumlah =$this->input->post('jumlah');

		$cekData = array(
			'idSiswa' => $idSiswa,
			'jumlah' => $jumlah
		);
		$cek = $this->m_admin->cek($cekData, "informasispp")->num_rows();
		if ($cek > 0) {
			echo "<script>alert('Data sudah tersimpan');</script>";
			$data['kls'] = $this->m_admin->kelas()->result();
		$this->load->view('v_tambahInfo', $data);
		}
		else {
			$data = array($idSiswa, $jumlah);

			$this->m_admin->simpanMulti($data);
			redirect('c_admin/info');
		}
	}
	function info()
	{
		$data['kls'] = $this->m_admin->kelas()->result();
		$this->load->view('v_dataInfo', $data);
	}
	function getDataInfo()
	{
		$idKelas = $this->input->post('idKelas', TRUE);
		$data = $this->m_admin->getDataInfo($idKelas)->result();
		echo json_encode($data);
	}
	function statusInfo()
	{
		$idInfo = $this->input->post('kode');
		$data=$this->m_admin->statusInfo($idInfo);
	
		echo json_encode($data);
	}

	//keterangan nilai
	function tambahKetNilai()
	{
		$data['ta'] = $this->m_admin->thnAjaran()->result();
		$this->load->view('v_tambahKetNilai', $data);
	}
	function simpanKetNilai()
	{
		$bobotSekolah = $this->input->post("bobotSekolah");
		$bobotGuru = $this->input->post("bobotGuru");
		$idTA = $this->input->post("TA");
		$total = $bobotSekolah + $bobotGuru;

		$cekData = array(
			'idTahunAjaran' => $idTA
		);
		$cek = $this->m_admin->cek($cekData, "ketNilai")->num_rows();
		if ($cek > 0) {
			echo "<script>alert('Data sudah tersimpan');</script>";
			$data['ta'] = $this->m_admin->thnAjaran()->result();
			$this->load->view('v_tambahKetNilai', $data);
		}
		elseif ($total > 100) {
			echo "<script>alert('Bobot lebih dari 100%');</script>";
			$data['ta'] = $this->m_admin->thnAjaran()->result();
			$this->load->view('v_tambahKetNilai', $data);
		}
		else {
			$data = array(
				'idKetNilai' => "",
				'idTahunAjaran' => $idTA,
				'bobotSekolah' => $bobotSekolah,
				'bobotGuru' => $bobotGuru,
				'statusKetNilai' => '1'
			);
	
			$this->m_admin->simpanData($data, 'ketnilai');
			redirect('c_admin/ketNilai');
		}
	}
	function ketNilai()
	{
		$data['ta'] = $this->m_admin->thnAjaran()->result();
		$this->load->view('v_dataKetNilai', $data);
	}
	function getKetNilai()
	{
		$idTA = $this->input->post('idTA', TRUE);
		$where = array('idTahunAjaran' => $idTA);
		$data = $this->m_admin->getKetNilai($where)->result();
		echo json_encode($data);
	}
	function editKetNilai()
	{
		$id = $this->input->get('id');
		$data = $this->m_admin->editKetNilai($id);
		echo json_encode($data);
	}
	function updateKetNilai()
	{
		$id=$this->input->post('id');
        $sklh=$this->input->post('sklh');
		$guru=$this->input->post('guru');

		$where = array('idKetNilai' => $id,);

		$data = array(
			'bobotSekolah' => $sklh,
			'bobotGuru' => $guru,
		);
        $data=$this->m_admin->updateData($where, $data, 'ketnilai');
        echo json_encode($data);
	}

	function updateAbsen()
	{
		$id=$this->input->post('id');
        $absen=$this->input->post('absen');

		$where = array('idAbsen' => $id,);

		$data = array(
			'absen' => $absen,
		);
        $data=$this->m_admin->updateData($where, $data, 'absensi');
        echo json_encode($data);
	}

	function getKelas()
	{
		$idMapel = $this->input->post('idMapel');
		$data = $this->m_admin->getKelas($idMapel)->result();
		echo json_encode($data);
	}

	//absensi
	function editAbsensi()
	{
		$id = $this->input->get('id');
		$data = $this->m_admin->editAbsensi($id)->result();
		echo json_encode($data);
	}
	function getMapel()
	{
		$nomorInduk = $this->input->post('nomorInduk', TRUE);
		$MA = $this->m_admin->getMapel($nomorInduk)->result(); //getMapel untuk Absensi
		$MN = $this->m_admin->getMapelNilai($nomorInduk)->result(); //getMapel untuk Nilai
		$data = array(
			'mapelAbsen' => $MA,
			'mapelNilai' => $MN,
		 );
		echo json_encode($data);
	}
	function getMataPelajaran()
	{
		$nomorInduk = $this->input->post('nomorInduk', TRUE);
		$matpel = $this->m_admin->getMataPelajaran($nomorInduk)->result();
		echo json_encode($matpel);
	}
	function mapelAbsen()
	{
		$nomorInduk = $this->input->post('nomorInduk');
		$data = $this->m_admin->absenMapel($nomorInduk)->result();
		echo json_encode($data);
	}
	function getTanggal()
	{
		$id = $this->input->post('id');
		$data = $this->m_admin->getTanggal($id)->result();
		echo json_encode($data);
	}
	function klsAbsen()
	{
		$tgl = $this->input->post('tgl');
		$data = $this->m_admin->klsAbsen($tgl)->result();
		echo json_encode($data);
	}
	function getAbsensi()
	{
		$id=$this->input->post('id');
		$tgl=$this->input->post('tgl');
		$data=$this->m_admin->getAbsensi($id, $tgl)->result();
		echo json_encode($data);
	}
	function tambahAbsensi()
	{
		$data['guru'] = $this->m_admin->jadwalGuru()->result();
		$this->load->view('v_tambahAbsensi1', $data);
	}
	function getNama()
	{
		$idKelas = $this->input->post('idKelas', TRUE);
		$idMapel = $this->input->post('idMapel', TRUE);
		$nama = $this->m_admin->getNama($idKelas)->result();
		$jadwal = $this->m_admin->getJadwal($idKelas, $idMapel)->result();
		$data = array(
			'nama' => $nama,
			'jadwal' => $jadwal
		);
		echo json_encode($data);
	}
	function simpanAbsen()
	{
		$idSiswa = $this->input->post('idSiswa');
		$idJadwal = $this->input->post('idJadwal');
		$guru = $this->input->post('guru');
		$ket = $this->input->post('ket');
		$mapel = $this->input->post('mapel');

		$tanggal = date('Y-m-d');

		$data = array($idSiswa, $tanggal, $idJadwal, $guru);

		//$this->m_admin->simpanAbsen($data);

		for($i=0 ; $i < count($idSiswa); $i++){
            $result = array(
                'idAbsen' => "",
				'idSiswa' => $idSiswa[$i],
				'idMapel' => $mapel,
				'idJadwal' => $idJadwal,
				'nomorInduk' => $guru,
                'tanggal' => $tanggal,
				'absen' => $ket[$i],
                'statusAbsen' => '1',
			);
			$this->m_admin->simpanAbsen($result, 'absensi');
        }
		
		redirect('c_admin/absensi');
	}
	function absensi()
	{
		$data['guru'] = $this->m_admin->jadwalGuru()->result();
		$this->load->view('v_dataAbsensi', $data);	
	}

	function getJadwal()
	{
		$idKelas = $this->input->post('idKelas');
		$data = $this->m_admin->getJadwal($idKelas)->result();
		echo json_encode($data);
	}

	//jadwal ujian
	function tambahJadwalUjian()
	{
		$data['kls'] = $this->m_admin->kelas()->result();
		$data['guru'] = $this->m_admin->jadwalGuru()->result();
		$data['ta'] = $this->m_admin->thnAjaran()->result();
		$this->load->view('v_tambahJadwalUjian', $data);
	}
	function jadwalMapel()
	{
		$tahunAjaran = $this->input->post('tahunAjaran', TRUE);
		$data = $this->m_admin->jadwalMapel($tahunAjaran)->result();
		echo json_encode($data);
	}
	function simpanJadwalUjian()
	{
		$tahunAjaran = $this->input->post('idTahunAjaran');
		$hari = $this->input->post('hari');
		$jamMulai = $this->input->post('jamMulai');
		$jamSelesai = $this->input->post('jamSelesai');
		$mapel = $this->input->post('mapel');

		$cekData = array(
			'idTahunAjaran' => $tahunAjaran,
			'idMapel' => $mapel,
			'hari' => $hari,
			'jamMulai' => $jamMulai,
			'jamSelesai' => $jamSelesai
		);
		$cek = $this->m_admin->cek($cekData, "jadwalujian")->num_rows();
		$cekMapel = $this->m_admin->tampilkanDataMapel()->result();
		foreach ($cekMapel as $list) {
			$namaMapel = $list->idMapel;
		}
		if ($cek > 0) {
			echo "<script>alert('Data sudah tersimpan');</script>";
			$data['kls'] = $this->m_admin->kelas()->result();
			$data['guru'] = $this->m_admin->jadwalGuru()->result();
			$data['ta'] = $this->m_admin->thnAjaran()->result();
			$this->load->view('v_tambahJadwalUjian', $data);
		}
		else if($namaMapel != $mapel){
			$data = array(
				'idJadwalUjian' => "",
				'idTahunAjaran' => $tahunAjaran,
				'idMapel' => $mapel,
				'hari' => $hari,
				'jamMulai' => $jamMulai,
				'jamSelesai' => $jamSelesai
			);
	
			$this->m_admin->simpanData($data, 'jadwalujian');
			redirect('c_admin/jadwalUjian');
		}
		else{
			$data = array(
				'idJadwalUjian' => "",
				'idTahunAjaran' => $tahunAjaran,
				'idMapel' => $mapel,
				'hari' => $hari,
				'jamMulai' => $jamMulai,
				'jamSelesai' => $jamSelesai
			);
	
			$this->m_admin->simpanData($data, 'jadwalujian');
			redirect('c_admin/jadwalUjian');
		}
	}
	function jadwalUjian()
	{
		$data['ta'] = $this->m_admin->thnAjaran()->result();
		$data['mapel'] = $this->m_admin->tampilkanDataMapel()->result();
		$this->load->view('v_dataJadwalUjian', $data);
	}
	function getJadwalUjian()
	{
		$id = $this->input->post('id', TRUE);
		$jurusan = $this->m_admin->getJurusan($id)->result();
		foreach ($jurusan as $a) {
			$jenis = $a->jurusanKelas;
		}
		// $where = array(
		// 	'jadwalUjian.idTahunAjaran' => $id,
		// 	'matapelajaran.jenisMapel' => $jenis, 
		// );

		// $data = $this->m_admin->getJadwalUjian($where)->result();
		$ipa = $this->m_admin->getJadwalUjian($jenis)->result();
		$umum = $this->m_admin->getJadwalUmum()->result();
		$jadwal = $this->m_admin->getAllJadwal()->result();
		// $ipa = $this->m_admin->getIPA($idTA)->result();
		// $ips = $this->m_admin->getIPS($idTA)->result();
		$data = array(
			'jadwal' => $jadwal,
			'ipa' => $ipa,
			'umum' => $umum,
		);
		echo json_encode($data);
	}
	function getUjianJadwal()
	{
		$id = $this->input->post('id', TRUE);
		$ta = $this->input->post('ta'. TRUE);

		$hari = $this->m_admin->getHari($ta)->result();
		$data = array(
			'hari' => $hari, 
		);
		echo json_encode($data);
	}
	function pengawas()
	{
		$idTA = $this->input->post('idTA', TRUE);
		$idKls = $this->input->post('idKls', TRUE);
		$jadwal = $this->m_admin->jadwalUjian($idTA)->result();
		$jadwal1 = $this->m_admin->pengawas($idTA, $idKls)->result();
		$cek = $this->m_admin->cekPengawas()->result();
		$data = array(
			'jadwal' => $jadwal,
			'jadwal1' => $jadwal1,
			'cek' => $cek,
		);
		echo json_encode($data);
	}
	function getdataMapel()
	{
		$data = $this->m_admin->getdataMapel()->result();
		for($i = 0; $i < count($data); $i++) {
			$where = array(
				'hari' => $data[$i]->hari,
				'jamMulai' => $data[$i]->jamMulai,
				'jamSelesai' => $data[$i]->jamSelesai,
			);
			$data = (object)array_merge((array)$data[$i], (array)$this->m_admin->dataMapel($where)->result());
		}
		echo json_encode($data);
	}
	function editJadwalUjian()
	{
		$id = $this->input->get('id');
		$data = $this->m_admin->editJadwalUjian($id);
		echo json_encode($data);
	}
	function updateJadwalUjian()
	{
		$id=$this->input->post('id');
        $hari=$this->input->post('hari');
		$jamMulai=$this->input->post('jamMulai');
		$jamSelesai=$this->input->post('jamSelesai');
		$mapel=$this->input->post('mapel');

		$where = array('idJadwalUjian' => $id,);

		$data = array(
			'idMapel' => $mapel,
			'hari' => $hari,
			'jamMulai' => $jamMulai,
			'jamSelesai' => $jamSelesai,
		);
        $data=$this->m_admin->updateData($where, $data, 'jadwalUjian');
        echo json_encode($data);
	}
	function jadwalUjianSiswa()
	{
		$data['ta'] = $this->m_admin->thnAjaran()->result();
		$this->load->view('v_dataJadwalSiswa', $data);
	}
	function getKls()
	{
		$idTA = $this->input->post('idTA', TRUE);
		$data = $this->m_admin->getKls($idTA)->result();
		echo json_encode($data);
	}
	function dataSiswa()
	{
		$id = $this->input->post('id', TRUE);
		$data = $this->m_admin->dataSiswa($id)->result();
		echo json_encode($data);
	}
	function infoSiswa()
	{
		$id = $this->input->post('id', TRUE);
		$data = $this->m_admin->infoSiswa($id)->result();
		echo json_encode($data);
	}
	function jadwalNgawas()
	{
		$data['guru'] = $this->m_admin->jadwalGuru()->result();
		$data['kls'] = $this->m_admin->kelas()->result();
		$data['ta'] = $this->m_admin->thnAjaran()->result();
		$this->load->view('v_dataJadwalMengawas', $data);
	}
	function tambahJadwalNgawas()
	{
		$data['guru'] = $this->m_admin->jadwalGuru()->result();
		$data['kls'] = $this->m_admin->kelas()->result();
		$data['ta'] = $this->m_admin->thnAjaran()->result();
		$this->load->view('v_tambahPengawas', $data);
	}
	function getJadwalNgawas()
	{
		$idTA = $this->input->post('idTA', TRUE);
		$jadwal = $this->m_admin->getJadwalNgawas($idTA)->result();
		$guru = $this->m_admin->jadwalGuru()->result();
		$kelas = $this->m_admin->kelas()->result();
		$data = array(
			'jadwal' => $jadwal,
			'kelas' => $kelas,
			'guru' => $guru,
		);
		echo json_encode($data);
	}
	function simpanPengawas()
	{
		$idMapel = $this->input->post('idMapel');
		$idKelas = $this->input->post('idKelas');
		$nomorInduk = $this->input->post('nomorInduk');
		$idJadwalUjian = $this->m_admin->jadwalUjianMapel($idMapel)->result();
		foreach ($idJadwalUjian as $idJU) {
			$id = $idJU->idJadwalUjian;
		}
		$cekData = array(
			// 'idJadwalUjian' => $id,
			'idKelas' => $idKelas,
			'nomorInduk' => $nomorInduk,
		);
		$cek = $this->m_admin->cek($cekData, "jadwalPengawas")->num_rows();
		$cekGuru = $this->m_admin->cekGuru($idMapel)->result();
		foreach ($cekGuru as $list) {
			$mapel = $list->idMapel;
			$guru = $list->nomorInduk;
		}
		if ($cek > 0) {
			echo "<script>alert('Data sudah tersimpan');</script>";
			$data['ta'] = $this->m_admin->thnAjaran()->result();
			$this->load->view('v_tambahPengawas', $data);
		}
		elseif ($idMapel == $mapel && $nomorInduk == $guru) {
			echo "<script>alert('Guru mengajar mata pelajaran');</script>";
			$data['ta'] = $this->m_admin->thnAjaran()->result();
			$this->load->view('v_tambahPengawas', $data);
		}
		else {
			$data = array(
				'idJadwalPengawas' => "",
				'idJadwalUjian' => $idMapel,
				'idKelas' => $idKelas,
				'nomorInduk' => $nomorInduk,
			);

			$this->m_admin->simpanData($data, 'jadwalPengawas');
			redirect('c_admin/jadwalNgawas');
		}
	}
	function ngawasMapel()
	{
		$jamMulai = $this->input->post('jamMulai', TRUE);
		$data = $this->m_admin->ngawasMapel($jamMulai)->result();
		echo json_encode($data);
	}
	function ngawasHari()
	{
		$idTA = $this->input->post('idTA', TRUE);
		$data = $this->m_admin->ngawasHari($idTA)->result();
		echo json_encode($data);
	}
	function ngawasJam()
	{
		$hari = $this->input->post('hari', TRUE);
		$data = $this->m_admin->ngawasJam($hari)->result();
		echo json_encode($data);
	}
	function ngawasGuru()
	{
		$id = $this->input->post('id', TRUE);
		$ngawas = $this->m_admin->tambahNgawas($id)->result();
		$guru = $this->m_admin->jadwalGuru()->result();
		$data = array('ngawas' => $ngawas, 'guru' => $guru,);
		echo json_encode($data);
	}
	function ngawasKelas()
	{
		$id = $this->input->post('id', TRUE);
		$ngawas = $this->m_admin->tambahNgawas($id)->result();
		$kelas = $this->m_admin->kelas()->result();
		$data = array('ngawas' => $ngawas, 'kelas' => $kelas,);
		echo json_encode($data);
	}
	function pengawasHari()
	{
		$idTA = $this->input->post('idTA', TRUE);
		$hari = $this->input->post('hari');
		$jadwal = $this->m_admin->jadwalUjianHari($idTA, $hari)->result();
		print_r($jadwal);
		// $jadwal1 = $this->m_admin->pengawas($idTA)->result();
		// $data = array(
		// 	'jadwal' => $jadwal,
		// 	'jadwal1' => $jadwal1,
		// );
		// echo json_encode($data);
	}

	//pengembangan diri
	function tambahPengembanganDIri()
	{
		$this->load->view('v_tambahNilaiPD');
	}
	function dataPengembanganDiri()
	{
		$data['pd'] = $this->m_admin->pengembanganDiri()->result();
		$this->load->view('v_dataNilaiPD', $data);
	}
	function updateNilaiPD()
	{
		$id = $this->input->post('id_edit');
		$sikap = $this->input->post('sikap');
		$predikat = $this->input->post('predikat');
		$deskripsi = $this->input->post('deskripsi');

		$data = array(
			'predikat' => $predikat,
			'sikap' => $sikap,
			'deskripsi' => $deskripsi, 
		);
		$where = array('idKompetensi' => $id);
		$this->m_admin->updateData($where, $data, 'kompetensiNilai');
		redirect('c_admin/dataPengembanganDiri');
	}
	function simpanNilaiPD()
	{
		$sikap = $this->input->post('sikap');
		$predikat = $this->input->post('predikat');
		$deskripsi = $this->input->post('deskripsi');

		$data = array(
			'idKompetensi' => '',
			'predikat' => $predikat,
			'sikap' => $sikap,
			'deskripsi' => $deskripsi,
		);

		$this->m_admin->simpanData($data, 'kompetensiNilai');
		redirect('c_admin/dataPengembanganDiri');
	}
	function catatanWaliKelas()
	{
		$where = array('userRole' => 'Wali Kelas', 'statusUser' => '1');
		$data['dataWk'] = $this->m_admin->tampilkanDataPegawai($where)->result();
		$this->load->view('v_catatanWaliKls', $data);
	}
	function getWKelas()
	{
		$nomorInduk = $this->input->post('nomorInduk', TRUE);
		$data = $this->m_admin->getWKelas($nomorInduk)->result();
		echo json_encode($data);
	}
	function getCatatan()
	{
		$idKelas = $this->input->post('idKelas', TRUE);
		$nama = $this->m_admin->viewNama($idKelas)->result();
		$catatan = $this->m_admin->viewCatatan($idKelas)->result();
		$data = array(
			'nama' => $nama,
			'cttn' => $catatan,
		);
		echo json_encode($data);
	}
	function getAddSiswa()
	{
		$id = $this->input->get('id');
		$data = $this->m_admin->addSiswa($id)->result();
		echo json_encode($data);
	}
	function getEditSiswa()
	{
		$id = $this->input->get('id');
		$data = $this->m_admin->getEditSiswa($id)->result();
		echo json_encode($data);
	}
	function getEditEkskul()
	{
		$id = $this->input->get('id');
		$data = $this->m_admin->getEditEkskul($id)->result();
		echo json_encode($data);
	}
	function simpanCatatan()
	{
		$id=$this->input->post('id');
        $cttn=$this->input->post('cttn');

		$data = array(
			'idCatatan' => "",
			'idSiswa' => $id,
			'catatan' => $cttn,
		);
        $data=$this->m_admin->simpanData($data, 'catatan_walikelas');
        echo json_encode($data);
	}
	function updateCatatan()
	{
		$id=$this->input->post('id');
		$cttn=$this->input->post('cttn');

		$where = array('idSiswa' => $id,);

		$data = array(
			'catatan' => $cttn,
		);
        $data=$this->m_admin->updateData($where, $data, 'catatan_waliKelas');
        echo json_encode($data);
	}
	function ekstrak()
	{
		$where = array('userRole' => 'Wali Kelas', 'statusUser' => '1');
		$data['dataWk'] = $this->m_admin->tampilkanDataPegawai($where)->result();
		$this->load->view('v_ekstrakurikuler', $data);
	}
	function getEkskul()
	{
		$idKelas = $this->input->post('idKelas', TRUE);
		$nama = $this->m_admin->viewNama($idKelas)->result();
		$eks = $this->m_admin->viewEkskul($idKelas)->result();
		for($i = 0 ; $i < count($nama); $i++) {
			$id = $nama[$i]->idSiswa;
			$status = $this->m_admin->viewStatus($id)->result();
			$nama[$i]->status = (object) array_merge((array) $nama[$i],(array) $status);
		}
		$data = array(
			'nama' => $nama,
			'eks' => $eks,
		);
		echo json_encode($data);
	}
	function tambahEkskul()
	{
		$where = array('userRole' => 'Wali Kelas', 'statusUser' => '1');
		$data['dataWk'] = $this->m_admin->tampilkanDataPegawai($where)->result();
		$this->load->view('v_tambahEkskul', $data);
	}
	function simpanEkskul()
	{
		$checks = $this->input->post("counter");
		print_r($checks);

		if($checks != "")
		{
			foreach ($checks as $list) {
				$data = array(
					'idEkskul' => "",
					'idSiswa' => $this->input->post('id'),
					'namaEkskul' => $this->input->post('eks'.$list),
					'predikat' => $this->input->post('predikat'.$list),
					'ketEkskul' => $this->input->post('ket'.$list)
				 );
				 $this->m_admin->simpanData($data, 'ekskul_siswa');
			}
			
		}

		redirect('c_admin/tambahEkskul');
	}

	//buku nilai
	function dataBukuNilai()
	{
		$data['guru'] = $this->m_admin->jadwalGuru()->result();

		$this->load->view('v_dataBukuNilai', $data);
	}
	function tambahBukuNilai()
	{
		$data['guru'] = $this->m_admin->jadwalGuru()->result();
		$this->load->view('v_tambahBukuNilai1', $data);
	}
	function simpanBukuNilai()
	{
		$guru = $this->input->post('guru');
		$mapel = $this->input->post('mapel');
		$kelas = $this->input->post('kelas');
		$jenis = $this->input->post('jns');
		$tgl = $this->input->post('tgl');
		$siswa = $this->input->post('idSiswa');
		$nilai = $this->input->post('nilai');
		$smt = $this->input->post('smt');

		$tanggal = date('Y-m-d', strtotime($tgl));

		for($i=0 ; $i < count($siswa); $i++){
            $result = array(
                'idBukuNilai' => "", 
				'nomorInduk' => $guru,
				'idMapel' => $mapel,
				'idSiswa' => $siswa[$i],
				'idKelas' => $kelas,
				'jenisNilai' => $jenis,
				'nilai' => $nilai[$i],
				'tanggal' => $tanggal,
				'semester' => $smt,
				'statusBukuNilai' => "1",
			);
			$this->m_admin->simpanNilai($result, 'bukunilai');
        }
		
		redirect('c_admin/dataBukuNilai');
	}
	function getJnsNilai()
	{
		$id = $this->input->post('id');
		$data = $this->m_admin->getJnsNilai($id)->result();
		echo json_encode($data);
	}
	function getTglNilai()
	{
		$jenis = $this->input->post('jns');
		$data = $this->m_admin->getTglNilai($jenis)->result();
		echo json_encode($data);
	}
	function getNilaiSiswa()
	{
		$tgl = $this->input->post('tgl');
		$id = $this->input->post('id');
		$guru = $this->input->post('guru');
		$where = array(
			'bukunilai.tanggal' => $tgl,
			'bukunilai.idKelas' => $id,
			'bukunilai.nomorInduk' => $guru,
		);
		$data = $this->m_admin->getNilaiSiswa($where)->result();
		echo json_encode($data);
	}
	function editBukuNilai()
	{
		$id = $this->input->get('id');
		$where = array('bukunilai.idBukuNilai' => $id, );
		$data = $this->m_admin->editBukuNilai($id)->result();
		print_r($data);
		// echo json_encode($data);
	}

	//rapor
	function templateRapor()
	{
		$this->load->view('v_rapor');
	}
	function dataRapor()
	{
		// $data['kls'] = $this->m_admin->kelas()->result();
		$data['siswa'] = $this->m_admin->viewRapor()->result();
		$this->load->view('v_dataRapor', $data);
	}
	function getNamaSiswa()
	{
		$id = $this->input->post('id');
		$data = $this->m_admin->getNamaSiswa($id)->result();
		echo json_encode($data);
	}

	function getModalUjian()
	{
		$id = $this->input->get('id');
		$ujian = $this->m_admin->modalUjian($id)->result();
		$kelas = $this->m_admin->kelas()->result();
		$klsIPA = $this->m_admin->klsIPA()->result();
		$klsIPS = $this->m_admin->klsIPS()->result();
		$guru = $this->m_admin->jadwalGuru()->result();
		$data = array(
			'ujian' => $ujian,
			'kelas' => $kelas,
			'klsIPA' => $klsIPA,
			'klsIPS' => $klsIPS,
			'guru' => $guru
		);
		echo json_encode($data);
	}
	function pengawasSimpan()
	{
		$idJadwalUjian = $this->input->post('id');
		$kelas = $this->input->post('klsId');
		$guru = $this->input->post('guru');

		for($i=0 ; $i<count($kelas); $i++){
			$result = array(
				'idJadwalPengawas' => '',
				'idJadwalUjian' => $idJadwalUjian,
				'idKelas' => $kelas[$i],
				'nomorInduk' => $guru[$i],
				'statusPengawas' => '1', 
			);
			$this->m_admin->pengawasSimpan($result, 'jadwalpengawas');
		}
		redirect('c_admin/jadwalNgawas');
	}
}
?>