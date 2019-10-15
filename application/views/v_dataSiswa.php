<!doctype html>
<html class="no-js" lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Students | Information Academic Islamic Centre</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- favicon
		============================================ -->
  <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>assets/admin/img/favicon.ico">
  <!-- Google Fonts
		============================================ -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
  <!-- Bootstrap CSS
		============================================ -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/bootstrap.min.css">
  <!-- Bootstrap CSS
		============================================ -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/font-awesome.min.css">
  <!-- owl.carousel CSS
		============================================ -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/owl.carousel.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/owl.theme.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/owl.transitions.css">
  <!-- animate CSS
		============================================ -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/animate.css">
  <!-- normalize CSS
		============================================ -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/normalize.css">
  <!-- meanmenu icon CSS
		============================================ -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/meanmenu.min.css">
  <!-- main CSS
		============================================ -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/main.css">
  <!-- educate icon CSS
		============================================ -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/educate-custon-icon.css">
  <!-- morrisjs CSS
		============================================ -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/morrisjs/morris.css">
  <!-- mCustomScrollbar CSS
		============================================ -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/scrollbar/jquery.mCustomScrollbar.min.css">
  <!-- metisMenu CSS
		============================================ -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/metisMenu/metisMenu.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/metisMenu/metisMenu-vertical.css">
  <!-- calendar CSS
		============================================ -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/calendar/fullcalendar.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/calendar/fullcalendar.print.min.css">
  <!-- style CSS
		============================================ -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/style.css">
  <!-- responsive CSS
		============================================ -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/responsive.css">
  <!-- modernizr JS
		============================================ -->
  <script src="<?php echo base_url(); ?>assets/admin/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
  <!--[if lt IE 8]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->
  <!-- copy dari sini -->
  <!-- Start Left menu area -->
  <?php include("area-menu.php") ?>
  <!-- End Left menu area -->
  <!-- Start Welcome area -->
  <div class="all-content-wrapper">
    <?php include("logo.php") ?>
    <div class="header-advance-area">
      <?php include("mobile-menu.php") ?>
      <!-- Mobile Menu end -->
      <!-- copy sampe sini -->
      <div class="breadcome-area">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="breadcome-list single-page-breadcome">
                <div class="row">
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="breadcome-heading">
                      <form role="search" class="sr-input-func">
                        <input type="text" placeholder="Search..." class="search-int form-control">
                        <a href="#"><i class="fa fa-search"></i></a>
                      </form>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <ul class="breadcome-menu">
                      <li><a href="#">Home</a> <span class="bread-slash">/</span>
                      </li>
                      <li><span class="bread-blod">Students</span>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="product-status mg-b-15">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="product-status-wrap drp-lst">
              <h4>Students List</h4>
              <div class="add-product">
                <a href="<?php echo base_url('c_admin/tambahSiswa'); ?>">Add Students</a>
              </div>
              <div class="asset-inner">
                <table>
                  <tr>
                    <th>Nomor Induk</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Tahun Ajaran</th>
                    <th>Status</th>
                    <th>Setting</th>
                  </tr>
                  <?php
                  foreach ($dataSiswa as $listSiswa) { ?>
                    <tr>
                      <td><?php echo $listSiswa->nomorInduk ?></td>
                      <td><?php echo $listSiswa->namaUser ?></td>
                      <td><?php echo $listSiswa->ketKelas?> <?php echo $listSiswa->jurusanKelas?></td>
                      <td><?php echo $listSiswa->tahunAjaran?></td>
                      <td><?php
                            if ($listSiswa->statusSiswa == 1) { ?>
                          <button class="pd-setting">Aktif</button>
                        <?php } else { ?>
                          <button class="ds-setting">Tidak Aktif</button>
                        <?php }
                          ?></td>
                      <td>
                        <a href="<?php echo base_url('c_admin/editGuru/') . $listSiswa->nomorInduk; ?>">
                            <button data-toggle="tooltip" title="Edit" class="pd-setting-ed">
                              <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </button>
                        </a>
                        <?php
                          if ($listSiswa->statusSiswa == 1) { ?>
                          <a href="<?php echo base_url('c_admin/editGuru/') . $listSiswa->nomorInduk; ?>">
                            <button data-toggle="tooltip" title="Edit" class="pd-setting-ed">
                              <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </button>
                          </a>
                          <a href="<?php echo base_url('c_admin/statusGuru/') . $listSiswa->nomorInduk; ?>">
                            <button data-toggle="tooltip" title="Trash" class="pd-setting-ed">
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
                  <?php
                  }
                  ?>

                </table>
              </div>
              <div class="custom-pagination">
                <nav aria-label="Page navigation example">
                  <ul class="pagination">
                    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                  </ul>
                </nav>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php include("footer.php") ?>
  </div>

  <!-- jquery
		============================================ -->
  <script src="<?php echo base_url(); ?>assets/admin/js/vendor/jquery-1.12.4.min.js"></script>
  <!-- bootstrap JS
		============================================ -->
  <script src="<?php echo base_url(); ?>assets/admin/js/bootstrap.min.js"></script>
  <!-- wow JS
		============================================ -->
  <script src="<?php echo base_url(); ?>assets/admin/js/wow.min.js"></script>
  <!-- price-slider JS
		============================================ -->
  <script src="<?php echo base_url(); ?>assets/admin/js/jquery-price-slider.js"></script>
  <!-- meanmenu JS
		============================================ -->
  <script src="<?php echo base_url(); ?>assets/admin/js/jquery.meanmenu.js"></script>
  <!-- owl.carousel JS
		============================================ -->
  <script src="<?php echo base_url(); ?>assets/admin/js/owl.carousel.min.js"></script>
  <!-- sticky JS
		============================================ -->
  <script src="<?php echo base_url(); ?>assets/admin/js/jquery.sticky.js"></script>
  <!-- scrollUp JS
		============================================ -->
  <script src="<?php echo base_url(); ?>assets/admin/js/jquery.scrollUp.min.js"></script>
  <!-- counterup JS
		============================================ -->
  <script src="<?php echo base_url(); ?>assets/admin/js/counterup/jquery.counterup.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/admin/js/counterup/waypoints.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/admin/js/counterup/counterup-active.js"></script>
  <!-- mCustomScrollbar JS
		============================================ -->
  <script src="<?php echo base_url(); ?>assets/admin/js/scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/admin/js/scrollbar/mCustomScrollbar-active.js"></script>
  <!-- metisMenu JS
		============================================ -->
  <script src="<?php echo base_url(); ?>assets/admin/js/metisMenu/metisMenu.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/admin/js/metisMenu/metisMenu-active.js"></script>
  <!-- morrisjs JS
		============================================ -->
  <script src="<?php echo base_url(); ?>assets/admin/js/morrisjs/raphael-min.js"></script>
  <script src="<?php echo base_url(); ?>assets/admin/js/morrisjs/morris.js"></script>
  <script src="<?php echo base_url(); ?>assets/admin/js/morrisjs/morris-active.js"></script>
  <!-- morrisjs JS
		============================================ -->
  <script src="<?php echo base_url(); ?>assets/admin/js/sparkline/jquery.sparkline.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/admin/js/sparkline/jquery.charts-sparkline.js"></script>
  <script src="<?php echo base_url(); ?>assets/admin/js/sparkline/sparkline-active.js"></script>
  <!-- calendar JS
		============================================ -->
  <script src="<?php echo base_url(); ?>assets/admin/js/calendar/moment.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/admin/js/calendar/fullcalendar.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/admin/js/calendar/fullcalendar-active.js"></script>
  <!-- plugins JS
		============================================ -->
  <script src="<?php echo base_url(); ?>assets/admin/js/plugins.js"></script>
  <!-- main JS
		============================================ -->
  <script src="<?php echo base_url(); ?>assets/admin/js/main.js"></script>
</body>

</html>