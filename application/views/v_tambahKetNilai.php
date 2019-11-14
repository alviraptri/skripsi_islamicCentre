<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Keterangan Nilai | Information Academic Islamic Centre</title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url(); ?>assets/inter/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url(); ?>assets/inter/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url(); ?>assets/inter/vendors/nprogress/nprogress.css" rel="stylesheet">

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
                            <h3>Keterangan Nilai</h3>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Tambah Keterangan Nilai</h2>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">

                                    <form class="form-horizontal form-label-left" method="post" action="<?php echo base_url() . 'c_admin/simpanKetNilai'; ?>" novalidate>
                                        <div class="item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Guru <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6">
                                                <select name="guru" id="#" required="required" class="form-control">
                                                    <option value="">Pilih Guru</option>
                                                    <?php
                                                    foreach ($guru as $list) { ?>
                                                        <option value="<?php echo $list->nomorInduk ?>"><?php echo $list->namaUser ?> </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Mata Pelajaran <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6">
                                                <select name="mapel" id="#" required="required" class="form-control">
                                                    <option value="">Pilih Mata Pelajaran</option>
                                                    <?php
                                                    foreach ($mapel as $list) { ?>
                                                        <option value="<?php echo $list->idMapel ?>"><?php echo $list->namaMapel ?> </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <div class="col-md-6 col-sm-6">
                                                <label for="name">Keterangan Nilai<span class="required">*</span>
                                                </label>
                                            </div>
                                            <div class="col-md-6 col-sm-6">
                                                <label for="name">Bobot Nilai<span class="required">*</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <div class="col-md-6 col-sm-6">
                                            <input type="text" id="email" name="kat1" required="required" class="form-control" value="Kat 1" readonly>
                                            </div>
                                            <div class="col-md-6 col-sm-6">
                                            <input type="number" id="email" name="bobotKat1" required="required" class="form-control">
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <div class="col-md-6 col-sm-6">
                                            <input type="text" id="email" name="kat2" required="required" class="form-control" value="Kat 2" readonly>
                                            </div>
                                            <div class="col-md-6 col-sm-6">
                                            <input type="number" id="email" name="bobotKat2" required="required" class="form-control">
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <div class="col-md-6 col-sm-6">
                                            <input type="text" id="email" name="uts" required="required" class="form-control" value="UTS" readonly>
                                            </div>
                                            <div class="col-md-6 col-sm-6">
                                            <input type="number" id="email" name="bobotUts" required="required" class="form-control">
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <div class="col-md-6 col-sm-6">
                                            <input type="text" id="email" name="uas" required="required" class="form-control" value="UAS" readonly>
                                            </div>
                                            <div class="col-md-6 col-sm-6">
                                            <input type="number" id="email" name="bobotUas" required="required" class="form-control">
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