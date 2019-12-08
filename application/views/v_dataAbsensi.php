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
                                    <h2>Data Absensi</h2>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
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
                                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Mata Pelajaran <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6">
                                                <select name="mapel" id="mapel" required="required" class="form-control">
                                                    <option value="">Pilih Mata Pelajaran</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Tanggal<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6">
                                            <select name="tgl" id="tgl" required="required" class="form-control">
                                                    <option value="">Pilih Tanggal</option>
                                                </select>
                                            </div>
                                        </div>
                                        <table id="datatable-fixed-header" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Nama Siswa</th>
                                                    <th>Kelas</th>
                                                    <th>Absen</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>

                                            <tbody name="show_data" id="show_data">

                                            </tbody>
                                        </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /page content -->

            <!-- MODAL EDIT -->
            <div class="modal fade bs-example-modal-lg" id="ModalaEdit" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title" id="myModalLabel">Edit Absen</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <form class="form-horizontal form-label-left">
                            <div class="modal-body">
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">#</label>
                                    <div class="col-md-6 col-sm-6">
                                        <input name="id_edit" id="id_edit" class="form-control" type="text" placeholder="ID Ket Nilai" readonly>
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Nama</label>
                                    <div class="col-md-6 col-sm-6">
                                        <input name="nama_edit" id="nama_edit" class="form-control" type="text" placeholder="Nama Tahun Ajaran" readonly>
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Kelas</label>
                                    <div class="col-xs-9">
                                        <input name="kls_edit" id="kls_edit" class="form-control" type="text" placeholder="Nilai Satu" readonly>
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Absen</label>
                                    <div class="col-xs-9">
                                        <input name="absen_edit" id="absen_edit" class="form-control" type="text" placeholder="Nilai Dua" required>
                                    </div>
                                </div>

                            </div>

                            <div class="modal-footer">
                                <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                                <button class="btn btn-info" id="btn_update">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--END MODAL EDIT-->

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
            //view mapel dan kelas dan id jadwal
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
                            html += '<option value="' + data[i].idJadwal + '">' + data[i].namaMapel + '</option>'
                        }
                        $('#mapel').html(html);
                    }
                });
                return false;
            });

            //view tanggal
            $('#mapel').change(function() {
                var id = $(this).val();
                $.ajax({
                    url: "<?php echo site_url('c_admin/getTanggal'); ?>",
                    method: "POST",
                    data: {
                        id: id
                    },
                    async: true,
                    dataType: 'JSON',
                    success: function(data) {
                        var html = '';
                        var i;
                        for (i = 0; i < data.length; i++) {
                            html += '<option value="' + data[i].tanggal + '">' + data[i].tanggal+'</option>'
                        }
                        $('#tgl').html(html);
                    }
                });
                return false;
            });

            //view nama siswa
            $('#tgl').change(function() {
                var id = $(this).val();
                $.ajax({
                    url: "<?php echo site_url('c_admin/getAbsensi'); ?>",
                    method: "POST",
                    data: {
                        id: id
                    },
                    async: true,
                    dataType: 'JSON',
                    success: function(data) {
                        console.log(data);
                        var html = '';
                        for (var i = 0; i < data.length; i++) {
                            html += '<tr>' +
                                '<td> ' + data[i].namaUser + ' </td>' +
                                '<td> '+ data[i].ketKelas+' '+ data[i].jurusanKelas+' '+ data[i].nomorKelas+'</td>' +
                                '<td> '+ data[i].ketAbsen+' </td>' +
                                '<td><a href="javascript:;" class="btn btn-info btn-xs item_edit" data="' + data[i].idAbsen + '">' +
                                '<i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>' +
                                '</td>' +
                                '</tr>';
                        }
                        $('#show_data').html(html);
                    }
                });
                return false;
            });

            //GET UPDATE
            $('#show_data').on('click', '.item_edit', function() {
                var id = $(this).attr('data');
                $.ajax({
                    type: "GET",
                    url: "<?php echo base_url('c_admin/editAbsensi') ?>",
                    dataType: "JSON",
                    data: {
                        id: id
                    },
                    success: function(data) {
                        $.each(data, function(idAbsen, ketKelas, nomorKelas, jurusanKelas, namaUser, ketAbsen) {
                            $('#ModalaEdit').modal('show');
                            $('[name="id_edit"]').val(data.idAbsen);
                            $('[name="nama_edit"]').val(data.namaUser);
                            $('[name="kelas_edit"]').val(data.ketKelas);
                            $('[name="absen_edit"]').val(data.ketAbsen);
                        });
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