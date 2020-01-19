<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Siswa | Information Academic Islamic Centre</title>

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
                <h3>Siswa</h3>
              </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Edit Siswa</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                  <?php foreach ($editSiswa as $edit) { ?>
                    <form class="form-horizontal form-label-left" method="post" action="<?php echo base_url() . 'c_admin/updateSiswa'; ?>" novalidate>
                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Nomor Induk <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6">
                          <input id="name" class="form-control" name="nomorInduk" required="required" type="text" value="<?= $edit->nomorInduk ?>" readonly>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="email">Nama <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6">
                          <input type="text" id="email2" name="nama" required="required" class="form-control" value="<?= $edit->namaUser ?>">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="ttl">Tanggal Lahir <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6">
                          <input type="date" id="email" name="ttl" required="required" class="form-control" value="<?= $edit->ttlUser ?>">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="email">Email <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6">
                          <input type="email" id="email" name="email" required="required" class="form-control" value="<?= $edit->emailUser ?>">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="noTelp">Nomor Telephone <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6">
                          <input type="text" id="email2" name="noTelp" data-validate-length-range="11" required="required" class="form-control" value="<?= $edit->noTelp ?>">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="textarea">Alamat <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea id="textarea" required="required" name="alamat" class="form-control"><?= $edit->alamatUser ?></textarea>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="jk">Jenis Kelamin <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select name="jk" class="select2_single form-control">
                          <?php
                            if ($edit->jenisKelamin == 1) { ?>
                            <option value="1">Laki-Laki</option>
                            <?php } else { ?>
                              <option value="0">Perempuan</option>
                              <?php } ?>
                            <option value="0"> Perempuan </option>
                            <option value="1"> Laki-Laki</option>
                          </select>
                        </div>
                      </div>
                      
                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="kelas">Kelas <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select name="kelas" class="select2_single form-control">
                          <option value="<?= $edit->idKelas ?>"><?= $edit->ketKelas?> <?= $edit->jurusanKelas?> <?= $edit->nomorKelas?></option>
                          <?php foreach ($kls as $listKelas) {?>
                            <option value="<?php echo $listKelas->idKelas ?>"><?php echo$listKelas->ketKelas ?> <?php echo$listKelas->jurusanKelas ?> <?php echo$listKelas->nomorKelas ?></option>
                          <?php } ?>
                          </select>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="tahunAjaran">Tahun Ajaran <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select name="tahunAjaran" class="select2_single form-control">
                          <option value="<?= $edit->idTahunAjaran ?>"><?= $edit->tahunAjaran?></option>
                          <?php foreach ($ta as $listTA) {?>
                            <option value="<?php echo $listTA->idTahunAjaran ?>"><?php echo$listTA->tahunAjaran ?></option>
                          <?php } ?>
                          </select>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="userRole">Foto Profil <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="file" name="berkas" value="<?= $edit->gambar ?>">
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

    

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript">
    $(function () {
        $("#profesi").change(function () {
            if ($(this).val() == "Wali Kelas") {
                $("#tampilKelas").show();
            } else {
                $("#tampilKelas").hide();
            }
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
    <!-- validator -->
    <script src="<?php echo base_url(); ?>assets/inter/vendors/validator/validator.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url(); ?>assets/inter/build/js/custom.min.js"></script>
	
  </body>
</html>