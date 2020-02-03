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
                                            <select name="kelas" id="kelas" required="required" class="form-control">
                                                <option value="">Pilih Kelas</option>
                                                <?php
                                                foreach ($kls as $list) { ?>
                                                    <option value="<?php echo $list->idKelas ?>"><?php echo $list->ketKelas ?> <?php echo $list->jurusanKelas ?> <?php echo $list->nomorKelas ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li> <a href="<?php echo base_url('c_admin/tambahJadwalNgawas'); ?>"><button type="submit" class="btn btn-primary">Tambah Jadwal</button></a>
                                        </li>
                                    </ul>
                                    <br>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center;">Hari</th>
                                                <th style="text-align: center;">Tanggal</th>
                                                <th style="text-align: center;">Jam</th>
                                                <th style="text-align: center;">Mata Pelajaran</th>
                                                <th style="text-align: center;">Guru</th>
                                                <th style="text-align: center;">Kelas</th>
                                            </tr>
                                        </thead>
                                        <tbody name="show_data" id="show_data">
                                        </tbody>
                                    </table>
                                    <!-- <a href="<?php echo base_url('c_admin/tambahPegawai'); ?>"><button type="submit" class="btn btn-primary">Cetak Jadwal</button></a> -->
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
        function formatDate(date) {
            var d = new Date(date);
            var monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
            var day = d.getDate();
            var monthIndex = d.getMonth();
            var year = d.getFullYear();

            return day + ' ' + monthNames[monthIndex] + ' ' + year;
        }
        $(document).ready(function() {
            $('#kelas').change(function() {
                var idKls = $(this).val();
                var idTA = $('#tahunAjaran').val();
                $.ajax({
                    url: "<?php echo site_url('c_admin/pengawas'); ?>",
                    method: "POST",
                    data: {
                        idTA: idTA,
                        idKls: idKls
                    },
                    async: true,
                    dataType: 'JSON',
                    success: function(data) {
                        console.log(data);
                        var html = '';
                        var i;
                        var html_senin = '';
                        var html_selasa = '';
                        var html_rabu = '';
                        var html_kamis = '';
                        var html_jumat = '';
                        var span_senin = 0;
                        var span_selasa = 0;
                        var span_rabu = 0;
                        var span_kamis = 0;
                        var span_jumat = 0;
                        for (i = 0; i < data.jadwal.length; i++) {
                            if (data.jadwal[i].hari == "Senin") {
                                html_senin +=
                                    '<td style="vertical-align : middle;"> ' + formatDate(data.jadwal[i].tanggal) + ' </td>' +
                                    '<td style="vertical-align : middle;"> ' + data.jadwal[i].jamMulai + ' - ' + data.jadwal[i].jamSelesai + ' </td>' +
                                    '<td style="vertical-align : middle;"> ' + data.jadwal[i].namaMapel + ' </td>' +
                                    '<td id = "nama' + [i] + '"> </td>' +
                                    '<td id = "datakelas' + [i] + '"> </td>' +
                                    '</tr>';
                                span_senin++;
                            }
                            if (data.jadwal[i].hari == "Selasa") {
                                html_selasa +=
                                    '<td style="vertical-align : middle;"> ' + formatDate(data.jadwal[i].tanggal) + ' </td>' +
                                    '<td style="vertical-align : middle;"> ' + data.jadwal[i].jamMulai + ' - ' + data.jadwal[i].jamSelesai + ' </td>' +
                                    '<td style="vertical-align : middle;"> ' + data.jadwal[i].namaMapel + ' </td>' +
                                    '<td id = "nama' + [i] + '"> </td>' +
                                    '<td id = "datakelas' + [i] + '"> </td>' +
                                    '</tr>';
                                span_selasa++;
                            }
                            if (data.jadwal[i].hari == "Rabu") {
                                html_rabu +=
                                    '<td style="vertical-align : middle;"> ' + formatDate(data.jadwal[i].tanggal) + ' </td>' +
                                    '<td style="vertical-align : middle;"> ' + data.jadwal[i].jamMulai + ' - ' + data.jadwal[i].jamSelesai + ' </td>' +
                                    '<td style="vertical-align : middle;"> ' + data.jadwal[i].namaMapel + ' </td>' +
                                    '<td id = "nama' + [i] + '"> </td>' +
                                    '<td id = "datakelas' + [i] + '"> </td>' +
                                    '</tr>';
                                span_rabu++;
                            }
                            if (data.jadwal[i].hari == "Kamis") {
                                html_kamis +=
                                    '<td style="vertical-align : middle;"> ' + formatDate(data.jadwal[i].tanggal) + ' </td>' +
                                    '<td style="vertical-align : middle;"> ' + data.jadwal[i].jamMulai + ' - ' + data.jadwal[i].jamSelesai + ' </td>' +
                                    '<td style="vertical-align : middle;"> ' + data.jadwal[i].namaMapel + ' </td>' +
                                    '<td id = "nama' + [i] + '"> </td>' +
                                    '<td id = "datakelas' + [i] + '"> </td>' +
                                    '</tr>';
                                span_kamis++;
                            }
                            if (data.jadwal[i].hari == "Jumat") {
                                html_jumat +=
                                    '<td style="vertical-align : middle;"> ' + formatDate(data.jadwal[i].tanggal) + ' </td>' +
                                    '<td style="vertical-align : middle;"> ' + data.jadwal[i].jamMulai + ' - ' + data.jadwal[i].jamSelesai + ' </td>' +
                                    '<td style="vertical-align : middle;"> ' + data.jadwal[i].namaMapel + ' </td>' +
                                    '<td id = "nama' + [i] + '"> </td>' +
                                    '<td id = "datakelas' + [i] + '"> </td>' +
                                    '</tr>';
                                span_jumat++;
                            }
                        }
                        html_senin = '<tr>' +
                            '<td rowspan="' + span_senin + '" style="vertical-align : middle;text-align:center;"> Senin </td>' + html_senin;
                        html_selasa = '<tr>' +
                            '<td rowspan="' + span_selasa + '" style="vertical-align : middle;text-align:center;"> Selasa </td>' + html_selasa;
                        html_rabu = '<tr>' +
                            '<td rowspan="' + span_rabu + '" style="vertical-align : middle;text-align:center;"> Rabu </td>' + html_rabu;
                        html_kamis = '<tr>' +
                            '<td rowspan="' + span_kamis + '" style="vertical-align : middle;text-align:center;"> Kamis </td>' + html_kamis;
                        html_jumat = '<tr>' +
                            '<td rowspan="' + span_jumat + '" style="vertical-align : middle;text-align:center;"> Jumat </td>' + html_jumat;
                        $('#show_data').html(html_senin + html_selasa + html_rabu + html_kamis + html_jumat);

                        htmlGuru = '';
                        for (i = 0; i < data.jadwal1.length; i++) {
                            htmlGuru = data.jadwal1[i].namaUser;
                            $('#nama' + i).html(htmlGuru);
                            htmlGuru = data.jadwal1[i].ketKelas + ' ' + data.jadwal1[i].jurusanKelas + ' ' + data.jadwal1[i].nomorKelas;
                            $('#datakelas' + i).html(htmlGuru);
                        }
                    }
                });
                return false;
            });
            //filter hari
            $('#hari').change(function() {
                var hari = $(this).val();
                var idTA = $('#tahunAjaran').val();
                $.ajax({
                    url: "<?php echo site_url('c_admin/pengawasHari'); ?>",
                    method: "POST",
                    data: {
                        hari: hari,
                        idTa: idTA
                    },
                    async: true,
                    dataType: 'JSON',
                    success: function(data) {
                        console.log(data);
                        var html = '';
                        var i;
                        for (i = 0; i < data.jadwal.length; i++) {
                            html += '<tr>' +
                                '<td> ' + data.jadwal[i].hari + ' </td>' +
                                '<td> ' + data.jadwal[i].jamMulai + ' - ' + data.jadwal[i].jamSelesai + ' </td>' +
                                '<td> ' + data.jadwal[i].namaMapel + ' </td>' +
                                '<td id = "nama' + [i] + '"> </td>' +
                                '<td id = "datakelas' + [i] + '"> </td>' +
                                '</tr>';
                        }
                        $('#show_data').html(html);
                        html = '';
                        for (i = 0; i < data.jadwal1.length; i++) {
                            html = data.jadwal1[i].namaUser;
                            $('#nama' + i).html(html);
                            html = data.jadwal1[i].ketKelas + ' ' + data.jadwal1[i].jurusanKelas + ' ' + data.jadwal1[i].nomorKelas;
                            $('#datakelas' + i).html(html);
                        }
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