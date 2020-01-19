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
                                    <h2>Hasil Perbandingan Kriteria</h2>

                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <h5>Matriks Perbandingan Berpasangan</h5>
                                    <table id="datatable-fixed-header" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Kriteria</th>
                                                <?php
                                                foreach ($krit as $list) {
                                                    $nama = $list->jenisKriteria;
                                                    // }
                                                    // for ($i = 0; $i <= ($jmlh - 1); $i++) { 
                                                ?>
                                                    <!-- <td><?php echo $nama[$i] ?></td> -->
                                                    <td><?php echo $nama ?></td>
                                                <?php }
                                                ?>
                                            </tr>
                                        </thead>
                                        <tbody name="show_data" id="show_data">
                                            <?php
                                            $counter = 0;
                                            foreach ($krit as $list) {
                                                $nama = $list->jenisKriteria;
                                                // }
                                            ?>
                                                <tr>

                                                    <td><?php echo $nama ?></td>
                                                    <?php
                                                    // for ($j = 0; $j <= ($jmlh - 1); $j++) {
                                                        for ($k = 0; $k <= ($jmlh - 1); $k++) { ?>
                                                            <td><?php echo round($matrik[$counter][$k], 5) ?></td>
                                                    <?php }
                                                    // }
                                                    ?>
                                                </tr>
                                            <?php 
                                            $counter++;
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td><b>Jumlah</b></td>
                                                <?php
                                                for ($i = 0; $i <= ($jmlh - 1); $i++) { ?>
                                                    <th><?php echo round($jmlmpb[$i], 5) ?></th>
                                                <?php }
                                                ?>
                                            </tr>
                                        </tfoot>
                                    </table>

                                    <br>
                                    <h5>Matriks Nilai Kriteria</h5>
                                    <table id="datatable-fixed-header" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Kriteria</th>
                                                <?php
                                                foreach ($krit as $list) {
                                                    $nama = $list->jenisKriteria;
                                                    // }
                                                    // for ($i = 0; $i <= ($jmlh - 1); $i++) { 
                                                ?>
                                                    <th><?= $nama ?></th>
                                                <?php }
                                                ?>
                                                <th>Jumlah</th>
                                                <th>Priotiry Vector</th>
                                            </tr>
                                        </thead>
                                        <tbody name="show_data" id="show_data">
                                            <?php
                                            $counter = 0;
                                            foreach ($krit as $list) {
                                                $nama = $list->jenisKriteria;
                                                // }
                                                // for ($i = 0; $i <= ($jmlh - 1); $i++) { 
                                            ?>
                                                <tr>
                                                    <td><?php echo $nama ?></td>

                                                <?php 
                                                // for ($x = 0; $x <= ($jmlh - 1); $x++) {
                                                    for ($y = 0; $y <= ($jmlh - 1); $y++) { ?>
                                                        <td><?php echo round($matrikb[$counter][$y], 5) ?> </td>
                                                    <?php } ?>
                                                    <td><?php echo round($jmlmnk[$counter], 5) ?> </td>
                                                    <td><?php echo round($pv[$counter], 5) ?> </td>
                                            <?php //}
                                            $counter++;
                                            }
                                            ?>
                                            </tr>
                                            <tr>
                                                <td colspan="<?php echo ($jmlh + 2) ?>"><b>Principe Eigen Vector (λ maks)</b></td>
                                                <td><?php echo (round($eigenvektor, 5)) ?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="<?php echo ($jmlh + 2) ?>"><b>Consistency Index</b></td>
                                                <td><?php echo (round($consIndex, 5)) ?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="<?php echo ($jmlh + 2) ?>"><b>Consistency Ratio</b></td>
                                                <td><?php echo (round(($consRatio * 100), 2)) ?> %</td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <?php
                                    if ($consRatio > 0.1) { ?>
                                        <div class="ui icon red message">
                                            <i class="close icon"></i>
                                            <i class="warning circle icon"></i>
                                            <div class="content">
                                                <div class="header">
                                                    Nilai Consistency Ratio melebihi 10% !!!
                                                </div>
                                                <p>Mohon input kembali tabel perbandingan...</p>
                                            </div>
                                        </div>

                                        <br>

                                        <a href='javascript:history.back()'>
                                            <button class="ui left labeled icon button">
                                                <i class="left arrow icon"></i>
                                                Kembali
                                            </button>
                                        </a>
                                    <?php
                                    }
                                    ?>
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