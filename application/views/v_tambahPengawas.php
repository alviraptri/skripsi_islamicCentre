<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Jadwal Mengawas Guru | Information Academic Islamic Centre</title>

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
                            <h3>Jadwal Mengawas Guru</h3>
                        </div>
                    </div>

                    <div class="clearfix"></div>

                    <div class="row">
                        <!-- button -->
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <form class="form-horizontal form-label-left" method="post" action="<?php echo base_url() . 'c_admin/simpanPengawas'; ?>" novalidate>
                                    <!-- tahun ajaran -->
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Tahun Ajaran <span class="required"></span>
                                        </label>
                                        <div class="col-md-6 col-sm-6">
                                            <select name="idTA" id="tahunAjaran" required="required" class="form-control">
                                                <option value="">Pilih Tahun Ajaran</option>
                                                <?php
                                                foreach ($ta as $list) { ?>
                                                    <option value="<?php echo $list->idTahunAjaran ?>"><?php echo $list->tahunAjaran ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- hari -->
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Hari <span class="required"></span>
                                        </label>
                                        <div class="col-md-6 col-sm-6">
                                            <select name="hari" id="hari" required="required" class="form-control">
                                                <option value="">Pilih Hari</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- jam -->
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Jam <span class="required"></span>
                                        </label>
                                        <div class="col-md-6 col-sm-6">
                                            <select name="id" id="jam" required="required" class="form-control">
                                                <option value="">Pilih Jam</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- mata pelajaran -->
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Mata Pelajaran <span class="required"></span>
                                        </label>
                                        <div class="col-md-6 col-sm-6">
                                            <select name="idMapel" id="mapel" required="required" class="form-control">
                                                <option value="">Pilih Mata Pelajaran</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- guru -->
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Guru <span class="required"></span>
                                        </label>
                                        <div class="col-md-6 col-sm-6">
                                            <select name="nomorInduk" id="guru" required="required" class="form-control">
                                                <option value="">Pilih Guru</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- kelas -->
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Kelas <span class="required"></span>
                                        </label>
                                        <div class="col-md-6 col-sm-6">
                                            <select name="idKelas" id="kelas" required="required" class="form-control">
                                                <option value="">Pilih Kelas</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!--   <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th style="text-align: center;">Hari</th>
                                                    <th style="text-align: center;">Jam</th>
                                                    <th style="text-align: center;">Mata Pelajaran</th>
                                                    <th style="text-align: center;">Guru</th>
                                                    <th style="text-align: center;">Kelas</th>
                                                </tr>
                                            </thead>
                                            <tbody name="show_data" id="show_data">
                                            </tbody>
                                        </table>-->
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 offset-md-3">
                                    <button id="send" type="submit" class="btn btn-success">Simpan</button>
                                    <a href="<?php echo base_url('c_admin/index'); ?>"><button type="submit" class="btn btn-primary">Batal</button></a>
                                </div>

                                </form>
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
            //view hari
            $('#tahunAjaran').change(function() {
                var idTA = $(this).val();
                $.ajax({
                    url: "<?php echo site_url('c_admin/ngawasHari'); ?>",
                    method: "POST",
                    data: {
                        idTA: idTA
                    },
                    async: true,
                    dataType: 'JSON',
                    success: function(data) {
                        var html = '';
                        var i;
                        html += '<option value="">Pilih Hari</option>';
                        for (i = 0; i < data.length; i++) {
                            html += '<option value="' + data[i].hari + '">' + data[i].hari + '</option>'
                        }
                        $('#hari').html(html);
                    }
                });
                return false;
            });

            //view jam
            $('#hari').change(function() {
                var hari = $(this).val();
                $.ajax({
                    url: "<?php echo site_url('c_admin/ngawasJam'); ?>",
                    method: "POST",
                    data: {
                        hari: hari
                    },
                    async: true,
                    dataType: 'JSON',
                    success: function(data) {
                        var html = '';
                        var i;
                        html += '<option value="">Pilih Jam</option>';
                        for (i = 0; i < data.length; i++) {
                            html += '<option value="' + data[i].jamMulai + '">' + data[i].jamMulai + ' - ' + data[i].jamSelesai + '</option>'
                        }
                        $('#jam').html(html);
                    }
                });
                return false;
            });

            //view mapel
            $('#jam').change(function() {
                var jamMulai = $(this).val();
                $.ajax({
                    url: "<?php echo site_url('c_admin/ngawasMapel'); ?>",
                    method: "POST",
                    data: {
                        jamMulai: jamMulai
                    },
                    async: true,
                    dataType: 'JSON',
                    success: function(data) {
                        var html = '';
                        var i;
                        html += '<option value="">Pilih Mata Pelajaran</option>';
                        for (i = 0; i < data.length; i++) {
                            html += '<option value="' + data[i].idJadwalUjian + '">' + data[i].namaMapel + '</option>'
                        }
                        $('#mapel').html(html);
                    }
                });
                return false;
            });

            //view guru
            $('#jam').change(function() {
                var id = $(this).val();
                $.ajax({
                    url: "<?php echo site_url('c_admin/ngawasGuru'); ?>",
                    method: "POST",
                    data: {
                        id: id
                    },
                    async: true,
                    dataType: 'JSON',
                    success: function(data) {
                        var html = '';
                        var i;
                        html += '<option value="">Pilih Guru</option>';
                        // if (data.ngawas.idJadwalPengawas == 0) {
                        //     for (i = 0; i < data.guru.length; i++) {
                        //         html += '<option value="' + data.guru[i].nomorInduk + '">' + data.guru[i].namaUser + '</option>'
                        //     }
                        //     $('#guru').html(html);
                        // }
                        for (i = 0; i < data.guru.length; i++) {
                                html += '<option value="' + data.guru[i].nomorInduk + '">' + data.guru[i].namaUser + '</option>'
                            }
                            $('#guru').html(html);
                    }
                });
                return false;
            });

            //view kelas
            $('#jam').change(function() {
                var id = $(this).val();
                $.ajax({
                    url: "<?php echo site_url('c_admin/ngawasKelas'); ?>",
                    method: "POST",
                    data: {
                        id: id
                    },
                    async: true,
                    dataType: 'JSON',
                    success: function(data) {
                        var html = '';
                        var i;
                        html += '<option value="">Pilih Kelas</option>';
                        // if (data.ngawas.idJadwalPengawas == 0) {
                        //     for (i = 0; i < data.guru.length; i++) {
                        //         html += '<option value="' + data.guru[i].nomorInduk + '">' + data.guru[i].namaUser + '</option>'
                        //     }
                        //     $('#guru').html(html);
                        // }
                        for (i = 0; i < data.kelas.length; i++) {
                                html += '<option value="' + data.kelas[i].idKelas + '">' + data.kelas[i].ketKelas + ' ' + data.kelas[i].jurusanKelas + ' ' + data.kelas[i].nomorKelas + '</option>'
                            }
                            $('#kelas').html(html);
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