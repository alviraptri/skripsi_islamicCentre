<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Rekomendasi | Information Academic Islamic Centre</title>

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
                            <h3>Rekomendasi</h3>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Alternatif</h2>

                                    <div class="clearfix"></div>
                                </div>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li> <a href="#"><button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#ModalaAdd"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Alternatif</button></a> </li>
                                </ul>
                                <div class="x_content">
                                    <table id="datatable-fixed-header" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Nama Siswa</th>
                                                <th>Nama Alternatif</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>


                                        <tbody name="show_data" id="show_data">
                                            <?php
                                            foreach ($alternatif as $list) { ?>
                                                <tr>
                                                    <td><?php echo $list->namaUser ?></td>
                                                    <td><?php echo $list->namaAlternatif ?></td>
                                                    <td>
                                                        <!-- <a href="<?php echo base_url('c_admin/editSiswa/') . $list->idAlternatif; ?>">
                                                            <button data-toggle="tooltip" title="Edit" class="btn btn-info btn-xs">
                                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                            </button>
                                                        </a> -->
                                                        <a href="javascript:;">
                                                            <button data-toggle="tooltip" title="Edit" class="btn btn-info btn-xs item_edit" data="<?php $list->idAlternatif ?>">
                                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                            </button>
                                                        </a>
                                                        <a href="<?php echo base_url('c_admin/statusSiswa/') . $list->idAlternatif; ?>">
                                                            <button data-toggle="tooltip" title="Hapus" class="btn btn-danger btn-xs">
                                                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                            </button> 
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <ul class="nav navbar-right panel_toolbox">
                        <li> <a href="<?php echo base_url('c_rekomendasi/lihatSiswa'); ?>"><button class="btn btn-warning btn-xs"> Data Alternatif Siswa <i class="fa fa-angle-double-right" aria-hidden="true"></i> </button></a> </li>
                    </ul>
                </div>
            </div>
            <!-- /page content -->

            <!-- MODAL ADD -->
            <div class="modal fade" id="ModalaAdd" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title" id="myModalLabel">Tambah Alternatif</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <form class="form-horizontal form-label-left">
                            <div class="modal-body">
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Nama Siswa</label>
                                    <div class="col-md-6 col-sm-6">
                                        <select name="siswa" id="siswa" class="form-control">
                                            <option value="">Pilih Siswa</option>
                                            <?php
                                            foreach ($siswa as $list) {?>
                                                <option value="<?= $list->nomorInduk?>"><?= $list->namaUser?></option>
                                            <?php }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Nama Alternatif</label>
                                    <div class="col-md-6 col-sm-6">
                                        <select name="alternatif" id="alternatif" class="form-control">
                                            <option value="">Pilih Jurusan</option>
                                            <option value="MIPA - UI">MIPA - UI</option>
                                            <option value="TEKNIK - UI">TEKNIK - UI</option>
                                            <option value="SENI - UI">SENI - UI</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                                <button class="btn btn-info" id="btn_simpan">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- MODAL EDIT -->
            <div class="modal fade" id="ModalaEdit" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title" id="myModalLabel">Edit Kriteria</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <form class="form-horizontal form-label-left">
                            <div class="modal-body">
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Nama Kriteria</label>
                                    <div class="col-md-6 col-sm-6">
                                        <input name="nama_edit" id="nama_edit" class="form-control" type="text" placeholder="Nama Kriteria">
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

            //Simpan Barang
            $('#btn_simpan').on('click', function() {
                var siswa = $('#siswa').val();
                var alternatif = $('#alternatif').val();
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('c_rekomendasi/simpanAlternatif') ?>",
                    dataType: "JSON",
                    data: {
                        siswa: siswa,
                        alternatif: alternatif
                    },
                    success: function(data) {
                        $('[name="siswa"]').val(" ");
                        $('[name="alternatif"]').val(" ");
                        $('#ModalaAdd').modal('hide');
                    }
                });
                return false;
            });

            //GET UPDATE
            $('#show_data').on('click', '.item_edit', function() {
                var id = $(this).attr('data');
                $.ajax({
                    type: "GET",
                    url: "<?php echo base_url('c_rekomendasi/editKriteria') ?>",
                    dataType: "JSON",
                    data: {
                        id: id
                    },
                    success: function(data) {
                        $.each(data, function(jenisKriteria) {
                            $('#ModalaEdit').modal('show');
                            $('[name="nama_edit"]').val(data.jenisKriteria);
                        });
                    }
                });
                return false;
            });

            //update data
            $('#btn_update').on('click', function() {
                var id = $('#id_edit').val();
                var cttn = $('#cttn_edit').val();
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('c_admin/updateCatatan') ?>",
                    dataType: "JSON",
                    data: {
                        id: id,
                        cttn: cttn,
                    },
                    success: function(data) {
                        $('[name="nama_edit"]').val("");
                        $('[name="cttn_edit"]').val("");
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