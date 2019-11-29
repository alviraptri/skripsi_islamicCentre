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
                                        <div class="item item form-group">
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
                                        <div class="item item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="nama">Mata Pelajaran<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6   ">
                                                <select name="mapel" id="mapel" class="form-control">
                                                    <option value=""> Pilih Mata Pelajaran</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!-- <div class="item form-group">
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

            <!-- MODAL EDIT -->
            <div class="modal fade bs-example-modal-lg" id="ModalaEdit" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title" id="myModalLabel">Edit Keterangan Nilai</h3>
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
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Guru</label>
                                    <div class="col-md-6 col-sm-6">
                                        <input name="guru_edit" id="guru_edit" class="form-control" type="text" placeholder="Nama Guru" readonly>
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Mata Pelajaran</label>
                                    <div class="col-xs-9">
                                        <input name="mapel_edit" id="mapel_edit" class="form-control" type="text" placeholder="Mata Pelajaran" readonly>
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Nilai Satu</label>
                                    <div class="col-xs-9">
                                        <input name="nsatu_edit" id="nsatu_edit" class="form-control" type="text" placeholder="Nilai Satu" required>
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Nilai Dua</label>
                                    <div class="col-xs-9">
                                        <input name="ndua_edit" id="ndua_edit" class="form-control" type="text" placeholder="Nilai Dua" required>
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Nilai UTS</label>
                                    <div class="col-xs-9">
                                        <input name="nuts_edit" id="nuts_edit" class="form-control" type="text" placeholder="Nilai UTS" required>
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Nilai UAS</label>
                                    <div class="col-xs-9">
                                        <input name="nuas_edit" id="nuas_edit" class="form-control" type="text" placeholder="Nilai UAS" required>
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

            //view
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

            $('#mapel').change(function() {
                var idMapel = $(this).val();
                $.ajax({
                    url: "<?php echo site_url('c_admin/getKetNilai'); ?>",
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
                            html += '<tr>' +
                                '<td> Nilai Satu </td>' +
                                '<td>' + data[i].nilaiSatu + '</td>' +
                                '<td rowspan="4"><a href="javascript:;" class="btn btn-info btn-xs item_edit" data="' + data[i].idJadwalUjian + '">' +
                                '<i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>' +
                                '</td>' +
                                '</tr><tr>' +
                                '<td> Nilai Dua </td>' +
                                '<td>' + data[i].nilaiDua + '</td>' +
                                '</tr><tr>' +
                                '<td> Nilai UTS </td>' +
                                '<td>' + data[i].nilaiUts + '</td>' +
                                '</tr><tr>' +
                                '<td> Nilai UAS </td>' +
                                '<td>' + data[i].nilaiUas + '</td>' +
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
                    url: "<?php echo base_url('c_admin/editKetNilai') ?>",
                    dataType: "JSON",
                    data: {
                        id: id
                    },
                    success: function(data) {
                        $.each(data, function(idKetNilai, namaUser, namaMapel, nilaiSatu, nilaiDua, nilaiUts, nilaiUas) {
                            $('#ModalaEdit').modal('show');
                            $('[name="id_edit"]').val(data.idKetNilai);
                            $('[name="guru_edit"]').val(data.namaUser);
                            $('[name="mapel_edit"]').val(data.namaMapel);
                            $('[name="nsatu_edit"]').val(data.nilaiSatu);
                            $('[name="ndua_edit"]').val(data.nilaiDua);
                            $('[name="nuts_edit"]').val(data.nilaiUts);
                            $('[name="nuas_edit"]').val(data.nilaiUas);
                        });
                    }
                });
                return false;
            });

            //Update Barang
            $('#btn_update').on('click', function() {
                var id = $('#id_edit').val();
                var nsatu = $('#nsatu_edit').val();
                var ndua = $('#ndua_edit').val();
                var nuts = $('#nuts_edit').val();
                var nuas = $('#nuas_edit').val();
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('c_admin/updateKetNilai') ?>",
                    dataType: "JSON",
                    data: {
                        id: id,
                        nsatu: nsatu,
                        ndua: ndua,
                        nuts: nuts,
                        nuas: nuas
                    },
                    success: function(data) {
                        $('[name="id_edit"]').val("");
                        $('[name="guru_edit"]').val("");
                        $('[name="mapel_edit"]').val("");
                        $('[name="nsatu_edit"]').val("");
                        $('[name="ndua_edit"]').val("");
                        $('[name="nuts_edit"]').val("");
                        $('[name="nuas_edit"]').val("");
                        $('#ModalaEdit').modal('hide');
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