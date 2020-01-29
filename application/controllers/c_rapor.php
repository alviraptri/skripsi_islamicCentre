<?php
class c_rapor extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model(array('m_rapor'));
        $this->load->library('pdf');
    }

    function index($id)
    {
        $pdf = new FPDF('P', 'mm', 'A4'); //set Page
        $pdf->AddPage(); //Halaman Baru

        $siswa = $this->m_rapor->dataSiswa($id)->result();
        foreach ($siswa as $list) {
            $nama = $list->namaUser;
            $nomorInduk = $list->nomorInduk;
            $ket = $list->ketKelas;
            $jurusan = $list->jurusanKelas;
            $nomor = $list->nomorKelas;
            $ta = $list->tahunAjaran;
        }
        $bobot = $this->m_rapor->dataBobot()->result();
        foreach ($bobot as $b) {
            $sklh = $b->bobotSekolah;
            $guru = $b->bobotGuru;
        }
        $tugas = 0;
        $UH = 0;
        $praktek = 0;
        $uts = 0;
        $uas = 0;
        $nilai = $this->m_rapor->dataNilai($id)->result();
        foreach ($nilai as $n) {
            $semester = $n->semester;

            if ($n->idMapel == 14) {
                if ($n->jenisNilai == "Tugas") {
                    $tugas += $n->nilai; 
                }
                if($n->jenisNilai == "Ulangan Harian"){
                    $UH = $n->nilai;
                }
                if ($n->jenisNilai == "Praktek") {
                    $praktek = $n->nilai;
                }
                if($n->jenisNilai == "UTS"){
                    $uts = $n->nilai;
                }
                if($n->jenisNilai == "UAS"){
                    $uas = $n->nilai;
                }
            }  
        }
        $Nguru = ($tugas+$UH)/5;
        $totalGuru = $Nguru*($guru/100);
        $Nsklh = $uts*($sklh/100);
        $Ntotal = round($totalGuru) + round($Nsklh);

        if ($Ntotal >= 89) {
            $predikat = 'A';
        }
        else if ($Ntotal >= 77) {
            $predikat = 'B';
        }
        else if($Ntotal > 89){
            $predikat = 'B';
        }
        else if ($Ntotal >= 65) {
            $predikat = "C";
        }
        else if($Ntotal < 77){
            $predikat = "C";
        }
        else if ($Ntotal < 65) {
            $predikat = "D";
        }
        
        //header kanan
        $pdf->SetFont('Arial', '', 10); //setting jenis font yang akan digunakan
        $pdf->Cell(35, 5, 'Nama Sekolah', 0, 0, 'L');
        $pdf->Cell(95, 5, ': SMAS ISLAMIC CENTRE', 0, 0, 'L');
        //header kiri
        $pdf->Cell(35, 5, 'Kelas', 0, 0, 'L');
        $pdf->Cell(95, 5, ': ' . $ket . ' ' . $jurusan . ' ' . $nomor . '', 0, 1, 'L');

        //header kanan
        $pdf->Cell(35, 5, 'Alamat', 0, 0, 'L');
        $pdf->Cell(95, 5, ': JL. CIUJUNG RAYA NO. 4', 0, 0, 'L');
        //header kiri
        $pdf->Cell(35, 5, 'Semester', 0, 0, 'L');
        if ($semester == 1) {
            $pdf->Cell(95, 5, ': 1 (Satu)', 0, 1, 'L');
        }
        else {
            $pdf->Cell(95, 5, ': 2 (Dua)', 0, 1, 'L');
        }

        //header kanan
        $pdf->Cell(35, 5, 'Nama', 0, 0, 'L');
        $pdf->Cell(95, 5, ': ' . $nama . '', 0, 0, 'L');
        //header kiri
        $pdf->Cell(35, 5, 'Tahun Pelajaran', 0, 0, 'L');
        $pdf->Cell(95, 5, ': ' . $ta . '', 0, 1, 'L');

        //header kanan
        $pdf->Cell(35, 5, 'Nomor Induk', 0, 0, 'L');
        $pdf->Cell(95, 5, ': ' . $nomorInduk . '', 0, 1, 'L');
        //garis
        $pdf->Cell(195, 1, '', 'B', 1, 'L');

        //isi judul
        $pdf->SetFont('Arial', 'B', 16); //setting jenis font yang akan digunakan
        $pdf->Cell(0, 17, 'CAPAIAN HASIL BELAJAR', 0, 1, 'C');

        //isi
        $pdf->SetFont('Arial', 'B', 10); //setting jenis font yang akan digunakan
        $pdf->Cell(35, 15, 'A. SIKAP', 0, 1, 'L');
        $pdf->Cell(35, 1, '1. Sikap Spiritual', 0, 1, 'L');

        //tabel
        $pdf->Cell(10,7,'',0,1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(40,6,'$predikat',1,0, 'C');
        $pdf->Cell(155,6,'Deskripsi',1,1, 'C');
        $pdf->Cell(40,6,'',1,0, 'C');
        $pdf->Cell(155,6,'',1,1, 'C');
        $pdf->SetFont('Arial', '', 10);

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(35, 17, '2. Sikap Sosial', 0, 1, 'L');
        //tabel
        $pdf->Cell(10,0,'',0,1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(40,6,'$predikat',1,0, 'C');
        $pdf->Cell(155,6,'Deskripsi',1,1, 'C');
        $pdf->Cell(40,6,'',1,0, 'C');
        $pdf->Cell(155,6,'',1,1, 'C');
        $pdf->SetFont('Arial', '', 10);

        date_default_timezone_set('Asia/Jakarta');// change according timezone
        $tgl = date( 'd F Y', time ());
        $wk = $this->m_rapor->getId($id)->result();
        foreach ($wk as $list) {
            $namaWK = $list->namaUser;
            $niWK = $list->nomorInduk;
        }

        //ttd
        $pdf->SetY(115);
        $pdf->SetFont('Arial', '', 10); //setting jenis font yang akan digunakan
        $pdf->Cell(35, 5, '', 0, 0, 'L');
        $pdf->Cell(95, 5, '', 0, 0, 'L');
        //header kiri
        $pdf->Cell(35, 10, 'Tangerang, '.$tgl.'', 0, 1, 'L');
        $pdf->Cell(35, 0, '', 0, 0, 'L');
        $pdf->Cell(95, 0, '', 0, 0, 'L');
        $pdf->Cell(35, 0, 'Wali Kelas', 0, 1, 'L');

        $pdf->SetY(140);
        $pdf->Cell(35, 5, '', 0, 0, 'L');
        $pdf->Cell(95, 5, '', 0, 0, 'L');
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(35, 3, $namaWK, 0, 1, 'L');
        $pdf->Cell(35, 5, '', 0, 0, 'L');
        $pdf->Cell(95, 5, '', 0, 0, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(35, 5, 'NIP. '.$niWK, 0, 1, 'L');

        //footer
        $pdf->SetY(265);
        //garis
        $pdf->Cell(195, 1, '', 'B', 1, 'L');
        $pdf->SetFont('Arial','I',8);
        $pdf->Cell(170,10, $ket.'  '.$jurusan.'  '.$nomor.'  |  '.$nama.'  |  '.$nomorInduk, 0,0,'L');
        $pdf->Cell(0,10,'eRapor  SMA  |  Hal  : '.$pdf->PageNo(),0,0,'C');


        $pdf->AddPage(); //Halaman Baru

        //header kanan
        $pdf->SetFont('Arial', '', 10); //setting jenis font yang akan digunakan
        $pdf->Cell(35, 5, 'Nama Sekolah', 0, 0, 'L');
        $pdf->Cell(95, 5, ': SMAS ISLAMIC CENTRE', 0, 0, 'L');
        //header kiri
        $pdf->Cell(35, 5, 'Kelas', 0, 0, 'L');
        $pdf->Cell(95, 5, ': ' . $ket . ' ' . $jurusan . ' ' . $nomor . '', 0, 1, 'L');

        //header kanan
        $pdf->Cell(35, 5, 'Alamat', 0, 0, 'L');
        $pdf->Cell(95, 5, ': JL. CIUJUNG RAYA NO. 4', 0, 0, 'L');
        //header kiri
        $pdf->Cell(35, 5, 'Semester', 0, 0, 'L');
        $pdf->Cell(95, 5, ': 1 (Satu)', 0, 1, 'L');

        //header kanan
        $pdf->Cell(35, 5, 'Nama', 0, 0, 'L');
        $pdf->Cell(95, 5, ': ' . $nama . '', 0, 0, 'L');
        //header kiri
        $pdf->Cell(35, 5, 'Tahun Pelajaran', 0, 0, 'L');
        $pdf->Cell(95, 5, ': ' . $ta . '', 0, 1, 'L');

        //header kanan
        $pdf->Cell(35, 5, 'Nomor Induk/NISN', 0, 0, 'L');
        $pdf->Cell(95, 5, ': ' . $nomorInduk . ' / ', 0, 1, 'L');
        //garis
        $pdf->Cell(195, 1, '', 'B', 1, 'L');

        //isi
        $pdf->SetFont('Arial', 'B', 10); //setting jenis font yang akan digunakan
        $pdf->Cell(35, 10, 'B. PENGETAHUAN', 0, 1, 'L');
        $pdf->Cell(35, 0, 'Kriteria Ketuntasan Minimal = 65', 0, 1, 'L');

        //tabel
        $pdf->Cell(10,5,'',0,1);
        $pdf->SetFont('Arial', 'B', 10);
        //baris satu yang menguras tenaga
        $pdf->Cell(10,5,' ','LTR',0,'L',0);   // empty cell with left,top, and right borders
        $pdf->Cell(45,5,' ','LTR',0,'L',0);
        $pdf->Cell(140,5,'Pengetahuan',1,1,'C',0);
        $pdf->Cell(10,5,'No','LBR',0,'C',0);  // cell with left and right borders
        $pdf->Cell(45,5,'Mata Pelajaran','LBR',0,'C',0);  // cell with left and right borders
        $pdf->Cell(15,5,'Nilai',1,0,'C',0);
        $pdf->Cell(20,5,'$predikat',1,0,'C',0);
        $pdf->Cell(105,5,'Deskripsi',1,1,'C',0);

        //baris dua
        $pdf->Cell(195,5,'Kelompok A','LBR',1,'L',0);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(10,5,'','LTR',0,'C',0);  // cell with left and right borders
        $start_x=$pdf->GetX(); //initial x (start of column position)
        $current_y = $pdf->GetY();
        $current_x = $pdf->GetX();

        $cell_width = 45;  //define cell width
        $cell_height=5;    //define cell height
        $pdf->MultiCell($cell_width,$cell_height,'Pendidikan Agama Islam dan Budi Pekerti',1, 'L'); //print one cell value
        $current_x+=$cell_width;                           //calculate position for next cell
        $pdf->SetXY($current_x, $current_y);
        // $pdf->Cell(50,5,'Pendidikan Agama Islam dan Budi Pekerti',1,0,'L',0);  // cell with left and right borders
        $pdf->Cell(15,5,'','LTR',0,'C',0);
        $pdf->Cell(20,5,'','LTR',0,'C',0);
        $pdf->Cell(105,5,'','LTR',1,'L',0);
        
        $pdf->Cell(10,5,'1','LBR',0,'C',0);  // cell with left and right borders
        $pdf->Cell(45,5,'','LBR',0,'C',0); //ga usah diisi
        $pdf->Cell(15,5,$Ntotal,'LBR',0,'C',0);
        $pdf->Cell(20,5,$predikat,'LBR',0,'C',0);
        $pdf->Cell(105,5,'','LBR',1,'L',0);
        
        //baris tiga
        $pdf->Cell(10,5,'','LTR',0,'C',0);  // cell with left and right borders
        $start_x=$pdf->GetX(); //initial x (start of column position)
        $current_y = $pdf->GetY();
        $current_x = $pdf->GetX();

        $cell_width = 45;  //define cell width
        $cell_height=5;    //define cell height
        $pdf->MultiCell($cell_width,$cell_height,'Pendidikan Pancasila dan Kewarganegaraan',1, 'L'); //print one cell value
        $current_x+=$cell_width;                           //calculate position for next cell
        $pdf->SetXY($current_x, $current_y);
        $pdf->Cell(15,5,'','LTR',0,'C',0);
        $pdf->Cell(20,5,'','LTR',0,'C',0);
        $pdf->Cell(105,5,'','LTR',1,'L',0);
        
        $pdf->Cell(10,5,'2','LBR',0,'C',0);  // cell with left and right borders
        $pdf->Cell(45,5,'','LBR',0,'C',0); //ga usah diisi
        $pdf->Cell(15,5,'','LBR',0,'C',0);
        $pdf->Cell(20,5,'','LBR',0,'C',0);
        $pdf->Cell(105,5,'','LBR',1,'L',0);

        //baris empat
        $pdf->Cell(10,5,'3',1,0,'C',0);  // cell with left and right borders
        $pdf->Cell(45,5,'Bahasa Indonesia',1,0,'L',0); 
        $pdf->Cell(15,5,'',1,0,'C',0);
        $pdf->Cell(20,5,'',1,0,'C',0);
        $pdf->Cell(105,5,'',1,1,'L',0);

        //baris lima
        $pdf->Cell(10,5,'4',1,0,'C',0);  // cell with left and right borders
        $pdf->Cell(45,5,'Matematika (Umum)',1,0,'L',0); 
        $pdf->Cell(15,5,'',1,0,'C',0);
        $pdf->Cell(20,5,'',1,0,'C',0);
        $pdf->Cell(105,5,'',1,1,'L',0);

        //baris enam
        $pdf->Cell(10,5,'5',1,0,'C',0);  // cell with left and right borders
        $pdf->Cell(45,5,'Sejarah Indonesia',1,0,'L',0); 
        $pdf->Cell(15,5,'',1,0,'C',0);
        $pdf->Cell(20,5,'',1,0,'C',0);
        $pdf->Cell(105,5,'',1,1,'L',0);

        //baris tujuh
        $pdf->Cell(10,5,'6',1,0,'C',0);  // cell with left and right borders
        $pdf->Cell(45,5,'Bahasa Inggris',1,0,'L',0); 
        $pdf->Cell(15,5,'',1,0,'C',0);
        $pdf->Cell(20,5,'',1,0,'C',0);
        $pdf->Cell(105,5,'',1,1,'L',0);

        //baris delapan
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(195,5,'Kelompok B','LBR',1,'L',0);
        $pdf->SetFont('Arial', '', 10);

        //baris sembilan
        $pdf->Cell(10,5,'1',1,0,'C',0);  // cell with left and right borders
        $pdf->Cell(45,5,'Seni Budaya',1,0,'L',0); 
        $pdf->Cell(15,5,'',1,0,'C',0);
        $pdf->Cell(20,5,'',1,0,'C',0);
        $pdf->Cell(105,5,'',1,1,'L',0);

        //baris 10
        $pdf->Cell(10,5,'','LTR',0,'C',0);  // cell with left and right borders
        $start_x=$pdf->GetX(); //initial x (start of column position)
        $current_y = $pdf->GetY();
        $current_x = $pdf->GetX();

        $cell_width = 45;  //define cell width
        $cell_height=5;    //define cell height
        $pdf->MultiCell($cell_width,$cell_height,'Pendidikan Jasmani, Olahraga, dan Kesehatan',1,'L'); //print one cell value
        $current_x+=$cell_width;                           //calculate position for next cell
        $pdf->SetXY($current_x, $current_y);
        $pdf->Cell(15,5,'','LTR',0,'C',0);
        $pdf->Cell(20,5,'','LTR',0,'C',0);
        $pdf->Cell(105,5,'','LTR',1,'L',0);
        
        $pdf->Cell(10,5,'2','LBR',0,'C',0);  // cell with left and right borders
        $pdf->Cell(45,5,'','LBR',0,'C',0); //ga usah diisi
        $pdf->Cell(15,5,'','LBR',0,'C',0);
        $pdf->Cell(20,5,'','LBR',0,'C',0);
        $pdf->Cell(105,5,'','LBR',1,'L',0);
        
        //baris 11
        $pdf->Cell(10,5,'','LTR',0,'C',0);  // cell with left and right borders
        $start_x=$pdf->GetX(); //initial x (start of column position)
        $current_y = $pdf->GetY();
        $current_x = $pdf->GetX();

        $cell_width = 45;  //define cell width
        $cell_height=5;    //define cell height
        $pdf->MultiCell($cell_width,$cell_height,'Prakarya dan Kewirausahaan',1, 'L'); //print one cell value
        $current_x+=$cell_width;                           //calculate position for next cell
        $pdf->SetXY($current_x, $current_y);
        // $pdf->Cell(50,5,'Pendidikan Agama Islam dan Budi Pekerti',1,0,'L',0);  // cell with left and right borders
        $pdf->Cell(15,5,'','LTR',0,'C',0);
        $pdf->Cell(20,5,'','LTR',0,'C',0);
        $pdf->Cell(105,5,'','LTR',1,'L',0);
        
        $pdf->Cell(10,5,'3','LBR',0,'C',0);  // cell with left and right borders
        $pdf->Cell(45,5,'','LBR',0,'C',0); //ga usah diisi
        $pdf->Cell(15,5,'','LBR',0,'C',0);
        $pdf->Cell(20,5,'','LBR',0,'C',0);
        $pdf->Cell(105,5,'','LBR',1,'L',0);

        //baris 12
        $pdf->Cell(10,5,'','LTR',0,'C',0);  // cell with left and right borders
        $start_x=$pdf->GetX(); //initial x (start of column position)
        $current_y = $pdf->GetY();
        $current_x = $pdf->GetX();

        $cell_width = 45;  //define cell width
        $cell_height=5;    //define cell height
        $pdf->MultiCell($cell_width,$cell_height,'Bahasa Arab Quran (Muatan Lokal)',1, 'L'); //print one cell value
        $current_x+=$cell_width;                           //calculate position for next cell
        $pdf->SetXY($current_x, $current_y);
        // $pdf->Cell(50,5,'Pendidikan Agama Islam dan Budi Pekerti',1,0,'L',0);  // cell with left and right borders
        $pdf->Cell(15,5,'','LTR',0,'C',0);
        $pdf->Cell(20,5,'','LTR',0,'C',0);
        $pdf->Cell(105,5,'','LTR',1,'L',0);
        
        $pdf->Cell(10,5,'4','LBR',0,'C',0);  // cell with left and right borders
        $pdf->Cell(45,5,'','LBR',0,'C',0); //ga usah diisi
        $pdf->Cell(15,5,'','LBR',0,'C',0);
        $pdf->Cell(20,5,'','LBR',0,'C',0);
        $pdf->Cell(105,5,'','LBR',1,'L',0);

        //baris 13
        $pdf->Cell(10,5,'5',1,0,'C',0);  // cell with left and right borders
        $pdf->Cell(45,5,'English Conversation',1,0,'L',0); 
        $pdf->Cell(15,5,'',1,0,'C',0);
        $pdf->Cell(20,5,'',1,0,'C',0);
        $pdf->Cell(105,5,'',1,1,'L',0);

        //baris 14
        $pdf->Cell(10,5,'6',1,0,'C',0);  // cell with left and right borders
        $pdf->Cell(45,5,'Aqidah Akhlah',1,0,'L',0); 
        $pdf->Cell(15,5,'',1,0,'C',0);
        $pdf->Cell(20,5,'',1,0,'C',0);
        $pdf->Cell(105,5,'',1,1,'L',0);

        //baris 15
        $pdf->Cell(10,5,'7',1,0,'C',0);  // cell with left and right borders
        $pdf->Cell(45,5,'Bimbingan TIK',1,0,'L',0); 
        $pdf->Cell(15,5,'',1,0,'C',0);
        $pdf->Cell(20,5,'',1,0,'C',0);
        $pdf->Cell(105,5,'',1,1,'L',0);

        //baris 16
        $pdf->Cell(10,5,'8',1,0,'C',0);  // cell with left and right borders
        $pdf->Cell(45,5,'Muhadoroh',1,0,'L',0); 
        $pdf->Cell(15,5,'',1,0,'C',0);
        $pdf->Cell(20,5,'',1,0,'C',0);
        $pdf->Cell(105,5,'',1,1,'L',0);

        //baris 17
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(195,5,'Kelompok C','LBR',1,'L',0);
        $pdf->SetFont('Arial', '', 10);

        //baris 18
        $pdf->Cell(10,5,'1',1,0,'C',0);  // cell with left and right borders
        $pdf->Cell(45,5,'Matematika (Peminatan)',1,0,'L',0); 
        $pdf->Cell(15,5,'',1,0,'C',0);
        $pdf->Cell(20,5,'',1,0,'C',0);
        $pdf->Cell(105,5,'',1,1,'L',0);
        
        //baris 19
        $pdf->Cell(10,5,'2',1,0,'C',0);  // cell with left and right borders
        $pdf->Cell(45,5,'Biologi',1,0,'L',0); 
        $pdf->Cell(15,5,'',1,0,'C',0);
        $pdf->Cell(20,5,'',1,0,'C',0);
        $pdf->Cell(105,5,'',1,1,'L',0);

        //baris 20
        $pdf->Cell(10,5,'3',1,0,'C',0);  // cell with left and right borders
        $pdf->Cell(45,5,'Fisika',1,0,'L',0); 
        $pdf->Cell(15,5,'',1,0,'C',0);
        $pdf->Cell(20,5,'',1,0,'C',0);
        $pdf->Cell(105,5,'',1,1,'L',0);

        //baris 21
        $pdf->Cell(10,5,'4',1,0,'C',0);  // cell with left and right borders
        $pdf->Cell(45,5,'Kimia',1,0,'L',0); 
        $pdf->Cell(15,5,'',1,0,'C',0);
        $pdf->Cell(20,5,'',1,0,'C',0);
        $pdf->Cell(105,5,'',1,1,'L',0);

        //baris 22
        $pdf->Cell(10,5,'5',1,0,'C',0);  // cell with left and right borders
        $pdf->Cell(45,5,'Bahasa dan Sastra Arab',1,0,'L',0); 
        $pdf->Cell(15,5,'',1,0,'C',0);
        $pdf->Cell(20,5,'',1,0,'C',0);
        $pdf->Cell(105,5,'',1,1,'L',0);

        //baris 23
        $pdf->Cell(10,5,'6',1,0,'C',0);  // cell with left and right borders
        $pdf->Cell(45,5,'Sosiologi',1,0,'L',0); 
        $pdf->Cell(15,5,'',1,0,'C',0);
        $pdf->Cell(20,5,'',1,0,'C',0);
        $pdf->Cell(105,5,'',1,1,'L',0);
        // //baris 18
        // $pdf->Cell(10,5,'1',1,0,'C',0);  // cell with left and right borders
        // $pdf->Cell(45,5,'Geografi',1,0,'L',0); 
        // $pdf->Cell(15,5,'',1,0,'C',0);
        // $pdf->Cell(20,5,'',1,0,'C',0);
        // $pdf->Cell(105,5,'',1,1,'L',0);
        // //baris 19
        // $pdf->Cell(10,5,'2',1,0,'C',0);  // cell with left and right borders
        // $pdf->Cell(45,5,'Sosiologi',1,0,'L',0); 
        // $pdf->Cell(15,5,'',1,0,'C',0);
        // $pdf->Cell(20,5,'',1,0,'C',0);
        // $pdf->Cell(105,5,'',1,1,'L',0);
        // //baris 20
        // $pdf->Cell(10,5,'3',1,0,'C',0);  // cell with left and right borders
        // $pdf->Cell(45,5,'Ekonomi',1,0,'L',0); 
        // $pdf->Cell(15,5,'',1,0,'C',0);
        // $pdf->Cell(20,5,'',1,0,'C',0);
        // $pdf->Cell(105,5,'',1,1,'L',0);
        // //baris 21
        // $pdf->Cell(10,5,'4',1,0,'C',0);  // cell with left and right borders
        // $pdf->Cell(45,5,'Sejarah',1,0,'L',0); 
        // $pdf->Cell(15,5,'',1,0,'C',0);
        // $pdf->Cell(20,5,'',1,0,'C',0);
        // $pdf->Cell(105,5,'',1,1,'L',0);
        // //baris 22
        // $pdf->Cell(10,5,'5',1,0,'C',0);  // cell with left and right borders
        // $pdf->Cell(45,5,'Bahasa dan Sastra Arab',1,0,'L',0); 
        // $pdf->Cell(15,5,'',1,0,'C',0);
        // $pdf->Cell(20,5,'',1,0,'C',0);
        // $pdf->Cell(105,5,'',1,1,'L',0);
        // //baris 23
        // $pdf->Cell(10,5,'6',1,0,'C',0);  // cell with left and right borders
        // $pdf->Cell(45,5,'Biologi',1,0,'L',0); 
        // $pdf->Cell(15,5,'',1,0,'C',0);
        // $pdf->Cell(20,5,'',1,0,'C',0);
        // $pdf->Cell(105,5,'',1,1,'L',0);

        //ttd
        $pdf->SetY(195);
        $pdf->SetFont('Arial', '', 10); //setting jenis font yang akan digunakan
        $pdf->Cell(35, 5, '', 0, 0, 'L');
        $pdf->Cell(95, 5, '', 0, 0, 'L');
        //header kiri
        $pdf->Cell(35, 10, 'Tangerang, '.$tgl.'', 0, 1, 'L');
        $pdf->Cell(35, 0, '', 0, 0, 'L');
        $pdf->Cell(95, 0, '', 0, 0, 'L');
        $pdf->Cell(35, 0, 'Wali Kelas', 0, 1, 'L');

        $pdf->SetY(220);
        $pdf->Cell(35, 5, '', 0, 0, 'L');
        $pdf->Cell(95, 5, '', 0, 0, 'L');
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(35, 3, $namaWK, 0, 1, 'L');
        $pdf->Cell(35, 5, '', 0, 0, 'L');
        $pdf->Cell(95, 5, '', 0, 0, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(35, 5, 'NIP. '.$niWK, 0, 1, 'L');

        //footer
        $pdf->SetY(265);
        //garis
        $pdf->Cell(195, 1, '', 'B', 1, 'L');
        $pdf->SetFont('Arial','I',8);
        $pdf->Cell(170,10, $ket.'  '.$jurusan.'  '.$nomor.'  |  '.$nama.'  |  '.$nomorInduk, 0,0,'L');
        $pdf->Cell(0,10,'eRapor  SMA  |  Hal  : '.$pdf->PageNo(),0,0,'C');

        $pdf->AddPage(); //Halaman Baru

        //header kanan
        $pdf->SetFont('Arial', '', 10); //setting jenis font yang akan digunakan
        $pdf->Cell(35, 5, 'Nama Sekolah', 0, 0, 'L');
        $pdf->Cell(95, 5, ': SMAS ISLAMIC CENTRE', 0, 0, 'L');
        //header kiri
        $pdf->Cell(35, 5, 'Kelas', 0, 0, 'L');
        $pdf->Cell(95, 5, ': ' . $ket . ' ' . $jurusan . ' ' . $nomor . '', 0, 1, 'L');

        //header kanan
        $pdf->Cell(35, 5, 'Alamat', 0, 0, 'L');
        $pdf->Cell(95, 5, ': JL. CIUJUNG RAYA NO. 4', 0, 0, 'L');
        //header kiri
        $pdf->Cell(35, 5, 'Semester', 0, 0, 'L');
        $pdf->Cell(95, 5, ': 1 (Satu)', 0, 1, 'L');

        //header kanan
        $pdf->Cell(35, 5, 'Nama', 0, 0, 'L');
        $pdf->Cell(95, 5, ': ' . $nama . '', 0, 0, 'L');
        //header kiri
        $pdf->Cell(35, 5, 'Tahun Pelajaran', 0, 0, 'L');
        $pdf->Cell(95, 5, ': ' . $ta . '', 0, 1, 'L');

        //header kanan
        $pdf->Cell(35, 5, 'Nomor Induk/NISN', 0, 0, 'L');
        $pdf->Cell(95, 5, ': ' . $nomorInduk . ' / ', 0, 1, 'L');
        //garis
        $pdf->Cell(195, 1, '', 'B', 1, 'L');

        //isi
        $pdf->SetFont('Arial', 'B', 10); //setting jenis font yang akan digunakan
        $pdf->Cell(35, 10, 'B. KETERAMPILAN', 0, 1, 'L');
        $pdf->Cell(35, 0, 'Kriteria Ketuntasan Minimal = 65', 0, 1, 'L');

        //tabel
        $pdf->Cell(10,5,'',0,1);
        $pdf->SetFont('Arial', 'B', 10);
        //baris satu yang menguras tenaga
        $pdf->Cell(10,5,' ','LTR',0,'L',0);   // empty cell with left,top, and right borders
        $pdf->Cell(45,5,' ','LTR',0,'L',0);
        $pdf->Cell(140,5,'Keterampilan',1,1,'C',0);
        $pdf->Cell(10,5,'No','LBR',0,'C',0);  // cell with left and right borders
        $pdf->Cell(45,5,'Mata Pelajaran','LBR',0,'C',0);  // cell with left and right borders
        $pdf->Cell(15,5,'Nilai',1,0,'C',0);
        $pdf->Cell(20,5,'$predikat',1,0,'C',0);
        $pdf->Cell(105,5,'Deskripsi',1,1,'C',0);

        //baris dua
        $pdf->Cell(195,5,'Kelompok A','LBR',1,'L',0);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(10,5,'','LTR',0,'C',0);  // cell with left and right borders
        $start_x=$pdf->GetX(); //initial x (start of column position)
        $current_y = $pdf->GetY();
        $current_x = $pdf->GetX();

        $cell_width = 45;  //define cell width
        $cell_height=5;    //define cell height
        $pdf->MultiCell($cell_width,$cell_height,'Pendidikan Agama Islam dan Budi Pekerti',1, 'L'); //print one cell value
        $current_x+=$cell_width;                           //calculate position for next cell
        $pdf->SetXY($current_x, $current_y);
        // $pdf->Cell(50,5,'Pendidikan Agama Islam dan Budi Pekerti',1,0,'L',0);  // cell with left and right borders
        $pdf->Cell(15,5,'','LTR',0,'C',0);
        $pdf->Cell(20,5,'','LTR',0,'C',0);
        $pdf->Cell(105,5,'','LTR',1,'L',0);
        
        $pdf->Cell(10,5,'1','LBR',0,'C',0);  // cell with left and right borders
        $pdf->Cell(45,5,'','LBR',0,'C',0); //ga usah diisi
        $pdf->Cell(15,5,'','LBR',0,'C',0);
        $pdf->Cell(20,5,'','LBR',0,'C',0);
        $pdf->Cell(105,5,'','LBR',1,'L',0);
        
        //baris tiga
        $pdf->Cell(10,5,'','LTR',0,'C',0);  // cell with left and right borders
        $start_x=$pdf->GetX(); //initial x (start of column position)
        $current_y = $pdf->GetY();
        $current_x = $pdf->GetX();

        $cell_width = 45;  //define cell width
        $cell_height=5;    //define cell height
        $pdf->MultiCell($cell_width,$cell_height,'Pendidikan Pancasila dan Kewarganegaraan',1, 'L'); //print one cell value
        $current_x+=$cell_width;                           //calculate position for next cell
        $pdf->SetXY($current_x, $current_y);
        $pdf->Cell(15,5,'','LTR',0,'C',0);
        $pdf->Cell(20,5,'','LTR',0,'C',0);
        $pdf->Cell(105,5,'','LTR',1,'L',0);
        
        $pdf->Cell(10,5,'2','LBR',0,'C',0);  // cell with left and right borders
        $pdf->Cell(45,5,'','LBR',0,'C',0); //ga usah diisi
        $pdf->Cell(15,5,'','LBR',0,'C',0);
        $pdf->Cell(20,5,'','LBR',0,'C',0);
        $pdf->Cell(105,5,'','LBR',1,'L',0);

        //baris empat
        $pdf->Cell(10,5,'3',1,0,'C',0);  // cell with left and right borders
        $pdf->Cell(45,5,'Bahasa Indonesia',1,0,'L',0); 
        $pdf->Cell(15,5,'',1,0,'C',0);
        $pdf->Cell(20,5,'',1,0,'C',0);
        $pdf->Cell(105,5,'',1,1,'L',0);

        //baris lima
        $pdf->Cell(10,5,'4',1,0,'C',0);  // cell with left and right borders
        $pdf->Cell(45,5,'Matematika (Umum)',1,0,'L',0); 
        $pdf->Cell(15,5,'',1,0,'C',0);
        $pdf->Cell(20,5,'',1,0,'C',0);
        $pdf->Cell(105,5,'',1,1,'L',0);

        //baris enam
        $pdf->Cell(10,5,'5',1,0,'C',0);  // cell with left and right borders
        $pdf->Cell(45,5,'Sejarah Indonesia',1,0,'L',0); 
        $pdf->Cell(15,5,'',1,0,'C',0);
        $pdf->Cell(20,5,'',1,0,'C',0);
        $pdf->Cell(105,5,'',1,1,'L',0);

        //baris tujuh
        $pdf->Cell(10,5,'6',1,0,'C',0);  // cell with left and right borders
        $pdf->Cell(45,5,'Bahasa Inggris',1,0,'L',0); 
        $pdf->Cell(15,5,'',1,0,'C',0);
        $pdf->Cell(20,5,'',1,0,'C',0);
        $pdf->Cell(105,5,'',1,1,'L',0);

        //baris delapan
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(195,5,'Kelompok B','LBR',1,'L',0);
        $pdf->SetFont('Arial', '', 10);

        //baris sembilan
        $pdf->Cell(10,5,'1',1,0,'C',0);  // cell with left and right borders
        $pdf->Cell(45,5,'Seni Budaya',1,0,'L',0); 
        $pdf->Cell(15,5,'',1,0,'C',0);
        $pdf->Cell(20,5,'',1,0,'C',0);
        $pdf->Cell(105,5,'',1,1,'L',0);

        //baris 10
        $pdf->Cell(10,5,'','LTR',0,'C',0);  // cell with left and right borders
        $start_x=$pdf->GetX(); //initial x (start of column position)
        $current_y = $pdf->GetY();
        $current_x = $pdf->GetX();

        $cell_width = 45;  //define cell width
        $cell_height=5;    //define cell height
        $pdf->MultiCell($cell_width,$cell_height,'Pendidikan Jasmani, Olahraga, dan Kesehatan',1,'L'); //print one cell value
        $current_x+=$cell_width;                           //calculate position for next cell
        $pdf->SetXY($current_x, $current_y);
        $pdf->Cell(15,5,'','LTR',0,'C',0);
        $pdf->Cell(20,5,'','LTR',0,'C',0);
        $pdf->Cell(105,5,'','LTR',1,'L',0);
        
        $pdf->Cell(10,5,'2','LBR',0,'C',0);  // cell with left and right borders
        $pdf->Cell(45,5,'','LBR',0,'C',0); //ga usah diisi
        $pdf->Cell(15,5,'','LBR',0,'C',0);
        $pdf->Cell(20,5,'','LBR',0,'C',0);
        $pdf->Cell(105,5,'','LBR',1,'L',0);
        
        //baris 11
        $pdf->Cell(10,5,'','LTR',0,'C',0);  // cell with left and right borders
        $start_x=$pdf->GetX(); //initial x (start of column position)
        $current_y = $pdf->GetY();
        $current_x = $pdf->GetX();

        $cell_width = 45;  //define cell width
        $cell_height=5;    //define cell height
        $pdf->MultiCell($cell_width,$cell_height,'Prakarya dan Kewirausahaan',1, 'L'); //print one cell value
        $current_x+=$cell_width;                           //calculate position for next cell
        $pdf->SetXY($current_x, $current_y);
        // $pdf->Cell(50,5,'Pendidikan Agama Islam dan Budi Pekerti',1,0,'L',0);  // cell with left and right borders
        $pdf->Cell(15,5,'','LTR',0,'C',0);
        $pdf->Cell(20,5,'','LTR',0,'C',0);
        $pdf->Cell(105,5,'','LTR',1,'L',0);
        
        $pdf->Cell(10,5,'3','LBR',0,'C',0);  // cell with left and right borders
        $pdf->Cell(45,5,'','LBR',0,'C',0); //ga usah diisi
        $pdf->Cell(15,5,'','LBR',0,'C',0);
        $pdf->Cell(20,5,'','LBR',0,'C',0);
        $pdf->Cell(105,5,'','LBR',1,'L',0);

        //baris 12
        $pdf->Cell(10,5,'','LTR',0,'C',0);  // cell with left and right borders
        $start_x=$pdf->GetX(); //initial x (start of column position)
        $current_y = $pdf->GetY();
        $current_x = $pdf->GetX();

        $cell_width = 45;  //define cell width
        $cell_height=5;    //define cell height
        $pdf->MultiCell($cell_width,$cell_height,'Bahasa Arab Quran (Muatan Lokal)',1, 'L'); //print one cell value
        $current_x+=$cell_width;                           //calculate position for next cell
        $pdf->SetXY($current_x, $current_y);
        // $pdf->Cell(50,5,'Pendidikan Agama Islam dan Budi Pekerti',1,0,'L',0);  // cell with left and right borders
        $pdf->Cell(15,5,'','LTR',0,'C',0);
        $pdf->Cell(20,5,'','LTR',0,'C',0);
        $pdf->Cell(105,5,'','LTR',1,'L',0);
        
        $pdf->Cell(10,5,'4','LBR',0,'C',0);  // cell with left and right borders
        $pdf->Cell(45,5,'','LBR',0,'C',0); //ga usah diisi
        $pdf->Cell(15,5,'','LBR',0,'C',0);
        $pdf->Cell(20,5,'','LBR',0,'C',0);
        $pdf->Cell(105,5,'','LBR',1,'L',0);

        //baris 13
        $pdf->Cell(10,5,'5',1,0,'C',0);  // cell with left and right borders
        $pdf->Cell(45,5,'English Conversation',1,0,'L',0); 
        $pdf->Cell(15,5,'',1,0,'C',0);
        $pdf->Cell(20,5,'',1,0,'C',0);
        $pdf->Cell(105,5,'',1,1,'L',0);

        //baris 14
        $pdf->Cell(10,5,'6',1,0,'C',0);  // cell with left and right borders
        $pdf->Cell(45,5,'Aqidah Akhlah',1,0,'L',0); 
        $pdf->Cell(15,5,'',1,0,'C',0);
        $pdf->Cell(20,5,'',1,0,'C',0);
        $pdf->Cell(105,5,'',1,1,'L',0);

        //baris 15
        $pdf->Cell(10,5,'7',1,0,'C',0);  // cell with left and right borders
        $pdf->Cell(45,5,'Bimbingan TIK',1,0,'L',0); 
        $pdf->Cell(15,5,'',1,0,'C',0);
        $pdf->Cell(20,5,'',1,0,'C',0);
        $pdf->Cell(105,5,'',1,1,'L',0);

        //baris 16
        $pdf->Cell(10,5,'8',1,0,'C',0);  // cell with left and right borders
        $pdf->Cell(45,5,'Muhadoroh',1,0,'L',0); 
        $pdf->Cell(15,5,'',1,0,'C',0);
        $pdf->Cell(20,5,'',1,0,'C',0);
        $pdf->Cell(105,5,'',1,1,'L',0);

        //baris 17
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(195,5,'Kelompok C','LBR',1,'L',0);
        $pdf->SetFont('Arial', '', 10);

        //baris 18
        $pdf->Cell(10,5,'1',1,0,'C',0);  // cell with left and right borders
        $pdf->Cell(45,5,'Matematika (Peminatan)',1,0,'L',0); 
        $pdf->Cell(15,5,'',1,0,'C',0);
        $pdf->Cell(20,5,'',1,0,'C',0);
        $pdf->Cell(105,5,'',1,1,'L',0);
        
        //baris 19
        $pdf->Cell(10,5,'2',1,0,'C',0);  // cell with left and right borders
        $pdf->Cell(45,5,'Biologi',1,0,'L',0); 
        $pdf->Cell(15,5,'',1,0,'C',0);
        $pdf->Cell(20,5,'',1,0,'C',0);
        $pdf->Cell(105,5,'',1,1,'L',0);

        //baris 20
        $pdf->Cell(10,5,'3',1,0,'C',0);  // cell with left and right borders
        $pdf->Cell(45,5,'Fisika',1,0,'L',0); 
        $pdf->Cell(15,5,'',1,0,'C',0);
        $pdf->Cell(20,5,'',1,0,'C',0);
        $pdf->Cell(105,5,'',1,1,'L',0);

        //baris 21
        $pdf->Cell(10,5,'4',1,0,'C',0);  // cell with left and right borders
        $pdf->Cell(45,5,'Kimia',1,0,'L',0); 
        $pdf->Cell(15,5,'',1,0,'C',0);
        $pdf->Cell(20,5,'',1,0,'C',0);
        $pdf->Cell(105,5,'',1,1,'L',0);

        //baris 22
        $pdf->Cell(10,5,'5',1,0,'C',0);  // cell with left and right borders
        $pdf->Cell(45,5,'Bahasa dan Sastra Arab',1,0,'L',0); 
        $pdf->Cell(15,5,'',1,0,'C',0);
        $pdf->Cell(20,5,'',1,0,'C',0);
        $pdf->Cell(105,5,'',1,1,'L',0);

        //baris 23
        $pdf->Cell(10,5,'6',1,0,'C',0);  // cell with left and right borders
        $pdf->Cell(45,5,'Sosiologi',1,0,'L',0); 
        $pdf->Cell(15,5,'',1,0,'C',0);
        $pdf->Cell(20,5,'',1,0,'C',0);
        $pdf->Cell(105,5,'',1,1,'L',0);
        // //baris 18
        // $pdf->Cell(10,5,'1',1,0,'C',0);  // cell with left and right borders
        // $pdf->Cell(45,5,'Geografi',1,0,'L',0); 
        // $pdf->Cell(15,5,'',1,0,'C',0);
        // $pdf->Cell(20,5,'',1,0,'C',0);
        // $pdf->Cell(105,5,'',1,1,'L',0);
        // //baris 19
        // $pdf->Cell(10,5,'2',1,0,'C',0);  // cell with left and right borders
        // $pdf->Cell(45,5,'Sosiologi',1,0,'L',0); 
        // $pdf->Cell(15,5,'',1,0,'C',0);
        // $pdf->Cell(20,5,'',1,0,'C',0);
        // $pdf->Cell(105,5,'',1,1,'L',0);
        // //baris 20
        // $pdf->Cell(10,5,'3',1,0,'C',0);  // cell with left and right borders
        // $pdf->Cell(45,5,'Ekonomi',1,0,'L',0); 
        // $pdf->Cell(15,5,'',1,0,'C',0);
        // $pdf->Cell(20,5,'',1,0,'C',0);
        // $pdf->Cell(105,5,'',1,1,'L',0);
        // //baris 21
        // $pdf->Cell(10,5,'4',1,0,'C',0);  // cell with left and right borders
        // $pdf->Cell(45,5,'Sejarah',1,0,'L',0); 
        // $pdf->Cell(15,5,'',1,0,'C',0);
        // $pdf->Cell(20,5,'',1,0,'C',0);
        // $pdf->Cell(105,5,'',1,1,'L',0);
        // //baris 22
        // $pdf->Cell(10,5,'5',1,0,'C',0);  // cell with left and right borders
        // $pdf->Cell(45,5,'Bahasa dan Sastra Arab',1,0,'L',0); 
        // $pdf->Cell(15,5,'',1,0,'C',0);
        // $pdf->Cell(20,5,'',1,0,'C',0);
        // $pdf->Cell(105,5,'',1,1,'L',0);
        // //baris 23
        // $pdf->Cell(10,5,'6',1,0,'C',0);  // cell with left and right borders
        // $pdf->Cell(45,5,'Biologi',1,0,'L',0); 
        // $pdf->Cell(15,5,'',1,0,'C',0);
        // $pdf->Cell(20,5,'',1,0,'C',0);
        // $pdf->Cell(105,5,'',1,1,'L',0);

        //tabel interval
        $pdf->SetFont('Arial', 'B', 10); //setting jenis font yang akan digunakan
        $pdf->Cell(35, 10, 'Tabel interval $predikat berdasarkan KKM', 0, 1, 'L');

        $pdf->Cell(39,5,' ','LTR',0,'L',0);   // empty cell with left,top, and right borders
        $pdf->Cell(156,5,'$predikat',1,1,'C',0);
        $pdf->Cell(39,5,'KKM','LBR',0,'C',0);  // cell with left and right borders
        $pdf->Cell(39,5,'D',1,0,'C',0);
        $pdf->Cell(39,5,'C',1,0,'C',0);
        $pdf->Cell(39,5,'B',1,0,'C',0);
        $pdf->Cell(39,5,'A',1,1,'C',0);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(39,5,'65',1,0,'C',0);  // cell with left and right borders
        $pdf->Cell(39,5,'Nilai < 65',1,0,'C',0);
        $pdf->Cell(39,5,'65 <= Nilai < 77',1,0,'C',0);
        $pdf->Cell(39,5,'77 <= Nilai < 89',1,0,'C',0);
        $pdf->Cell(39,5,'Nilai >= 89',1,1,'C',0);

        //ttd
        $pdf->SetY(220);
        $pdf->SetFont('Arial', '', 10); //setting jenis font yang akan digunakan
        $pdf->Cell(35, 5, '', 0, 0, 'L');
        $pdf->Cell(95, 5, '', 0, 0, 'L');
        //header kiri
        $pdf->Cell(35, 10, 'Tangerang, '.$tgl.'', 0, 1, 'L');
        $pdf->Cell(35, 0, '', 0, 0, 'L');
        $pdf->Cell(95, 0, '', 0, 0, 'L');
        $pdf->Cell(35, 0, 'Wali Kelas', 0, 1, 'L');

        $pdf->SetY(245);
        $pdf->Cell(35, 5, '', 0, 0, 'L');
        $pdf->Cell(95, 5, '', 0, 0, 'L');
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(35, 3, $namaWK, 0, 1, 'L');
        $pdf->Cell(35, 5, '', 0, 0, 'L');
        $pdf->Cell(95, 5, '', 0, 0, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(35, 5, 'NIP. '.$niWK, 0, 1, 'L');

        //footer
        $pdf->SetY(265);
        //garis
        $pdf->Cell(195, 1, '', 'B', 1, 'L');
        $pdf->SetFont('Arial','I',8);
        $pdf->Cell(170,10, $ket.'  '.$jurusan.'  '.$nomor.'  |  '.$nama.'  |  '.$nomorInduk, 0,0,'L');
        $pdf->Cell(0,10,'eRapor  SMA  |  Hal  : '.$pdf->PageNo(),0,0,'C');

        $pdf->AddPage(); //Halaman Baru

        $siswa = $this->m_rapor->dataSiswa($id)->result();
        foreach ($siswa as $list) {
            $nama = $list->namaUser;
            $nomorInduk = $list->nomorInduk;
            $ket = $list->ketKelas;
            $jurusan = $list->jurusanKelas;
            $nomor = $list->nomorKelas;
            $ta = $list->tahunAjaran;
        }

        //header kanan
        $pdf->SetFont('Arial', '', 10); //setting jenis font yang akan digunakan
        $pdf->Cell(35, 5, 'Nama Sekolah', 0, 0, 'L');
        $pdf->Cell(95, 5, ': SMAS ISLAMIC CENTRE', 0, 0, 'L');
        //header kiri
        $pdf->Cell(35, 5, 'Kelas', 0, 0, 'L');
        $pdf->Cell(95, 5, ': ' . $ket . ' ' . $jurusan . ' ' . $nomor . '', 0, 1, 'L');

        //header kanan
        $pdf->Cell(35, 5, 'Alamat', 0, 0, 'L');
        $pdf->Cell(95, 5, ': JL. CIUJUNG RAYA NO. 4', 0, 0, 'L');
        //header kiri
        $pdf->Cell(35, 5, 'Semester', 0, 0, 'L');
        $pdf->Cell(95, 5, ': 1 (Satu)', 0, 1, 'L');

        //header kanan
        $pdf->Cell(35, 5, 'Nama', 0, 0, 'L');
        $pdf->Cell(95, 5, ': ' . $nama . '', 0, 0, 'L');
        //header kiri
        $pdf->Cell(35, 5, 'Tahun Pelajaran', 0, 0, 'L');
        $pdf->Cell(95, 5, ': ' . $ta . '', 0, 1, 'L');

        //header kanan
        $pdf->Cell(35, 5, 'Nomor Induk/NISN', 0, 0, 'L');
        $pdf->Cell(95, 5, ': ' . $nomorInduk . ' / ', 0, 1, 'L');
        //garis
        $pdf->Cell(195, 1, '', 'B', 1, 'L');

        //isi
        $pdf->SetFont('Arial', 'B', 10); //setting jenis font yang akan digunakan
        $pdf->Cell(35, 10, 'D. EKSTRAKURIKULER', 0, 1, 'L');

        //tabel
        $pdf->Cell(10,0,'',0,1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(10,6,'No',1,0, 'C');
        $pdf->Cell(50,6,'Kegiatan Ekstrakurikuler',1,0, 'C');
        $pdf->Cell(30,6,'$predikat',1,0, 'C');
        $pdf->Cell(105,6,'Keterangan',1,1, 'C');
        $pdf->SetFont('Arial', '', 10);

        //isi
        $pdf->Cell(35, 5, '', 0, 1, 'L');
        $pdf->SetFont('Arial', 'B', 10); //setting jenis font yang akan digunakan
        $pdf->Cell(35, 10, 'E. PRESTASI', 0, 1, 'L');

        //tabel
        $pdf->Cell(10,0,'',0,1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(10,6,'No',1,0, 'C');
        $pdf->Cell(50,6,'Jenis Prestasi',1,0, 'C');
        $pdf->Cell(135,6,'Keterangan',1,1, 'C');
        $pdf->SetFont('Arial', '', 10);

        //isi
        $pdf->Cell(35, 5, '', 0, 1, 'L');
        $pdf->SetFont('Arial', 'B', 10); //setting jenis font yang akan digunakan
        $pdf->Cell(35, 10, 'F. KETIDAKHADIRAN', 0, 1, 'L');

        //tabel
        $pdf->Cell(10,0,'',0,1);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(60,6,'      Sakit',1,0, 'L');
        $pdf->Cell(35,6,':              Hari     ',1,1, 'L');
        $pdf->Cell(60,6,'      Izin',1,0, 'L');
        $pdf->Cell(35,6,':              Hari     ',1,1, 'L');
        $pdf->Cell(60,6,'      Tanpa Keterangan',1,0, 'L');
        $pdf->Cell(35,6,':              Hari     ',1,1, 'L');
        $pdf->SetFont('Arial', '', 10);

        date_default_timezone_set('Asia/Jakarta');// change according timezone
        $tgl = date( 'd F Y', time ());
        $wk = $this->m_rapor->getId($id)->result();
        foreach ($wk as $list) {
            $namaWK = $list->namaUser;
            $niWK = $list->nomorInduk;
        }

        //ttd
        $pdf->SetY(115);
        $pdf->SetFont('Arial', '', 10); //setting jenis font yang akan digunakan
        $pdf->Cell(35, 10, 'Mengetahui', 0, 0, 'L');
        $pdf->Cell(95, 0, '', 0, 0, 'L');
        $pdf->Cell(35, 10, 'Tangerang, '.$tgl.'', 0, 1, 'L');
        $pdf->Cell(35, 0, 'Orang Tua/Wali,', 0, 0, 'L');
        $pdf->Cell(95, 0, '', 0, 0, 'L');
        $pdf->Cell(35, 0, 'Wali Kelas', 0, 1, 'L');
        $pdf->Cell(35, 0, '', 0, 0, 'L');
        $pdf->SetY(140);
        $pdf->Cell(35, 3, '..........................', 0, 0, 'L');
        $pdf->Cell(95, 5, '', 0, 0, 'L');
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(35, 3, $namaWK, 0, 1, 'L');
        $pdf->Cell(35, 5, '', 0, 0, 'L');
        $pdf->Cell(95, 5, '', 0, 0, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(35, 5, 'NIP. '.$niWK, 0, 1, 'L');

        //tengah
        $pdf->SetY(150);
        $pdf->SetFont('Arial', '', 10); //setting jenis font yang akan digunakan
        $pdf->Cell(70, 5, '', 0, 0, 'L');
        //header kiri
        $pdf->Cell(35, 10, 'Mengetahui,', 0, 1, 'L');
        $pdf->Cell(70, 0, '', 0, 0, 'L');
        $pdf->Cell(35, 0, 'Kepala Sekolah', 0, 1, 'L');

        $pdf->SetY(175);
        $pdf->Cell(70, 5, '', 0, 0, 'L');
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(35, 3, 'Sumardi, S.Pd. , M.MM..', 0, 1, 'L');
        $pdf->Cell(70, 5, '', 0, 0, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(35, 5, 'NIP. 196804211998021002', 0, 1, 'L');


        //footer
        $pdf->SetY(265);
        //garis
        $pdf->Cell(195, 1, '', 'B', 1, 'L');
        $pdf->SetFont('Arial','I',8);
        $pdf->Cell(170,10, $ket.'  '.$jurusan.'  '.$nomor.'  |  '.$nama.'  |  '.$nomorInduk, 0,0,'L');
        $pdf->Cell(0,10,'eRapor  SMA  |  Hal  : '.$pdf->PageNo(),0,0,'C');

        $pdf->Output();
    }
}
