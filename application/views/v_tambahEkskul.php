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
                                    <h2>Tambah Ekstrakurikuler</h2>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">

                                    <form class="form-horizontal form-label-left" method="post" action="<?php echo base_url() . 'c_admin/simpanEkskul'; ?>" novalidate>
                                        <div class="item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Guru <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6">
                                                <select name="guru" id="guru" required="required" class="form-control">
                                                    <option value="">Pilih Guru</option>
                                                    <?php
                                                    foreach ($dataWk as $list) { ?>
                                                        <option value="<?php echo $list->nomorInduk ?>"><?php echo $list->namaUser ?> </option>
                                                    <?php } ?>
                                                </select>
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
                                            <!-- <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Tanggal<span class="required">*</span>
                                            </label> -->
                                            <div class="col-md-6 col-sm-6" id="jadwal">
                                            </div>
                                        </div>
                                        <table id="datatable-fixed-header" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Nama Siswa</th>
                                                    <th>Status</th>
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
            <div class="modal fade bs-example-modal-lg" id="ModalaAdd" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title" id="myModalLabel">Tambah Ekstrakurikuler</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <form class="form-horizontal form-label-left" action="<?php echo base_url("c_admin/simpanEkskul") ?>" method="POST">

                            <div class="modal-body">
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Nama</label>
                                    <div class="col-md-6 col-sm-6">
                                        <input name="id" id="id" class="form-control" type="text" placeholder="Nama Tahun Ajaran" readonly hidden>
                                        <input name="nama" id="nama" class="form-control" type="text" placeholder="Nama Tahun Ajaran" readonly>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-lg-12">
                                        <button type="button" onclick="loadnew()" id="btn-tambah-form" class="btn btn-primary">Tambah Baris</button>
                                    </div>
                                </div>

                                <div class="view-this">

                                    <div class="form-group row">
                                        <div class="col-lg-4">
                                            <input type="hidden" name="counter[]" value="0">
                                            <!-- <input name="id" id="id" class="form-control" type="text" placeholder="Nama Tahun Ajaran" readonly> -->
                                            <label>Ekstrakurikuler</label>
                                            <select name="eks0" id="eks" class="form-control">
                                                <option value="-">Pilih</option>
                                                <option value="OSIS">OSIS</option>
                                                <option value="ROHIS">ROHIS</option>
                                                <option value="Basket">Basket</option>
                                                <OPtion value="Futsal">Futsal</OPtion>
                                                <option value="Voli">Voli</option>
                                                <option value="Tari Saman">Tari Saman</option>
                                                <option value="Paskibra">Paskibra</option>
                                                <option value="Pramuka">Pramuka</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-2">
                                            <label class="">Predikat</label>
                                            <div class="kt-input-icon">
                                                <select name="predikat0" id="predikat" class="form-control">
                                                    <option value="-">Pilih</option>
                                                    <option value="A">A</option>
                                                    <option value="B">B</option>
                                                    <option value="C">C</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="">Keterangan</label>
                                            <div class="kt-input-icon">
                                                <input type="text" name="ket0" id="ket" class="form-control">
                                            </div>
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
                        for (var i = 0; i < data.nama.length; i++) {
                            var flag = false;
                                for (var j = 0; j < data.eks.length; j++) {
                                    if (data.eks[j].idSiswa == data.nama[i].idSiswa) {
                                        flag = true;
                                        break;
                                    }
                                }
                            if (flag == true) {
                                html += '<tr>' +
                                    '<td> <input type="text" name="id" value="" hidden> ' + data.nama[i].namaUser + ' </td>' +
                                    '<td>Data Tersimpan</td>' +
                                    '<td><button class="btn btn-info btn-xs item_add" disabled>' +
                                        '<i class="fa fa-plus" aria-hidden="true"></i></button></td>' +
                                    '</tr>';
                            } else {
                                html += '<tr>' +
                                    '<td> <input type="text" name="id" value="" hidden> ' + data.nama[i].namaUser + ' </td>' +
                                    '<td>Tidak Ada Data</td>' +
                                    '<td>' +
                                    '<a href="javascript:;" title="Edit" class="item_add" data="' + data.nama[i].idSiswa + '">' +
                                    '<button type="button" class="btn btn-info btn-xs"><i class="fa fa-plus" aria-hidden="true"></i></button></a>' +
                                    '</td>' +
                                    '</tr>';
                            }
                        }
                        $('#show_data').html(html);
                    }
                });
                return false;
            });

            //GET ADD
            $('#show_data').on('click', '.item_add', function() {
                var id = $(this).attr('data');
                $.ajax({
                    type: "GET",
                    url: "<?php echo base_url('c_admin/getAddSiswa') ?>",
                    dataType: "JSON",
                    data: {
                        id: id
                    },
                    success: function(data) {
                        console.log(data);
                        $('#ModalaAdd').modal('show');
                        $('[name="id"]').val(data[0].idSiswa);
                        $('[name="nama"]').val(data[0].namaUser);
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

    <script>
        var counter = 1;

        function loadnew() {
            var newrow = $(".view-this");
            var cols = "";
            cols += '<div class="form-group row">';
            cols += '<div class="col-lg-4">';
            cols += '<input type="hidden" name="counter[]" value="' + counter + '">';
            cols += '<select name="eks'+counter+'" id="eks" class="form-control">';
            cols += '<option value="-">Pilih</option>';
            cols += '<option value="OSIS">OSIS</option>';
            cols += '<option value="ROHIS">ROHIS</option>';
            cols += '<option value="Basket">Basket</option>';
            cols += '<OPtion value="Futsal">Futsal</OPtion>';
            cols += '<option value="Voli">Voli</option>';
            cols += '<option value="Tari Saman">Tari Saman</option>';
            cols += '<option value="Paskibra">Paskibra</option>';
            cols += '<option value="Pramuka">Pramuka</option>';
            cols += '</select>';
            cols += '</div>';
            cols += '<div class="col-lg-2">';
            cols += '<div class="kt-input-icon">';
            cols += '<select name="predikat' + counter + '" id="predikat" class="form-control">';
            cols += '<option value="-">Pilih</option>';
            cols += '<option value="A">A</option>';
            cols += '<option value="B">B</option>';
            cols += '<option value="C">C</option>';
            cols += '</select>';
            cols += '</div>';
            cols += '</div>';
            cols += '<div class="col-lg-6">';
            cols += '<div class="kt-input-icon">';
            cols += '<input type="text" name="ket' + counter + '" id="ket" class="form-control">';
            cols += '</div>';
            cols += '</div>';
            cols += '</div>';
            newrow.append(cols);
            $("form-group row").append(newrow);
            counter++;
            document.getElementById("counter").value = counter;
        }
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