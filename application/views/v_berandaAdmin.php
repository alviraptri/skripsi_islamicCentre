<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="images/favicon.ico" type="image/ico" />

  <title>Beranda | Information Academic Islamic Centre</title>

  <!-- Bootstrap -->
  <link href="<?php echo base_url(); ?>assets/inter/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="<?php echo base_url(); ?>assets/inter/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- NProgress -->
  <link href="<?php echo base_url(); ?>assets/inter/vendors/nprogress/nprogress.css" rel="stylesheet">
  <!-- iCheck -->
  <link href="<?php echo base_url(); ?>assets/inter/vendors/iCheck/skins/flat/green.css" rel="stylesheet">

  <!-- bootstrap-progressbar -->
  <link href="<?php echo base_url(); ?>assets/inter/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
  <!-- JQVMap -->
  <link href="<?php echo base_url(); ?>assets/inter/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet" />
  <!-- bootstrap-daterangepicker -->
  <link href="<?php echo base_url(); ?>assets/inter/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

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
        <!-- top tiles done -->
        <div class="row top_tiles">
          <div class="animated flipInY col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <div class="tile-stats">
              <div class="icon"><i class="fa fa-graduation-cap"></i></div>
              <div class="count"><?php echo $jmlhSiswa; ?></div>
              <h3>Total Siswa</h3>
            </div>
          </div>
          <div class="animated flipInY col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <div class="tile-stats">
              <div class="icon"><i class="fa fa-user"></i></div>
              <div class="count"><?php echo $jmlhGuru; ?></div>
              <h3>Total Guru</h3>
            </div>
          </div>
          <div class="animated flipInY col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <div class="tile-stats">
              <div class="icon"><i class="fa fa-institution"></i></div>
              <div class="count"><?php echo $jmlhKls; ?></div>
              <h3>Total Kelas</h3>
            </div>
          </div>
          <div class="animated flipInY col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <?php
            $total = 0;
            $avg = 0;
            foreach ($nilai as $n) {
              $total += $n->totalNilai;
            }
            $avg = $total / $rapor;
            ?>
            <div class="tile-stats">
              <div class="icon"><i class="fa fa-bar-chart"></i></div>
              <div class="count"><?php echo round($avg); ?></div>
              <h3>Rata-rata Nilai</h3>
            </div>
          </div>
        </div>
        <!-- /top tiles done -->
        <br />

        <!-- ranking paralel dan nilai tertinggi -->
        <div class="row">
          <div class="col-md-6 col-sm-6  ">
            <div class="x_panel">
              <div class="x_title">
                <h2>Ranking Paralel</h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li>
                    <select class="form-control" id="keteranganId" name="keteranganId">
                      <option value=""> Kelas </option>
                      <?php
                      foreach ($ketKelas as $list) { ?>
                        <option value="<?php echo $list->ketKelas ?>"><?php echo $list->ketKelas ?> </option>
                      <?php } ?>
                    </select></li>
                  <li>&nbsp;</li>
                  <li>

                  </li>
                </ul>
                <div class="clearfix"></div>
              </div>
              <select class="form-control" id="jurusanId">
                <option value=""> Jurusan </option>
              </select>
              <div class="x_content">

                <table class="table">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Nama</th>
                      <th>Kelas</th>
                    </tr>
                  </thead>
                  <tbody id="rankingId">

                  </tbody>
                </table>

              </div>
            </div>
          </div>

          <div class="col-md-6 col-sm-6  ">
            <div class="x_panel">
              <div class="x_title">
                <h2>Nilai Tertinggi</h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li><select class="form-control" id="kelasId">
                      <option value=""> Kelas </option>
                      <?php
                      foreach ($ketKelas as $list) { ?>
                        <option value="<?php echo $list->ketKelas ?>"><?php echo $list->ketKelas ?> </option>
                      <?php } ?>
                    </select></li>
                  <li>&nbsp;</li>
                  <li>

                  </li>
                </ul>
                <div class="clearfix"></div>
              </div>
              <select class="form-control" id="mapelId">
                <option value=""> Mata Pelajaran </option>
              </select>
              <div class="x_content">

                <table class="table">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Nama</th>
                      <th>Kelas</th>
                    </tr>
                  </thead>
                  <tbody id="nilaiId">

                  </tbody>
                </table>

              </div>
            </div>
          </div>
        </div>
        <!-- ranking paralel dan nilai tertinggi -->

        <div class="row">
          <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="x_panel tile fixed_height_320">
              <div class="x_title">
                <h2>Ranking Kelas</h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li>
                  </li>
                  <li>
                  </li>
                  <li><select class="form-control" id="klsId" name="kls">
                      <option value=""> Kelas </option>
                      <?php
                      foreach ($kls as $list) { ?>
                        <option value="<?php echo $list->idKelas ?>"><?php echo $list->ketKelas?> <?php echo $list->jurusanKelas?> <?php echo $list->nomorKelas ?></option>
                      <?php } ?>
                      </select>
                  </li>
                </ul>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">

                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Nama</th>
                        </tr>
                      </thead>
                      <tbody id="namaSiswaId">
                      </tbody>
                    </table>

                  </div>
            </div>
          </div>

          <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="x_panel tile fixed_height_320">
              <div class="x_title">
                <h2>Ranking Terendah</h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li>
                  </li>
                  <li>
                  </li>
                  <li><select class="form-control" id="klssId" name="kls">
                      <option value=""> Kelas </option>
                      <?php
                      foreach ($kls as $list) { ?>
                        <option value="<?php echo $list->idKelas ?>"><?php echo $list->ketKelas?> <?php echo $list->jurusanKelas?> <?php echo $list->nomorKelas ?></option>
                      <?php } ?>
                      </select>
                  </li>
                </ul>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">

                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Nama</th>
                        </tr>
                      </thead>
                      <tbody id="namaaSiswaId">
                      </tbody>
                    </table>

                  </div>
            </div>
          </div>


          <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="x_panel tile fixed_height_320">
              <div class="x_title">
                <h2>Total Absensi</h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li>
                  </li>
                  <li>
                  </li>
                  <li><select class="form-control" id="absenKlsId" name="kls">
                      <option value=""> Kelas </option>
                      <?php
                      foreach ($kls as $list) { ?>
                        <option value="<?php echo $list->idKelas ?>"><?php echo $list->ketKelas?> <?php echo $list->jurusanKelas?> <?php echo $list->nomorKelas ?></option>
                      <?php } ?>
                      </select>
                  </li>
                </ul>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">

              <select class="form-control" id="absensiId" name="kls">
                      <option value=""> Absensi </option>
                      </select>
                      <br>
                      <h1 style="font-size: 100px" id="hslAbsenId"></h1>
                      <p><center>Siswa</center></p>

                  </div>
            </div>
          </div>

        </div>

        <div class="row">

          <div class="col-md-4 col-sm-4 col-xs-12">
          <div class="x_panel">
                <div class="x_title">
                  <h2>Ekstrakurikuler Siswa </h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <div class="dashboard-widget-content">

                    <ul class="list-unstyled timeline widget">
                      <?php
                      foreach ($ekskul as $e) {?>
                      
                      <li>
                        <div class="block">
                          <div class="block_content">
                            <h2 class="title">
                                              <?= $e->namaEkskul?>
                                          </h2>
                          </div>
                        </div>
                      </li>
                      <?php }
                      ?>
                    </ul>
                  </div>
                </div>
              </div>
          </div>


          <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Jurusan Kuliah Siswa</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Nama Jurusan dan Universitas</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $num = 1;
                        foreach ($kuliah as $k) { ?>
                          <tr>
                            <th scope="row"><?= $num ?></th>
                            <td><?= $k->namaAlternatif ?></td>
                          </tr>
                        <?php $num++;
                        }
                        ?>
                      </tbody>
                    </table>

                  </div>
                </div>
              </div>

            </div>
          </div>

          <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Rekomendasi</h2>
                    <ul class="nav navbar-right panel_toolbox">
                  <li>
                  </li>
                  <li>
                  </li>
                  <li><select class="form-control" id="idKelas" name="kls">
                      <option value=""> Kelas </option>
                      <?php
                      foreach ($kls as $list) { ?>
                        <option value="<?php echo $list->idKelas ?>"><?php echo $list->ketKelas?> <?php echo $list->jurusanKelas?> <?php echo $list->nomorKelas ?></option>
                      <?php } ?>
                      </select>
                  </li>
                </ul>
                    <div class="clearfix"></div>
                  </div>
                  
                  <div class="x_content">
                  <select class="form-control" id="namaId" name="kls">
                      <option value=""> Nama Siswa </option>
                      </select>
<br>
                    <table class="table table-striped">
                      <tbody id="rekomendasiId">
                      </tbody>
                    </table>

                  </div>
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

  <script type="text/javascript" src="<?php echo base_url() . 'assets/jquery-3.3.1.js' ?>"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      //view mapel dan kelas dan id jadwal
      $('#keteranganId').change(function() {
        var ket = $(this).val();
        $.ajax({
          url: "<?php echo site_url('c_beranda/getJurusan'); ?>",
          method: "POST",
          data: {
            ket: ket
          },
          async: true,
          dataType: 'JSON',
          success: function(data) {
            var html = '';
            var i;
            html = '<option value=""> Jurusan </option>';
            for (i = 0; i < data.length; i++) {
              html += '<option value="' + data[i].jurusanKelas + '"> ' + data[i].jurusanKelas + ' </option>';
            }
            $('#jurusanId').html(html);
          }
        });
        return false;
      });

      //view mapel dan kelas dan id jadwal
      $('#jurusanId').change(function() {
        var jurusan = $(this).val();
        var ket = $('#keteranganId').val();
        $.ajax({
          url: "<?php echo site_url('c_beranda/getNilaiSiswa'); ?>",
          method: "POST",
          data: {
            jurusan: jurusan,
            ket: ket
          },
          async: true,
          dataType: 'JSON',
          success: function(data) {
            var html = '';
            var i;
            var number = 1;
            for (i = 0; i < data.length; i++) {
              html += '<tr>' +
                '<td>' + number + '</td>' +
                '<td>' + data[i].namaUser + '</td>' +
                '<td>' + data[i].ketKelas + ' ' + data[i].jurusanKelas + ' ' + data[i].nomorKelas + '</td>' +
                '</tr>';
              number++;
            }
            $('#rankingId').html(html);
          }
        });
        return false;
      });

      $('#kelasId').change(function() {
        var kls = $(this).val();
        $.ajax({
          url: "<?php echo site_url('c_beranda/getMapel'); ?>",
          method: "POST",
          data: {
            kls: kls
          },
          async: true,
          dataType: 'JSON',
          success: function(data) {
            var html = '';
            var i;
            html = '<option value=""> Mata Pelajaran </option>';
            for (i = 0; i < data.length; i++) {
              html += '<option value="' + data[i].idMapel + '"> ' + data[i].namaMapel + ' </option>';
            }
            $('#mapelId').html(html);
          }
        });
        return false;
      });

      //view mapel dan kelas dan id jadwal
      $('#mapelId').change(function() {
        var mapel = $(this).val();
        var kls = $('#kelasId').val();
        $.ajax({
          url: "<?php echo site_url('c_beranda/getHasilNilai'); ?>",
          method: "POST",
          data: {
            mapel: mapel,
            kls: kls
          },
          async: true,
          dataType: 'JSON',
          success: function(data) {
            var html = '';
            var i;
            var number = 1;
            for (i = 0; i < data.length; i++) {
              html += '<tr>' +
                '<td>' + number + '</td>' +
                '<td>' + data[i].namaUser + '</td>' +
                '<td>' + data[i].ketKelas + ' ' + data[i].jurusanKelas + ' ' + data[i].nomorKelas + '</td>' +
                '</tr>';
              number++;
            }
            $('#nilaiId').html(html);
          }
        });
        return false;
      });

      //view mapel dan kelas dan id jadwal
      $('#klsId').change(function() {
        var kls = $(this).val();
        $.ajax({
          url: "<?php echo site_url('c_beranda/getNamaSiswa'); ?>",
          method: "POST",
          data: {
            kls: kls
          },
          async: true,
          dataType: 'JSON',
          success: function(data) {
            var html = '';
            var i;
            var number = 1;
            for (i = 0; i < data.length; i++) {
              html += '<tr>' +
                '<td>' + number + '</td>' +
                '<td>' + data[i].namaUser + '</td>' +
                '</tr>';
              number++;
            }
            $('#namaSiswaId').html(html);
          }
        });
        return false;
      });

      //view mapel dan kelas dan id jadwal
      $('#klssId').change(function() {
        var kls = $(this).val();
        $.ajax({
          url: "<?php echo site_url('c_beranda/getNilaiTerendah'); ?>",
          method: "POST",
          data: {
            kls: kls
          },
          async: true,
          dataType: 'JSON',
          success: function(data) {
            var html = '';
            var i;
            var number = 1;
            for (i = 0; i < data.length; i++) {
              html += '<tr>' +
                '<td>' + number + '</td>' +
                '<td>' + data[i].namaUser + '</td>' +
                '</tr>';
              number++;
            }
            $('#namaaSiswaId').html(html);
          }
        });
        return false;
      });

      //view mapel dan kelas dan id jadwal
      $('#absenKlsId').change(function() {
        var kls = $(this).val();
        $.ajax({
          url: "<?php echo site_url('c_beranda/getJenisAbsen'); ?>",
          method: "POST",
          data: {
            kls: kls
          },
          async: true,
          dataType: 'JSON',
          success: function(data) {
            var html = '';
            var i;
            var number = 1;
            var ket = '';
            html = '<option value=""> Absensi </option>';
            for (i = 0; i < data.length; i++) {
              if (data[i].absen == "H") {
                ket = "Hadir";
              }
              else if (data[i].absen == "A") {
                ket = "Alpa";
              }
              else if (data[i].absen == "S") {
                ket = "Sakit";
              }
              else if (data[i].absen == "I") {
                ket = "Izin";
              }
              html += '<option value="' + data[i].absen + '"> ' + ket + ' </option>';
            }
            $('#absensiId').html(html);
          }
        });
        return false;
      });

      //view mapel dan kelas dan id jadwal
      $('#absensiId').change(function() {
        var absen = $(this).val();
        var kls = $('#absenKlsId').val();
        $.ajax({
          url: "<?php echo site_url('c_beranda/getJmlhAbsen'); ?>",
          method: "POST",
          data: {
            absen: absen,
            kls: kls
          },
          async: true,
          dataType: 'JSON',
          success: function(data) {
            var html = '';
            var i;
              html += '<center>'+data.length+'</center>';
            $('#hslAbsenId').html(html);
          }
        });
        return false;
      });

      //view mapel dan kelas dan id jadwal
      $('#idKelas').change(function() {
        var kls = $(this).val();
        $.ajax({
          url: "<?php echo site_url('c_beranda/getSiswa'); ?>",
          method: "POST",
          data: {
            kls: kls
          },
          async: true,
          dataType: 'JSON',
          success: function(data) {
            var html = '';
            var i;
            html = '<option value=""> Nama Siswa </option>';
            for (i = 0; i < data.length; i++) {
              html += '<option value="' + data[i].idSiswa + '"> ' + data[i].namaUser + ' </option>';
            }
            $('#namaId').html(html);
          }
        });
        return false;
      });

      //view mapel dan kelas dan id jadwal
      $('#namaId').change(function() {
        var id = $(this).val();
        $.ajax({
          url: "<?php echo site_url('c_beranda/getRekomendasi'); ?>",
          method: "POST",
          data: {
            id: id
          },
          async: true,
          dataType: 'JSON',
          success: function(data) {
            var html = '';
            var i;
            var number = 1;
            for (i = 0; i < data.length; i++) {
              html += '<tr>' +
                '<td>' + number + '</td>' +
                '<td>' + data[i].namaAlternatif + '</td>' +
                '</tr>';
              number++;
            }
            $('#rekomendasiId').html(html);
          }
        });
        return false;
      });
    });
  </script>

  <!-- jQuery -->
  <script src="<?php echo base_url(); ?>assets/inter/vendors/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="<?php echo base_url(); ?>assets/inter/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!-- FastClick -->
  <script src="<?php echo base_url(); ?>assets/inter/vendors/fastclick/lib/fastclick.js"></script>
  <!-- NProgress -->
  <script src="<?php echo base_url(); ?>assets/inter/vendors/nprogress/nprogress.js"></script>
  <!-- Chart.js -->
  <script src="<?php echo base_url(); ?>assets/inter/vendors/Chart.js/dist/Chart.min.js"></script>
  <!-- gauge.js -->
  <script src="<?php echo base_url(); ?>assets/inter/vendors/gauge.js/dist/gauge.min.js"></script>
  <!-- bootstrap-progressbar -->
  <script src="<?php echo base_url(); ?>assets/inter/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
  <!-- iCheck -->
  <script src="<?php echo base_url(); ?>assets/inter/vendors/iCheck/icheck.min.js"></script>
  <!-- Skycons -->
  <script src="<?php echo base_url(); ?>assets/inter/vendors/skycons/skycons.js"></script>
  <!-- Flot -->
  <script src="<?php echo base_url(); ?>assets/inter/vendors/Flot/jquery.flot.js"></script>
  <script src="<?php echo base_url(); ?>assets/inter/vendors/Flot/jquery.flot.pie.js"></script>
  <script src="<?php echo base_url(); ?>assets/inter/vendors/Flot/jquery.flot.time.js"></script>
  <script src="<?php echo base_url(); ?>assets/inter/vendors/Flot/jquery.flot.stack.js"></script>
  <script src="<?php echo base_url(); ?>assets/inter/vendors/Flot/jquery.flot.resize.js"></script>
  <!-- Flot plugins -->
  <script src="<?php echo base_url(); ?>assets/inter/vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
  <script src="<?php echo base_url(); ?>assets/inter/vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/inter/vendors/flot.curvedlines/curvedLines.js"></script>
  <!-- DateJS -->
  <script src="<?php echo base_url(); ?>assets/inter/vendors/DateJS/build/date.js"></script>
  <!-- JQVMap -->
  <script src="<?php echo base_url(); ?>assets/inter/vendors/jqvmap/dist/jquery.vmap.js"></script>
  <script src="<?php echo base_url(); ?>assets/inter/vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
  <script src="<?php echo base_url(); ?>assets/inter/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
  <!-- bootstrap-daterangepicker -->
  <script src="<?php echo base_url(); ?>assets/inter/vendors/moment/min/moment.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/inter/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

  <!-- Custom Theme Scripts -->
  <script src="<?php echo base_url(); ?>assets/inter/build/js/custom.min.js"></script>

</body>

</html>