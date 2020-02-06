<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Rapor | Information Academic Islamic Centre</title>

  <!-- Bootstrap -->
  <link href="<?php echo base_url(); ?>assets/inter/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="<?php echo base_url(); ?>assets/inter/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- NProgress -->
  <link href="<?php echo base_url(); ?>assets/inter/vendors/nprogress/nprogress.css" rel="stylesheet">
  <!-- iCheck -->
  <link href="<?php echo base_url(); ?>assets/inter/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
  <!-- Datatables -->
  <link href="<?php echo base_url(); ?>assets/inter/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/inter/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/inter/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/inter/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/inter/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

  <!-- Custom Theme Style -->
  <link href="<?php echo base_url(); ?>assets/inter/build/css/custom.min.css" rel="stylesheet">
  <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/internal/media/logos/faviconic.ico" />
</head>

<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col">
        <?php include("view-sidebar.php") ?>
      </div>

      <!-- top navigation -->
      <?php include("view-topNavigation.php") ?>
      <!-- /top navigation -->

      <!-- page content -->
      <div class="right_col" role="main">
        <div class="">
          <div class="page-title">
            <div class="title_left">
              <h3>Informasi Nilai</h3>
            </div>
          </div>

          <div class="clearfix"></div>

          <div class="row">
            <!-- button -->
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                    <?php
                    foreach ($siswa as $s) {
                        $nama = $s->namaUser;
                        $ket = $s->ketKelas;
                        $jurusan = $s->jurusanKelas;
                        $nomor = $s->nomorKelas;
                        $nomorInduk = $s->nomorInduk;
                        $id = $s->idSiswa;
                    }
                    foreach ($bobot as $b) {
                        $sklh = $b->bobotSekolah;
                        $guru = $b->bobotGuru;
                    }
                    ?>
                  <h2><?= $nama?> - <?= $ket ." ". $jurusan. " ". $nomor?></h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                <form class="form-horizontal form-label-left" method="post" action="<?php echo base_url() . 'c_admin/simpanTotalNilai'; ?>">
                <div class="modal-body">
                  <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align"><b>Nomor Induk</b></label>
                    <div class="col-md-8 col-sm-8">
                      <input name="id" id="id_edit" class="form-control" type="text" value="<?= $nomorInduk ?>" readonly>
                    </div>
                  </div>

                  <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3">Pendidikan Agama Islam dan Budi Pekerti</label>
                    <div class="col-md-1 col-sm-1">
                      <?php
                      $tugasPai = 0;
                      $UHPai = 0;
                      $praktekPai = 0;
                      $utsPai = 0;
                      $uasPai = 0;
                      foreach ($nilai as $n) {
                        $semester = $n->semester;

                        if ($n->idMapel == 14) {
                          if ($n->jenisNilai == "Tugas") {
                            $tugasPai += $n->nilai;
                          }
                          if ($n->jenisNilai == "Ulangan Harian") {
                            $UHPai = $n->nilai;
                          }
                          if ($n->jenisNilai == "Praktek") {
                            $praktekPai = $n->nilai;
                          }
                          if ($n->jenisNilai == "UTS") {
                            $utsPai = $n->nilai;
                          }
                          if ($n->jenisNilai == "UAS") {
                            $uasPai = $n->nilai;
                          }
                        }
                      }
                      if ($semester == 1) {
                        $NguruPai = ($tugasPai + $UHPai) / 5;
                        $totalGuruPai = $NguruPai * ($guru / 100);
                        $NsklhPai = $utsPai * ($sklh / 100);
                        $NtotalPai = round($totalGuruPai) + round($NsklhPai);
                      } else {
                        $NguruPai = ($tugasPai + $UHPai) / 5;
                        $totalGuruPai = $NguruPai * ($guru / 100);
                        $NsklhPai = $uasPai * ($sklh / 100);
                        $NtotalPai = round($totalGuruPai) + round($NsklhPai);
                      }
                      ?>
                      <input name="pai" id="paiId" class="form-control" type="text" value="<?= $NtotalPai ?>" readonly>
                    </div>
                    <?php
                    if ($jurusan == "IPA") { ?>
                      <label class="col-form-label col-md-3 col-sm-3">Matematika (Peminatan)</label>
                      <div class="col-md-1 col-sm-1">
                      <?php
                      $tugasMtkPm = 0;
                      $UHMtkPm = 0;
                      $praktekMtkPm = 0;
                      $utsMtkPm = 0;
                      $uasMtkPm = 0;
                      foreach ($nilai as $n) {
                        $semester = $n->semester;

                        if ($n->idMapel == 11) {
                          if ($n->jenisNilai == "Tugas") {
                            $tugasMtkPm += $n->nilai;
                          }
                          if ($n->jenisNilai == "Ulangan Harian") {
                            $UHMtkPm = $n->nilai;
                          }
                          if ($n->jenisNilai == "Praktek") {
                            $praktekMtkPm = $n->nilai;
                          }
                          if ($n->jenisNilai == "UTS") {
                            $utsMtkPm = $n->nilai;
                          }
                          if ($n->jenisNilai == "UAS") {
                            $uasMtkPm = $n->nilai;
                          }
                        }
                      }
                      if ($semester == 1) {
                        $NguruMtkPm = ($tugasMtkPm + $UHMtkPm ) / 5;
                        $totalGuruMtkPm = $NguruMtkPm * ($guru / 100);
                        $NsklhMtkPm = $utsMtkPm * ($sklh / 100);
                        $NtotalMtkPm = round($totalGuruMtkPm ) + round($NsklhMtkPm );
                      } else {
                        $NguruMtkPm = ($tugasMtkPm + $UHMtkPm ) / 5;
                        $totalGuruMtkPm = $NguruMtkPm * ($guru / 100);
                        $NsklhMtkPm = $uasMtkPm * ($sklh / 100);
                        $NtotalMtkPm = round($totalGuruMtkPm ) + round($NsklhMtkPm );
                      }
                      ?>
                      <input name="MtkPm" id="MtkPmId" class="form-control" type="text" value="<?= $NtotalMtkPm ?>" readonly>
                      </div>
                    <?php } else { ?>
                      <label class="col-form-label col-md-3 col-sm-3">Geografi</label>
                      <div class="col-md-1 col-sm-1">
                      <?php
                      $tugasGeo = 0;
                      $UHGeo = 0;
                      $praktekGeo = 0;
                      $utsGeo = 0;
                      $uasGeo = 0;
                      foreach ($nilai as $n) {
                        $semester = $n->semester;

                        if ($n->idMapel == 9) {
                          if ($n->jenisNilai == "Tugas") {
                            $tugasGeo += $n->nilai;
                          }
                          if ($n->jenisNilai == "Ulangan Harian") {
                            $UHGeo = $n->nilai;
                          }
                          if ($n->jenisNilai == "Praktek") {
                            $praktekGeo = $n->nilai;
                          }
                          if ($n->jenisNilai == "UTS") {
                            $utsGeo = $n->nilai;
                          }
                          if ($n->jenisNilai == "UAS") {
                            $uasGeo = $n->nilai;
                          }
                        }
                      }
                      if ($semester == 1) {
                        $NguruGeo = ($tugasGeo + $UHGeo ) / 5;
                        $totalGuruGeo = $NguruGeo * ($guru / 100);
                        $NsklhGeo = $utsGeo * ($sklh / 100);
                        $NtotalGeo = round($totalGuruGeo ) + round($NsklhGeo );
                      } else {
                        $NguruGeo = ($tugasGeo + $UHGeo ) / 5;
                        $totalGuruGeo = $NguruGeo * ($guru / 100);
                        $NsklhGeo = $uasGeo * ($sklh / 100);
                        $NtotalGeo = round($totalGuruGeo ) + round($NsklhGeo );
                      }
                      ?>
                      <input name="Geo" id="GeoId" class="form-control" type="text" value="<?= $NtotalGeo ?>" readonly>
                      </div>
                    <?php }
                    ?>
                    <label class="col-form-label col-md-3 col-sm-3">Seni Budaya</label>
                    <div class="col-md-1 col-sm-1">
                    <?php
                      $tugasSenbud = 0;
                      $UHSenbud = 0;
                      $praktekSenbud = 0;
                      $utsSenbud = 0;
                      $uasSenbud = 0;
                      foreach ($nilai as $n) {
                        $semester = $n->semester;

                        if ($n->idMapel == 20) {
                          if ($n->jenisNilai == "Tugas") {
                            $tugasSenbud += $n->nilai;
                          }
                          if ($n->jenisNilai == "Ulangan Harian") {
                            $UHSenbud = $n->nilai;
                          }
                          if ($n->jenisNilai == "Praktek") {
                            $praktekSenbud = $n->nilai;
                          }
                          if ($n->jenisNilai == "UTS") {
                            $utsSenbud = $n->nilai;
                          }
                          if ($n->jenisNilai == "UAS") {
                            $uasSenbud = $n->nilai;
                          }
                        }
                      }
                      if ($semester == 1) {
                        $NguruSenbud = ($tugasSenbud + $UHSenbud ) / 5;
                        $totalGuruSenbud = $NguruSenbud * ($guru / 100);
                        $NsklhSenbud = $utsSenbud * ($sklh / 100);
                        $NtotalSenbud = round($totalGuruSenbud ) + round($NsklhSenbud );
                      } else {
                        $NguruSenbud = ($tugasSenbud + $UHSenbud ) / 5;
                        $totalGuruSenbud = $NguruSenbud * ($guru / 100);
                        $NsklhSenbud = $uasSenbud * ($sklh / 100);
                        $NtotalSenbud = round($totalGuruSenbud ) + round($NsklhSenbud );
                      }
                      ?>
                      <input name="Senbud" id="SenbudId" class="form-control" type="text" value="<?= $NtotalSenbud ?>" readonly>
                    </div>
                  </div>
                  <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3">Pendidikan Pancasila dan Kewarganegaraan</label>
                    <div class="col-md-1 col-sm-1">
                      <?php
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
                          if ($n->jenisNilai == "Ulangan Harian") {
                            $UHPkn = $n->nilai;
                          }
                          if ($n->jenisNilai == "Praktek") {
                            $praktekPkn = $n->nilai;
                          }
                          if ($n->jenisNilai == "UTS") {
                            $utsPkn = $n->nilai;
                          }
                          if ($n->jenisNilai == "UAS") {
                            $uasPkn = $n->nilai;
                          }
                        }
                      }
                      if ($semester == 1) {
                        $NguruPkn = ($tugasPkn + $UHPkn) / 5;
                        $totalGuruPkn = $NguruPkn * ($guru / 100);
                        $NsklhPkn = $utsPkn * ($sklh / 100);
                        $NtotalPkn = round($totalGuruPkn) + round($NsklhPkn);
                      } else {
                        $NguruPkn = ($tugasPkn + $UHPkn) / 5;
                        $totalGuruPkn = $NguruPkn * ($guru / 100);
                        $NsklhPkn = $uasPkn * ($sklh / 100);
                        $NtotalPkn = round($totalGuruPkn) + round($NsklhPkn);
                      }
                      ?>
                      <input name="pkn" id="pknId" class="form-control" type="text" value="<?= $NtotalPkn ?>" readonly>
                    </div>
                    <?php if ($jurusan == "IPA") { ?>
                      <label class="col-form-label col-md-3 col-sm-3">Biologi</label>
                      <div class="col-md-1 col-sm-1">
                      <?php
                      $tugasBio = 0;
                      $UHBio = 0;
                      $praktekBio = 0;
                      $utsBio = 0;
                      $uasBio = 0;
                      foreach ($nilai as $n) {
                        $semester = $n->semester;

                        if ($n->idMapel == 4) {
                          if ($n->jenisNilai == "Tugas") {
                            $tugasBio += $n->nilai;
                          }
                          if ($n->jenisNilai == "Ulangan Harian") {
                            $UHBio = $n->nilai;
                          }
                          if ($n->jenisNilai == "Praktek") {
                            $praktekBio = $n->nilai;
                          }
                          if ($n->jenisNilai == "UTS") {
                            $utsBio = $n->nilai;
                          }
                          if ($n->jenisNilai == "UAS") {
                            $uasBio = $n->nilai;
                          }
                        }
                      }
                      if ($semester == 1) {
                        $NguruBio = ($tugasBio + $UHBio ) / 5;
                        $totalGuruBio = $NguruBio * ($guru / 100);
                        $NsklhBio = $utsBio * ($sklh / 100);
                        $NtotalBio = round($totalGuruBio ) + round($NsklhBio );
                      } else {
                        $NguruBio = ($tugasBio + $UHBio ) / 5;
                        $totalGuruBio = $NguruBio * ($guru / 100);
                        $NsklhBio = $uasBio * ($sklh / 100);
                        $NtotalBio = round($totalGuruBio ) + round($NsklhBio );
                      }
                      ?>
                      <input name="Bio" id="BioId" class="form-control" type="text" value="<?= $NtotalBio ?>" readonly>
                      </div>
                    <?php } else { ?>
                      <label class="col-form-label col-md-3 col-sm-3">Sosiologi</label>
                      <div class="col-md-1 col-sm-1">
                      <?php
                      $tugasSos = 0;
                      $UHSos = 0;
                      $praktekSos = 0;
                      $utsSos = 0;
                      $uasSos = 0;
                      foreach ($nilai as $n) {
                        $semester = $n->semester;

                        if ($n->idMapel == 9) {
                          if ($n->jenisNilai == "Tugas") {
                            $tugasSos += $n->nilai;
                          }
                          if ($n->jenisNilai == "Ulangan Harian") {
                            $UHSos = $n->nilai;
                          }
                          if ($n->jenisNilai == "Praktek") {
                            $praktekSos = $n->nilai;
                          }
                          if ($n->jenisNilai == "UTS") {
                            $utsSos = $n->nilai;
                          }
                          if ($n->jenisNilai == "UAS") {
                            $uasSos = $n->nilai;
                          }
                        }
                      }
                      if ($semester == 1) {
                        $NguruSos = ($tugasSos + $UHSos ) / 5;
                        $totalGuruSos = $NguruSos * ($guru / 100);
                        $NsklhSos = $utsSos * ($sklh / 100);
                        $NtotalSos = round($totalGuruSos ) + round($NsklhSos );
                      } else {
                        $NguruSos = ($tugasSos + $UHSos ) / 5;
                        $totalGuruSos = $NguruSos * ($guru / 100);
                        $NsklhSos = $uasSos * ($sklh / 100);
                        $NtotalSos = round($totalGuruSos ) + round($NsklhSos );
                      }
                      ?>
                      <input name="Sos" id="SosId" class="form-control" type="text" value="<?= $NtotalSos ?>" readonly>
                      </div>
                    <?php }
                    ?>
                    <label class="col-form-label col-md-3 col-sm-3">Prakarya dan Kewirausahaan</label>
                    <div class="col-md-1 col-sm-1">
                    <?php
                      $tugasPrk = 0;
                      $UHPrk = 0;
                      $praktekPrk = 0;
                      $utsPrk = 0;
                      $uasPrk = 0;
                      foreach ($nilai as $n) {
                        $semester = $n->semester;

                        if ($n->idMapel == 17) {
                          if ($n->jenisNilai == "Tugas") {
                            $tugasPrk += $n->nilai;
                          }
                          if ($n->jenisNilai == "Ulangan Harian") {
                            $UHPrk = $n->nilai;
                          }
                          if ($n->jenisNilai == "Praktek") {
                            $praktekPrk = $n->nilai;
                          }
                          if ($n->jenisNilai == "UTS") {
                            $utsPrk = $n->nilai;
                          }
                          if ($n->jenisNilai == "UAS") {
                            $uasPrk = $n->nilai;
                          }
                        }
                      }
                      if ($semester == 1) {
                        $NguruPrk = ($tugasPrk + $UHPrk ) / 5;
                        $totalGuruPrk = $NguruPrk * ($guru / 100);
                        $NsklhPrk = $utsPrk * ($sklh / 100);
                        $NtotalPrk = round($totalGuruPrk ) + round($NsklhPrk );
                      } else {
                        $NguruPrk = ($tugasPrk + $UHPrk ) / 5;
                        $totalGuruPrk = $NguruPrk * ($guru / 100);
                        $NsklhPrk = $uasPrk * ($sklh / 100);
                        $NtotalPrk = round($totalGuruPrk ) + round($NsklhPrk );
                      }
                      ?>
                      <input name="Prk" id="PrkId" class="form-control" type="text" value="<?= $NtotalPrk ?>" readonly>
                    </div>
                  </div>
                  <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3">Bahasa Indonesia</label>
                    <div class="col-md-1 col-sm-1">
                    <?php
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
                          if ($n->jenisNilai == "Ulangan Harian") {
                            $UHBi = $n->nilai;
                          }
                          if ($n->jenisNilai == "Praktek") {
                            $praktekBi = $n->nilai;
                          }
                          if ($n->jenisNilai == "UTS") {
                            $utsBi = $n->nilai;
                          }
                          if ($n->jenisNilai == "UAS") {
                            $uasBi = $n->nilai;
                          }
                        }
                      }
                      if ($semester == 1) {
                        $NguruBi = ($tugasBi + $UHBi) / 5;
                        $totalGuruBi = $NguruBi * ($guru / 100);
                        $NsklhBi = $utsBi * ($sklh / 100);
                        $NtotalBi = round($totalGuruBi) + round($NsklhBi);
                      } else {
                        $NguruBi = ($tugasBi + $UHBi) / 5;
                        $totalGuruBi = $NguruBi * ($guru / 100);
                        $NsklhBi = $uasBi * ($sklh / 100);
                        $NtotalBi = round($totalGuruBi) + round($NsklhBi);
                      }
                      ?>
                      <input name="bind" id="bindId" class="form-control" type="text" value="<?= $NtotalBi?>" readonly>
                    </div>
                    <?php
                    if ($jurusan == "IPA") { ?>
                      <label class="col-form-label col-md-3 col-sm-3">Fisika</label>
                      <div class="col-md-1 col-sm-1">
                      <?php
                      $tugasFis = 0;
                      $UHFis = 0;
                      $praktekFis = 0;
                      $utsFis = 0;
                      $uasFis = 0;
                      foreach ($nilai as $n) {
                        $semester = $n->semester;

                        if ($n->idMapel == 8) {
                          if ($n->jenisNilai == "Tugas") {
                            $tugasFis += $n->nilai;
                          }
                          if ($n->jenisNilai == "Ulangan Harian") {
                            $UHFis = $n->nilai;
                          }
                          if ($n->jenisNilai == "Praktek") {
                            $praktekFis = $n->nilai;
                          }
                          if ($n->jenisNilai == "UTS") {
                            $utsFis = $n->nilai;
                          }
                          if ($n->jenisNilai == "UAS") {
                            $uasFis = $n->nilai;
                          }
                        }
                      }
                      if ($semester == 1) {
                        $NguruFis = ($tugasFis + $UHFis ) / 5;
                        $totalGuruFis = $NguruFis * ($guru / 100);
                        $NsklhFis = $utsFis * ($sklh / 100);
                        $NtotalFis = round($totalGuruFis ) + round($NsklhFis );
                      } else {
                        $NguruFis = ($tugasFis + $UHFis ) / 5;
                        $totalGuruFis = $NguruFis * ($guru / 100);
                        $NsklhFis = $uasFis * ($sklh / 100);
                        $NtotalFis = round($totalGuruFis ) + round($NsklhFis );
                      }
                      ?>
                      <input name="Fis" id="FisId" class="form-control" type="text" value="<?= $NtotalFis ?>" readonly>
                      </div>
                    <?php } else { ?>
                      <label class="col-form-label col-md-3 col-sm-3">Ekonomi</label>
                      <div class="col-md-1 col-sm-1">
                      <?php
                      $tugasEko = 0;
                      $UHEko = 0;
                      $praktekEko = 0;
                      $utsEko = 0;
                      $uasEko = 0;
                      foreach ($nilai as $n) {
                        $semester = $n->semester;

                        if ($n->idMapel == 7) {
                          if ($n->jenisNilai == "Tugas") {
                            $tugasEko += $n->nilai;
                          }
                          if ($n->jenisNilai == "Ulangan Harian") {
                            $UHEko = $n->nilai;
                          }
                          if ($n->jenisNilai == "Praktek") {
                            $praktekEko = $n->nilai;
                          }
                          if ($n->jenisNilai == "UTS") {
                            $utsEko = $n->nilai;
                          }
                          if ($n->jenisNilai == "UAS") {
                            $uasEko = $n->nilai;
                          }
                        }
                      }
                      if ($semester == 1) {
                        $NguruEko = ($tugasEko + $UHEko ) / 5;
                        $totalGuruEko = $NguruEko * ($guru / 100);
                        $NsklhEko = $utsEko * ($sklh / 100);
                        $NtotalEko = round($totalGuruEko ) + round($NsklhEko );
                      } else {
                        $NguruEko = ($tugasEko + $UHEko ) / 5;
                        $totalGuruEko = $NguruEko * ($guru / 100);
                        $NsklhEko = $uasEko * ($sklh / 100);
                        $NtotalEko = round($totalGuruEko ) + round($NsklhEko );
                      }
                      ?>
                      <input name="Eko" id="EkoId" class="form-control" type="text" value="<?= $NtotalEko ?>" readonly>
                      </div>
                    <?php }
                    ?>
                    <label class="col-form-label col-md-3 col-sm-3">Pendidikan Jasmani, Olahraga, dan Kesehatan</label>
                    <div class="col-md-1 col-sm-1">
                    <?php
                      $tugasOr = 0;
                      $UHOr = 0;
                      $praktekOr = 0;
                      $utsOr = 0;
                      $uasOr = 0;
                      foreach ($nilai as $n) {
                        $semester = $n->semester;

                        if ($n->idMapel == 15) {
                          if ($n->jenisNilai == "Tugas") {
                            $tugasOr += $n->nilai;
                          }
                          if ($n->jenisNilai == "Ulangan Harian") {
                            $UHOr = $n->nilai;
                          }
                          if ($n->jenisNilai == "Praktek") {
                            $praktekOr = $n->nilai;
                          }
                          if ($n->jenisNilai == "UTS") {
                            $utsOr = $n->nilai;
                          }
                          if ($n->jenisNilai == "UAS") {
                            $uasOr = $n->nilai;
                          }
                        }
                      }
                      if ($semester == 1) {
                        $NguruOr = ($tugasOr + $UHOr ) / 5;
                        $totalGuruOr = $NguruOr * ($guru / 100);
                        $NsklhOr = $utsOr * ($sklh / 100);
                        $NtotalOr = round($totalGuruOr ) + round($NsklhOr );
                      } else {
                        $NguruOr = ($tugasOr + $UHOr ) / 5;
                        $totalGuruOr = $NguruOr * ($guru / 100);
                        $NsklhOr = $uasOr * ($sklh / 100);
                        $NtotalOr = round($totalGuruOr ) + round($NsklhOr );
                      }
                      ?>
                      <input name="Or" id="OrId" class="form-control" type="text" value="<?= $NtotalOr ?>" readonly>
                    </div>
                  </div>
                  <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3">Matematika (Umum)</label>
                    <div class="col-md-1 col-sm-1">
                    <?php
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
                          if ($n->jenisNilai == "Ulangan Harian") {
                            $UHMtk = $n->nilai;
                          }
                          if ($n->jenisNilai == "Praktek") {
                            $praktekMtk = $n->nilai;
                          }
                          if ($n->jenisNilai == "UTS") {
                            $utsMtk = $n->nilai;
                          }
                          if ($n->jenisNilai == "UAS") {
                            $uasMtk = $n->nilai;
                          }
                        }
                      }
                      if ($semester == 1) {
                        $NguruMtk = ($tugasMtk + $UHMtk) / 5;
                        $totalGuruMtk = $NguruMtk * ($guru / 100);
                        $NsklhMtk = $utsMtk * ($sklh / 100);
                        $NtotalMtk = round($totalGuruMtk) + round($NsklhMtk);
                      } else {
                        $NguruMtk = ($tugasMtk + $UHMtk) / 5;
                        $totalGuruMtk = $NguruMtk * ($guru / 100);
                        $NsklhMtk = $uasMtk * ($sklh / 100);
                        $NtotalMtk = round($totalGuruMtk) + round($NsklhMtk);
                      }
                      ?>
                      <input name="mtk" id="mtkId" class="form-control" type="text" value="<?= $NtotalMtk?>" readonly>
                    </div>
                    <?php
                    if ($jurusan == "IPA") { ?>
                      <label class="col-form-label col-md-3 col-sm-3">Kimia</label>
                      <div class="col-md-1 col-sm-1">
                      <?php
                      $tugasKim = 0;
                      $UHKim = 0;
                      $praktekKim = 0;
                      $utsKim = 0;
                      $uasKim = 0;
                      foreach ($nilai as $n) {
                        $semester = $n->semester;

                        if ($n->idMapel == 10) {
                          if ($n->jenisNilai == "Tugas") {
                            $tugasKim += $n->nilai;
                          }
                          if ($n->jenisNilai == "Ulangan Harian") {
                            $UHKim = $n->nilai;
                          }
                          if ($n->jenisNilai == "Praktek") {
                            $praktekKim = $n->nilai;
                          }
                          if ($n->jenisNilai == "UTS") {
                            $utsKim = $n->nilai;
                          }
                          if ($n->jenisNilai == "UAS") {
                            $uasKim = $n->nilai;
                          }
                        }
                      }
                      if ($semester == 1) {
                        $NguruKim = ($tugasKim + $UHKim ) / 5;
                        $totalGuruKim = $NguruKim * ($guru / 100);
                        $NsklhKim = $utsKim * ($sklh / 100);
                        $NtotalKim = round($totalGuruKim ) + round($NsklhKim );
                      } else {
                        $NguruKim = ($tugasKim + $UHKim ) / 5;
                        $totalGuruKim = $NguruKim * ($guru / 100);
                        $NsklhKim = $uasKim * ($sklh / 100);
                        $NtotalKim = round($totalGuruKim ) + round($NsklhKim );
                      }
                      ?>
                      <input name="Kim" id="KimId" class="form-control" type="text" value="<?= $NtotalKim ?>" readonly>
                      </div>
                    <?php } else { ?>
                      <label class="col-form-label col-md-3 col-sm-3">Sejarah Peminatan</label>
                      <div class="col-md-1 col-sm-1">
                      <?php
                      $tugasSjPm = 0;
                      $UHSjPm = 0;
                      $praktekSjPm = 0;
                      $utsSjPm = 0;
                      $uasSjPm = 0;
                      foreach ($nilai as $n) {
                        $semester = $n->semester;

                        if ($n->idMapel == 18) {
                          if ($n->jenisNilai == "Tugas") {
                            $tugasSjPm += $n->nilai;
                          }
                          if ($n->jenisNilai == "Ulangan Harian") {
                            $UHSjPm = $n->nilai;
                          }
                          if ($n->jenisNilai == "Praktek") {
                            $praktekSjPm = $n->nilai;
                          }
                          if ($n->jenisNilai == "UTS") {
                            $utsSjPm = $n->nilai;
                          }
                          if ($n->jenisNilai == "UAS") {
                            $uasSjPm = $n->nilai;
                          }
                        }
                      }
                      if ($semester == 1) {
                        $NguruSjPm = ($tugasSjPm + $UHSjPm ) / 5;
                        $totalGuruSjPm = $NguruSjPm * ($guru / 100);
                        $NsklhSjPm = $utsSjPm * ($sklh / 100);
                        $NtotalSjPm = round($totalGuruSjPm ) + round($NsklhSjPm );
                      } else {
                        $NguruSjPm = ($tugasSjPm + $UHSjPm ) / 5;
                        $totalGuruSjPm = $NguruSjPm * ($guru / 100);
                        $NsklhSjPm = $uasSjPm * ($sklh / 100);
                        $NtotalSjPm = round($totalGuruSjPm ) + round($NsklhSjPm );
                      }
                      ?>
                      <input name="SjPm" id="SjPmId" class="form-control" type="text" value="<?= $NtotalSjPm ?>" readonly>
                      </div>
                    <?php }
                    ?>
                    <label class="col-form-label col-md-3 col-sm-3">Bahasa Arab Quran (Muatan Lokal)</label>
                    <div class="col-md-1 col-sm-1">
                    <?php
                      $tugasQurdis = 0;
                      $UHQurdis = 0;
                      $praktekQurdis = 0;
                      $utsQurdis = 0;
                      $uasQurdis = 0;
                      foreach ($nilai as $n) {
                        $semester = $n->semester;

                        if ($n->idMapel == 13) {
                          if ($n->jenisNilai == "Tugas") {
                            $tugasQurdis += $n->nilai;
                          }
                          if ($n->jenisNilai == "Ulangan Harian") {
                            $UHQurdis = $n->nilai;
                          }
                          if ($n->jenisNilai == "Praktek") {
                            $praktekQurdis = $n->nilai;
                          }
                          if ($n->jenisNilai == "UTS") {
                            $utsQurdis = $n->nilai;
                          }
                          if ($n->jenisNilai == "UAS") {
                            $uasQurdis = $n->nilai;
                          }
                        }
                      }
                      if ($semester == 1) {
                        $NguruQurdis = ($tugasQurdis + $UHQurdis) / 5;
                        $totalGuruQurdis = $NguruQurdis * ($guru / 100);
                        $NsklhQurdis = $utsQurdis * ($sklh / 100);
                        $NtotalQurdis = round($totalGuruQurdis) + round($NsklhQurdis);
                      } else {
                        $NguruQurdis = ($tugasQurdis + $UHQurdis) / 5;
                        $totalGuruQurdis = $NguruQurdis * ($guru / 100);
                        $NsklhQurdis = $uasQurdis * ($sklh / 100);
                        $NtotalQurdis = round($totalGuruQurdis) + round($NsklhQurdis);
                      }
                      ?>
                      <input name="Qurdis" id="QurdisId" class="form-control" type="text" value="<?= $NtotalQurdis?>" readonly>
                    </div>
                  </div>
                  <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3">Sejarah Indonesia</label>
                    <div class="col-md-1 col-sm-1">
                    <?php
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
                          if ($n->jenisNilai == "Ulangan Harian") {
                            $UHSj = $n->nilai;
                          }
                          if ($n->jenisNilai == "Praktek") {
                            $praktekSj = $n->nilai;
                          }
                          if ($n->jenisNilai == "UTS") {
                            $utsSj = $n->nilai;
                          }
                          if ($n->jenisNilai == "UAS") {
                            $uasSj = $n->nilai;
                          }
                        }
                      }
                      if ($semester == 1) {
                        $NguruSj = ($tugasSj + $UHSj) / 5;
                        $totalGuruSj = $NguruSj * ($guru / 100);
                        $NsklhSj = $utsSj * ($sklh / 100);
                        $NtotalSj = round($totalGuruSj) + round($NsklhSj);
                      } else {
                        $NguruSj = ($tugasSj + $UHSj) / 5;
                        $totalGuruSj = $NguruSj * ($guru / 100);
                        $NsklhSj = $uasSj * ($sklh / 100);
                        $NtotalSj = round($totalGuruSj) + round($NsklhSj);
                      }
                      ?>
                      <input name="Sj" id="SjId" class="form-control" type="text" value="<?= $NtotalSj?>" readonly>
                    </div>
                    <label class="col-form-label col-md-3 col-sm-3">Bahasa dan Sastra Arab</label>
                    <div class="col-md-1 col-sm-1">
                    <?php
                      $tugasArab = 0;
                      $UHArab = 0;
                      $praktekArab = 0;
                      $utsArab = 0;
                      $uasArab = 0;
                      foreach ($nilai as $n) {
                        $semester = $n->semester;

                        if ($n->idMapel == 1) {
                          if ($n->jenisNilai == "Tugas") {
                            $tugasArab += $n->nilai;
                          }
                          if ($n->jenisNilai == "Ulangan Harian") {
                            $UHArab = $n->nilai;
                          }
                          if ($n->jenisNilai == "Praktek") {
                            $praktekArab = $n->nilai;
                          }
                          if ($n->jenisNilai == "UTS") {
                            $utsArab = $n->nilai;
                          }
                          if ($n->jenisNilai == "UAS") {
                            $uasArab = $n->nilai;
                          }
                        }
                      }
                      if ($semester == 1) {
                        $NguruArab = ($tugasArab + $UHArab ) / 5;
                        $totalGuruArab = $NguruArab * ($guru / 100);
                        $NsklhArab = $utsArab * ($sklh / 100);
                        $NtotalArab = round($totalGuruArab ) + round($NsklhArab );
                      } else {
                        $NguruArab = ($tugasArab + $UHArab ) / 5;
                        $totalGuruArab = $NguruArab * ($guru / 100);
                        $NsklhArab = $uasArab * ($sklh / 100);
                        $NtotalArab = round($totalGuruArab ) + round($NsklhArab );
                      }
                      ?>
                      <input name="Arab" id="ArabId" class="form-control" type="text" value="<?= $NtotalArab ?>" readonly>
                    </div>
                    <label class="col-form-label col-md-3 col-sm-3">English Conversation</label>
                    <div class="col-md-1 col-sm-1">
                    <?php
                      $tugasEc = 0;
                      $UHEc = 0;
                      $praktekEc = 0;
                      $utsEc = 0;
                      $uasEc = 0;
                      foreach ($nilai as $n) {
                        $semester = $n->semester;

                        if ($n->idMapel == 23) {
                          if ($n->jenisNilai == "Tugas") {
                            $tugasEc += $n->nilai;
                          }
                          if ($n->jenisNilai == "Ulangan Harian") {
                            $UHEc = $n->nilai;
                          }
                          if ($n->jenisNilai == "Praktek") {
                            $praktekIng = $n->nilai;
                          }
                          if ($n->jenisNilai == "UTS") {
                            $utsEc = $n->nilai;
                          }
                          if ($n->jenisNilai == "UAS") {
                            $uasEc = $n->nilai;
                          }
                        }
                      }
                      if ($semester == 1) {
                        $NguruEc = ($tugasEc + $UHEc ) / 5;
                        $totalGuruEc = $NguruEc * ($guru / 100);
                        $NsklhEc = $utsEc * ($sklh / 100);
                        $NtotalEc = round($totalGuruEc ) + round($NsklhEc );
                      } else {
                        $NguruEc = ($tugasEc + $UHEc ) / 5;
                        $totalGuruEc = $NguruEc * ($guru / 100);
                        $NsklhEc = $uasEc * ($sklh / 100);
                        $NtotalEc = round($totalGuruEc ) + round($NsklhEc );
                      }
                      ?>
                      <input name="Ec" id="EcId" class="form-control" type="text" value="<?= $NtotalEc ?>" readonly>
                    </div>
                  </div>
                  <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3">Bahasa Inggris</label>
                    <div class="col-md-1 col-sm-1">
                    <?php
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
                          if ($n->jenisNilai == "Ulangan Harian") {
                            $UHIng = $n->nilai;
                          }
                          if ($n->jenisNilai == "Praktek") {
                            $praktekIng = $n->nilai;
                          }
                          if ($n->jenisNilai == "UTS") {
                            $utsIng = $n->nilai;
                          }
                          if ($n->jenisNilai == "UAS") {
                            $uasIng = $n->nilai;
                          }
                        }
                      }
                      if ($semester == 1) {
                        $NguruIng = ($tugasIng + $UHIng ) / 5;
                        $totalGuruIng = $NguruIng * ($guru / 100);
                        $NsklhIng = $utsIng * ($sklh / 100);
                        $NtotalIng = round($totalGuruIng ) + round($NsklhIng );
                      } else {
                        $NguruIng = ($tugasIng + $UHIng ) / 5;
                        $totalGuruIng = $NguruIng * ($guru / 100);
                        $NsklhIng = $uasIng * ($sklh / 100);
                        $NtotalIng = round($totalGuruIng ) + round($NsklhIng );
                      }
                      ?>
                      <input name="Ing" id="IngId" class="form-control" type="text" value="<?= $NtotalIng ?>" readonly>
                    </div>
                    <?php
                    if ($jurusan == "IPA") { ?>
                      <label class="col-form-label col-md-3 col-sm-3">Sosiologi</label>
                      <div class="col-md-1 col-sm-1">
                      <?php
                      $tugasSosLm = 0;
                      $UHSosLm = 0;
                      $praktekSosLm = 0;
                      $utsSosLm = 0;
                      $uasSosLm = 0;
                      foreach ($nilai as $n) {
                        $semester = $n->semester;

                        if ($n->idMapel == 28) {
                          if ($n->jenisNilai == "Tugas") {
                            $tugasSosLm += $n->nilai;
                          }
                          if ($n->jenisNilai == "Ulangan Harian") {
                            $UHSosLm = $n->nilai;
                          }
                          if ($n->jenisNilai == "Praktek") {
                            $praktekSosLm = $n->nilai;
                          }
                          if ($n->jenisNilai == "UTS") {
                            $utsSosLm = $n->nilai;
                          }
                          if ($n->jenisNilai == "UAS") {
                            $uasSosLm = $n->nilai;
                          }
                        }
                      }
                      if ($semester == 1) {
                        $NguruSosLm = ($tugasSosLm + $UHSosLm ) / 5;
                        $totalGuruSosLm = $NguruSosLm * ($guru / 100);
                        $NsklhSosLm = $utsSosLm * ($sklh / 100);
                        $NtotalSosLm = round($totalGuruSosLm ) + round($NsklhSosLm );
                      } else {
                        $NguruSosLm = ($tugasSosLm + $UHSosLm ) / 5;
                        $totalGuruSosLm = $NguruSosLm * ($guru / 100);
                        $NsklhSosLm = $uasSosLm * ($sklh / 100);
                        $NtotalSosLm = round($totalGuruSosLm ) + round($NsklhSosLm );
                      }
                      ?>
                      <input name="SosLm" id="SosLmId" class="form-control" type="text" value="<?= $NtotalSosLm ?>" readonly>
                      </div>
                    <?php } else { ?>
                      <label class="col-form-label col-md-3 col-sm-3">Biologi</label>
                      <div class="col-md-1 col-sm-1">
                      <?php
                      $tugasBioLm = 0;
                      $UHBioLm = 0;
                      $praktekBioLm = 0;
                      $utsBioLm = 0;
                      $uasBioLm = 0;
                      foreach ($nilai as $n) {
                        $semester = $n->semester;

                        if ($n->idMapel == 27) {
                          if ($n->jenisNilai == "Tugas") {
                            $tugasBioLm += $n->nilai;
                          }
                          if ($n->jenisNilai == "Ulangan Harian") {
                            $UHBioLm = $n->nilai;
                          }
                          if ($n->jenisNilai == "Praktek") {
                            $praktekBioLm = $n->nilai;
                          }
                          if ($n->jenisNilai == "UTS") {
                            $utsBioLm = $n->nilai;
                          }
                          if ($n->jenisNilai == "UAS") {
                            $uasBioLm = $n->nilai;
                          }
                        }
                      }
                      if ($semester == 1) {
                        $NguruBioLm = ($tugasBioLm + $UHBioLm ) / 5;
                        $totalGuruBioLm = $NguruBioLm * ($guru / 100);
                        $NsklhBioLm = $utsBioLm * ($sklh / 100);
                        $NtotalBioLm = round($totalGuruBioLm ) + round($NsklhBioLm );
                      } else {
                        $NguruBioLm = ($tugasBioLm + $UHBioLm ) / 5;
                        $totalGuruBioLm = $NguruBioLm * ($guru / 100);
                        $NsklhBioLm = $uasBioLm * ($sklh / 100);
                        $NtotalBioLm = round($totalGuruBioLm ) + round($NsklhBioLm );
                      }
                      ?>
                      <input name="BioLm" id="BioLmId" class="form-control" type="text" value="<?= $NtotalBioLm ?>" readonly>
                      </div>
                    <?php }
                    ?>
                    <label class="col-form-label col-md-3 col-sm-3">Aqidah Akhlak</label>
                    <div class="col-md-1 col-sm-1">
                    <?php
                      $tugasAqidah = 0;
                      $UHAqidah = 0;
                      $praktekAqidah = 0;
                      $utsAqidah = 0;
                      $uasAqidah = 0;
                      foreach ($nilai as $n) {
                        $semester = $n->semester;

                        if ($n->idMapel == 24) {
                          if ($n->jenisNilai == "Tugas") {
                            $tugasAqidah += $n->nilai;
                          }
                          if ($n->jenisNilai == "Ulangan Harian") {
                            $UHAqidah = $n->nilai;
                          }
                          if ($n->jenisNilai == "Praktek") {
                            $praktekAqidah = $n->nilai;
                          }
                          if ($n->jenisNilai == "UTS") {
                            $utsAqidah = $n->nilai;
                          }
                          if ($n->jenisNilai == "UAS") {
                            $uasAqidah = $n->nilai;
                          }
                        }
                      }
                      if ($semester == 1) {
                        $NguruAqidah = ($tugasAqidah + $UHAqidah ) / 5;
                        $totalGuruAqidah = $NguruAqidah * ($guru / 100);
                        $NsklhAqidah = $utsAqidah * ($sklh / 100);
                        $NtotalAqidah = round($totalGuruAqidah ) + round($NsklhAqidah );
                      } else {
                        $NguruAqidah = ($tugasAqidah + $UHAqidah ) / 5;
                        $totalGuruAqidah = $NguruAqidah * ($guru / 100);
                        $NsklhAqidah = $uasAqidah * ($sklh / 100);
                        $NtotalAqidah = round($totalGuruAqidah ) + round($NsklhAqidah );
                      }
                      ?>
                      <input name="Aqidah" id="AqidahId" class="form-control" type="text" value="<?= $NtotalAqidah ?>" readonly>
                    </div>
                  </div>
                  <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3">Bimbingan TIK</label>
                    <div class="col-md-1 col-sm-1">
                    <?php
                      $tugasTik = 0;
                      $UHTik = 0;
                      $praktekTik = 0;
                      $utsTik = 0;
                      $uasTik = 0;
                      foreach ($nilai as $n) {
                        $semester = $n->semester;

                        if ($n->idMapel == 6) {
                          if ($n->jenisNilai == "Tugas") {
                            $tugasTik += $n->nilai;
                          }
                          if ($n->jenisNilai == "Ulangan Harian") {
                            $UHTik = $n->nilai;
                          }
                          if ($n->jenisNilai == "Praktek") {
                            $praktekTik = $n->nilai;
                          }
                          if ($n->jenisNilai == "UTS") {
                            $utsTik = $n->nilai;
                          }
                          if ($n->jenisNilai == "UAS") {
                            $uasTik = $n->nilai;
                          }
                        }
                      }
                      if ($semester == 1) {
                        $NguruTik = ($tugasTik + $UHTik ) / 5;
                        $totalGuruTik = $NguruTik * ($guru / 100);
                        $NsklhTik = $utsTik * ($sklh / 100);
                        $NtotalTik = round($totalGuruTik ) + round($NsklhTik );
                      } else {
                        $NguruTik = ($tugasTik + $UHTik ) / 5;
                        $totalGuruTik = $NguruTik * ($guru / 100);
                        $NsklhTik = $uasTik * ($sklh / 100);
                        $NtotalTik = round($totalGuruTik ) + round($NsklhTik );
                      }
                      ?>
                      <input name="Tik" id="TikId" class="form-control" type="text" value="<?= $NtotalTik ?>" readonly>
                    </div>
                    <label class="col-form-label col-md-3 col-sm-3">Muhadoroh</label>
                    <div class="col-md-1 col-sm-1">
                    <?php
                      $tugasMuhadoroh = 0;
                      $UHMuhadoroh = 0;
                      $praktekMuhadoroh = 0;
                      $utsMuhadoroh = 0;
                      $uasMuhadoroh = 0;
                      foreach ($nilai as $n) {
                        $semester = $n->semester;

                        if ($n->idMapel == 25) {
                          if ($n->jenisNilai == "Tugas") {
                            $tugasMuhadoroh += $n->nilai;
                          }
                          if ($n->jenisNilai == "Ulangan Harian") {
                            $UHMuhadoroh = $n->nilai;
                          }
                          if ($n->jenisNilai == "Praktek") {
                            $praktekMuhadoroh = $n->nilai;
                          }
                          if ($n->jenisNilai == "UTS") {
                            $utsMuhadoroh = $n->nilai;
                          }
                          if ($n->jenisNilai == "UAS") {
                            $uasMuhadoroh = $n->nilai;
                          }
                        }
                      }
                      if ($semester == 1) {
                        $NguruMuhadoroh = ($tugasMuhadoroh + $UHMuhadoroh ) / 5;
                        $totalGuruMuhadoroh = $NguruMuhadoroh * ($guru / 100);
                        $NsklhMuhadoroh = $utsMuhadoroh * ($sklh / 100);
                        $NtotalMuhadoroh = round($totalGuruMuhadoroh ) + round($NsklhMuhadoroh );
                      } else {
                        $NguruMuhadoroh = ($tugasMuhadoroh + $UHMuhadoroh ) / 5;
                        $totalGuruMuhadoroh = $NguruMuhadoroh * ($guru / 100);
                        $NsklhMuhadoroh = $uasMuhadoroh * ($sklh / 100);
                        $NtotalMuhadoroh = round($totalGuruMuhadoroh ) + round($NsklhMuhadoroh );
                      }
                      ?>
                      <input name="Muhadoroh" id="MuhadorohId" class="form-control" type="text" value="<?= $NtotalMuhadoroh ?>" readonly>
                    </div>
                  </div>
                </div>
                <?php
                $totalNilai = 0;
                if ($jurusan == "IPA") {
                    $totalNilai = ($NtotalPai+$NtotalMtkPm+$NtotalSenbud+$NtotalPkn+$NtotalBio+$NtotalPrk+$NtotalBi+$NtotalFis+$NtotalOr+$NtotalMtk+$NtotalKim+$NtotalQurdis+$NtotalSj+$NtotalArab+$NtotalEc+$NtotalIng+$NtotalSosLm+$NtotalAqidah+$NtotalTik+$NtotalMuhadoroh)/22;?>
                    <input name="totalNilai" id="totalId" class="form-control" type="text" value="<?= round($totalNilai) ?>" readonly hidden>
                <?php }
                else {
                    $totalNilai = ($NtotalPai+$NtotalSjPm+$NtotalSenbud+$NtotalPkn+$NtotalSos+$NtotalPrk+$NtotalBi+$NtotalEko+$NtotalOr+$NtotalMtk+$NtotalGeo+$NtotalQurdis+$NtotalSj+$NtotalArab+$NtotalEc+$NtotalIng+$NtotalBioLm+$NtotalAqidah+$NtotalTik+$NtotalMuhadoroh)/22;?>
                    <input name="totalNilai" id="totalId" class="form-control" type="text" value="<?= round($totalNilai) ?>" readonly hidden>
                <?php }
                ?>
                <input name="siswaId" id="idSiswa" class="form-control" type="text" value="<?= $id ?>" readonly hidden>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-info" id="btn_update">Simpan</button>
                </div>
              </form>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
      <!-- /page content -->

      <!-- footer content -->
      <footer>
        <?php include("v-Footer.php") ?>
      </footer>
      <!-- /footer content -->
    </div>
  </div>

  <!-- jQuery -->
  <script src="<?php echo base_url(); ?>assets/inter/vendors/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="<?php echo base_url(); ?>assets/inter/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!-- FastClick -->
  <script src="<?php echo base_url(); ?>assets/inter/vendors/fastclick/lib/fastclick.js"></script>
  <!-- NProgress -->
  <script src="<?php echo base_url(); ?>assets/inter/vendors/nprogress/nprogress.js"></script>
  <!-- iCheck -->
  <script src="<?php echo base_url(); ?>assets/inter/vendors/iCheck/icheck.min.js"></script>
  <!-- Datatables -->
  <script src="<?php echo base_url(); ?>assets/inter/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/inter/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/inter/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/inter/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/inter/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/inter/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/inter/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/inter/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/inter/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/inter/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/inter/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
  <script src="<?php echo base_url(); ?>assets/inter/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/inter/vendors/jszip/dist/jszip.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/inter/vendors/pdfmake/build/pdfmake.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/inter/vendors/pdfmake/build/vfs_fonts.js"></script>

  <!-- Custom Theme Scripts -->
  <script src="<?php echo base_url(); ?>assets/inter/build/js/custom.min.js"></script>

</body>

</html>