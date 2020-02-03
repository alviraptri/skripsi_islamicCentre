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

        $nilaiSP = 0;
        $nilaiSS = 0;
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
        $tugasPai = 0;
        $UHPai = 0;
        $praktekPai = 0;
        $utsPai = 0;
        $uasPai = 0;
        $nilai = $this->m_rapor->dataNilai($id)->result();
        foreach ($nilai as $n) {
            $semester = $n->semester;

            if ($n->idMapel == 14) {
                if ($n->jenisNilai == "Tugas") {
                    $tugasPai += $n->nilai; 
                }
                if($n->jenisNilai == "Ulangan Harian"){
                    $UHPai = $n->nilai;
                }
                if ($n->jenisNilai == "Praktek") {
                    $praktekPai = $n->nilai;
                }
                if($n->jenisNilai == "UTS"){
                    $utsPai = $n->nilai;
                }
                if($n->jenisNilai == "UAS"){
                    $uasPai = $n->nilai;
                }
            }  
        }
        if ($semester == 1) {
            $NguruPai = ($tugasPai+$UHPai)/5;
            $totalGuruPai = $NguruPai*($guru/100);
            $NsklhPai = $utsPai*($sklh/100);
            $NtotalPai = round($totalGuruPai) + round($NsklhPai);
        }
        else {
            $NguruPai = ($tugasPai+$UHPai)/5;
            $totalGuruPai = $NguruPai*($guru/100);
            $NsklhPai = $uasPai*($sklh/100);
            $NtotalPai = round($totalGuruPai) + round($NsklhPai);
        }
        if ($NtotalPai >= 89) {
            $predikat = 'A';
        }
        else if ($NtotalPai >= 77) {
            $predikat = 'B';
        }
        else if($NtotalPai > 89){
            $predikat = 'B';
        }
        else if ($NtotalPai >= 65) {
            $predikat = "C";
        }
        else if($NtotalPai < 77){
            $predikat = "C";
        }
        else if ($NtotalPai < 65) {
            $predikat = "D";
        }
        
        $tugasPkn = 0;
        $UHPkn = 0;
        $praktekPkn = 0;
        $utsPkn = 0;
        $uasPkn = 0;
        foreach ($nilai as $n) {
            $semester = $n->semester;

            if ($n->idMapel == 16) {
                if ($n->jenisNilai == "Tugas") {
                    $tugasPkn += $n->nilai; 
                }
                if($n->jenisNilai == "Ulangan Harian"){
                    $UHPkn = $n->nilai;
                }
                if ($n->jenisNilai == "Praktek") {
                    $praktekPkn = $n->nilai;
                }
                if($n->jenisNilai == "UTS"){
                    $utsPkn = $n->nilai;
                }
                if($n->jenisNilai == "UAS"){
                    $uasPkn = $n->nilai;
                }
            }  
        }
        if ($semester == 1) {
            $NguruPkn = ($tugasPkn+$UHPkn)/5;
            $totalGuruPkn = $NguruPkn*($guru/100);
            $NsklhPkn = $utsPkn*($sklh/100);
            $NtotalPkn = round($totalGuruPkn) + round($NsklhPkn);
        }
        else {
            $NguruPkn = ($tugasPkn+$UHPkn)/5;
            $totalGuruPkn = $NguruPkn*($guru/100);
            $NsklhPkn = $uasPkn*($sklh/100);
            $NtotalPkn = round($totalGuruPkn) + round($NsklhPkn);
        }
        if ($NtotalPkn >= 89) {
            $predikat = 'A';
        }
        else if ($NtotalPkn >= 77) {
            $predikat = 'B';
        }
        else if($NtotalPkn > 89){
            $predikat = 'B';
        }
        else if ($NtotalPkn >= 65) {
            $predikat = "C";
        }
        else if($NtotalPkn < 77){
            $predikat = "C";
        }
        else if ($NtotalPkn < 65) {
            $predikat = "D";
        }

        $tugasBi = 0;
        $UHBi = 0;
        $praktekBi = 0;
        $utsBi = 0;
        $uasBi = 0;
        foreach ($nilai as $n) {
            $semester = $n->semester;

            if ($n->idMapel == 2) {
                if ($n->jenisNilai == "Tugas") {
                    $tugasBi += $n->nilai; 
                }
                if($n->jenisNilai == "Ulangan Harian"){
                    $UHBi = $n->nilai;
                }
                if ($n->jenisNilai == "Praktek") {
                    $praktekBi = $n->nilai;
                }
                if($n->jenisNilai == "UTS"){
                    $utsBi = $n->nilai;
                }
                if($n->jenisNilai == "UAS"){
                    $uasBi = $n->nilai;
                }
            }  
        }
        if ($semester == 1) {
            $NguruBi = ($tugasBi+$UHBi)/5;
            $totalGuruBi = $NguruBi*($guru/100);
            $NsklhBi = $utsBi*($sklh/100);
            $NtotalBi = round($totalGuruBi) + round($NsklhBi);
        }
        else {
            $NguruBi = ($tugasBi+$UHBi)/5;
            $totalGuruBi = $NguruBi*($guru/100);
            $NsklhBi = $uasBi*($sklh/100);
            $NtotalBi = round($totalGuruBi) + round($NsklhBi);
        }
        if ($NtotalBi >= 89) {
            $predikat = 'A';
        }
        else if ($NtotalBi >= 77) {
            $predikat = 'B';
        }
        else if($NtotalBi > 89){
            $predikat = 'B';
        }
        else if ($NtotalBi >= 65) {
            $predikat = "C";
        }
        else if($NtotalBi < 77){
            $predikat = "C";
        }
        else if ($NtotalBi < 65) {
            $predikat = "D";
        }

        $tugasMtk = 0;
        $UHMtk = 0;
        $praktekMtk = 0;
        $utsMtk = 0;
        $uasMtk = 0;
        foreach ($nilai as $n) {
            $semester = $n->semester;

            if ($n->idMapel == 12) {
                if ($n->jenisNilai == "Tugas") {
                    $tugasMtk += $n->nilai; 
                }
                if($n->jenisNilai == "Ulangan Harian"){
                    $UHMtk = $n->nilai;
                }
                if ($n->jenisNilai == "Praktek") {
                    $praktekMtk = $n->nilai;
                }
                if($n->jenisNilai == "UTS"){
                    $utsMtk = $n->nilai;
                }
                if($n->jenisNilai == "UAS"){
                    $uasMtk = $n->nilai;
                }
            }  
        }
        if ($semester == 1) {
            $NguruMtk = ($tugasMtk+$UHMtk)/5;
            $totalGuruMtk = $NguruMtk*($guru/100);
            $NsklhMtk = $utsMtk*($sklh/100);
            $NtotalMtk = round($totalGuruMtk) + round($NsklhMtk);
        }
        else {
            $NguruMtk = ($tugasMtk+$UHMtk)/5;
            $totalGuruMtk = $NguruMtk*($guru/100);
            $NsklhMtk = $uasMtk*($sklh/100);
            $NtotalMtk = round($totalGuruMtk) + round($NsklhMtk);
        }
        if ($NtotalMtk >= 89) {
            $predikat = 'A';
        }
        else if ($NtotalMtk >= 77) {
            $predikat = 'B';
        }
        else if($NtotalMtk > 89){
            $predikat = 'B';
        }
        else if ($NtotalMtk >= 65) {
            $predikat = "C";
        }
        else if($NtotalMtk < 77){
            $predikat = "C";
        }
        else if ($NtotalMtk < 65) {
            $predikat = "D";
        }

        $tugasSj = 0;
        $UHSj = 0;
        $praktekSj = 0;
        $utsSj = 0;
        $uasSj = 0;
        foreach ($nilai as $n) {
            $semester = $n->semester;

            if ($n->idMapel == 19) {
                if ($n->jenisNilai == "Tugas") {
                    $tugasSj += $n->nilai; 
                }
                if($n->jenisNilai == "Ulangan Harian"){
                    $UHSj = $n->nilai;
                }
                if ($n->jenisNilai == "Praktek") {
                    $praktekSj = $n->nilai;
                }
                if($n->jenisNilai == "UTS"){
                    $utsSj = $n->nilai;
                }
                if($n->jenisNilai == "UAS"){
                    $uasSj = $n->nilai;
                }
            }  
        }
        if ($semester == 1) {
            $NguruSj = ($tugasSj+$UHSj)/5;
            $totalGuruSj = $NguruSj*($guru/100);
            $NsklhSj = $utsSj*($sklh/100);
            $NtotalSj = round($totalGuruSj) + round($NsklhSj);
        }
        else {
            $NguruSj = ($tugasSj+$UHSj)/5;
            $totalGuruSj = $NguruSj*($guru/100);
            $NsklhSj = $uasSj*($sklh/100);
            $NtotalSj = round($totalGuruSj) + round($NsklhSj);
        }
        if ($NtotalSj >= 89) {
            $predikat = 'A';
        }
        else if ($NtotalSj >= 77) {
            $predikat = 'B';
        }
        else if($NtotalSj > 89){
            $predikat = 'B';
        }
        else if ($NtotalSj >= 65) {
            $predikat = "C";
        }
        else if($NtotalSj < 77){
            $predikat = "C";
        }
        else if ($NtotalSj < 65) {
            $predikat = "D";
        }

        $tugasIng = 0;
        $UHIng = 0;
        $praktekIng = 0;
        $utsIng = 0;
        $uasIng = 0;
        foreach ($nilai as $n) {
            $semester = $n->semester;

            if ($n->idMapel == 3) {
                if ($n->jenisNilai == "Tugas") {
                    $tugasIng += $n->nilai; 
                }
                if($n->jenisNilai == "Ulangan Harian"){
                    $UHIng = $n->nilai;
                }
                if ($n->jenisNilai == "Praktek") {
                    $praktekIng = $n->nilai;
                }
                if($n->jenisNilai == "UTS"){
                    $utsIng = $n->nilai;
                }
                if($n->jenisNilai == "UAS"){
                    $uasIng = $n->nilai;
                }
            }  
        }
        if ($semester == 1) {
            $NguruIng = ($tugasIng+$UHIng)/5;
            $totalGuruIng = $NguruIng*($guru/100);
            $NsklhIng = $utsIng*($sklh/100);
            $NtotalIng = round($totalGuruIng) + round($NsklhIng);
        }
        else {
            $NguruIng = ($tugasIng+$UHIng)/5;
            $totalGuruIng = $NguruIng*($guru/100);
            $NsklhIng = $uasIng*($sklh/100);
            $NtotalIng = round($totalGuruIng) + round($NsklhIng);
        }
        if ($NtotalIng >= 89) {
            $predikat = 'A';
        }
        else if ($NtotalIng >= 77) {
            $predikat = 'B';
        }
        else if($NtotalIng > 89){
            $predikat = 'B';
        }
        else if ($NtotalIng >= 65) {
            $predikat = "C";
        }
        else if($NtotalIng < 77){
            $predikat = "C";
        }
        else if ($NtotalIng < 65) {
            $predikat = "D";
        }
        $nilaiSS = ($NtotalPai+$NtotalPkn+$NtotalBi+$NtotalMtk+$NtotalSj+$NtotalIng)/6;

        $tugasSb = 0;
        $UHSb = 0;
        $praktekSb = 0;
        $utsSb = 0;
        $uasSb = 0;
        $nilai = $this->m_rapor->dataNilai($id)->result();
        foreach ($nilai as $n) {
            $semester = $n->semester;

            if ($n->idMapel == 20) {
                if ($n->jenisNilai == "Tugas") {
                    $tugasSb += $n->nilai; 
                }
                if($n->jenisNilai == "Ulangan Harian"){
                    $UHSb = $n->nilai;
                }
                if ($n->jenisNilai == "Praktek") {
                    $praktekSb = $n->nilai;
                }
                if($n->jenisNilai == "UTS"){
                    $utsSb = $n->nilai;
                }
                if($n->jenisNilai == "UAS"){
                    $uasSb = $n->nilai;
                }
            }  
        }
        if ($semester == 1) {
            $NguruSb = ($tugasSb+$UHSb)/5;
            $totalGuruSb = $NguruSb*($guru/100);
            $NsklhSb = $utsSb*($sklh/100);
            $NtotalSb = round($totalGuruSb) + round($NsklhSb);
        }
        else {
            $NguruSb = ($tugasSb+$UHSb)/5;
            $totalGuruSb = $NguruSb*($guru/100);
            $NsklhSb = $uasSb*($sklh/100);
            $NtotalSb = round($totalGuruSb) + round($NsklhSb);
        }
        if ($NtotalSb >= 89) {
            $predikat = 'A';
        }
        else if ($NtotalSb >= 77) {
            $predikat = 'B';
        }
        else if($NtotalSb > 89){
            $predikat = 'B';
        }
        else if ($NtotalSb >= 65) {
            $predikat = "C";
        }
        else if($NtotalSb < 77){
            $predikat = "C";
        }
        else if ($NtotalSb < 65) {
            $predikat = "D";
        }

        $tugasOr = 0;
        $UHOr = 0;
        $praktekOr = 0;
        $utsOr = 0;
        $uasOr = 0;
        $nilai = $this->m_rapor->dataNilai($id)->result();
        foreach ($nilai as $n) {
            $semester = $n->semester;

            if ($n->idMapel == 15) {
                if ($n->jenisNilai == "Tugas") {
                    $tugasOr += $n->nilai; 
                }
                if($n->jenisNilai == "Ulangan Harian"){
                    $UHOr = $n->nilai;
                }
                if ($n->jenisNilai == "Praktek") {
                    $praktekOr = $n->nilai;
                }
                if($n->jenisNilai == "UTS"){
                    $utsOr = $n->nilai;
                }
                if($n->jenisNilai == "UAS"){
                    $uasOr = $n->nilai;
                }
            }  
        }
        if ($semester == 1) {
            $NguruOr = ($tugasOr+$UHOr)/5;
            $totalGuruOr = $NguruOr*($guru/100);
            $NsklhOr = $utsOr*($sklh/100);
            $NtotalOr = round($totalGuruOr) + round($NsklhOr);
        }
        else {
            $NguruOr = ($tugasOr+$UHOr)/5;
            $totalGuruOr = $NguruOr*($guru/100);
            $NsklhOr = $uasOr*($sklh/100);
            $NtotalOr = round($totalGuruOr) + round($NsklhOr);
        }
        if ($NtotalOr >= 89) {
            $predikat = 'A';
        }
        else if ($NtotalOr >= 77) {
            $predikat = 'B';
        }
        else if($NtotalOr > 89){
            $predikat = 'B';
        }
        else if ($NtotalOr >= 65) {
            $predikat = "C";
        }
        else if($NtotalOr < 77){
            $predikat = "C";
        }
        else if ($NtotalOr < 65) {
            $predikat = "D";
        }
        $tugasPK = 0;
        $UHPK = 0;
        $praktekPK = 0;
        $utsPK = 0;
        $uasPK = 0;
        $nilai = $this->m_rapor->dataNilai($id)->result();
        foreach ($nilai as $n) {
            $semester = $n->semester;

            if ($n->idMapel == 17) {
                if ($n->jenisNilai == "Tugas") {
                    $tugasPK += $n->nilai; 
                }
                if($n->jenisNilai == "Ulangan Harian"){
                    $UHPK = $n->nilai;
                }
                if ($n->jenisNilai == "Praktek") {
                    $praktekPK = $n->nilai;
                }
                if($n->jenisNilai == "UTS"){
                    $utsPK = $n->nilai;
                }
                if($n->jenisNilai == "UAS"){
                    $uasPK = $n->nilai;
                }
            }  
        }
        if ($semester == 1) {
            $NguruPK = ($tugasPK +$UHPK )/5;
            $totalGuruPK = $NguruPK *($guru/100);
            $NsklhPK = $utsPK *($sklh/100);
            $NtotalPK = round($totalGuruPK ) + round($NsklhPK );
        }
        else {
            $NguruPK = ($tugasPK +$UHPK )/5;
            $totalGuruPK = $NguruPK *($guru/100);
            $NsklhPK = $uasPK *($sklh/100);
            $NtotalPK = round($totalGuruPK ) + round($NsklhPK );
        }
        if ($NtotalPK >= 89) {
            $predikat = 'A';
        }
        else if ($NtotalPK >= 77) {
            $predikat = 'B';
        }
        else if($NtotalPK > 89){
            $predikat = 'B';
        }
        else if ($NtotalPK >= 65) {
            $predikat = "C";
        }
        else if($NtotalPK < 77){
            $predikat = "C";
        }
        else if ($NtotalPK < 65) {
            $predikat = "D";
        }
        $tugasQurdis = 0;
        $UHQurdis = 0;
        $praktekQurdis = 0;
        $utsQurdis = 0;
        $uasQurdis = 0;
        $nilai = $this->m_rapor->dataNilai($id)->result();
        foreach ($nilai as $n) {
            $semester = $n->semester;

            if ($n->idMapel == 13) {
                if ($n->jenisNilai == "Tugas") {
                    $tugasQurdis += $n->nilai; 
                }
                if($n->jenisNilai == "Ulangan Harian"){
                    $UHQurdis = $n->nilai;
                }
                if ($n->jenisNilai == "Praktek") {
                    $praktekQurdis = $n->nilai;
                }
                if($n->jenisNilai == "UTS"){
                    $utsQurdis = $n->nilai;
                }
                if($n->jenisNilai == "UAS"){
                    $uasQurdis = $n->nilai;
                }
            }  
        }
        if ($semester == 1) {
            $NguruQurdis = ($tugasQurdis +$UHQurdis )/5;
            $totalGuruQurdis = $NguruQurdis *($guru/100);
            $NsklhQurdis = $utsQurdis *($sklh/100);
            $NtotalQurdis = round($totalGuruQurdis ) + round($NsklhQurdis );
        }
        else {
            $NguruQurdis = ($tugasQurdis +$UHQurdis )/5;
            $totalGuruQurdis = $NguruQurdis *($guru/100);
            $NsklhQurdis = $uasQurdis *($sklh/100);
            $NtotalQurdis = round($totalGuruQurdis ) + round($NsklhQurdis );
        }
        if ($NtotalQurdis >= 89) {
            $predikat = 'A';
        }
        else if ($NtotalQurdis >= 77) {
            $predikat = 'B';
        }
        else if($NtotalQurdis > 89){
            $predikat = 'B';
        }
        else if ($NtotalQurdis >= 65) {
            $predikat = "C";
        }
        else if($NtotalQurdis < 77){
            $predikat = "C";
        }
        else if ($NtotalQurdis < 65) {
            $predikat = "D";
        }
        $tugasEC = 0;
        $UHEC = 0;
        $praktekEC = 0;
        $utsEC = 0;
        $uasEC = 0;
        $nilai = $this->m_rapor->dataNilai($id)->result();
        foreach ($nilai as $n) {
            $semester = $n->semester;

            if ($n->idMapel == 23) {
                if ($n->jenisNilai == "Tugas") {
                    $tugasEC += $n->nilai; 
                }
                if($n->jenisNilai == "Ulangan Harian"){
                    $UHEC = $n->nilai;
                }
                if ($n->jenisNilai == "Praktek") {
                    $praktekEC = $n->nilai;
                }
                if($n->jenisNilai == "UTS"){
                    $utsEC = $n->nilai;
                }
                if($n->jenisNilai == "UAS"){
                    $uasEC = $n->nilai;
                }
            }  
        }
        if ($semester == 1) {
            $NguruEC = ($tugasEC +$UHEC )/5;
            $totalGuruEC = $NguruEC *($guru/100);
            $NsklhEC = $utsEC *($sklh/100);
            $NtotalEC = round($totalGuruEC ) + round($NsklhEC );
        }
        else {
            $NguruEC = ($tugasEC +$UHEC )/5;
            $totalGuruEC = $NguruEC *($guru/100);
            $NsklhEC = $uasEC *($sklh/100);
            $NtotalEC = round($totalGuruEC ) + round($NsklhEC );
        }
        if ($NtotalEC >= 89) {
            $predikat = 'A';
        }
        else if ($NtotalEC >= 77) {
            $predikat = 'B';
        }
        else if($NtotalEC > 89){
            $predikat = 'B';
        }
        else if ($NtotalEC >= 65) {
            $predikat = "C";
        }
        else if($NtotalEC < 77){
            $predikat = "C";
        }
        else if ($NtotalEC < 65) {
            $predikat = "D";
        }
        $tugasAA = 0;
        $UHAA = 0;
        $praktekAA = 0;
        $utsAA = 0;
        $uasAA = 0;
        $nilai = $this->m_rapor->dataNilai($id)->result();
        foreach ($nilai as $n) {
            $semester = $n->semester;

            if ($n->idMapel == 24) {
                if ($n->jenisNilai == "Tugas") {
                    $tugasAA += $n->nilai; 
                }
                if($n->jenisNilai == "Ulangan Harian"){
                    $UHAA = $n->nilai;
                }
                if ($n->jenisNilai == "Praktek") {
                    $praktekAA = $n->nilai;
                }
                if($n->jenisNilai == "UTS"){
                    $utsAA = $n->nilai;
                }
                if($n->jenisNilai == "UAS"){
                    $uasAA = $n->nilai;
                }
            }  
        }
        if ($semester == 1) {
            $NguruAA = ($tugasAA +$UHAA )/5;
            $totalGuruAA = $NguruAA *($guru/100);
            $NsklhAA = $utsAA *($sklh/100);
            $NtotalAA = round($totalGuruAA ) + round($NsklhAA );
        }
        else {
            $NguruAA = ($tugasAA +$UHAA )/5;
            $totalGuruAA = $NguruAA *($guru/100);
            $NsklhAA = $uasAA *($sklh/100);
            $NtotalAA = round($totalGuruAA ) + round($NsklhAA );
        }
        if ($NtotalAA >= 89) {
            $predikat = 'A';
        }
        else if ($NtotalAA >= 77) {
            $predikat = 'B';
        }
        else if($NtotalAA > 89){
            $predikat = 'B';
        }
        else if ($NtotalAA >= 65) {
            $predikat = "C";
        }
        else if($NtotalAA < 77){
            $predikat = "C";
        }
        else if ($NtotalAA < 65) {
            $predikat = "D";
        }
        $tugasTIK = 0;
        $UHTIK = 0;
        $praktekTIK = 0;
        $utsTIK = 0;
        $uasTIK = 0;
        $nilai = $this->m_rapor->dataNilai($id)->result();
        foreach ($nilai as $n) {
            $semester = $n->semester;

            if ($n->idMapel == 6) {
                if ($n->jenisNilai == "Tugas") {
                    $tugasTIK += $n->nilai; 
                }
                if($n->jenisNilai == "Ulangan Harian"){
                    $UHTIK = $n->nilai;
                }
                if ($n->jenisNilai == "Praktek") {
                    $praktekTIK = $n->nilai;
                }
                if($n->jenisNilai == "UTS"){
                    $utsTIK = $n->nilai;
                }
                if($n->jenisNilai == "UAS"){
                    $uasTIK = $n->nilai;
                }
            }  
        }
        if ($semester == 1) {
            $NguruTIK = ($tugasTIK +$UHTIK )/5;
            $totalGuruTIK = $NguruTIK *($guru/100);
            $NsklhTIK = $utsTIK *($sklh/100);
            $NtotalTIK = round($totalGuruTIK ) + round($NsklhTIK );
        }
        else {
            $NguruTIK = ($tugasTIK +$UHTIK )/5;
            $totalGuruTIK = $NguruTIK *($guru/100);
            $NsklhTIK = $uasTIK *($sklh/100);
            $NtotalTIK = round($totalGuruTIK ) + round($NsklhTIK );
        }
        if ($NtotalTIK >= 89) {
            $predikat = 'A';
        }
        else if ($NtotalTIK >= 77) {
            $predikat = 'B';
        }
        else if($NtotalTIK > 89){
            $predikat = 'B';
        }
        else if ($NtotalTIK >= 65) {
            $predikat = "C";
        }
        else if($NtotalTIK < 77){
            $predikat = "C";
        }
        else if ($NtotalTIK < 65) {
            $predikat = "D";
        }
        $tugasMD = 0;
        $UHMD = 0;
        $praktekMD = 0;
        $utsMD = 0;
        $uasMD = 0;
        $nilai = $this->m_rapor->dataNilai($id)->result();
        foreach ($nilai as $n) {
            $semester = $n->semester;

            if ($n->idMapel == 25) {
                if ($n->jenisNilai == "Tugas") {
                    $tugasMD += $n->nilai; 
                }
                if($n->jenisNilai == "Ulangan Harian"){
                    $UHMD = $n->nilai;
                }
                if ($n->jenisNilai == "Praktek") {
                    $praktekMD = $n->nilai;
                }
                if($n->jenisNilai == "UTS"){
                    $utsMD = $n->nilai;
                }
                if($n->jenisNilai == "UAS"){
                    $uasMD = $n->nilai;
                }
            }  
        }
        if ($semester == 1) {
            $NguruMD = ($tugasMD +$UHMD )/5;
            $totalGuruMD = $NguruMD *($guru/100);
            $NsklhMD = $utsMD *($sklh/100);
            $NtotalMD = round($totalGuruMD ) + round($NsklhMD );
        }
        else {
            $NguruMD = ($tugasMD +$UHMD )/5;
            $totalGuruMD = $NguruMD *($guru/100);
            $NsklhMD = $uasMD *($sklh/100);
            $NtotalMD = round($totalGuruMD ) + round($NsklhMD );
        }
        if ($NtotalMD >= 89) {
            $predikat = 'A';
        }
        else if ($NtotalMD >= 77) {
            $predikat = 'B';
        }
        else if($NtotalMD > 89){
            $predikat = 'B';
        }
        else if ($NtotalMD >= 65) {
            $predikat = "C";
        }
        else if($NtotalMD < 77){
            $predikat = "C";
        }
        else if ($NtotalMD < 65) {
            $predikat = "D";
        }
        $nilaiSP = ($NtotalSb+$NtotalOr+$NtotalPK+$NtotalQurdis+$NtotalEC+$NtotalEC+$NtotalAA+$NtotalTIK+$NtotalMD)/8;
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
        $pdf->Cell(35, 1, '1. Sikap Sosial', 0, 1, 'L');

        if ($nilaiSS >= 89) {
            $predikatSS = 'A';
        }
        else if ($nilaiSS >= 77) {
            $predikatSS = 'B';
        }
        else if($nilaiSS > 89){
            $predikatSS = 'B';
        }
        else if ($nilaiSS >= 65) {
            $predikatSS = "C";
        }
        else if($nilaiSS < 77){
            $predikatSS = "C";
        }
        else if ($nilaiSS < 65) {
            $predikatSS = "D";
        }
        //tabel
        $pdf->Cell(10,7,'',0,1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(40,6,'Predikat',1,0, 'C');
        $pdf->Cell(155,6,'Deskripsi',1,1, 'C');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(40,20,$predikatSS,1,0, 'C');
        $sikapSosial = $this->m_rapor->getSikapSS($predikatSS)->result();
        foreach ($sikapSosial as $list) {
            $pdf->Cell(155,20,$list->deskripsi,1,1, 'L');
        }
        $pdf->SetFont('Arial', '', 10);

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(35, 17, '2. Sikap Spiritual', 0, 1, 'L');
        //tabel
        $pdf->Cell(10,0,'',0,1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(40,6,'Predikat',1,0, 'C');
        $pdf->Cell(155,6,'Deskripsi',1,1, 'C');
        $pdf->SetFont('Arial', '', 10);
        if ($nilaiSP >= 89) {
            $predikatSP = 'A';
        }
        else if ($nilaiSP >= 77) {
            $predikatSP = 'B';
        }
        else if($nilaiSP > 89){
            $predikatSP = 'B';
        }
        else if ($nilaiSP >= 65) {
            $predikatSP = "C";
        }
        else if($nilaiSP < 77){
            $predikatSP = "C";
        }
        else if ($nilaiSP < 65) {
            $predikatSP = "D";
        }
        $pdf->Cell(40,20,$predikatSP,1,0, 'C');
        $sikapSpiritual = $this->m_rapor->getSikapSP($predikatSP)->result();
        foreach ($sikapSpiritual as $list) {
            $pdf->Cell(155,20,$list->deskripsi,1,1, 'L');
        }
        $pdf->SetFont('Arial', '', 10);

        date_default_timezone_set('Asia/Jakarta');// change according timezone
        $tgl = date( 'd F Y', time ());
        $wk = $this->m_rapor->getId($id)->result();
        foreach ($wk as $list) {
            $namaWK = $list->namaUser;
            $niWK = $list->nomorInduk;
        }

        //ttd
        $pdf->SetY(150);
        $pdf->SetFont('Arial', '', 10); //setting jenis font yang akan digunakan
        $pdf->Cell(35, 5, '', 0, 0, 'L');
        $pdf->Cell(95, 5, '', 0, 0, 'L');
        //header kiri
        $pdf->Cell(35, 10, 'Tangerang, '.$tgl.'', 0, 1, 'L');
        $pdf->Cell(35, 0, '', 0, 0, 'L');
        $pdf->Cell(95, 0, '', 0, 0, 'L');
        $pdf->Cell(35, 0, 'Wali Kelas', 0, 1, 'L');

        $pdf->SetY(180);
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
        $pdf->Cell(20,5,'Predikat',1,0,'C',0);
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
        $pdf->Cell(15,5,$NtotalPai,'LBR',0,'C',0);
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
        $pdf->Cell(15,5,$NtotalPkn,'LBR',0,'C',0);
        $pdf->Cell(20,5,$predikat,'LBR',0,'C',0);
        $pdf->Cell(105,5,'','LBR',1,'L',0);

        //baris empat
        $pdf->Cell(10,5,'3',1,0,'C',0);  // cell with left and right borders
        $pdf->Cell(45,5,'Bahasa Indonesia',1,0,'L',0); 
        $pdf->Cell(15,5,$NtotalBi,1,0,'C',0);
        $pdf->Cell(20,5,$predikat,1,0,'C',0);
        $pdf->Cell(105,5,'',1,1,'L',0);

        //baris lima
        $pdf->Cell(10,5,'4',1,0,'C',0);  // cell with left and right borders
        $pdf->Cell(45,5,'Matematika (Umum)',1,0,'L',0); 
        $pdf->Cell(15,5,$NtotalMtk,1,0,'C',0);
        $pdf->Cell(20,5,$predikat,1,0,'C',0);
        $pdf->Cell(105,5,'',1,1,'L',0);

        //baris enam
        $pdf->Cell(10,5,'5',1,0,'C',0);  // cell with left and right borders
        $pdf->Cell(45,5,'Sejarah Indonesia',1,0,'L',0); 
        $pdf->Cell(15,5,$NtotalSj,1,0,'C',0);
        $pdf->Cell(20,5,$predikat,1,0,'C',0);
        $pdf->Cell(105,5,'',1,1,'L',0);

        //baris tujuh
        $pdf->Cell(10,5,'6',1,0,'C',0);  // cell with left and right borders
        $pdf->Cell(45,5,'Bahasa Inggris',1,0,'L',0); 
        $pdf->Cell(15,5,$NtotalIng,1,0,'C',0);
        $pdf->Cell(20,5,$predikat,1,0,'C',0);
        $pdf->Cell(105,5,'',1,1,'L',0);

        
        //baris delapan
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(195,5,'Kelompok B','LBR',1,'L',0);
        $pdf->SetFont('Arial', '', 10);

        //baris sembilan
        $pdf->Cell(10,5,'1',1,0,'C',0);  // cell with left and right borders
        $pdf->Cell(45,5,'Seni Budaya',1,0,'L',0); 
        $pdf->Cell(15,5,$NtotalSb,1,0,'C',0);
        $pdf->Cell(20,5,$predikat,1,0,'C',0);
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
        $pdf->Cell(15,5,$NtotalOr,'LBR',0,'C',0);
        $pdf->Cell(20,5,$predikat,'LBR',0,'C',0);
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
        $pdf->Cell(15,5,$NtotalPK,'LBR',0,'C',0);
        $pdf->Cell(20,5,$predikat,'LBR',0,'C',0);
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
        $pdf->Cell(15,5,$NtotalQurdis,'LBR',0,'C',0);
        $pdf->Cell(20,5,$predikat,'LBR',0,'C',0);
        $pdf->Cell(105,5,'','LBR',1,'L',0);

        //baris 13
        $pdf->Cell(10,5,'5',1,0,'C',0);  // cell with left and right borders
        $pdf->Cell(45,5,'English Conversation',1,0,'L',0); 
        $pdf->Cell(15,5,$NtotalEC,1,0,'C',0);
        $pdf->Cell(20,5,$predikat,1,0,'C',0);
        $pdf->Cell(105,5,'',1,1,'L',0);

        //baris 14
        $pdf->Cell(10,5,'6',1,0,'C',0);  // cell with left and right borders
        $pdf->Cell(45,5,'Aqidah Akhlah',1,0,'L',0); 
        $pdf->Cell(15,5,$NtotalAA,1,0,'C',0);
        $pdf->Cell(20,5,$predikat,1,0,'C',0);
        $pdf->Cell(105,5,'',1,1,'L',0);

        //baris 15
        $pdf->Cell(10,5,'7',1,0,'C',0);  // cell with left and right borders
        $pdf->Cell(45,5,'Bimbingan TIK',1,0,'L',0); 
        $pdf->Cell(15,5,$NtotalTIK,1,0,'C',0);
        $pdf->Cell(20,5,$predikat,1,0,'C',0);
        $pdf->Cell(105,5,'',1,1,'L',0);

        //baris 16
        $pdf->Cell(10,5,'8',1,0,'C',0);  // cell with left and right borders
        $pdf->Cell(45,5,'Muhadoroh',1,0,'L',0); 
        $pdf->Cell(15,5,$NtotalMD,1,0,'C',0);
        $pdf->Cell(20,5,$predikat,1,0,'C',0);
        $pdf->Cell(105,5,'',1,1,'L',0);

        //baris 17
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(195,5,'Kelompok C','LBR',1,'L',0);
        $pdf->SetFont('Arial', '', 10);

        if ($jurusan == "IPA") {
            $tugasPm = 0;
            $UHPm = 0;
            $praktekPm = 0;
            $utsPm = 0;
            $uasPm = 0;
            $nilai = $this->m_rapor->dataNilai($id)->result();
            foreach ($nilai as $n) {
                $semester = $n->semester;

                if ($n->idMapel == 11) {
                    if ($n->jenisNilai == "Tugas") {
                        $tugasPm += $n->nilai; 
                    }
                    if($n->jenisNilai == "Ulangan Harian"){
                        $UHPm = $n->nilai;
                    }
                    if ($n->jenisNilai == "Praktek") {
                        $praktekPm = $n->nilai;
                    }
                    if($n->jenisNilai == "UTS"){
                        $utsPm = $n->nilai;
                    }
                    if($n->jenisNilai == "UAS"){
                        $uasPm = $n->nilai;
                    }
                }  
            }
            if ($semester == 1) {
                $NguruPm = ($tugasPm +$UHPm )/5;
                $totalGuruPm = $NguruPm *($guru/100);
                $NsklhPm = $utsPm *($sklh/100);
                $NtotalPm = round($totalGuruPm ) + round($NsklhPm );
            }
            else {
                $NguruPm = ($tugasPm +$UHPm )/5;
                $totalGuruPm = $NguruPm *($guru/100);
                $NsklhPm = $uasPm *($sklh/100);
                $NtotalPm = round($totalGuruPm ) + round($NsklhPm );
            }
            if ($NtotalPm >= 89) {
                $predikat = 'A';
            }
            else if ($NtotalPm >= 77) {
                $predikat = 'B';
            }
            else if($NtotalPm > 89){
                $predikat = 'B';
            }
            else if ($NtotalPm >= 65) {
                $predikat = "C";
            }
            else if($NtotalPm < 77){
                $predikat = "C";
            }
            else if ($NtotalPm < 65) {
                $predikat = "D";
            }
            //baris 18
            $pdf->Cell(10,5,'1',1,0,'C',0);  // cell with left and right borders
            $pdf->Cell(45,5,'Matematika (Peminatan)',1,0,'L',0); 
            $pdf->Cell(15,5,$NtotalPm,1,0,'C',0);
            $pdf->Cell(20,5,$predikat,1,0,'C',0);
            $pdf->Cell(105,5,'',1,1,'L',0);
            
            $tugasBio = 0;
            $UHBio = 0;
            $praktekBio = 0;
            $utsBio = 0;
            $uasBio = 0;
            $nilai = $this->m_rapor->dataNilai($id)->result();
            foreach ($nilai as $n) {
                $semester = $n->semester;

                if ($n->idMapel == 4) {
                    if ($n->jenisNilai == "Tugas") {
                        $tugasBio += $n->nilai; 
                    }
                    if($n->jenisNilai == "Ulangan Harian"){
                        $UHBio = $n->nilai;
                    }
                    if ($n->jenisNilai == "Praktek") {
                        $praktekBio = $n->nilai;
                    }
                    if($n->jenisNilai == "UTS"){
                        $utsBio = $n->nilai;
                    }
                    if($n->jenisNilai == "UAS"){
                        $uasBio = $n->nilai;
                    }
                }  
            }
            if ($semester == 1) {
                $NguruBio = ($tugasBio +$UHBio )/5;
                $totalGuruBio = $NguruBio *($guru/100);
                $NsklhBio = $utsBio *($sklh/100);
                $NtotalBio = round($totalGuruBio ) + round($NsklhBio );
            }
            else {
                $NguruBio = ($tugasBio +$UHBio )/5;
                $totalGuruBio = $NguruBio *($guru/100);
                $NsklhBio = $uasBio *($sklh/100);
                $NtotalBio = round($totalGuruBio ) + round($NsklhBio );
            }
            if ($NtotalBio >= 89) {
                $predikat = 'A';
            }
            else if ($NtotalBio >= 77) {
                $predikat = 'B';
            }
            else if($NtotalBio > 89){
                $predikat = 'B';
            }
            else if ($NtotalBio >= 65) {
                $predikat = "C";
            }
            else if($NtotalBio < 77){
                $predikat = "C";
            }
            else if ($NtotalBio < 65) {
                $predikat = "D";
            }
            //baris 19
            $pdf->Cell(10,5,'2',1,0,'C',0);  // cell with left and right borders
            $pdf->Cell(45,5,'Biologi',1,0,'L',0); 
            $pdf->Cell(15,5,$NtotalBio,1,0,'C',0);
            $pdf->Cell(20,5,$predikat,1,0,'C',0);
            $pdf->Cell(105,5,'',1,1,'L',0);

            $tugasFis = 0;
            $UHFis = 0;
            $praktekFis = 0;
            $utsFis = 0;
            $uasFis = 0;
            $nilai = $this->m_rapor->dataNilai($id)->result();
            foreach ($nilai as $n) {
                $semester = $n->semester;

                if ($n->idMapel == 8) {
                    if ($n->jenisNilai == "Tugas") {
                        $tugasFis += $n->nilai; 
                    }
                    if($n->jenisNilai == "Ulangan Harian"){
                        $UHFis = $n->nilai;
                    }
                    if ($n->jenisNilai == "Praktek") {
                        $praktekFis = $n->nilai;
                    }
                    if($n->jenisNilai == "UTS"){
                        $utsFis = $n->nilai;
                    }
                    if($n->jenisNilai == "UAS"){
                        $uasFis = $n->nilai;
                    }
                }  
            }
            if ($semester == 1) {
                $NguruFis = ($tugasFis +$UHFis )/5;
                $totalGuruFis = $NguruFis *($guru/100);
                $NsklhFis = $utsFis *($sklh/100);
                $NtotalFis = round($totalGuruFis ) + round($NsklhFis );
            }
            else {
                $NguruFis = ($tugasFis +$UHFis )/5;
                $totalGuruFis = $NguruFis *($guru/100);
                $NsklhFis = $uasFis *($sklh/100);
                $NtotalFis = round($totalGuruFis ) + round($NsklhFis );
            }
            if ($NtotalFis >= 89) {
                $predikat = 'A';
            }
            else if ($NtotalFis >= 77) {
                $predikat = 'B';
            }
            else if($NtotalFis > 89){
                $predikat = 'B';
            }
            else if ($NtotalFis >= 65) {
                $predikat = "C";
            }
            else if($NtotalFis < 77){
                $predikat = "C";
            }
            else if ($NtotalFis < 65) {
                $predikat = "D";
            }
            //baris 20
            $pdf->Cell(10,5,'3',1,0,'C',0);  // cell with left and right borders
            $pdf->Cell(45,5,'Fisika',1,0,'L',0); 
            $pdf->Cell(15,5,$NtotalFis,1,0,'C',0);
            $pdf->Cell(20,5,$predikat,1,0,'C',0);
            $pdf->Cell(105,5,'',1,1,'L',0);

            $tugasKim = 0;
            $UHKim = 0;
            $praktekKim = 0;
            $utsKim = 0;
            $uasKim = 0;
            $nilai = $this->m_rapor->dataNilai($id)->result();
            foreach ($nilai as $n) {
                $semester = $n->semester;

                if ($n->idMapel == 10) {
                    if ($n->jenisNilai == "Tugas") {
                        $tugasKim += $n->nilai; 
                    }
                    if($n->jenisNilai == "Ulangan Harian"){
                        $UHKim = $n->nilai;
                    }
                    if ($n->jenisNilai == "Praktek") {
                        $praktekKim = $n->nilai;
                    }
                    if($n->jenisNilai == "UTS"){
                        $utsKim = $n->nilai;
                    }
                    if($n->jenisNilai == "UAS"){
                        $uasKim = $n->nilai;
                    }
                }  
            }
            if ($semester == 1) {
                $NguruKim = ($tugasKim +$UHKim )/5;
                $totalGuruKim = $NguruKim *($guru/100);
                $NsklhKim = $utsKim *($sklh/100);
                $NtotalKim = round($totalGuruKim ) + round($NsklhKim );
            }
            else {
                $NguruKim = ($tugasKim +$UHKim )/5;
                $totalGuruKim = $NguruKim *($guru/100);
                $NsklhKim = $uasKim *($sklh/100);
                $NtotalKim = round($totalGuruKim ) + round($NsklhKim );
            }
            if ($NtotalKim >= 89) {
                $predikat = 'A';
            }
            else if ($NtotalKim >= 77) {
                $predikat = 'B';
            }
            else if($NtotalKim > 89){
                $predikat = 'B';
            }
            else if ($NtotalKim >= 65) {
                $predikat = "C";
            }
            else if($NtotalKim < 77){
                $predikat = "C";
            }
            else if ($NtotalKim < 65) {
                $predikat = "D";
            }
            //baris 21
            $pdf->Cell(10,5,'4',1,0,'C',0);  // cell with left and right borders
            $pdf->Cell(45,5,'Kimia',1,0,'L',0); 
            $pdf->Cell(15,5,$NtotalKim,1,0,'C',0);
            $pdf->Cell(20,5,$predikat,1,0,'C',0);
            $pdf->Cell(105,5,'',1,1,'L',0);

            $tugasArab = 0;
            $UHArab = 0;
            $praktekArab = 0;
            $utsArab = 0;
            $uasArab = 0;
            $nilai = $this->m_rapor->dataNilai($id)->result();
            foreach ($nilai as $n) {
                $semester = $n->semester;

                if ($n->idMapel == 1) {
                    if ($n->jenisNilai == "Tugas") {
                        $tugasArab += $n->nilai; 
                    }
                    if($n->jenisNilai == "Ulangan Harian"){
                        $UHArab = $n->nilai;
                    }
                    if ($n->jenisNilai == "Praktek") {
                        $praktekArab = $n->nilai;
                    }
                    if($n->jenisNilai == "UTS"){
                        $utsArab = $n->nilai;
                    }
                    if($n->jenisNilai == "UAS"){
                        $uasArab = $n->nilai;
                    }
                }  
            }
            if ($semester == 1) {
                $NguruArab = ($tugasArab +$UHArab )/5;
                $totalGuruArab = $NguruArab *($guru/100);
                $NsklhArab = $utsArab *($sklh/100);
                $NtotalArab = round($totalGuruArab ) + round($NsklhArab );
            }
            else {
                $NguruArab = ($tugasArab +$UHArab )/5;
                $totalGuruArab = $NguruArab *($guru/100);
                $NsklhArab = $uasArab *($sklh/100);
                $NtotalArab = round($totalGuruArab ) + round($NsklhArab );
            }
            if ($NtotalArab >= 89) {
                $predikat = 'A';
            }
            else if ($NtotalArab >= 77) {
                $predikat = 'B';
            }
            else if($NtotalArab > 89){
                $predikat = 'B';
            }
            else if ($NtotalArab >= 65) {
                $predikat = "C";
            }
            else if($NtotalArab < 77){
                $predikat = "C";
            }
            else if ($NtotalArab < 65) {
                $predikat = "D";
            }
            //baris 22
            $pdf->Cell(10,5,'5',1,0,'C',0);  // cell with left and right borders
            $pdf->Cell(45,5,'Bahasa dan Sastra Arab',1,0,'L',0); 
            $pdf->Cell(15,5,$NtotalArab,1,0,'C',0);
            $pdf->Cell(20,5,$predikat,1,0,'C',0);
            $pdf->Cell(105,5,'',1,1,'L',0);

            $tugasLM = 0;
            $UHLM = 0;
            $praktekLM = 0;
            $utsLM = 0;
            $uasLM = 0;
            $nilai = $this->m_rapor->dataNilai($id)->result();
            foreach ($nilai as $n) {
                $semester = $n->semester;

                if ($n->idMapel == 28) {
                    if ($n->jenisNilai == "Tugas") {
                        $tugasLM += $n->nilai; 
                    }
                    if($n->jenisNilai == "Ulangan Harian"){
                        $UHLM = $n->nilai;
                    }
                    if ($n->jenisNilai == "Praktek") {
                        $praktekLM = $n->nilai;
                    }
                    if($n->jenisNilai == "UTS"){
                        $utsLM = $n->nilai;
                    }
                    if($n->jenisNilai == "UAS"){
                        $uasLM = $n->nilai;
                    }
                }  
            }
            if ($semester == 1) {
                $NguruLM = ($tugasLM +$UHLM )/5;
                $totalGuruLM = $NguruLM *($guru/100);
                $NsklhLM = $utsLM *($sklh/100);
                $NtotalLM = round($totalGuruLM ) + round($NsklhLM );
            }
            else {
                $NguruLM = ($tugasLM +$UHLM )/5;
                $totalGuruLM = $NguruLM *($guru/100);
                $NsklhLM = $uasLM *($sklh/100);
                $NtotalLM = round($totalGuruLM ) + round($NsklhLM );
            }
            if ($NtotalLM >= 89) {
                $predikat = 'A';
            }
            else if ($NtotalLM >= 77) {
                $predikat = 'B';
            }
            else if($NtotalLM > 89){
                $predikat = 'B';
            }
            else if ($NtotalLM >= 65) {
                $predikat = "C";
            }
            else if($NtotalLM < 77){
                $predikat = "C";
            }
            else if ($NtotalLM < 65) {
                $predikat = "D";
            }
            //baris 23
            $pdf->Cell(10,5,'6',1,0,'C',0);  // cell with left and right borders
            $pdf->Cell(45,5,'Sosiologi',1,0,'L',0); 
            $pdf->Cell(15,5,$NtotalLM,1,0,'C',0);
            $pdf->Cell(20,5,$predikat,1,0,'C',0);
            $pdf->Cell(105,5,'',1,1,'L',0);
        }
        else{
            $tugasGeo = 0;
            $UHGeo = 0;
            $praktekGeo = 0;
            $utsGeo = 0;
            $uasGeo = 0;
            $nilai = $this->m_rapor->dataNilai($id)->result();
            foreach ($nilai as $n) {
                $semester = $n->semester;

                if ($n->idMapel == 9) {
                    if ($n->jenisNilai == "Tugas") {
                        $tugasGeo += $n->nilai; 
                    }
                    if($n->jenisNilai == "Ulangan Harian"){
                        $UHGeo = $n->nilai;
                    }
                    if ($n->jenisNilai == "Praktek") {
                        $praktekGeo = $n->nilai;
                    }
                    if($n->jenisNilai == "UTS"){
                        $utsGeo = $n->nilai;
                    }
                    if($n->jenisNilai == "UAS"){
                        $uasGeo = $n->nilai;
                    }
                }  
            }
            if ($semester == 1) {
                $NguruGeo = ($tugasGeo +$UHGeo )/5;
                $totalGuruGeo = $NguruGeo *($guru/100);
                $NsklhGeo = $utsGeo *($sklh/100);
                $NtotalGeo = round($totalGuruGeo ) + round($NsklhGeo );
            }
            else {
                $NguruGeo = ($tugasGeo +$UHGeo )/5;
                $totalGuruGeo = $NguruGeo *($guru/100);
                $NsklhGeo = $uasGeo *($sklh/100);
                $NtotalGeo = round($totalGuruGeo ) + round($NsklhGeo );
            }
            if ($NtotalGeo >= 89) {
                $predikat = 'A';
            }
            else if ($NtotalGeo >= 77) {
                $predikat = 'B';
            }
            else if($NtotalGeo > 89){
                $predikat = 'B';
            }
            else if ($NtotalGeo >= 65) {
                $predikat = "C";
            }
            else if($NtotalGeo < 77){
                $predikat = "C";
            }
            else if ($NtotalGeo < 65) {
                $predikat = "D";
            }
            //baris 18
            $pdf->Cell(10,5,'1',1,0,'C',0);  // cell with left and right borders
            $pdf->Cell(45,5,'Geografi',1,0,'L',0); 
            $pdf->Cell(15,5,$NtotalGeo,1,0,'C',0);
            $pdf->Cell(20,5,$predikat,1,0,'C',0);
            $pdf->Cell(105,5,'',1,1,'L',0);

            $tugasSos = 0;
            $UHSos = 0;
            $praktekSos = 0;
            $utsSos = 0;
            $uasSos = 0;
            $nilai = $this->m_rapor->dataNilai($id)->result();
            foreach ($nilai as $n) {
                $semester = $n->semester;

                if ($n->idMapel == 21) {
                    if ($n->jenisNilai == "Tugas") {
                        $tugasSos += $n->nilai; 
                    }
                    if($n->jenisNilai == "Ulangan Harian"){
                        $UHSos = $n->nilai;
                    }
                    if ($n->jenisNilai == "Praktek") {
                        $praktekSos = $n->nilai;
                    }
                    if($n->jenisNilai == "UTS"){
                        $utsSos = $n->nilai;
                    }
                    if($n->jenisNilai == "UAS"){
                        $uasSos = $n->nilai;
                    }
                }  
            }
            if ($semester == 1) {
                $NguruSos = ($tugasSos +$UHSos )/5;
                $totalGuruSos = $NguruSos *($guru/100);
                $NsklhSos = $utsSos *($sklh/100);
                $NtotalSos = round($totalGuruSos ) + round($NsklhSos );
            }
            else {
                $NguruSos = ($tugasSos +$UHSos )/5;
                $totalGuruSos = $NguruSos *($guru/100);
                $NsklhSos = $uasSos *($sklh/100);
                $NtotalSos = round($totalGuruSos ) + round($NsklhSos );
            }
            if ($NtotalSos >= 89) {
                $predikat = 'A';
            }
            else if ($NtotalSos >= 77) {
                $predikat = 'B';
            }
            else if($NtotalSos > 89){
                $predikat = 'B';
            }
            else if ($NtotalSos >= 65) {
                $predikat = "C";
            }
            else if($NtotalSos < 77){
                $predikat = "C";
            }
            else if ($NtotalSos < 65) {
                $predikat = "D";
            }
            //baris 19
            $pdf->Cell(10,5,'2',1,0,'C',0);  // cell with left and right borders
            $pdf->Cell(45,5,'Sosiologi',1,0,'L',0); 
            $pdf->Cell(15,5,$NtotalSos,1,0,'C',0);
            $pdf->Cell(20,5,$predikat,1,0,'C',0);
            $pdf->Cell(105,5,'',1,1,'L',0);

            $tugasEko = 0;
            $UHEko = 0;
            $praktekEko = 0;
            $utsEko = 0;
            $uasEko = 0;
            $nilai = $this->m_rapor->dataNilai($id)->result();
            foreach ($nilai as $n) {
                $semester = $n->semester;

                if ($n->idMapel == 7) {
                    if ($n->jenisNilai == "Tugas") {
                        $tugasEko += $n->nilai; 
                    }
                    if($n->jenisNilai == "Ulangan Harian"){
                        $UHEko = $n->nilai;
                    }
                    if ($n->jenisNilai == "Praktek") {
                        $praktekEko = $n->nilai;
                    }
                    if($n->jenisNilai == "UTS"){
                        $utsEko = $n->nilai;
                    }
                    if($n->jenisNilai == "UAS"){
                        $uasEko = $n->nilai;
                    }
                }  
            }
            if ($semester == 1) {
                $NguruEko = ($tugasEko +$UHEko )/5;
                $totalGuruEko = $NguruEko *($guru/100);
                $NsklhEko = $utsEko *($sklh/100);
                $NtotalEko = round($totalGuruEko ) + round($NsklhEko );
            }
            else {
                $NguruEko = ($tugasEko +$UHEko )/5;
                $totalGuruEko = $NguruEko *($guru/100);
                $NsklhEko = $uasEko *($sklh/100);
                $NtotalEko = round($totalGuruEko ) + round($NsklhEko );
            }
            if ($NtotalEko >= 89) {
                $predikat = 'A';
            }
            else if ($NtotalEko >= 77) {
                $predikat = 'B';
            }
            else if($NtotalEko > 89){
                $predikat = 'B';
            }
            else if ($NtotalEko >= 65) {
                $predikat = "C";
            }
            else if($NtotalEko < 77){
                $predikat = "C";
            }
            else if ($NtotalEko < 65) {
                $predikat = "D";
            }
            //baris 20
            $pdf->Cell(10,5,'3',1,0,'C',0);  // cell with left and right borders
            $pdf->Cell(45,5,'Ekonomi',1,0,'L',0); 
            $pdf->Cell(15,5,$NtotalEko,1,0,'C',0);
            $pdf->Cell(20,5,$predikat,1,0,'C',0);
            $pdf->Cell(105,5,'',1,1,'L',0);

            $tugasSJPM = 0;
            $UHSJPM = 0;
            $praktekSJPM = 0;
            $utsSJPM = 0;
            $uasSJPM = 0;
            $nilai = $this->m_rapor->dataNilai($id)->result();
            foreach ($nilai as $n) {
                $semester = $n->semester;

                if ($n->idMapel == 18) {
                    if ($n->jenisNilai == "Tugas") {
                        $tugasSJPM += $n->nilai; 
                    }
                    if($n->jenisNilai == "Ulangan Harian"){
                        $UHSJPM = $n->nilai;
                    }
                    if ($n->jenisNilai == "Praktek") {
                        $praktekSJPM = $n->nilai;
                    }
                    if($n->jenisNilai == "UTS"){
                        $utsSJPM = $n->nilai;
                    }
                    if($n->jenisNilai == "UAS"){
                        $uasSJPM = $n->nilai;
                    }
                }  
            }
            if ($semester == 1) {
                $NguruSJPM = ($tugasSJPM +$UHSJPM )/5;
                $totalGuruSJPM = $NguruSJPM *($guru/100);
                $NsklhSJPM = $utsSJPM *($sklh/100);
                $NtotalSJPM = round($totalGuruSJPM ) + round($NsklhSJPM );
            }
            else {
                $NguruSJPM = ($tugasSJPM +$UHSJPM )/5;
                $totalGuruSJPM = $NguruSJPM *($guru/100);
                $NsklhSJPM = $uasSJPM *($sklh/100);
                $NtotalSJPM = round($totalGuruSJPM ) + round($NsklhSJPM );
            }
            if ($NtotalSJPM >= 89) {
                $predikat = 'A';
            }
            else if ($NtotalSJPM >= 77) {
                $predikat = 'B';
            }
            else if($NtotalSJPM > 89){
                $predikat = 'B';
            }
            else if ($NtotalSJPM >= 65) {
                $predikat = "C";
            }
            else if($NtotalSJPM < 77){
                $predikat = "C";
            }
            else if ($NtotalSJPM < 65) {
                $predikat = "D";
            }
            //baris 21
            $pdf->Cell(10,5,'4',1,0,'C',0);  // cell with left and right borders
            $pdf->Cell(45,5,'Sejarah',1,0,'L',0); 
            $pdf->Cell(15,5,$NtotalSJPM,1,0,'C',0);
            $pdf->Cell(20,5,$predikat,1,0,'C',0);
            $pdf->Cell(105,5,'',1,1,'L',0);

            $tugasArab = 0;
            $UHArab = 0;
            $praktekArab = 0;
            $utsArab = 0;
            $uasArab = 0;
            $nilai = $this->m_rapor->dataNilai($id)->result();
            foreach ($nilai as $n) {
                $semester = $n->semester;

                if ($n->idMapel == 1) {
                    if ($n->jenisNilai == "Tugas") {
                        $tugasArab += $n->nilai; 
                    }
                    if($n->jenisNilai == "Ulangan Harian"){
                        $UHArab = $n->nilai;
                    }
                    if ($n->jenisNilai == "Praktek") {
                        $praktekArab = $n->nilai;
                    }
                    if($n->jenisNilai == "UTS"){
                        $utsArab = $n->nilai;
                    }
                    if($n->jenisNilai == "UAS"){
                        $uasArab = $n->nilai;
                    }
                }  
            }
            if ($semester == 1) {
                $NguruArab = ($tugasArab +$UHArab )/5;
                $totalGuruArab = $NguruArab *($guru/100);
                $NsklhArab = $utsArab *($sklh/100);
                $NtotalArab = round($totalGuruArab ) + round($NsklhArab );
            }
            else {
                $NguruArab = ($tugasArab +$UHArab )/5;
                $totalGuruArab = $NguruArab *($guru/100);
                $NsklhArab = $uasArab *($sklh/100);
                $NtotalArab = round($totalGuruArab ) + round($NsklhArab );
            }
            if ($NtotalArab >= 89) {
                $predikat = 'A';
            }
            else if ($NtotalArab >= 77) {
                $predikat = 'B';
            }
            else if($NtotalArab > 89){
                $predikat = 'B';
            }
            else if ($NtotalArab >= 65) {
                $predikat = "C";
            }
            else if($NtotalArab < 77){
                $predikat = "C";
            }
            else if ($NtotalArab < 65) {
                $predikat = "D";
            }
            //baris 22
            $pdf->Cell(10,5,'5',1,0,'C',0);  // cell with left and right borders
            $pdf->Cell(45,5,'Bahasa dan Sastra Arab',1,0,'L',0); 
            $pdf->Cell(15,5,$NtotalArab,1,0,'C',0);
            $pdf->Cell(20,5,$predikat,1,0,'C',0);
            $pdf->Cell(105,5,'',1,1,'L',0);

            $tugasBioLM = 0;
            $UHBioLM = 0;
            $praktekBioLM = 0;
            $utsBioLM = 0;
            $uasBioLM = 0;
            $nilai = $this->m_rapor->dataNilai($id)->result();
            foreach ($nilai as $n) {
                $semester = $n->semester;

                if ($n->idMapel == 14) {
                    if ($n->jenisNilai == "Tugas") {
                        $tugasBioLM += $n->nilai; 
                    }
                    if($n->jenisNilai == "Ulangan Harian"){
                        $UHBioLM = $n->nilai;
                    }
                    if ($n->jenisNilai == "Praktek") {
                        $praktekBioLM = $n->nilai;
                    }
                    if($n->jenisNilai == "UTS"){
                        $utsBioLM = $n->nilai;
                    }
                    if($n->jenisNilai == "UAS"){
                        $uasBioLM = $n->nilai;
                    }
                }  
            }
            if ($semester == 1) {
                $NguruBioLM = ($tugasBioLM +$UHBioLM )/5;
                $totalGuruBioLM = $NguruBioLM *($guru/100);
                $NsklhBioLM = $utsBioLM *($sklh/100);
                $NtotalBioLM = round($totalGuruBioLM ) + round($NsklhBioLM );
            }
            else {
                $NguruBioLM = ($tugasBioLM +$UHBioLM )/5;
                $totalGuruBioLM = $NguruBioLM *($guru/100);
                $NsklhBioLM = $uasBioLM *($sklh/100);
                $NtotalBioLM = round($totalGuruBioLM ) + round($NsklhBioLM );
            }
            if ($NtotalBioLM >= 89) {
                $predikat = 'A';
            }
            else if ($NtotalBioLM >= 77) {
                $predikat = 'B';
            }
            else if($NtotalBioLM > 89){
                $predikat = 'B';
            }
            else if ($NtotalBioLM >= 65) {
                $predikat = "C";
            }
            else if($NtotalBioLM < 77){
                $predikat = "C";
            }
            else if ($NtotalBioLM < 65) {
                $predikat = "D";
            }
            //baris 23
            $pdf->Cell(10,5,'6',1,0,'C',0);  // cell with left and right borders
            $pdf->Cell(45,5,'Biologi',1,0,'L',0); 
            $pdf->Cell(15,5,$NtotalBioLM,1,0,'C',0);
            $pdf->Cell(20,5,$predikat,1,0,'C',0);
            $pdf->Cell(105,5,'',1,1,'L',0);
        }

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
