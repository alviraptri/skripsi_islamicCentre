<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Mata Pelajaran | Information Academic Islamic Centre</title>

  <!-- Bootstrap -->
  <link href="<?php echo base_url(); ?>assets/inter/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="<?php echo base_url(); ?>assets/inter/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- NProgress -->
  <link href="<?php echo base_url(); ?>assets/inter/vendors/nprogress/nprogress.css" rel="stylesheet">

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
              <h3>Mata Pelajaran</h3>
            </div>
          </div>
          <div class="clearfix"></div>

          <div class="row">
            <div class="col-md-12 col-sm-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Edit Mata Pelajaran</h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <?php foreach ($editMapel as $edit) { ?>
                    <form class="form-horizontal form-label-left" novalidate method="post" action="<?php echo base_url() . 'c_admin/updateMapel'; ?>">

                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="nomorInduk"># <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6">
                          <input id="name" class="form-control" data-validate-length-range="6" data-validate-words="2" name="idMapel" type="text" value="<?= $edit->idMapel ?>" readonly>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="nama">Mata Pelajaran <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6">
                          <input type="text" id="email" name="mapel" required="required" class="form-control" value="<?= $edit->namaMapel ?>">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="tahunAjaran">Tahun Ajaran <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6">
                          <select name="tahunAjaran" class="select2_single form-control">
                            <option value="<?= $edit->idTahunAjaran ?>" selected><?= $edit->tahunAjaran ?></option>
                            <?php
                            foreach ($ta as $list) {
                              if ($edit->idTahunAjaran != $list->idTahunAjaran) { ?>
                                <option value="<?= $list->idTahunAjaran ?>"><?= $list->tahunAjaran ?></option>
                            <?php }
                            }
                            ?>
                          </select>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="tahunAjaran">Jenis Mata Pelajaran <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6">
                          <select name="jenisMapel" class="select2_single form-control">
                            <option value="<?= $edit->jenisMapel ?>" selected><?= $edit->jenisMapel ?></option>
                            <?php
                            foreach ($jenis as $list) {
                              if ($edit->jenisMapel != $list->jenisMapel) { ?>
                                <option value="<?= $list->jenisMapel ?>"><?= $list->jenisMapel ?></option>
                            <?php }
                            }
                            ?>
                          </select>
                        </div>
                      </div>

                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 offset-md-3">
                          <button id="send" type="submit" class="btn btn-success">Simpan</button>
                          <a href="<?php echo base_url('c_admin/index'); ?>"><button type="submit" class="btn btn-primary">Batal</button></a>
                        </div>
                      </div>
                    </form>
                  <?php } ?>
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
  <!-- validator -->
  <script src="<?php echo base_url(); ?>assets/inter/vendors/validator/validator.js"></script>

  <!-- Custom Theme Scripts -->
  <script src="<?php echo base_url(); ?>assets/inter/build/js/custom.min.js"></script>

</body>

</html>