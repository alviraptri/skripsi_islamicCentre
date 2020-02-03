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
                            <h3>Lihat Jadwal Siswa</h3>
                        </div>
                    </div>

                    <div class="clearfix"></div>

                    <div class="row">
                        <!-- button -->
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Kelas <span class="required"></span>
                                        </label>
                                        <div class="col-md-6 col-sm-6">
                                            <select name="idKelas" id="klsId" required="required" class="form-control">
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
                                    <br>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center;">Hari</th>
                                                <th style="text-align: center;">Jam</th>
                                                <th style="text-align: center;">Mata Pelajaran</th>
                                                <th style="text-align: center;">Guru</th>
                                            </tr>
                                        </thead>
                                        <tbody name="show_data" id="show_data">
                                        </tbody>
                                    </table>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li id="printId"> 
                                        </li>
                                    </ul>
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

    <!-- MODAL Edit -->
    <div class="modal fade bs-example-modal-lg" id="ModalaAdd" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="myModalLabel">Tambah Pengawas</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <form class="form-horizontal form-label-left" action="<?php echo base_url("c_admin/pengawasSimpan") ?>" method="POST">

                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-lg-4">
                                <label>Hari</label>
                                <div class="kt-input-icon">
                                    <input type="text" name="id" id="ujianId" class="form-control" hidden>
                                    <input type="text" name="hari" id="hariId" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <label class="">Jam</label>
                                <div class="kt-input-icon">
                                    <input type="text" name="jam" id="jamId" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <label class="">Mata Pelajaran</label>
                                <div class="kt-input-icon">
                                    <input type="text" name="mapel" id="mapelId" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row" id="dataKelas">
                            <div class="col-lg-4">
                                <label>Kelas</label>
                                <div class="kt-input-icon" id="cKelas">

                                </div>
                            </div>
                            <div class="col-lg-8">
                                <label class="">Guru</label>
                                <div class="kt-input-icon" id="pengawas">
                                    <!-- <select name="guru" id="guruId" class="form-control">
                                        <option value="">Pilih Guru</option>
                                    </select> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                        <button type="submit" class="btn btn-info">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--END MODAL Edit-->

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
            //Jadwal
            $('#klsId').change(function() {
                var id = $(this).val();
                $.ajax({
                    url: "<?php echo site_url('c_admin/lihatJadwalSiswa'); ?>",
                    method: "POST",
                    data: {
                        id: id,
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
                        var print = '';
                        for (i = 0; i < data.jadwal.length; i++) {
                            if (data.jadwal[i].hari == "Senin") {
                                    html_senin +=
                                        '<td style="vertical-align : middle;"> ' + data.jadwal[i].jamMulai + ' - ' + data.jadwal[i].jamSelesai + ' </td>' +
                                        '<td style="vertical-align : middle;"> ' + data.jadwal[i].namaMapel + ' </td>' +
                                        '<td style="vertical-align : middle;"> ' + data.jadwal[i].namaUser + ' </td>' +
                                        '</tr>';
                                    span_senin++;
                            }
                            if (data.jadwal[i].hari == "Selasa") {
                                    html_selasa +=
                                        '<td style="vertical-align : middle;"> ' + data.jadwal[i].jamMulai + ' - ' + data.jadwal[i].jamSelesai + ' </td>' +
                                        '<td style="vertical-align : middle;"> ' + data.jadwal[i].namaMapel + ' </td>' +
                                        '<td style="vertical-align : middle;"> ' + data.jadwal[i].namaUser + ' </td>' +
                                        '</tr>';
                                    span_selasa++;
                            }
                            if (data.jadwal[i].hari == "Rabu") {
                                    html_rabu +=
                                        '<td style="vertical-align : middle;"> ' + data.jadwal[i].jamMulai + ' - ' + data.jadwal[i].jamSelesai + ' </td>' +
                                        '<td style="vertical-align : middle;"> ' + data.jadwal[i].namaMapel + ' </td>' +
                                        '<td style="vertical-align : middle;"> ' + data.jadwal[i].namaUser + ' </td>' +
                                        '</tr>';
                                    span_rabu++;
                            }
                            if (data.jadwal[i].hari == "Kamis") {
                                    html_kamis +=
                                        '<td style="vertical-align : middle;"> ' + data.jadwal[i].jamMulai + ' - ' + data.jadwal[i].jamSelesai + ' </td>' +
                                        '<td style="vertical-align : middle;"> ' + data.jadwal[i].namaMapel + ' </td>' +
                                        '<td style="vertical-align : middle;"> ' + data.jadwal[i].namaUser + ' </td>' +
                                        '</tr>';
                                    span_kamis++;
                            }
                            if (data.jadwal[i].hari == "Jumat") {
                                    html_jumat +=
                                        '<td style="vertical-align : middle;"> ' + data.jadwal[i].jamMulai + ' - ' + data.jadwal[i].jamSelesai + ' </td>' +
                                        '<td style="vertical-align : middle;"> ' + data.jadwal[i].namaMapel + ' </td>' +
                                        '<td style="vertical-align : middle;"> ' + data.jadwal[i].namaUser + ' </td>' +
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

                        print = '<a href="<?php echo base_url();?>c_jadwalSiswa/index/'+ data.jadwal[0].idKelas+'" target="_blank"><button type="submit" class="btn btn-secondary">Cetak Jadwal Siswa</button></a>';
                        $('#printId').html(print);
                    }
                });
                return false;
            });

            //GET ADD
            $('#show_data').on('click', '.item_add', function() {
                var id = $(this).attr('data');
                $.ajax({
                    type: "GET",
                    url: "<?php echo base_url('c_admin/getModalUjian') ?>",
                    dataType: "JSON",
                    data: {
                        id: id
                    },
                    success: function(data) {
                        $('#cKelas').empty();
                        $('#pengawas').empty();
                        console.log(data);
                        html = '';

                        $('#ModalaAdd').modal('show');
                        $('[name="id"]').val(data.ujian[0].idJadwalUjian);
                        $('[name="hari"]').val(data.ujian[0].hari);
                        $('[name="jam"]').val(data.ujian[0].jamMulai + ' - ' + data.ujian[0].jamSelesai);
                        $('[name="mapel"]').val(data.ujian[0].namaMapel + ' - ' + data.ujian[0].jenisMapel);
                        if (data.ujian[0].jenisMapel == "IPA") {
                            console.log("MASUK KE IPA");
                            for (i = 0; i < data.klsIPA.length; i++) {
                                html = '<input type="text" name="klsId[]" id="idKls" class="form-control" value="' + data.klsIPA[i].idKelas + '" hidden>' +
                                    '<input type="text" name="namaKls[]" id="klsNama" class="form-control" value="' + data.klsIPA[i].ketKelas + ' ' + data.klsIPA[i].jurusanKelas + ' ' + data.klsIPA[i].nomorKelas + '" readonly>';
                                $('#cKelas').append(html);
                                html = '<select name="guru[]" id="guruId' + i + '" class="form-control">' +
                                    '<option value="">Pilih Guru</option>' +
                                    '</select>';
                                $('#pengawas').append(html);
                                htmlGuru = '';
                                htmlGuru = '<option value="">Pilih Guru</option>';
                                for (j = 0; j < data.guru.length; j++) {
                                    htmlGuru += '<option value="' + data.guru[j].nomorInduk + '">' + data.guru[j].namaUser + '</option>'
                                    $('#guruId' + i).html(htmlGuru);
                                }
                            }
                        } else if (data.ujian[0].jenisMapel == "IPS") {
                            console.log("MASUK KE IPS");
                            for (i = 0; i < data.klsIPS.length; i++) {
                                html = '<input type="text" name="klsId[]" id="idKls" class="form-control" value="' + data.klsIPS[i].idKelas + '" hidden>' +
                                    '<input type="text" name="namaKls" id="klsNama" class="form-control" value="' + data.klsIPS[i].ketKelas + ' ' + data.klsIPS[i].jurusanKelas + ' ' + data.klsIPS[i].nomorKelas + '" readonly>';
                                $('#cKelas').append(html);
                                html = '<select name="guru[]" id="guruId' + i + '" class="form-control">' +
                                    '<option value="">Pilih Guru</option>' +
                                    '</select>';
                                $('#pengawas').append(html);
                                htmlGuru = '';
                                htmlGuru = '<option value="">Pilih Guru</option>';
                                for (j = 0; j < data.guru.length; j++) {
                                    htmlGuru += '<option value="' + data.guru[j].nomorInduk + '">' + data.guru[j].namaUser + '</option>'
                                    $('#guruId' + i).html(htmlGuru);
                                }
                            }
                        } else {
                            for (i = 0; i < data.kelas.length; i++) {
                                console.log("MASUK KE UMUM");
                                html = '<input type="text" name="klsId[]" id="idKls" class="form-control" value="' + data.kelas[i].idKelas + '" hidden>' +
                                    '<input type="text" name="namaKls[]" id="klsNama" class="form-control" value="' + data.kelas[i].ketKelas + ' ' + data.kelas[i].jurusanKelas + ' ' + data.kelas[i].nomorKelas + '" readonly>';
                                $('#cKelas').append(html);
                                html = '<select name="guru[]" id="guruId' + i + '" class="form-control">' +
                                    '<option value="">Pilih Guru</option>' +
                                    '</select>';
                                $('#pengawas').append(html);

                                htmlGuru = '<option value="">Pilih Guru</option>';
                                for (j = 0; j < data.guru.length; j++) {
                                    htmlGuru += '<option value="' + data.guru[j].nomorInduk + '">' + data.guru[j].namaUser + '</option>'
                                    $('#guruId' + i).html(htmlGuru);
                                }
                            }
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