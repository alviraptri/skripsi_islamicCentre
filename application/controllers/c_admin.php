<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class c_admin extends CI_Controller 
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model(array('m_login', 'm_admin'));	
	}
    function index() 
	{
		$this->load->view('v_berandaAdmin');
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
		$photo = $this->input->post('berkas');
		$kelas = $this->input->post('kelas');

		$tgl = date('Y-m-d', strtotime($ttl));

		$config['upload_path'] = './assets/inter/images/profil';
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
		$config['encrypt_name'] = TRUE;

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
		$photo = $this->input->post('berkas');

		$tgl = date('Y-m-d', strtotime($ttl));

		$config['upload_path'] = './assets/inter/images/profil';
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
		$config['encrypt_name'] = TRUE;

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

		$where = array(
            'nomorInduk' => $noInduk
        );
		$a = $this->m_admin->selectSiswa($where, 'datasiswa')->result();
		foreach ($a as $data) {
			$idSiswa = $data->idSiswa;
		};
		$data_session = array('idSiswa' => $idSiswa);
		$this->session->set_userdata($data_session);
		redirect('c_admin/tambahWaliMurid');
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
	function mapel()
	{
		$data['mapel'] = $this->m_admin->tampilkanDataMapel()->result();
		$this->load->view('v_dataMapel', $data);
	}
	function editMapel($idMapel)
	{
		$data['editMapel'] = $this->m_admin->editMapel($idMapel)->result();
		$this->load->view('v_editMapel', $data);
	}
	function updateMapel()
	{
		$idMapel = $this->input->post('idMapel');
		$mapel = $this->input->post('mapel');
		$tahunAjaran = $this->input->post('tahunAjaran');
		$where = array('idMapel' => $idMapel );

		$data = array(
			'idMapel' => $idMapel,
			'namaMapel' => $mapel,
			'idTahunAjaran' => $tahunAjaran,
		);

		$this->m_admin->updateData($where, $data, 'matapelajaran');
		redirect('c_admin/mapel');
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

		$data = array(
			'idTahunAjaran' => "",
			'tahunAjaran' => $thnajaran,
			'statusTahunAjaran' => 1 
		);

		$this->m_admin->simpanData($data, 'tahunajaran');
		redirect('c_admin/tahunAjaran');
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

		$data = array($idSiswa, $jumlah);

		$this->m_admin->simpanMulti($data);
		redirect('c_admin/info');
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
		$data['guru'] = $this->m_admin->jadwalGuru()->result();
		$data['mapel'] = $this->m_admin->tampilkanDataMapel()->result();
		$this->load->view('v_tambahKetNilai', $data);
	}
	function simpanKetNilai()
	{
		$bobotKat1 = $this->input->post("bobotKat1");
		$bobotKat2 = $this->input->post("bobotKat2");
		$bobotUts = $this->input->post("bobotUts");
		$bobotUas = $this->input->post("bobotUas");
		$nomorInduk = $this->input->post("guru");
		$idMapel = $this->input->post("mapel");

		$data = array(
			'idKetNilai' => "",
			'nomorInduk' => $nomorInduk,
			'idMapel' => $idMapel,
			'nilaiSatu' => $bobotKat1,
			'nilaiDua' => $bobotKat2,
			'nilaiUts' => $bobotUts,
			'nilaiUas' => $bobotUas,
			'statusKetNilai' => '1'
		);

		$this->m_admin->simpanData($data, 'ketnilai');
		redirect('c_admin/ketNilai');
	}
	function ketNilai()
	{
		$data['guru'] = $this->m_admin->jadwalGuru()->result();
		$this->load->view('v_dataKetNilai', $data);
	}
	function getMapel()
	{
		$nomorInduk = $this->input->post('nomorInduk', TRUE);
		$data = $this->m_admin->getMapel($nomorInduk)->result();
		echo json_encode($data);
	}
	function getKetNilai()
	{
		$idMapel = $this->input->post('idMapel', TRUE);
		$where = array('idMapel' => $idMapel);
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
        $nsatu=$this->input->post('nsatu');
		$ndua=$this->input->post('ndua');
		$nuts=$this->input->post('nuts');
		$nuas=$this->input->post('nuas');

		$where = array('idKetNilai' => $id,);

		$data = array(
			'nilaiSatu' => $nsatu,
			'nilaiDua' => $ndua,
			'nilaiUts' => $nuts,
			'nilaiUas' => $nuas,
		);
        $data=$this->m_admin->updateData($where, $data, 'ketnilai');
        echo json_encode($data);
	}

	function getKelas()
	{
		$idMapel = $this->input->post('idMapel');
		$data = $this->m_admin->getKelas($idMapel)->result();
		echo json_encode($data);
	}

	//absensi
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
		$cek = $this->input->post('cek');
		$tanggal = $this->input->post('tgl');
		$idJadwal = $this->input->post('idJadwal');

		$data = array($idSiswa, $cek, $tanggal, $idJadwal);
		//$this->m_admin->simpanAbsen($data);

		for($i=0 ; $i < count($data); $i++){
            $result = array(
                'idAbsen' => "",
                'idSiswa' => $idSiswa[$i],
                'idJadwal' => $idJadwal,
                'tanggal' => $tanggal,
                'absen' => $cek[$i],
                'statusAbsen' => '1',
			);
			$this->m_admin->simpanAbsen($result, 'absensi');
        }
		
		redirect('c_admin/absensi');
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
		// $guru = $this->input->post('guru');
		// $kelas = $this->input->post('kls');

		$data = array(
			'idJadwalUjian' => "",
			'idTahunAjaran' => $tahunAjaran,
			// 'nomorInduk' => $guru,
			// 'idKelas' => $kelas,
			'idMapel' => $mapel,
			'hari' => $hari,
			'jamMulai' => $jamMulai,
			'jamSelesai' => $jamSelesai
		);

		$this->m_admin->simpanData($data, 'jadwalujian');
		redirect('c_admin/jadwalUjian');
	}
	function jadwalUjian()
	{
		$data['ta'] = $this->m_admin->thnAjaran()->result();
		$this->load->view('v_dataJadwalUjian', $data);
	}
	function getJadwalUjian()
	{
		$idTA = $this->input->post('idTA', TRUE);
		$data = $this->m_admin->getJadwalUjian($idTA)->result();
		echo json_encode($data);
	}
	function editJadwalUjian()
	{
		$id = $this->input->get('id');
		$data = $this->m_admin->editJadwalUjian($id);
		echo json_encode($data);
	}
}
?>