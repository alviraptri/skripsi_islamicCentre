<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Informasi SPP | Information Academic Islamic Centre</title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url(); ?>assets/inter/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url(); ?>assets/inter/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url(); ?>assets/inter/vendors/nprogress/nprogress.css" rel="stylesheet">

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
                            <h3>Informasi SPP</h3>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Data Informasi SPP</h2>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">

                                    <form class="form-horizontal form-label-left" method="post" action="" novalidate>
                                        <div class="item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="nama">Kelas<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6   ">
                                                <select name="idKelas" id="kelas" class="form-control">
                                                    <option value=""> Pilih Kelas</option>
                                                    <?php
                                                    foreach ($kls as $kelas) { ?>
                                                        <option value="<?= $kelas->idKelas ?>"><?= $kelas->ketKelas ?> <?= $kelas->jurusanKelas ?> <?= $kelas->nomorKelas ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <table id="datatable-fixed-header" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Nama Siswa</th>
                                                    <th>Jumlah Biaya</th>
                                                    <th>Status</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>

                                            <tbody name="siswa" id="show_data">

                                            </tbody>
                                        </table>
                                        <div class="ln_solid"></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--MODAL HAPUS-->
                    <div class="modal fade" id="ModalHapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel">Hapus Informasi</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
                                </div>
                                <form class="form-horizontal">
                                    <div class="modal-body">

                                        <input type="hidden" name="kode" id="textkode" value="">
                                        <div class="alert alert-warning">
                                            <p>Apakah Anda yakin mau menghapus informasi ?</p>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                                        <button class="btn_hapus btn btn-danger" id="btn_hapus">Ya</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--END MODAL HAPUS-->
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
    <script type="text/javascript" src="<?php echo base_url() . 'assets/jquery.priceformat.js' ?>"></script>
    <script type="text/javascript">
        $(document).ready(function() {

            //view
            $('#kelas').change(function() {
                var idKelas = $(this).val();
                $(function() {
                    $('#biaya').priceFormat({
                        prefix: 'Rp ',
                        centsSeparator: ',',
                        thousandsSeparator: '.'
                    });
                })

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
                                '<td><span class="badge badge-info">Lunas</span></td>' +
                                '<td><a href="javascript:;" class="btn btn-danger btn-xs item_hapus" data="' + data[i].idInfo + '">Hapus</a></td>' +
                                '</tr>';
                        }
                        $('#show_data').html(html);

                    }
                });

                return false;
            });

            //GET HAPUS
            $('#show_data').on('click', '.item_hapus', function() {
                var idInfo = $(this).attr('data');
                $('#ModalHapus').modal('show');
                $('[name="kode"]').val(idInfo);
            });

            //Hapus Barang
            $('#btn_hapus').on('click', function() {
                var kode = $('#textkode').val();
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('c_admin/statusInfo') ?>",
                    dataType: "JSON",
                    data: {
                        kode: kode
                    },
                    success: function(data) {
                        $('#ModalHapus').modal('hide');
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