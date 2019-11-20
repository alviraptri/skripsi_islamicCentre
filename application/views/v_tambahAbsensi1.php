<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Absensi | Information Academic Islamic Centre</title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url(); ?>assets/inter/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url(); ?>assets/inter/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url(); ?>assets/inter/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?php echo base_url(); ?>assets/inter/vendors/iCheck/skins/flat/green.css" rel="stylesheet">

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
                            <h3>Absensi</h3>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Tambah Absensi</h2>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">

                                    <form class="form-horizontal form-label-left" method="post" action="<?php echo base_url() . 'c_admin/simpanAbsen'; ?>" novalidate>
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
                                            <div class="col-md-6 col-sm-6" id="jadwalGuru">
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Mata Pelajaran <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6">
                                                <select name="mapel" id="mapel" required="required" class="form-control">
                                                    <option value="">Pilih Mata Pelajaran</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <div class="col-md-6 col-sm-6" id="jadwalMapel">
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Kelas<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6">
                                                <select name="kelas" id="kelas" required="required" class="form-control">
                                                    <option value="">Pilih Kelas</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <div class="col-md-6 col-sm-6" id="jadwal">
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Tanggal<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6">
                                                <?php 
                                                $tgl = date('d F Y');
                                                ?>
                                                <input type="text" id="tanggal" name="tanggal[] " required="required" class="form-control" value="<?php echo $tgl?>" readonly>
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Tanggal<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6">
                                                <?php 
                                                $format = date('Y-m-d');
                                                ?>
                                                <input type="text" id="tgl" name="tgl[] " required="required" class="form-control" value="<?php echo $format?>" hidden>
                                            </div>
                                        </div>
                                        <table id="datatable-fixed-header" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Nama Siswa</th>
                                                    <th>Absen</th>
                                                </tr>
                                            </thead>

                                            <tbody name="show_data" id="show_data">

                                            </tbody>
                                        </table>

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

    <script type="text/javascript" src="<?php echo base_url() . 'assets/jquery-3.3.1.js' ?>"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            //view mapel
            $('#guru').change(function() {
                var nomorInduk = $(this).val();
                $.ajax({
                    url: "<?php echo site_url('c_admin/getMapel'); ?>",
                    method: "POST",
                    data: {
                        nomorInduk: nomorInduk
                    },
                    async: true,
                    dataType: 'JSON',
                    success: function(data) {
                        var html ='';
                        var i;
                        for(i = 0; i < data.length; i++){
                            html += '<input type="text" id="idKelas" name="idKelas" required="required" class="form-control" value="'+data[i].idJadwal+'">';
                        }
                        $('#jadwalGuru').html(html);
                    }
                });
                return false;
            });

            //view id jadwal setelah select guru
            $('#guru').change(function() {
                var nomorInduk = $(this).val();
                $.ajax({
                    url: "<?php echo site_url('c_admin/getMapel'); ?>",
                    method: "POST",
                    data: {
                        nomorInduk: nomorInduk
                    },
                    async: true,
                    dataType: 'JSON',
                    success: function(data) {
                        var html = '';
                        var i;
                        for (i = 0; i < data.length; i++) {
                            html += '<option value="' + data[i].idMapel + '">' + data[i].namaMapel + '</option>'
                        }
                        $('#mapel').html(html);
                    }
                });
                return false;
            });

            //view kelas
            $('#mapel').change(function() {
                var idMapel = $(this).val();
                $.ajax({
                    url: "<?php echo site_url('c_admin/getKelas'); ?>",
                    method: "POST",
                    data: {
                        idMapel: idMapel
                    },
                    async: true,
                    dataType: 'JSON',
                    success: function(data) {
                        var html = '';
                        var i;
                        for (i = 0; i < data.length; i++) {
                            html += '<option value="' + data[i].idKelas + '">' + data[i].ketKelas + ' '+ data[i].jurusanKelas +' '+ data[i].nomorKelas +'</option>'
                        }
                        $('#kelas').html(html);
                    }
                });
                return false;
            });

            //view id jadwal setelah select mapel
            $('#mapel').change(function() {
                var idMapel = $(this).val();
                $.ajax({
                    url: "<?php echo site_url('c_admin/getKelas'); ?>",
                    method: "POST",
                    data: {
                        idMapel: idMapel
                    },
                    async: true,
                    dataType: 'JSON',
                    success: function(data) {
                        var html = '';
                        var i;
                        for (i = 0; i < data.length; i++) {
                            html += '<input type="text" id="idMapel" name="idMapel[]" required="required" class="form-control" value="'+data[i].idMapel+'">'
                        }
                        $('#jadwalMapel').html(html);
                    }
                });
                return false;
            });

            //view kelas
            // $('#guru').change(function() {
            //     var nomorInduk = $(this).val();
            //     $.ajax({
            //         url: "<?php echo site_url('c_admin/getMapel'); ?>",
            //         method: "POST",
            //         data: {
            //             nomorInduk: nomorInduk
            //         },
            //         async: true,
            //         dataType: 'JSON',
            //         success: function(data) {
            //             var html = '';
            //             var i;
            //             for (i = 0; i < data.length; i++) {
            //                 html += '<option value="' + data[i].idKelas + '">' + data[i].ketKelas + ' '+ data[i].jurusanKelas +' '+ data[i].nomorKelas +'</option>'
            //             }
            //             $('#kelas').html(html);
            //         }
            //     });
            //     return false;
            // });

            //view nama siswa
            $('#kelas').change(function(){
                var idKelas = $(this).val();
                $.ajax({
                    url: "<?php echo site_url('c_admin/getNama'); ?>",
                    method: "POST",
                    data: {
                        idKelas: idKelas
                    },
                    async: true,
                    dataType: 'JSON',
                    success: function(data){
                        var html ='';
                        var i;
                        for(i = 0; i < data.length; i++){
                            html += '<tr>'+
                            '<td> '+ data[i].namaUser +' </td>'+
                            '<td> <div class="checkbox">'+
                            '<label>'+
                              '<input type="text" name="idSiswa[]" id="biaya" value="'+data[i].idSiswa+'" hidden><input type="checkbox" name="cek[]" class="flat" value="1">'+
                            '</label>'+
                          '</div> </td>'+
                            '</tr>';
                        }
                        $('#show_data').html(html);
                    }
                });
                return false;
            });

            //ambil id jadwal setelah pilih kelas
            $('#kelas').change(function(){
                var idKelas = $(this).val();
                $.ajax({
                    url: "<?php echo site_url('c_admin/getNama'); ?>",
                    method: "POST",
                    data: {
                        idKelas: idKelas
                    },
                    async: true,
                    dataType: 'JSON',
                    success: function(data){
                        var html ='';
                        var i;
                        for(i = 0; i < data.length; i++){
                            html += '<input type="text" id="idKelas" name="idKelas[]" required="required" class="form-control" value="'+data[i].idKelas+'">';
                        }
                        $('#jadwal').html(html);
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