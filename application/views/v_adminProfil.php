<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Profil Saya | Information Academic Islamic Centre</title>

  <!-- Bootstrap -->
  <link href="<?php echo base_url(); ?>assets/inter/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="<?php echo base_url(); ?>assets/inter/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- NProgress -->
  <link href="<?php echo base_url(); ?>assets/inter/vendors/nprogress/nprogress.css" rel="stylesheet">
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
        <div class="">
          <div class="page-title">
            <div class="title_left">
              <h3>Profil Saya</h3>
            </div>
          </div>

          <div class="clearfix"></div>

          <div class="row">
            <div class="col-md-12 col-sm-12 ">
              <div class="x_panel">
                <div class="x_content">
                  <div class="col-md-3 col-sm-3  profile_left">
                    <div class="profile_img">
                      <div id="crop-avatar">
                        <!-- Current avatar -->
                        <?php foreach ($profil as $list) { ?>
                          <img class="img-responsive avatar-view" src="<?php echo base_url(); ?>assets/inter/images/profil/<?php echo $list->gambar ?>" alt="Avatar" title="Change the avatar">
                        <?php } ?>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-9 col-sm-9 ">

                    <div class="profile_title">
                      <div class="col-md-6">
                        <?php foreach ($profil as $list) { ?>
                          <h3><?php echo $list->namaUser ?></h3>
                          <ul class="list-unstyled user_data">
                            <li><i class="fa fa-calendar user-profile-icon"></i> &nbsp;&nbsp;&nbsp;<?php echo $list->ttlUser ?>
                            </li>
                            <li>
                              <?php if ($list->jenisKelamin == '1') { ?>
                                <i class="fa fa-male user-profile-icon"></i> &nbsp;&nbsp;&nbsp;&nbsp;Laki-Laki
                              <?php } else { ?>
                                <i class="fa fa-female user-profile-icon"></i> &nbsp;&nbsp;&nbsp;&nbsp;Perempuan
                              <?php } ?>
                            </li>
                            <li><i class="fa fa-envelope user-profile-icon"></i>&nbsp;&nbsp;&nbsp;<?php echo $list->emailUser ?>
                            </li>
                            <li><i class="fa fa-phone user-profile-icon"></i>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $list->noTelp ?>
                            </li>
                            <li><i class="fa fa-map-marker user-profile-icon"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $list->alamatUser ?>
                            </li>
                          </ul>
                          <a href="<?php echo base_url('c_admin/editAdmin/') . $list->nomorInduk; ?>" class="btn btn-success"><i class="fa fa-edit m-right-xs"></i>Edit Profile</a>
                        <?php } ?>
                        <br />
                      </div>

                    </div>
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

  <!-- jQuery -->
  <script src="<?php echo base_url(); ?>assets/inter/vendors/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="<?php echo base_url(); ?>assets/inter/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!-- FastClick -->
  <script src="<?php echo base_url(); ?>assets/inter/vendors/fastclick/lib/fastclick.js"></script>
  <!-- NProgress -->
  <script src="<?php echo base_url(); ?>assets/inter/vendors/nprogress/nprogress.js"></script>
  <!-- morris.js -->
  <script src="<?php echo base_url(); ?>assets/inter/vendors/raphael/raphael.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/inter/vendors/morris.js/morris.min.js"></script>
  <!-- bootstrap-progressbar -->
  <script src="<?php echo base_url(); ?>assets/inter/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
  <!-- bootstrap-daterangepicker -->
  <script src="<?php echo base_url(); ?>assets/inter/vendors/moment/min/moment.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/inter/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

  <!-- Custom Theme Scripts -->
  <script src="<?php echo base_url(); ?>assets/inter/build/js/custom.min.js"></script>

</body>

</html>