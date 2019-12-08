<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Jadwal Ujian Siswa | Information Academic Islamic Centre</title>

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
                            <h3>Jadwal Ujian Siswa</h3>
                        </div>
                    </div>

                    <div class="clearfix"></div>

                    <div class="row">
                        <!-- button -->
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Tahun Ajaran <span class="required"></span>
                                        </label>
                                        <div class="col-md-6 col-sm-6">
                                            <select name="idTahunAjaran" id="tahunAjaran" required="required" class="form-control">
                                                <option value="">Pilih Tahun Ajaran</option>
                                                <?php
                                                foreach ($ta as $list) { ?>
                                                    <option value="<?php echo $list->idTahunAjaran ?>"><?php echo $list->tahunAjaran ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Kelas <span class="required"></span>
                                        </label>
                                        <div class="col-md-6 col-sm-6">
                                            <select name="idKelas" id="kelas" required="required" class="form-control">
                                                <option value="">Pilih Kelas</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Nama Siswa <span class="required"></span>
                                        </label>
                                        <div class="col-md-6 col-sm-6">
                                            <select name="idSiswa" id="siswa" required="required" class="form-control">
                                                <option value="">Pilih Siswa</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">

                                    <div class="row">
                                        <div class="col-sm-3">

                                        </div>
                                        <div class="col-sm-6">
                                            <h3>
                                                <center><b>KARTU UJIAN SISWA</b></center>
                                            </h3>
                                            <h3>
                                                <center><b>SMA ISLAMIC CENTRE</b></center>
                                            </h3>
                                            <br>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-2">
                                            <h2>
                                                NAMA<br>
                                                NIS<br>
                                                KELAS<br>
                                            </h2>
                                        </div>
                                        <div class="col-sm-4" id="data">
                                            <!-- <h2>
                                                : ALVIRA PUTRI YUDINI<br>
                                                : 00000023804<br>
                                                : XII IPA 2<br>
                                            </h2> -->
                                        </div>
                                        <div class="col-sm-4" id="foto">
                                            <!-- <center><img src="<?php echo base_url(); ?>assets/inter/images/logo.jpg" alt="" style="width:30%;"></center> -->

                                        </div>
                                    </div>
                                    <br>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center;" rowspan="2">Hari</th>
                                                <th style="text-align: center;" rowspan="2">Jam</th>
                                                <th style="text-align: center;" colspan="2">Mata Pelajaran</th>
                                                <th style="text-align: center;" rowspan="2">Jenis Mata Pelajaran</th>
                                            </tr>
                                            <tr>
                                                <th style="text-align: center;">IPA</th>
                                                <th style="text-align: center;">IPS</th>
                                            </tr>
                                        </thead>
                                        <tbody name="show_data" id="show_data">
                                        </tbody>
                                    </table>
                                    <a href="<?php echo base_url('c_admin/tambahPegawai'); ?>"><button type="submit" class="btn btn-primary">Cetak Kartu</button></a>
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
            //view data kelas
            $('#tahunAjaran').change(function() {
                var idTA = $(this).val();
                $.ajax({
                    url: "<?php echo site_url('c_admin/getKls'); ?>",
                    method: "POST",
                    data: {
                        idTA: idTA
                    },
                    async: true,
                    dataType: 'JSON',
                    success: function(data) {
                        var html = '';
                        var i;
                        for (i = 0; i < data.length; i++) {
                            html += '<option value="' + data[i].idKelas + '">' + data[i].ketKelas + ' ' + data[i].jurusanKelas + ' ' + data[i].nomorKelas + '</option>'
                        }
                        $('#kelas').html(html);
                    }
                });
                return false;
            });
            //view data siswa
            $('#kelas').change(function() {
                var id = $(this).val();
                $.ajax({
                    url: "<?php echo site_url('c_admin/dataSiswa'); ?>",
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
                            html += '<option value="' + data[i].nomorInduk + '">' + data[i].namaUser + '</option>'
                        }
                        $('#siswa').html(html);
                    }
                });
                return false;
            });
            //view data info siswa
            $('#siswa').change(function() {
                var id = $(this).val();
                $.ajax({
                    url: "<?php echo site_url('c_admin/infoSiswa'); ?>",
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
                            html += '<h2>' +
                                ': ' + data[i].namaUser + '<br>' +
                                ': ' + data[i].nomorInduk + '<br>' +
                                ': ' + data[i].ketKelas + ' ' + data[i].jurusanKelas + ' ' + data[i].nomorKelas + '<br>' +
                                '</h2>'
                        }
                        $('#data').html(html);
                    }
                });
                return false;
            });
            $('#siswa').change(function() {
                var id = $(this).val();
                $.ajax({
                    url: "<?php echo site_url('c_admin/infoSiswa'); ?>",
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
                            html += '<center><img src="<?php echo base_url(); ?>assets/inter/images/' + data[i].gambar + '" alt="" style="width:30%;"></center>'
                        }
                        $('#foto').html(html);
                    }
                });
                return false;
            });

            //Jadwal
            $('#tahunAjaran').change(function() {
                var idTA = $(this).val();
                $.ajax({
                    url: "<?php echo site_url('c_admin/getJadwalUjian'); ?>",
                    method: "POST",
                    data: {
                        idTA: idTA
                    },
                    async: true,
                    dataType: 'JSON',
                    success: function(data) {
                        console.log(data);
                        var html = '';
                        var i;
                        for (i = 0; i < data.jadwal.length; i++) {
                            var ipa = "";
                            var ips = "";
                            if (data.jadwal[i].hari == data.jadwal[i].hari) {
                                if (data.jadwal[i].jenisMapel == "IPA") {
                                    ipa = data.jadwal[i].namaMapel;
                                } else if (data.jadwal[i].jenisMapel == "IPS") {
                                    ips = data.jadwal[i].namaMapel;
                                } else {
                                    ipa = data.jadwal[i].namaMapel;
                                    ips = data.jadwal[i].namaMapel;
                                }
                            }
                            html += '<tr>' +
                                '<td> ' + data.jadwal[i].hari + ' </td>' +
                                '<td> ' + data.jadwal[i].jamMulai + ' - ' + data.jadwal[i].jamSelesai + ' </td>' +
                                '<td>' + ipa + '</td>' +
                                '<td>'+ ips +'</td>' +
                                '<td>' + data.jadwal[i].jenisMapel + '</td>' +
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