<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Jadwal Ujian | Information Academic Islamic Centre</title>

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
                            <h3>Jadwal Ujian</h3>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Tambah Jadwal Ujian</h2>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">

                                    <form class="form-horizontal form-label-left" method="post" id="form" action="<?php echo base_url() . 'c_admin/simpanJadwalUjian'; ?>" novalidate>

                                        <div class="item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="nama">Tahun Ajaran<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6">
                                                <select name="tahunAjaran" id="tahunAjaran" class="select2_single form-control">
                                                    <option value=""> Pilih Tahun Ajaran </option>
                                                    <?php
                                                    foreach ($ta as $list) { ?>
                                                        <option value="<?php echo $list->idTahunAjaran ?>"> <?php echo $list->tahunAjaran ?> </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <table id="datatable-fixed-header dynamic_field" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Hari</th>
                                                    <th>Tanggal</th>
                                                    <th>Jam Mulai</th>
                                                    <th>Jam Selesai</th>
                                                    <th>Mata Pelajaran</th>
                                                    <th></th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <select name="hari" id="hari" required="required" class="form-control">
                                                            <option value="">Pilih Hari</option>
                                                            <option value="Senin"> Senin</option>
                                                            <option value="Selasa">Selasa</option>
                                                            <option value="Rabu">Rabu</option>
                                                            <option value="Kamis">Kamis</option>
                                                            <option value="Jum'at">Jum'at</option>
                                                            <option value="Sabtu">Sabtu</option>
                                                        </select>
                                                    </td>
                                                    <td><input type="date" id="tgl" name="tgl" required="required" class="form-control"></td>
                                                    <td><input type="time" id="jm" name="jamMulai" required="required" class="form-control"></td>
                                                    <td><input type="time" id="js" name="jamSelesai" required="required" class="form-control"></td>
                                                    <td>
                                                        <select name="mapel" id="mapel" required="required" class="form-control">
                                                            <option value="">Pilih Mapel</option>
                                                            <?php
                                                            foreach ($mapel as $list) { ?>
                                                                <option value="<?php echo $list->idMapel ?>"><?php echo $list->namaMapel ?> </option>
                                                            <?php } ?>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <button data-toggle="tooltip" onclick="loadnew()" title="Tambah" name="tambah" id="tambah" class="btn btn-info btn-xs">
                                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                                        </button>
                                                    </td>
                                                </tr>
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

            <!-- footer content -->
            <footer>
                <?php include("v-Footer.php") ?>
            </footer>
            <!-- /footer content -->
        </div>
    </div>


    <script src="<?php echo base_url(); ?>assets/jquery.min.js" type="text/javascript"></script>
    <script>
        var counter = 1;

        function loadnew() {
            var newrow = $("<tr>");
            var cols = "";

            cols += '<td>';
            cols += '<select name="hari' + counter + '" id="hari" required="required" class="form-control">';
            cols += '<option value="">Pilih Hari</option>';
            cols += '<option value="Senin"> Senin</option>';
            cols += '<option value="Selasa">Selasa</option>';
            cols += '<option value="Rabu">Rabu</option>';
            cols += '<option value="Kamis">Kamis</option>';
            cols += '<option value="Jumat">Jumat</option>';
            cols += '<option value="Sabtu">Sabtu</option>';
            cols += '</select>';
            cols += '</td>';
            cols += '<td><input type="date" id="tgl" name="tgl' + counter + '" required="required" class="form-control"></td>';
            cols += '<td><input type="time" id="jm" name="jamMulai' + counter + '" required="required" class="form-control"></td>';
            cols += '<td><input type="time" id="js" name="jamSelesai' + counter + '" required="required" class="form-control"></td>';
            cols += '<td><select name="mapel' + counter + '" id="mapel" required="required" class="form-control">';
            cols += '<option value="">Pilih Mapel</option>'; 
            cols += '<?php foreach($mapel as $list){?>';
            cols += '<option value="<?= $list->idMapel?>"><?= $list->namaMapel?> </option>';
            cols += '<?php } ?>';
            cols += '</select></td>';
            cols += '<td><button data-toggle="tooltip" title="Tambah" name="tambah" id="tambah" class="btn btn-info btn-xs"><i class="fa fa-plus" aria-hidden="true"></i></button></td>';

            newrow.append(cols);
            $("table.table-striped.table-bordered").append(newrow);
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