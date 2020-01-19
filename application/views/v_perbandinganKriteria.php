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
                            <h3>Rekomendasi</h3>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Perbandingan Kriteria</h2>

                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                <form class="form-horizontal form-label-left" method="post" action="<?php echo base_url() . 'c_rekomendasi/simpanPerbandingan'; ?>" novalidate>
                                    <table id="datatable-fixed-header" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Kriteria Pertama</th>
                                                <th>Perbandingan</th>
                                                <th>Kriteria Kedua</th>
                                            </tr>
                                        </thead>

                                        <tbody name="show_data" id="show_data">
                                            <?php 
                                            foreach ($krit as $list) {
                                                $id[] = $list->idKriteria;
                                                $jenis[] = $list->jenisKriteria;
                                            }

                                            $urut = 0;
                                            for ($i=0; $i <=($jmlh- 2) ; $i++) { 
                                                for ($j=($i+1); $j <= ($jmlh - 1) ; $j++) { 
                                                    $urut++; ?>
                                                    <tr>
                                                    <td>
                                                        <input type="text" name="idK1<?php echo $urut?>" value="<?= $id[$i]?>" hidden> <?= $jenis[$i]?>
                                                        <!-- <input name="pilih<?php echo $urut?>" value="1" checked="" class="hidden" type="radio">
							                            <label><?php echo $jenis[$i]; ?></label> -->
                                                    </td>
                                                    <td>
                                                        <select name="bobot<?php echo $urut?>" id="bobot" class="form-control">
                                                            <option value="">-----------------------------------------------------------------</option>
                                                            <option value="1">1 - Sama pentingnya (Equal importence)</option>
                                                            <option value="2">2 - Sama hingga sedikit lebih penting</option>
                                                            <option value="3">3 - Sedikit lebih penting (Slightly more importence)</option>
                                                            <option value="4">4 - Sedikit lebih hingga jelas lebih penting</option>
                                                            <option value="5">5 - Jelas lebih penting ( Materially more importence )</option>
                                                            <option value="6">6 - Jelas hingga sangat jelas lebih penting</option>
                                                            <option value="7">7 - Sangat jelas lebih penting ( Significantly more importence )</option>
                                                            <option value="8">8 - Sangat jelas hingga mutlak lebih penting</option>
                                                            <option value="9">9 - Mutlak lebih penting ( Absolutely more importence )</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="idK2<?php echo $urut?>" value="<?= $id[$j]?>" hidden> <?= $jenis[$j]?>
                                                        <!-- <input name="pilih<?php echo $urut?>" value="1" checked="" class="hidden" type="radio">
							                            <label><?php echo $jenis[$j]; ?></label> -->
                                                    </td>
                                                </tr>
                                            <?php }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                    <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <div class="col-md-6 offset-md-3">
                                                <button id="send" type="submit" class="btn btn-success">Simpan</button>
                                                <a href="<?php echo base_url('c_admin/index'); ?>"><button type="submit" class="btn btn-primary">Batal</button></a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /page content -->

            <!-- MODAL ADD -->
            <div class="modal fade" id="ModalaAdd" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title" id="myModalLabel">Tambah Kriteria</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <form class="form-horizontal form-label-left">
                            <div class="modal-body">
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Nama Kriteria</label>
                                    <div class="col-md-6 col-sm-6">
                                        <input name="nama" id="nama" class="form-control" type="text" placeholder="Nama Kriteria">
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
                var nama = $('#nama').val();
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('c_rekomendasi/simpanKriteria') ?>",
                    dataType: "JSON",
                    data: {
                        nama: nama
                    },
                    success: function(data) {
                        $('[name="nama"]').val(" ");
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