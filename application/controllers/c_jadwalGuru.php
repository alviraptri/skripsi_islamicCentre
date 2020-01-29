<?php
class c_jadwalGuru extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model(array('m_jadwalGuru'));
        $this->load->library('pdf');
    }
    function index()
    {
        $pdf = new FPDF('P', 'cm', 'A3'); //set Page
        $pdf->SetMargins(1,0,1); //margin
        $pdf->AddPage(); //Halaman Baru

        //HEADER
        $pdf->SetFont('Arial', '', 13); //setting jenis font yang akan digunakan
        $pdf->Cell(19,1, '', 0, 1, 'C');
        $pdf->Cell(19,1, 'DAFTAR PEMBAGIAN TUGAS MENGAJAR GURU (PENDIDIK) SMAS ISLAMIC CENTRE', 0, 1, 'C');
        $pdf->Cell(19,0, 'SEMESTER GANJIL TAHUN PELAJARAN 2019-2020', 0, 1, 'C');

        //tabel jadwal
		//header tabel
		//baris satu
        $pdf->Cell(19,0.6,'',0,1);
        $pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(0.7,0.6,' ','LTR',0,'L',0);   // empty cell with left,top, and right borders
		$pdf->Cell(4,0.6,' ','LTR',0,'L',0);
		$pdf->Cell(1,0.6,' ','LTR',0,'L',0);   // empty cell with left,top, and right borders
		$pdf->Cell(0.7,0.6,' ','LTR',0,'L',0);
		$pdf->Cell(4.8,0.6,' ','LTR',0,'L',0);
		$pdf->Cell(7.5,0.6,'Jam Mengajar Mata Pelajaran dan Kurikulum',1,0, 'C');
		$pdf->Cell(1,0.6,' ','LTR',1,'L',0);

		//baris dua
		$pdf->Cell(0.7,0.6,' ','LR',0,'L',0);   // empty cell with left,top, and right borders
		$pdf->Cell(4,0.6,' ','LR',0,'L',0);
		$pdf->Cell(1,0.6,' ','LR',0,'L',0);   // empty cell with left,top, and right borders
		$pdf->Cell(0.7,0.6,' ','LR',0,'L',0);
		$pdf->Cell(4.8,0.6,' ','LR',0,'L',0);
		$pdf->Cell(7.5,0.6,'Kurikulum KTSP 2013 (Kurikulum Nasional)',1,0, 'C');
		$pdf->Cell(1,0.6,' ','LR',1,'L',0);

		//baris tiga
		$pdf->Cell(0.7,0.6,'No.','LR',0, 'C');
		$pdf->Cell(4,0.6,'Nama Guru','LR',0, 'C');
		$start_x=$pdf->GetX(); //initial x (start of column position)
        $current_y = $pdf->GetY();
        $current_x = $pdf->GetX();
        $cell_width = 1;  //define cell width
        $cell_height=0.3;    //define cell height
        $pdf->MultiCell($cell_width,$cell_height,'Kode Guru','LR', 'C'); //print one cell value
        $current_x+=$cell_width;                           //calculate position for next cell
        $pdf->SetXY($current_x, $current_y);
		$pdf->Cell(0.7,0.6,'L/P','LR',0, 'C');
		$pdf->Cell(4.8,0.6,'Mata Pelajaran','LR',0, 'C');
		//ambil ket kelas
		$kelas = $this->m_jadwalGuru->kelas()->result();
		foreach ($kelas as $list) {
			$ketKls = $list->ketKelas;
			$pdf->Cell(2.5,0.6,'Kelas '.$ketKls,'LBR',0, 'C');
		}
		$pdf->Cell(1,0.6,'Total','LR',1, 'C');

		//baris empat
		$pdf->Cell(0.7,0.6,' ','LR',0,'L',0);   // empty cell with left,top, and right borders
		$pdf->Cell(4,0.6,' ','LR',0,'L',0);
		$pdf->Cell(1,0.6,' ','LR',0,'L',0);   // empty cell with left,top, and right borders
		$pdf->Cell(0.7,0.6,' ','LR',0,'L',0);
		$pdf->Cell(4.8,0.6,' ','LR',0,'L',0);
		//ambil jurusan kelas
		$pdf->SetFont('Arial', 'B', 6);
		$jurusan = $this->m_jadwalGuru->jurusan()->result();
		foreach ($jurusan as $list) {
			$jurusanKls = $list->jurusanKelas;
			$pdf->Cell(0.46875,0.6,$jurusanKls,'LBR',0, 'C');
		}
		$pdf->Cell(1,0.6,' ','LR',1,'L',0);

		$pdf->SetFont('Arial', 'B', 8);
		//baris LIMA
		$pdf->Cell(0.7,0.6,' ','LBR',0,'L',0);   // empty cell with left,top, and right borders
		$pdf->Cell(4,0.6,' ','LBR',0,'L',0);
		$pdf->Cell(1,0.6,' ','LBR',0,'L',0);   // empty cell with left,top, and right borders
		$pdf->Cell(0.7,0.6,' ','LBR',0,'L',0);
		$pdf->Cell(4.8,0.6,' ','LBR',0,'L',0);
		//ambil jurusan kelas
		$jurusan = $this->m_jadwalGuru->jurusan()->result();
		foreach ($jurusan as $list) {
			$nomorKls = $list->nomorKelas;
			$pdf->Cell(0.46875,0.6,$nomorKls,'LBR',0, 'C');
		}
		$pdf->Cell(1,0.6,' ','LBR',1,'L',0);

		//baris LIMA
		//ambil nama guru
		$pdf->SetFont('Arial', '', 6.5);
		$nama = $this->m_jadwalGuru->jadwalNama()->result();
		$counter = 1;
		foreach ($nama as $list) {
			$pdf->Cell(0.7,0.6,$counter,'LBR',0,'L',0);   // empty cell with left,top, and right borders
			$pdf->Cell(4,0.6,$list->namaUser,'LBR',0,'L',0);
			$pdf->Cell(1,0.6, '','LBR',0,'C',0);
			if ($list->jenisKelamin == 1) {
				$pdf->Cell(0.7,0.6,'L','LBR',0,'C',0);
			}
			else {
				$pdf->Cell(0.7,0.6,'P','LBR',0,'C',0);
			}
			$pdf->Cell(4.8,0.6,$list->namaMapel,'LBR',0,'L',0);   
			//ambil jurusan kelas
			$jurusan = $this->m_jadwalGuru->jurusan()->result();
			foreach ($jurusan as $list) {
				$nomorKls = $list->nomorKelas;
				$pdf->Cell(0.46875,0.6,$nomorKls,'LBR',0, 'C');
			}
			$pdf->Cell(1,0.6,' ','LBR',1,'L');

			$counter++;
		}

        $pdf->Output();
    }
}
?>