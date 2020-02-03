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
		$pdf->SetMargins(1, 0, 1); //margin
		$pdf->AddPage(); //Halaman Baru

		//HEADER
		$pdf->SetFont('Arial', '', 13); //setting jenis font yang akan digunakan
		$pdf->Cell(50, 1, '', 0, 1, 'C');
		$pdf->Cell(28, 1, 'DAFTAR PEMBAGIAN TUGAS MENGAJAR GURU (PENDIDIK) SMAS ISLAMIC CENTRE', 0, 1, 'C');
		$pdf->Cell(28, 0, 'SEMESTER GANJIL TAHUN PELAJARAN 2019-2020', 0, 1, 'C');

		//tabel jadwal
		//header tabel
		//baris satu
		$pdf->Cell(28, 0.7, '', 0, 1);
		$pdf->SetFont('Arial', 'B', 11);
		$pdf->Cell(1, 0.7, ' ', 'LTR', 0, 'L', 0);   // empty cell with left,top, and right borders
		$pdf->Cell(4.5, 0.7, ' ', 'LTR', 0, 'L', 0);
		$pdf->Cell(1, 0.7, ' ', 'LTR', 0, 'L', 0);
		$pdf->Cell(7, 0.7, ' ', 'LTR', 0, 'L', 0);
		$pdf->Cell(12, 0.7, 'Jam Mengajar Mata Pelajaran dan Kurikulum', 1, 0, 'C');
		$pdf->Cell(2, 0.7, ' ', 'LTR', 1, 'L', 0);

		//baris dua
		$pdf->Cell(1, 0.7, ' ', 'LR', 0, 'L', 0);   // empty cell with left,top, and right borders
		$pdf->Cell(4.5, 0.7, ' ', 'LR', 0, 'L', 0);
		$pdf->Cell(1, 0.7, ' ', 'LR', 0, 'L', 0);
		$pdf->Cell(7, 0.7, ' ', 'LR', 0, 'L', 0);
		$pdf->Cell(12, 0.7, 'Kurikulum KTSP 2013 (Kurikulum Nasional)', 1, 0, 'C');
		$pdf->Cell(2, 0.7, ' ', 'LR', 1, 'L', 0);

		//baris tiga
		$pdf->Cell(1, 0.7, 'No.', 'LR', 0, 'C');
		$pdf->Cell(4.5, 0.7, 'Nama Guru', 'LR', 0, 'C');
		$pdf->Cell(1, 0.7, 'L/P', 'LR', 0, 'C');
		$pdf->Cell(7, 0.7, 'Mata Pelajaran', 'LR', 0, 'C');
		//ambil ket kelas
		$kelas = $this->m_jadwalGuru->kelas()->result();
		foreach ($kelas as $list) {
			$ketKls = $list->ketKelas;
			$pdf->Cell(4, 0.7, 'Kelas ' . $ketKls, 'LBR', 0, 'C');
		}
		$pdf->Cell(2, 0.7, 'Total', 'LR', 1, 'C');

		//baris empat
		$pdf->Cell(1, 0.7, ' ', 'LBR', 0, 'L', 0);   // empty cell with left,top, and right borders
		$pdf->Cell(4.5, 0.7, ' ', 'LBR', 0, 'L', 0);
		$pdf->Cell(1, 0.7, ' ', 'LBR', 0, 'L', 0);
		$pdf->Cell(7, 0.7, ' ', 'LBR', 0, 'L', 0);
		//ambil jurusan kelas
		$pdf->SetFont('Arial', 'B', 10);
		$jurusan = $this->m_jadwalGuru->jurusan()->result();
		for ($i = 1; $i <= 3; $i++) {
			foreach ($jurusan as $list) {
				$jurusanKls = $list->jurusanKelas;
				$pdf->Cell(2, 0.7, $jurusanKls, 'LBR', 0, 'C');
			}
		}
		$pdf->Cell(2, 0.7, ' ', 'LBR', 1, 'L', 0);

		//baris LIMA
		//ambil nama guru
		$pdf->SetFont('Arial', '', 9);
		$nama = $this->m_jadwalGuru->jadwalNama()->result();
		$counter = 1;
		foreach ($nama as $list) {
			$nomorInduk = $list->nomorInduk;
			$pdf->Cell(1, 0.7, $counter, 'LBR', 0, 'L', 0);   // empty cell with left,top, and right borders
			$pdf->Cell(4.5, 0.7, $list->namaUser, 'LBR', 0, 'L', 0);
			if ($list->jenisKelamin == 1) {
				$pdf->Cell(1, 0.7, 'L', 'LBR', 0, 'C', 0);
			} else {
				$pdf->Cell(1, 0.7, 'P', 'LBR', 0, 'C', 0);
			}
			$pdf->Cell(7, 0.7, $list->namaMapel, 'LBR', 0, 'L', 0);
			//ambil jurusan kelas
			$jurusan = $this->m_jadwalGuru->jurusan()->result();
			$ketKelas = $this->m_jadwalGuru->ketKelas()->result();
			$totalSemua = 0;
			foreach ($ketKelas as $kls) {
				$keterangan = $kls->ketKelas;
			// }
			// for ($i = 1; $i <= $ket; $i++) {
				foreach ($jurusan as $list) {
					$jurusanKls = $list->jurusanKelas;
					$hasilKelas = $this->m_jadwalGuru->hasilKelas($nomorInduk, $keterangan, $jurusanKls)->num_rows();
					if ($hasilKelas > 0) {
						$pdf->Cell(2, 0.7, $hasilKelas, 'LBR', 0, 'C');
					}
					else {
						$pdf->Cell(2, 0.7, '-', 'LBR', 0, 'C');
					}
					$totalSemua += $hasilKelas; 
				}
			}
			$pdf->Cell(2, 0.7, $totalSemua.' Kelas', 'LBR', 1, 'C', 0);

			$counter++;
		}

		$pdf->Output();
	}
}
