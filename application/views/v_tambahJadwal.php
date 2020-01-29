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
              <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Tambah Jadwal</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <form class="form-horizontal form-label-left" method="post" action="<?php echo base_url() . 'c_admin/simpanJadwal'; ?>" novalidate>
                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Hari <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6">
                          <select name="hari" id="#" required="required" class="form-control">
                              <option value="">Pilih Hari</option>
                              <option value="Senin"> Senin</option>
                              <option value="Selasa">Selasa</option>
                              <option value="Rabu">Rabu</option>
                              <option value="Kamis">Kamis</option>
                              <option value="Jumat">Jumat</option>
                          </select>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="email">Jam<span class="required">*</span>
                        </label>
                        <div class="col-md-3 col-sm-3">
                        <select name="jamMulai" id="mulaiJam" required="required" class="form-control">
                              <option value="">Jam Mulai</option>
                              <option value="07:00">07.00</option>
                              <option value="08:30">08.30</option>
                              <option value="09:15">09.15</option>
                              <option value="10:15">10.15</option>
                              <option value="11:00">11.00</option>
                              <option value="11:45">11.45</option>
                              <option value="12:30">12.30</option>
                              <option value="13:45">13.45</option>
                          </select>
                        </div>
                        <div class="col-md-3 col-sm-3">
                        <select name="jamSelesai" id="selesaiJam" class="form-control">
                              <option value="">Jam Selesai</option>
                          </select>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Mata Pelajaran <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6">
                          <select name="mapel" id="#" required="required" class="form-control">
                              <option value="">Pilih Mapel</option>
                              <?php 
                              foreach ($mapel as $list) { ?>
                                  <option value="<?php echo $list->idMapel?>"><?php echo $list->namaMapel?> </option>
                              <?php } ?>
                          </select>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Guru <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6">
                          <select name="guru" id="#" required="required" class="form-control">
                              <option value="">Pilih Guru</option>
                              <?php 
                              foreach ($guru as $list) { ?>
                                  <option value="<?php echo $list->nomorInduk?>"><?php echo $list->namaUser?> </option>
                              <?php } ?>
                          </select>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Kelas <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6">
                          <select name="kls" id="#" required="required" class="form-control">
                              <option value="">Pilih Kelas</option>
                              <?php 
                              foreach ($kls as $list) { ?>
                                  <option value="<?php echo $list->idKelas?>"><?php echo $list->ketKelas?> <?php echo $list->jurusanKelas?> <?php echo $list->nomorKelas?></option>
                              <?php } ?>
                          </select>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Tahun Ajaran <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6">
                          <select name="ta" id="#" required="required" class="form-control">
                              <option value="">Pilih Tahun Ajaran</option>
                              <?php 
                              foreach ($ta as $list) { ?>
                                  <option value="<?php echo $list->idTahunAjaran?>"><?php echo $list->tahunAjaran?></option>
                              <?php } ?>
                          </select>
                        </div>
                      </div>
                      
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 offset-md-3">
                          <button id="send" type="submit" class="btn btn-success">Simpan</button>
                          <a href="<?php echo base_url('c_admin/jadwal'); ?>"><button type="button" class="btn btn-primary">Batal</button></a>
                        </div>
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

    <script type="text/javascript" src="<?php echo base_url() . 'assets/jquery-3.3.1.js' ?>"></script>
    <script type="text/javascript">
    $(document).ready(function(){
      $('#mulaiJam').change(function(){
        var jam = $(this).val();
        var html = '';
            if (jam == "07:00") {
              html += '<option value = "08:30">08.30</option>';
              html += '<option value = "09:15">09.15</option>';
            }
            else if(jam == "08:30"){
              html += '<option value = "09:15">09.15</option>';
              html += '<option value = "10:00">10.00</option>';
            }
            else if(jam == "09:15"){
              html += '<option value = "10:00">10.00</option>';
              html += '<option value = "11:00">11.00</option>';
              html += '<option value = "11:45">11.45</option>';
            }
            else if(jam == "10:15"){
              html += '<option value = "11:00">11.00</option>';
              html += '<option value = "11:45">11.45</option>';
              html += '<option value = "12:30">12.30</option>';
            }
            else if(jam == "11:00"){
              html += '<option value = "11:45">11.45</option>';
              html += '<option value = "13:15">13.15</option>';
              html += '<option value = "12:30">12.30</option>';
            }
            else if(jam == "11:45"){
              html += '<option value = "13:15">13.15</option>';
            }
            else if(jam == "12:30"){
              html += '<option value = "13:15">13.15</option>';
            }
            else if(jam == "13:45"){
              html += '<option value = "15:15">15.15</option>';
            }
            $('#selesaiJam').html(html);
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