<?php
class c_jadwalMengawas extends CI_Controller
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

        $jadwal = $this->m_jadwalGuru->jadwalPengawas()->result();
        $guru = $this->m_jadwalGuru->pengawas($id)->result();
        $tanggal = $this->m_jadwalGuru->tanggal()->result();
        foreach ($tanggal as $tgl) {
            $tglAkhir = $tgl->tanggal;
        }
		
		//HEADER
		$pdf->SetFont('Arial', '', 13); //setting jenis font yang akan digunakan
		$pdf->Cell(50, 1, '', 0, 1, 'C');
		$pdf->Cell(19, 0, 'JADWAL MENGAWAS UJIAN SMAS ISLAMIC CENTRE', 0, 1, 'C');
		$pdf->Cell(19, 1, 'SEMESTER GANJIL TAHUN PELAJARAN 2019-2020', 0, 1, 'C');

		
		$pdf->Cell(28, 0.7, '', 0, 1);
		$pdf->SetFont('Arial', 'B', 9.5);
        $pdf->Cell(2.2, 0.7, 'Hari', 1, 0, 'C', 0);
        $pdf->Cell(2.5, 0.7, 'Tanggal', 1, 0, 'C', 0);
		$pdf->Cell(2.5, 0.7, 'Jam', 1, 0, 'C', 0);
		$pdf->Cell(7, 0.7, 'Mata Pelajaran', 1, 0, 'C', 0);
		$pdf->Cell(5.5, 0.7, 'Guru', 1, 1, 'C', 0);

		$pdf->SetFont('Arial', '', 9.5);
		$flagSenin = true;
		foreach ($jadwal as $list) {
            if ($list->tanggal != $tglAkhir) {
                if ($list->hari == "Senin") {
                    if ($flagSenin == true) {
                        $pdf->Cell(2.2, 0.7, 'Senin', "LT", 0, 'C', 0);
                    }
                    else {
                        $pdf->Cell(2.2, 0.7, '', "L", 0, 'L', 0);
                    }
                    $tanggal = date('d F Y', strtotime($list->tanggal));
                    $pdf->Cell(2.5, 0.7, $tanggal, 1, 0, 'C', 0);
                    $jamMulai = date('H:i', strtotime($list->jamMulai));
                    $jamSelesai = date('H:i', strtotime($list->jamSelesai));
                    $pdf->Cell(2.5, 0.7, $jamMulai . ' - ' . $jamSelesai, 1, 0, 'C', 0);
                    $pdf->Cell(7, 0.7, $list->namaMapel, 1, 0, 'L', 0);
                    foreach ($guru as $listGuru) {
                        if ($list->idJadwalUjian == $listGuru->idJadwalUjian) {
                            $pdf->Cell(5.5, 0.7, $listGuru->namaUser, 1, 1, 'L', 0);
                        }
                    }
                    $flagSenin = false;
                }
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
                $tanggal = date('d F Y', strtotime($list->tanggal));
                $pdf->Cell(2.5, 0.7, $tanggal, 1, 0, 'C', 0);
                $jamMulai = date('H:i', strtotime($list->jamMulai));
                $jamSelesai = date('H:i', strtotime($list->jamSelesai));
				$pdf->Cell(2.5, 0.7, $jamMulai . ' - ' . $jamSelesai, 1, 0, 'C', 0);
				$pdf->Cell(7, 0.7, $list->namaMapel, 1, 0, 'L', 0);
				foreach ($guru as $listGuru) {
                    if ($list->idJadwalUjian == $listGuru->idJadwalUjian) {
                        $pdf->Cell(5.5, 0.7, $listGuru->namaUser, 1, 1, 'L', 0);
                    }
                }
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
                $tanggal = date('d F Y', strtotime($list->tanggal));
                $pdf->Cell(2.5, 0.7, $tanggal, 1, 0, 'C', 0);
                $jamMulai = date('H:i', strtotime($list->jamMulai));
                $jamSelesai = date('H:i', strtotime($list->jamSelesai));
                $pdf->Cell(2.5, 0.7, $jamMulai . ' - ' . $jamSelesai, 1, 0, 'C', 0);
				$pdf->Cell(7, 0.7, $list->namaMapel, 1, 0, 'L', 0);
				foreach ($guru as $listGuru) {
                    if ($list->idJadwalUjian == $listGuru->idJadwalUjian) {
                        $pdf->Cell(5.5, 0.7, $listGuru->namaUser, 1, 1, 'L', 0);
                    }
                }
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
                $tanggal = date('d F Y', strtotime($list->tanggal));
                $pdf->Cell(2.5, 0.7, $tanggal, 1, 0, 'C', 0);
                $jamMulai = date('H:i', strtotime($list->jamMulai));
                $jamSelesai = date('H:i', strtotime($list->jamSelesai));
                $pdf->Cell(2.5, 0.7, $jamMulai . ' - ' . $jamSelesai, 1, 0, 'C', 0);
				$pdf->Cell(7, 0.7, $list->namaMapel, 1, 0, 'L', 0);
				foreach ($guru as $listGuru) {
                    if ($list->idJadwalUjian == $listGuru->idJadwalUjian) {
                        $pdf->Cell(5.5, 0.7, $listGuru->namaUser, 1, 1, 'L', 0);
                    }
                }
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
                $tanggal = date('d F Y', strtotime($list->tanggal));
                $pdf->Cell(2.5, 0.7, $tanggal, 1, 0, 'C', 0);
                $jamMulai = date('H:i', strtotime($list->jamMulai));
                $jamSelesai = date('H:i', strtotime($list->jamSelesai));
                $pdf->Cell(2.5, 0.7, $jamMulai . ' - ' . $jamSelesai, 1, 0, 'C', 0);
				$pdf->Cell(7, 0.7, $list->namaMapel, 1, 0, 'L', 0);
				foreach ($guru as $listGuru) {
                    if ($list->idJadwalUjian == $listGuru->idJadwalUjian) {
                        $pdf->Cell(5.5, 0.7, $listGuru->namaUser, 1, 1, 'L', 0);
                    }
                }
				$flagJumat = false;
			}
        }
        $flagSeninn = true;
		foreach ($jadwal as $list) {
            if ($list->tanggal == $tglAkhir) {
                if ($list->hari == "Senin") {
                    if ($flagSeninn == true) {
                        $pdf->Cell(2.2, 0.7, 'Senin', "LT", 0, 'C', 0);
                    }
                    else {
                        $pdf->Cell(2.2, 0.7, '', "L", 0, 'L', 0);
                    }
                    $tanggal = date('d F Y', strtotime($list->tanggal));
                    $pdf->Cell(2.5, 0.7, $tanggal, 1, 0, 'C', 0);
                    $jamMulai = date('H:i', strtotime($list->jamMulai));
                    $jamSelesai = date('H:i', strtotime($list->jamSelesai));
                    $pdf->Cell(2.5, 0.7, $jamMulai . ' - ' . $jamSelesai, 1, 0, 'C', 0);
                    $pdf->Cell(7, 0.7, $list->namaMapel, 1, 0, 'L', 0);
                    foreach ($guru as $listGuru) {
                        if ($list->idJadwalUjian == $listGuru->idJadwalUjian) {
                            $pdf->Cell(5.5, 0.7, $listGuru->namaUser, 1, 1, 'L', 0);
                        }
                    }
                    $flagSeninn = false;
                }
            }
		}
		$pdf->Cell(2.2, 0.7, '', "T", 0, 'C', 0);

		$pdf->Output();
	}
}
