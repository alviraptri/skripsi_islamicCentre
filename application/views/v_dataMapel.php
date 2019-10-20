<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="images/favicon.ico" type="image/ico" />

  <title>Mata Pelajaran | Information Academic Islamic Centre</title>

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
              <h3>Siswa</h3>
            </div>
          </div>

          <div class="clearfix"></div>

          <div class="row">

            <!--responsive-->
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Data Mata Pelajaran</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li> <a href="<?php echo base_url('c_admin/tambahMapel'); ?>"><button type="submit" class="btn btn-primary">Tambah Mata Pelajaran</button></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Mata Pelajaran</th>
                        <th>Tahun Ajaran</th>
                        <th>Status</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($mapel as$listMapel) {?>
                        <tr>
                        <td><?php echo$listMapel->idMapel ?></td>
                          <td><?php echo$listMapel->namaMapel ?></td>
                          <td><?php echo$listMapel->tahunAjaran ?></td>
                          <td><?php
                                if ($listMapel->statusMapel == 1) { ?>
                              <button class="btn btn-success btn-xs">Aktif</button>
                            <?php } else { ?>
                              <button class="btn btn-danger btn-xs">Tidak Aktif</button>
                            <?php }
                              ?></td>
                          <td>
                            <?php
                              if ($listMapel->statusMapel == 1) { ?>
                              <a href="<?php echo base_url('c_admin/editMapel/') .$listMapel->idMapel; ?>">
                                <button data-toggle="tooltip" title="Edit" class="btn btn-info btn-xs">
                                  <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                </button>
                              </a>
                              <a href="<?php echo base_url('c_admin/statusMapel/') .$listMapel->idMapel; ?>">
                                <button data-toggle="tooltip" title="Hapus" class="btn btn-danger btn-xs">
                                  <i class="fa fa-trash-o" aria-hidden="true"></i>
                                </button>
                              </a>
                            <?php } else { ?>
                              <button data-toggle="tooltip" title="Edit" class="pd-setting-ed" disabled>
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                              </button>
                              <button data-toggle="tooltip" title="Trash" class="pd-setting-ed" disabled>
                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                              </button>
                            <?php } ?>
                          </td>
                        </tr>
                      <?php } ?>

                    </tbody>
                  </table>


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
  <script src="<?php echo base_url(); ?>assets/inter/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
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

</body>

</html>