<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Jadwal | Information Academic Islamic Centre</title>

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
              <h3>Jadwal</h3>
            </div>
          </div>

          <div class="clearfix"></div>

          <div class="row">
            <!-- button -->
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Data Jadwal</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li> <a href="<?php echo base_url('c_admin/tambahJadwal'); ?>"><button type="submit" class="btn btn-primary">Tambah Jadwal</button></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <table id="datatable-buttons" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                      <tr>
                        <th>Hari</th>
                        <th>Jam</th>
                        <th>Mata Pelajaran</th>
                        <th>Kelas</th>
                        <th>Status</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>

                    <tbody>
                      <?php foreach ($jadwal as $list) { ?>
                        <tr>
                          <td><?php echo $list->hari ?></td>
                          <?php $mulai = date('H:i', strtotime($list->jamMulai));
                          $selesai = date('H:i', strtotime($list->jamSelesai));?>
                          <td><?php echo $mulai ?> - <?= $selesai?></td>
                          <td><?= $list->namaMapel?></td>
                          <td><?php echo $list->ketKelas ?> <?php echo $list->jurusanKelas ?> <?php echo $list->nomorKelas ?></td>
                          <td><?php
                                if ($list->statusJadwal == 1) { ?>
                              <button class="btn btn-success btn-xs">Aktif</button>
                            <?php } else { ?>
                              <button class="btn btn-danger btn-xs">Tidak Aktif</button>
                            <?php }
                              ?></td>
                          <td>
                            <?php
                              if ($list->statusJadwal == 1) { ?>
                              <button data-toggle="modal" title="Lihat Lebih" class="btn btn-primary btn-xs" data-target="#bs-example-modal-sm<?php echo $list->idJadwal ?>">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                              </button>
                              <?php
                                  $data = array(
                                    'ketKelas' => $list->ketKelas,
                                    'idJadwal' => $list->idJadwal,
                                    'jurusanKelas' => $list->jurusanKelas,
                                    'nomorKelas' => $list->nomorKelas,
                                    'tahunAjaran' => $list->tahunAjaran,
                                    'namaUser' => $list->namaUser,
                                    'namaMapel' => $list->namaMapel,
                                    'hari' => $list->hari,
                                    'jamMulai' => $list->jamMulai,
                                    'jamSelesai' => $list->jamSelesai,
                                  );
                                  $this->load->view("v_modalJadwal", $data);
                                  ?>

                              <a href="<?php echo base_url('c_admin/editJadwal/') . $list->idJadwal; ?>">
                                <button data-toggle="tooltip" title="Edit" class="btn btn-info btn-xs">
                                  <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                </button>
                              </a>
                              <a href="<?php echo base_url('c_admin/statusJadwal/') . $list->idJadwal; ?>">
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