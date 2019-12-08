<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Jadwal Ujian| Information Academic Islamic Centre</title>

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
                            <h3>Jadwal Ujian</h3>
                        </div>
                    </div>

                    <div class="clearfix"></div>

                    <div class="row">
                        <!-- button -->
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Data Jadwal Ujian</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li> <a href="<?php echo base_url('c_admin/tambahJadwalUjian'); ?>"><button type="submit" class="btn btn-primary">Tambah Jadwal</button></a>
                                        </li>
                                        <li id="edit"> 
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                
                                    <table id="datatable-buttons" class="table table-striped table-bordered" style="width:100%">
                                    <div class="item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Tahun Ajaran <span class="required">*</span>
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
                                        <thead>
                                            <tr>
                                                <th>Hari</th>
                                                <th>Jam</th>
                                                <th>Mata Pelajaran</th>
                                                <th>Jenis Mata Pelajaran</th>
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
            <div class="modal fade bs-example-modal-lg" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title" id="myModalLabel">Edit Jadwal Ujian</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <form class="form-horizontal form-label-left">
                            <div class="modal-body">
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">#</label>
                                    <div class="col-md-6 col-sm-6">
                                        <input name="id_edit" id="id_edit" class="form-control" type="text" placeholder="ID Jadwal" readonly>
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Tahun Ajaran</label>
                                    <div class="col-md-6 col-sm-6">
                                    <input name="thnA_edit" id="thnA_edit" class="form-control" type="text" placeholder="ID TA" hidden>
                                        <input name="ta_edit" id="ta_edit" class="form-control" type="text" placeholder="Tahun Ajaran" readonly>
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Hari</label>
                                    <div class="col-xs-9">
                                        <input name="hari_edit" id="hari_edit" class="form-control" type="text" placeholder="hari">
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Jam Mulai</label>
                                    <div class="col-xs-9">
                                        <input name="jamM_edit" id="jamM_edit" class="form-control" type="time" placeholder="Jam" required>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Jam Selesai</label>
                                    <div class="col-xs-9">
                                        <input name="jamS_edit" id="jamS_edit" class="form-control" type="time" placeholder="Jam" required>
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Mata Pelajaran</label>
                                    <div class="col-xs-9">
                                    <input name="idM_edit" id="idM_edit" class="form-control" type="text" placeholder="ID" hidden>
                                        <input name="mapel_edit" id="mapel_edit" class="form-control" type="text" placeholder="Mata Pelajaran" required>
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Jenis Mata Pelajaran</label>
                                    <div class="col-xs-9">
                                        <input name="jenis_edit" id="jenis_edit" class="form-control" type="text" placeholder="Jenis" readonly>
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
            //view data
            $('#tahunAjaran').change(function(){
                var idTA = $(this).val();
                $.ajax({
                    url: "<?php echo site_url('c_admin/getJadwalUjian'); ?>",
                    method: "POST",
                    data: {
                        idTA: idTA
                    },
                    async: true,
                    dataType: 'JSON',
                    success: function(data){
                        var html ='';
                        var i;
                        for(i = 0; i < data.jadwal.length; i++){
                            html += '<tr>'+
                            '<td> '+ data.jadwal[i].hari +' </td>'+
                            '<td> '+ data.jadwal[i].jamMulai+' - '+data.jadwal[i].jamSelesai+' </td>'+
                            '<td> '+data.jadwal[i].namaMapel+' </td>'+
                            '<td>'+data.jadwal[i].jenisMapel+'</td>'+
                            '<td><a href="javascript:;" class="btn btn-info btn-xs item_edit" data="' + data.jadwal[i].idJadwalUjian + '">' +
                                '<i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>'+
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
                    url: "<?php echo base_url('c_admin/editJadwalUjian') ?>",
                    dataType: "JSON",
                    data: {
                        id: id
                    },
                    success: function(data) {
                        $.each(data, function(idJadwalUjian, hari, jamMulai, jamSelesai, namaMapel, idMapel, tahunAjaran, idTahunAjaran, jenisMapel) {
                            $('#ModalEdit').modal('show');
                            $('[name="id_edit"]').val(data.idJadwalUjian);
                            $('[name="thnA_edit"]').val(data.idTahunAjaran);
                            $('[name="ta_edit"]').val(data.tahunAjaran);
                            $('[name="hari_edit"]').val(data.hari);
                            $('[name="jamM_edit"]').val(data.jamMulai);
                            $('[name="jamS_edit"]').val(data.jamSelesai);
                            $('[name="idM_edit"]').val(data.idMapel);
                            $('[name="mapel_edit"]').val(data.namaMapel);
                            $('[name="jenis_edit"]').val(data.jenisMapel);
                        });
                    }
                });
                return false;
            });

            //Update Barang
            $('#btn_update').on('click', function() {
                var id = $('#id_edit').val();
                var hari = $('#hari_edit').val();
                var jamMulai = $('#jamM_edit').val();
                var jamSelesai = $('#jamS_edit').val();
                var mapel = $('#idM_edit').val();
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('c_admin/updateJadwalUjian') ?>",
                    dataType: "JSON",
                    data: {
                        id: id,
                        hari: hari,
                        jamMulai: jamMulai,
                        jamSelesai: jamSelesai,
                        mapel: mapel,
                    },
                    success: function(data) {
                        $('[name="id_edit"]').val("");
                            $('[name="thnA_edit"]').val("");
                            $('[name="ta_edit"]').val("");
                            $('[name="hari_edit"]').val("");
                            $('[name="jamM_edit"]').val("");
                            $('[name="jamS_edit"]').val("");
                            $('[name="idM_edit"]').val("");
                            $('[name="mapel_edit"]').val("");
                            $('[name="jenis_edit"]').val("");
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