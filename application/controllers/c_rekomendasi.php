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
    function perbandinganKriteria()
    {
        $data['krit'] = $this->m_rekomendasi->perbandinganKrit()->result();
        $data['jmlh'] = $this->m_rekomendasi->getJumlahKriteria();
        // $data['satu'] = $this->m_rekomendasi->getKriteriaSatu()->result();
        $this->load->view('v_perbandinganKriteria', $data);
    }
    function simpanPerbandingan()
    {
        $n = $this->m_rekomendasi->getJumlahKriteria();
        $matrik = array();
        $urut = 0;
        for ($i=0; $i <=($n- 2) ; $i++) { 
            for ($j=($i+1); $j <= ($n - 1) ; $j++) { 
                $urut++;

                $id1 = $this->input->post('idK1'.$urut);
                $id2 = $this->input->post('idK2'.$urut);
                $bobot = $this->input->post('bobot'.$urut);

                $data = array(
                    'idPK' => "", 
                    'kriteria_satu' => $id1,
                    'kriteria_dua' => $id2,
                    'bobotKriteria' => $bobot,
                );
                $matrik[$i][$j] = $bobot;
                $matrik[$j][$i] = 1 / $bobot;
                
                $this->m_admin->simpanData($data, 'perbandingan_kriteria');
            }
        }

        // diagonal --> bernilai 1
        for ($i = 0; $i <= ($n-1); $i++) {
            $matrik[$i][$i] = 1;
        }

        // inisialisasi jumlah tiap kolom dan baris kriteria
	    $jmlmpb = array();
	    $jmlmnk = array();
	    for ($i=0; $i <= ($n-1); $i++) {
		    $jmlmpb[$i] = 0;
		    $jmlmnk[$i] = 0;
        }
        
        // menghitung jumlah pada kolom kriteria tabel perbandingan berpasangan
        for ($x=0; $x <= ($n-1) ; $x++) {
            for ($y=0; $y <= ($n-1) ; $y++) {
                $value = $matrik[$x][$y];
                $jmlmpb[$y] += $value;
            }
        }

        // menghitung jumlah pada baris kriteria tabel nilai kriteria
        // matrikb merupakan matrik yang telah dinormalisasi
        for ($x=0; $x <= ($n-1) ; $x++) {
            for ($y=0; $y <= ($n-1) ; $y++) {
                $matrikb[$x][$y] = $matrik[$x][$y] / $jmlmpb[$y];
                $value	= $matrikb[$x][$y];
                $jmlmnk[$x] += $value;
            }

            // nilai priority vektor
            $pv[$x]	 = $jmlmnk[$x] / $n;

            $idKriteria = $this->m_rekomendasi->perbandinganKrit()->result();
            foreach ($idKriteria as $idk) {
                $id[] = $idk->idKriteria;
            }

            // memasukkan nilai priority vektor ke dalam tabel pv_kriteria dan pv_alternatif
            $data = array(
                'idKriteria' => $id[$x], 
                'nilaiPvKrit' => $pv[$x],
            );
            $this->m_admin->simpanData($data, 'pv_kriteria');
        }

        // cek konsistensi
        $data['eigenvektor'] = $this->getEigenVector($jmlmpb,$jmlmnk,$n);
        $data['consIndex'] = $this->getConsIndex($jmlmpb,$jmlmnk,$n);
        $data['consRatio'] = $this->getConsRatio($jmlmpb,$jmlmnk,$n);

        $data['krit'] = $this->m_rekomendasi->perbandinganKrit()->result();
        $data['jmlh'] = $this->m_rekomendasi->getJumlahKriteria();
        $data['matrik'] = $matrik;
        $data['jmlmpb'] = $jmlmpb;
        $data['jmlmnk'] = $jmlmnk;
        $data['matrikb'] = $matrikb;
        $data['pv'] = $pv;
        $this->load->view('v_hasilKriteria', $data);
    }
    // mencari Principe Eigen Vector (λ maks)
    function getEigenVector($matrik_a,$matrik_b,$n)
    {
        $eigenvektor = 0;
        for ($i=0; $i <= ($n-1) ; $i++) {
            $eigenvektor += ($matrik_a[$i] * (($matrik_b[$i]) / $n));
        }

        return $eigenvektor;
    }
    // mencari Cons Index
    function getConsIndex($matrik_a,$matrik_b,$n)
    {
        $eigenvektor = $this->getEigenVector($matrik_a,$matrik_b,$n);
        $consindex = ($eigenvektor - $n)/($n-1);

        return $consindex;
    }
    // Mencari Consistency Ratio
    function getConsRatio($matrik_a,$matrik_b,$n)
    {
        $ir = $this->m_rekomendasi->getNilaiIR($n)->result();
        foreach ($ir as $irn) {
            $nilaiIR = $irn->nilai;
        }
        $consindex = $this->getConsIndex($matrik_a,$matrik_b,$n);
        $consratio = $consindex / $nilaiIR;

        return $consratio;
    }
    function lihatSiswa()
    {
        $data['siswa'] = $this->m_rekomendasi->namaSiswa()->result();
        $this->session->set_userdata('kriteria', 0);
        $this->load->view('v_namaSiswa', $data);
    }
    function perbandinganAlternatif($id)
    {
        $data['alt'] = $this->m_rekomendasi->perbandinganAlternatif($id)->result();
        $data['jmlh'] = $this->m_rekomendasi->getJumlahAlternatif($id);
        $data['krit'] = $this->m_rekomendasi->getNamaKriteria()->result();
        $kriteria = (int) $this->session->userdata('kriteria');
        $this->session->set_userdata('siswa', $id);
        $this->session->set_userdata('kriteria', $kriteria+1);

        $this->load->view('v_perbandinganAlternatif', $data);
    }
    function simpanPerbandinganAlt($idSiswa)
    {
        $n = $this->m_rekomendasi->getJumlahAlternatif($idSiswa);
        $matrik = array();
        $urut = 0;
        $idKrit = $this->session->userdata('kriteria');
        for ($i=0; $i <=($n- 2) ; $i++) { 
            for ($j=($i+1); $j <= ($n - 1) ; $j++) { 
                $urut++;

                $id1 = $this->input->post('idA1'.$urut);
                $id2 = $this->input->post('idA2'.$urut);
                $bobot = $this->input->post('bobot'.$urut);

                $data = array(
                    'idPA' => "", 
                    'alternatifSatu' => $id1,
                    'alternatifDua' => $id2,
                    'idKriteria' => $idKrit,
                    'bobotAlternatif' => $bobot,
                );
                $matrik[$i][$j] = $bobot;
                $matrik[$j][$i] = 1 / $bobot;
                
                $this->m_admin->simpanData($data, 'perbandingan_alternatif');
            }
        }

        // diagonal --> bernilai 1
        for ($i = 0; $i <= ($n-1); $i++) {
            $matrik[$i][$i] = 1;
        }

        // inisialisasi jumlah tiap kolom dan baris kriteria
	    $jmlmpb = array();
	    $jmlmnk = array();
	    for ($i=0; $i <= ($n-1); $i++) {
		    $jmlmpb[$i] = 0;
		    $jmlmnk[$i] = 0;
        }
        
        // menghitung jumlah pada kolom kriteria tabel perbandingan berpasangan
        for ($x=0; $x <= ($n-1) ; $x++) {
            for ($y=0; $y <= ($n-1) ; $y++) {
                $value = $matrik[$x][$y];
                $jmlmpb[$y] += $value;
            }
        }

        // menghitung jumlah pada baris kriteria tabel nilai kriteria
        // matrikb merupakan matrik yang telah dinormalisasi
        for ($x=0; $x <= ($n-1) ; $x++) {
            for ($y=0; $y <= ($n-1) ; $y++) {
                $matrikb[$x][$y] = $matrik[$x][$y] / $jmlmpb[$y];
                $value	= $matrikb[$x][$y];
                $jmlmnk[$x] += $value;
            }

            // nilai priority vektor
            $pv[$x]	 = $jmlmnk[$x] / $n;
            $id = [];

            $idAlt = $this->m_rekomendasi->perbandinganAlt()->result();
            foreach ($idAlt as $ida) {
                // $id[] = $ida->idAlternatif;
                array_push($id, $ida->idAlternatif);
            }

            // memasukkan nilai priority vektor ke dalam tabel pv_kriteria dan pv_alternatif
            $data = array(
                'idHA' => "",
                'idAlternatif' => $id[$x],
                'idKriteria' => $idKrit,
                'nilaiHA' => $pv[$x],
            );
            $this->m_admin->simpanData($data, 'pv_alternatif');
        }

        // cek konsistensi
        $data['eigenvektor'] = $this->getEigenVector($jmlmpb,$jmlmnk,$n);
        $data['consIndex'] = $this->getConsIndex($jmlmpb,$jmlmnk,$n);
        $data['consRatio'] = $this->getConsRatio($jmlmpb,$jmlmnk,$n);

        $data['alt'] = $this->m_rekomendasi->perbandinganAlternatif($idSiswa)->result();
        $data['jmlh'] = $this->m_rekomendasi->getJumlahAlternatif($idSiswa);
        $data['matrik'] = $matrik;
        $data['jmlmpb'] = $jmlmpb;
        $data['jmlmnk'] = $jmlmnk;
        $data['matrikb'] = $matrikb;
        $data['pv'] = $pv;
        $this->load->view('v_hasilAlternatif', $data);
    }
    function minusKriteria() {
        $kriteria = (int) $this->session->userdata('kriteria');
        $this->session->set_userdata('kriteria', $kriteria-1);

        $data = array(
            'message' => 'success'
        );

        echo json_encode($data);
    }
    function hasilAkhir($idSiswa)
    {
        // menghitung perangkingan
        $jK = $this->m_rekomendasi->getJumlahKriteria();
        $jA = $this->m_rekomendasi->getJumlahAlternatif($idSiswa);
        $nilai = array();

        // mendapatkan nilai tiap alternatif
        for ($x=0; $x <= ($jA-1); $x++) {
	    // inisialisasi
            $nilai[$x] = 0;
            $idAlternatif = $this->m_rekomendasi->perbandinganAlt()->result();
            foreach ($idAlternatif as $ida) {
                $idAlt[] = $ida->idAlternatif;
            }
            $idKriteria = $this->m_rekomendasi->perbandinganKrit()->result();
            foreach ($idKriteria as $idk) {
                $idKrit[] = $idk->idKriteria;
            }

	        for ($y=0; $y <= ($jK-1); $y++) {
            $id_alternatif 	= $idAlt[$x];
            $id_kriteria	= $idKrit[$y];

            $pvAlt	= $this->m_rekomendasi->getAlternatifPV($id_alternatif,$id_kriteria)->result();
            $pvKrit	= $this->m_rekomendasi->getKriteriaPV($id_kriteria)->result();

            foreach ($pvAlt as $altPV) {
                $pv_alternatif = $altPV->nilaiHA;
            }
            foreach ($pvKrit as $kritPV) {
                $pv_kriteria = $kritPV->nilaiPvKrit;
            }
            $nilai[$x] += ($pv_alternatif * $pv_kriteria);
	        }
        } 

        // update nilai ranking
        for ($i=0; $i <= ($jA-1); $i++) { 
            $id_alt = $idAlt[$i];
            $data = array(
                'idRanking' => "",
                'idAlternatif' => $id_alt,
                'hasilAkhir' => $nilai[$i],
            );
            $this->m_admin->simpanData($data, 'rankingrekomendasi');
	        // $query = "INSERT INTO ranking VALUES ($id_alternatif,$nilai[$i]) ON DUPLICATE KEY UPDATE nilai=$nilai[$i]";
	        // $result = mysqli_query($koneksi,$query);
	        // if (!$result) {
		    // echo "Gagal mengupdate ranking";
		    // exit();
	        // }
        }
        $rank = $this->m_rekomendasi->lihatRanking()->result();
        sort($rank);
        $data['rank'] = $rank;
        $data['alternatifPV'] = $this->m_rekomendasi->getAlternatifPV_2($id_alternatif,$id_kriteria)->result();
        $data['kriteriaPV'] = $this->m_rekomendasi->getKriteriaPV_2()->result();
        $data['alt'] = $this->m_rekomendasi->perbandinganAlternatif($idSiswa)->result();
        $data['krit'] = $this->m_rekomendasi->perbandinganKrit()->result();
        $data['jK'] = $this->m_rekomendasi->getJumlahKriteria();
        $data['jA'] = $this->m_rekomendasi->getJumlahAlternatif($idSiswa);
        $data['nilai'] = $nilai;
        $this->load->view("v_hasilRanking", $data);
        
    }
}
