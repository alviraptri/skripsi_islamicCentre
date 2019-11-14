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
                                    <h2>Data Keterangan Nilai</h2>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">

                                    <form class="form-horizontal form-label-left" method="post" action="" novalidate>
                                    <div class="item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Guru <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6">
                                                <select name="guru" id="guru" required="required" class="form-control">
                                                    <option value="">Pilih Guru</option>
                                                    <?php
                                                    foreach ($guru as $list) { ?>
                                                        <option value="<?php echo $list->nomorInduk ?>"><?php echo $list->namaUser ?> </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="nama">Mata Pelajaran<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6   ">
                                                <select name="idKelas" id="mapel" class="form-control">
                                                    <option value=""> Pilih Mata Pelajaran</option>
                                                    <!-- <?php
                                                    foreach ($mapel as $list) { ?>
                                                        <option value="<?= $list->idMapel ?>"><?= $list->namaMapel ?></option>
                                                    <?php } ?> -->
                                                </select>
                                            </div>
                                        </div>
                                        <!-- <div class="form-group">
                                            <label>Nama Siswa</label>
                                            <select class="form-control" id="siswa" name="siswa" required>
                                                <option value="">Pilih Siswa</option>

                                            </select>
                                        </div> -->
                                        <table id="datatable-fixed-header" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Keterangan Nilai</th>
                                                    <th>Bobot Nilai</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>

                                            <tbody name="show_data" id="show_data">

                                            </tbody>
                                        </table>
                                        <div class="ln_solid"></div>
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
        $(document).ready(function() {

            //view
            $('#guru').change(function() {
                var nomorInduk = $(this).val();
                $.ajax({
                    url: "<?php echo site_url('c_admin/getMapel');?>",
                    method: "POST",
                    data: {
                        nomorInduk:nomorInduk
                    },
                    async: true,
                    dataType: 'JSON',
                    success: function(data){
                        var html = '';
                        var i;
                        for(i = 0; i<data/.length; i++){
                            html += '<option value="'+ data[i].idMapel +'">'+data[i].namaMapel+'</option>'
                        }
                        $('#mapel').html(html);
                    }
                });
                return false;

                $.ajax({
                    url: "<?php echo site_url('c_admin/getDataInfo'); ?>",
                    method: "POST",
                    data: {
                        idKelas: idKelas
                    },
                    async: true,
                    dataType: 'json',
                    success: function(data) {
                        var html = '';
                        var i;
                        for (i = 0; i < data.length; i++) {
                            html += '<tr>' +
                                '<td>' + data[i].namaUser + '</td>' +
                                '<td><input type="text" name="idSiswa[]" id="biaya" value="' + data[i].idInfo + '" hidden>' + data[i].jumlah + '</td>' +
                                '<td><a href="javascript:;" class="btn btn-danger btn-xs item_hapus" data="'+data[i].idInfo+'">Hapus</a></td>' +
                                '</tr>';
                        }
                        $('#show_data').html(html);

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
    <!-- validator -->
    <script src="<?php echo base_url(); ?>assets/inter/vendors/validator/validator.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url(); ?>assets/inter/build/js/custom.min.js"></script>

</body>

</html>