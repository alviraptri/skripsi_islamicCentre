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
                                    <h2>Hasil Rekomendasi</h2>

                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <h5>Hasil Perhitungan</h5>
                                    <table id="datatable-fixed-header" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Overall Composite Height</th>
                                                <th>Priority Vector (rata-rata)</th>
                                                <?php
                                                foreach ($alt as $alternatif) {
                                                    $namaAlt = $alternatif->namaAlternatif;
                                                    $idAlt[] = $alternatif->idAlternatif;
                                                // }
			                                    // for ($i=0; $i <= ($jA-1); $i++) {?> 
				                                <th><?= $namaAlt?></th>
			                                    <?php }
			                                    ?>
                                            </tr>
                                        </thead>
                                        <tbody name="show_data" id="show_data">
                                        <?php
                                            foreach ($krit as $list) {
                                                $namaKrit = $list->jenisKriteria;
                                                $idKrit[] = $list->idKriteria;
                                            }
                                            foreach ($kriteriaPV as $kritPV) {
                                                $PvKrit = $kritPV->nilaiPvKrit;
                                            
                                            for ($x=0; $x <= ($jK-1) ; $x++) { ?>
                                                <tr>
                                                <td><?= $namaKrit[$x]?></td>
                                                <td><?= round($PvKrit[$idKrit[$x]],5) ?></td>

                                                <?php 
                                                
                                                foreach ($alternatifPV as $altPV) {
                                                    $PvAlt = $altPV->nilaiHA;
                                                
                                                for ($y=0; $y <= ($jA-1); $y++) { ?>
                                                    <td><?= round($PvAlt($idAlt[$y],$idKrit[$x]),5)?></td>
                                                <?php } } }?>


                                                </tr>
                                            <?php }
                                        ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="2"><b>Total</b></td>
                                                <?php
                                                for ($i=0; $i <= ($jA-1); $i++) {?> 
                                                    <th><?= round($nilai[$i],5)?></th>
                                                <?php }
                                                ?>
                                            </tr>
                                        </tfoot>
                                    </table>

                                    <br>
                                    <h5>Perangkingan</h5>
                                    <table id="datatable-fixed-header" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Peringkat</th>
                                                <th>Alternatif</th>
                                                <th>Nilai</th>
                                            </tr>
                                        </thead>
                                        <tbody name="show_data" id="show_data">
                                            <tr>
                                            <?php
                                                $i = 0;
                                                foreach ($rank as $hasil) {
                                                    $nilai = $hasil->hasilAkhir;
                                                    $nama = $hasil->namaAlternatif;
                                                ?>
                                                <tr>
                                                    <?php if ($i == 1) {
                                                        echo "<td><div class=\"ui ribbon label\">Pertama</div></td>";
                                                    } else {
                                                        echo "<td>".$i."</td>";
                                                    }

                                                    ?>

                                                    <td><?php echo $nama ?></td>
                                                    <td><?php echo $nilai ?></td>
                                                </tr>

                                                <?php	
                                                $i++;
                                                }


                                            ?>
                                            </tr>
                                        </tbody>
                                    </table>
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

    <script type="text/javascript">
        function minus() {
            $.ajax({
                url : "<?php echo base_url().'c_rekomendasi/minusKriteria' ?>",
                method : 'POST',
                dataType : 'JSON',
                success : function(data) {
                    window.location.href = "<?php echo base_url().'c_rekomendasi/perbandinganAlternatif/'.$this->session->userdata('siswa'); ?>";
                }
            })
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