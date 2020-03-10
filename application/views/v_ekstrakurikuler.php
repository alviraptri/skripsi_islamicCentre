<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Pengembangan Diri | Information Academic Islamic Centre</title>

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
                            <h3>Pengembangan Diri</h3>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Ekstrakurikuler</h2>

                                    <div class="clearfix"></div>
                                </div>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li> <a href="<?php echo base_url('c_admin/tambahEkskul'); ?>"><button type="submit" class="btn btn-primary">Tambah Ekstrakulikuler</button></a>
                                    </li>
                                </ul>
                                <div class="x_content">

                                    <form class="form-horizontal form-label-left" method="post" action="<?php echo base_url() . 'c_admin/simpanEkskul'; ?>" novalidate>
                                        <div class="item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Guru
                                            </label>
                                            <div class="col-md-6 col-sm-6">
                                                <select name="guru" id="guru" class="form-control">
                                                    <option value="">Pilih Guru</option>
                                                    <?php
                                                    foreach ($dataWk as $list) { ?>
                                                        <option value="<?php echo $list->nomorInduk ?>"><?php echo $list->namaUser ?> </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Kelas
                                            </label>
                                            <div class="col-md-6 col-sm-6">
                                                <select name="kelas" id="kelas" class="form-control">
                                                    <option value="">Pilih Kelas</option>
                                                </select>
                                            </div>
                                        </div>



                                        <div class="item form-group">
                                            <!-- <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Tanggal<span class="required">*</span>
                                            </label> -->
                                            <div class="col-md-6 col-sm-6" id="jadwal">
                                            </div>
                                        </div>
                                        <table id="datatable-fixed-header" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Nama Siswa</th>
                                                    <th>Nama Ekstrakurikuler</th>
                                                    <th>Predikat</th>
                                                    <th>Keterangan</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>

                                            <tbody name="show_data" id="show_data">

                                            </tbody>
                                        </table>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /page content -->
            <!-- MODAL Edit -->
            <div class="modal fade bs-example-modal-lg" id="ModalaEdit" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title" id="myModalLabel">Edit Ekstrakurikuler</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <form class="form-horizontal form-label-left">
                            <div class="modal-body">
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Nama</label>
                                    <div class="col-md-6 col-sm-6">
                                    <input name="id_edit" id="id_edit" class="form-control" type="text" placeholder="Nama Tahun Ajaran" readonly hidden>
                                        <input name="nama_edit" id="nama_edit" class="form-control" type="text" placeholder="Nama Tahun Ajaran" readonly>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Ekstrakurikuler</label>
                                    <div class="col-md-6 col-sm-6">
                                    <input name="ekskul_edit" id="ekskul_edit" class="form-control" type="text" placeholder="Nama Tahun Ajaran" readonly>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Predikat</label>
                                    <div class="col-md-6 col-sm-6">
                                    <select name="predikat" id="predikatId" class="form-control">
                                        <option value="A"> A </option>
                                        <option value="B"> B </option>
                                        <option value="C"> C </option>
                                    </select>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Catatan</label>
                                    <div class="col-md-6 col-sm-6">
                                    <textarea name="cttn_edit" id="cttn_edit" cols="30" rows="10" class="form-control"></textarea>
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
            <!--END MODAL Edit-->

            <!-- footer content -->
            <footer>
                <?php include("v-Footer.php") ?>
            </footer>
            <!-- /footer content -->
        </div>
    </div>

    <script type="text/javascript" src="<?php echo base_url() . 'assets/jquery-3.3.1.js' ?>"></script>
    <script type="text/javascript">
    function selectElement(id, valueToSelect) {
                let element = document.getElementById(id);
                element.value = valueToSelect;
            }
        $(document).ready(function() {

            //view kelas
            $('#guru').change(function() {
                var nomorInduk = $(this).val();
                $.ajax({
                    url: "<?php echo site_url('c_admin/getWKelas'); ?>",
                    method: "POST",
                    data: {
                        nomorInduk: nomorInduk
                    },
                    async: true,
                    dataType: 'JSON',
                    success: function(data) {
                        var html = '';
                        var i;
                        html += '<option value="">Pilih Kelas</option>'
                        for (i = 0; i < data.length; i++) {
                            html += '<option value="' + data[i].idKelas + '">' + data[i].ketKelas + ' ' + data[i].jurusanKelas + ' ' + data[i].nomorKelas + '</option>'
                        }
                        $('#kelas').html(html);
                    }
                });
                return false;
            });

            //view nama siswa
            $('#kelas').change(function() {
                var idKelas = $(this).val();
                $.ajax({
                    url: "<?php echo site_url('c_admin/getEkskul'); ?>",
                    method: "POST",
                    data: {
                        idKelas: idKelas,
                    },
                    async: true,
                    dataType: 'JSON',
                    success: function(data) {
                        console.log(data);
                        var html = '';
                        for (var i = 0; i < data.eks.length; i++) {
                            html += '<tr>' +
                                '<td> <input type="text" name="idSiswa[]" value="" hidden> ' + data.eks[i].namaUser + ' </td>' +
                                '<td> ' + data.eks[i].namaEkskul + ' </td>' +
                                '<td> ' + data.eks[i].predikat + ' </td>' +
                                '<td> ' + data.eks[i].ketEkskul + ' </td>' +
                                '<td>' +
                                '<a href="javascript:;" title="Edit" class="btn btn-info btn-xs item_edit" data="' + data.eks[i].idEkskul + '">' +
                                '<i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>' +
                                '</td>' +
                                '</tr>';
                        }
                        $('#show_data').html(html);
                    }
                });
                return false;
            });

            //GET EDIT
            $('#show_data').on('click', '.item_edit', function() {
                var id = $(this).attr('data');
                $.ajax({
                    type: "GET",
                    url: "<?php echo base_url('c_admin/getEditEkskul') ?>",
                    dataType: "JSON",
                    data: {
                        id: id
                    },
                    success: function(data) {
                        console.log(data);
                        $('#ModalaEdit').modal('show');
                        $('[name="id_edit"]').val(data[0].idEkskul);
                        $('[name="nama_edit"]').val(data[0].namaUser);
                        $('[name="ekskul_edit"]').val(data[0].namaEkskul);
                        selectElement('predikatId', data[0].predikat);
                        $('[name="cttn_edit"]').val(data[0].ketEkskul);
                    }
                });
                return false;
            });
            

            //update data
            $('#btn_update').on('click', function() {
                var id = $('#id_edit').val();
                var cttn = $('#cttn_edit').val();
                var predikat = $('#predikatId').val();
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('c_admin/updateEkskul') ?>",
                    dataType: "JSON",
                    data: {
                        id: id,
                        cttn: cttn,
                        predikat: predikat
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