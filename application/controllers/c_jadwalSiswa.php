<?php
class c_jadwalSiswa extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model(array('m_jadwalGuru'));
		$this->load->library('pdf');
	}
	function index($id)
	{
		$pdf = new FPDF('P', 'cm', 'A4'); //set Page
		$pdf->SetMargins(1, 0, 1); //margin
		$pdf->AddPage(); //Halaman Baru

		$jadwal = $this->m_jadwalGuru->jadwalSiswa($id)->result();
		foreach ($jadwal as $list) {
			$ket = $list->ketKelas;
			$jurusan = $list->jurusanKelas;
			$nomor = $list->nomorKelas;
		}

		//HEADER
		$pdf->SetFont('Arial', '', 13); //setting jenis font yang akan digunakan
		$pdf->Cell(50, 1, '', 0, 1, 'C');
		$pdf->Cell(19, 0, 'JADWAL KEGIATAN BELAJAR SMAS ISLAMIC CENTRE', 0, 1, 'C');
		$pdf->Cell(19, 1, 'SEMESTER GANJIL TAHUN PELAJARAN 2019-2020', 0, 1, 'C');
		$pdf->Cell(19, 0, 'KELAS '.$ket. ' '.$jurusan.' '.$nomor, 0, 1, 'C');

		
		$pdf->Cell(28, 0.7, '', 0, 1);
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell(2.2, 0.7, 'Hari', 1, 0, 'C', 0);
		$pdf->Cell(3.5, 0.7, 'Jam', 1, 0, 'C', 0);
		$pdf->Cell(7.5, 0.7, 'Mata Pelajaran', 1, 0, 'C', 0);
		$pdf->Cell(6.3, 0.7, 'Guru', 1, 1, 'C', 0);

		$pdf->SetFont('Arial', '', 10);
		$flagSenin = true;
		foreach ($jadwal as $list) {
			if ($list->hari == "Senin") {
				if ($flagSenin == true) {
					$pdf->Cell(2.2, 0.7, 'Senin', "LT", 0, 'C', 0);
				}
				else {
					$pdf->Cell(2.2, 0.7, '', "L", 0, 'L', 0);
				}
				$pdf->Cell(3.5, 0.7, $list->jamMulai . ' - ' . $list->jamSelesai, 1, 0, 'C', 0);
				$pdf->Cell(7.5, 0.7, $list->namaMapel, 1, 0, 'L', 0);
				$pdf->Cell(6.3, 0.7, $list->namaUser, 1, 1, 'L', 0);
				$flagSenin = false;
			}
		}
		$flagSelasa = true;
		foreach ($jadwal as $list) {
			if ($list->hari == "Selasa") {
				if ($flagSelasa == true) {
					$pdf->Cell(2.2, 0.7, 'Selasa', "LT", 0, 'C', 0);
				}
				else {
					$pdf->Cell(2.2, 0.7, '', "L", 0, 'L', 0);
				}
				$pdf->Cell(3.5, 0.7, $list->jamMulai . ' - ' . $list->jamSelesai, 1, 0, 'C', 0);
				$pdf->Cell(7.5, 0.7, $list->namaMapel, 1, 0, 'L', 0);
				$pdf->Cell(6.3, 0.7, $list->namaUser, 1, 1, 'L', 0);
				$flagSelasa = false;
			}
		}
		$flagRabu = true;
		foreach ($jadwal as $list) {
			if ($list->hari == "Rabu") {
				if ($flagRabu == true) {
					$pdf->Cell(2.2, 0.7, 'Rabu', "LT", 0, 'C', 0);
				}
				else {
					$pdf->Cell(2.2, 0.7, '', "L", 0, 'L', 0);
				}
				$pdf->Cell(3.5, 0.7, $list->jamMulai . ' - ' . $list->jamSelesai, 1, 0, 'C', 0);
				$pdf->Cell(7.5, 0.7, $list->namaMapel, 1, 0, 'L', 0);
				$pdf->Cell(6.3, 0.7, $list->namaUser, 1, 1, 'L', 0);
				$flagRabu = false;
			}
		}
		$flagKamis = true;
		foreach ($jadwal as $list) {
			if ($list->hari == "Kamis") {
				if ($flagKamis == true) {
					$pdf->Cell(2.2, 0.7, 'Kamis', "LT", 0, 'C', 0);
				}
				else {
					$pdf->Cell(2.2, 0.7, '', "L", 0, 'L', 0);
				}
				$pdf->Cell(3.5, 0.7, $list->jamMulai . ' - ' . $list->jamSelesai, 1, 0, 'C', 0);
				$pdf->Cell(7.5, 0.7, $list->namaMapel, 1, 0, 'L', 0);
				$pdf->Cell(6.3, 0.7, $list->namaUser, 1, 1, 'L', 0);
				$flagKamis = false;
			}
		}
		$flagJumat = true;
		foreach ($jadwal as $list) {
			if ($list->hari == "Jumat") {
				if ($flagJumat == true) {
					$pdf->Cell(2.2, 0.7, 'Jumat', "LT", 0, 'C', 0);
				}
				else {
					$pdf->Cell(2.2, 0.7, '', "L", 0, 'L', 0);
				}
				$pdf->Cell(3.5, 0.7, $list->jamMulai . ' - ' . $list->jamSelesai, 1, 0, 'C', 0);
				$pdf->Cell(7.5, 0.7, $list->namaMapel, 1, 0, 'L', 0);
				$pdf->Cell(6.3, 0.7, $list->namaUser, 1, 1, 'L', 0);
				$flagJumat = false;
			}
		}
		$pdf->Cell(2.2, 0.7, '', "T", 0, 'C', 0);

		$pdf->Output();
	}
}
