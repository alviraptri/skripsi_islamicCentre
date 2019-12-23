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

    <!-- Custom styling plus plugins -->
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
                            <h3>Rekomendasi Jurusan Kuliah Siswa</h3>
                        </div>
                    </div>

                    <div class="clearfix"></div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Rekomendasi menggunakan <i>Analitycal Hierarchy Process</i> (AHP)</small></h2>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">

                                    <div class="clearfix"></div>

                                    <div class="col-md-12">
                                        <p><i>Analytic Hierarchy Process</i> (AHP) merupakan suatu model pendukung keputusan yang dikembangkan oleh Thomas L. Saaty. Model pendukung
                                            keputusan ini akan menguraikan masalah multi faktor atau multi kriteria yang kompleks menjadi suatu hirarki. Hirarki didefinisikan sebagai suatu
                                            representasi dari sebuah permasalahan yang kompleks dalam suatu struktur multi level dimana level pertama adalah tujuan, yang diikuti level faktor,
                                            kriteria, sub kriteria, dan seterusnya ke bawah hingga level terakhir dari alternatif.</p>

                                        <p>Rekomendasi menggunakan AHP ini dapat membantu sekolah dan siswa/i untuk melihat jurusan mana yang sesuai dan diinginkan oleh siswa. Pada <i>
                                                User Interface</i> (UI) milik siswa, nanti siswa dapat memilih jurusan dan Universitas yang diinginkan, dan pihak sekolah akan membantu siswa
                                            untuk melihat hasil rekomendasi dari sistem yang sebelumnya telah di lakukan perhitungan oleh AHP</p>

                                        <h2><b> Tabel Tingkat Kepentingan menurut Saaty (1980) </b></h2>
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Nilai Numerik</th>
                                                    <th>Tingkat Kepentingan <i>Preference</i></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Sama pentingnya (<i>Equal importence</i>)</td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td> Sama hingga sedikit lebih penting </td>
                                                </tr>
                                                <tr>
                                                    <td> 3 </td>
                                                    <td> Sedikit lebih penting (<i>Slightly more importence</i>) </td>
                                                </tr>
                                                <tr>
                                                    <td> 4 </td>
                                                    <td> Sedikit lebih hingga jelas lebih penting </td>
                                                </tr>
                                                <tr>
                                                    <td> 5 </td>
                                                    <td> Jelas lebih penting (<i> Materially more importence </i>) </td>
                                                </tr>
                                                <tr>
                                                    <td> 6 </td>
                                                    <td> Jelas hingga sangat jelas lebih penting </td>
                                                </tr>
                                                <tr>
                                                    <td> 7 </td>
                                                    <td> Sangat jelas lebih penting (<i> Significantly more importence </i>) </td>
                                                </tr>
                                                <tr>
                                                    <td> 8 </td>
                                                    <td> Sangat jelas hingga mutlak lebih penting </td>
                                                </tr>
                                                <tr>
                                                    <td> 9 </td>
                                                    <td> Mutlak lebih penting (<i> Absolutely more importence </i>) </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
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

    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>assets/inter/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url(); ?>assets/inter/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url(); ?>assets/inter/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?php echo base_url(); ?>assets/inter/vendors/nprogress/nprogress.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url(); ?>assets/inter/build/js/custom.min.js"></script>
</body>

</html>