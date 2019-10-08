<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Information Academic Islamic Centre | Login Admin</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- favicon
		============================================ -->
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>assets/admin/img/favicon.ico">
    <!-- Google Fonts
		============================================ -->
    <link href="https://fonts.googleapis.com/css?family=Play:400,700" rel="stylesheet">
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/bootstrap.min.css">
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/font-awesome.min.css">
    <!-- owl.carousel CSS
		============================================ -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/owl.carousel.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/owl.theme.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/owl.transitions.css">
    <!-- animate CSS
		============================================ -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/animate.css">
    <!-- normalize CSS
		============================================ -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/normalize.css">
    <!-- main CSS
		============================================ -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/main.css">
    <!-- morrisjs CSS
		============================================ -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/morrisjs/morris.css">
    <!-- mCustomScrollbar CSS
		============================================ -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/scrollbar/jquery.mCustomScrollbar.min.css">
    <!-- metisMenu CSS
		============================================ -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/metisMenu/metisMenu.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/metisMenu/metisMenu-vertical.css">
    <!-- calendar CSS
		============================================ -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/calendar/fullcalendar.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/calendar/fullcalendar.print.min.css">
    <!-- forms CSS
		============================================ -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/form/all-type-forms.css">
    <!-- style CSS
		============================================ -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/style.css">
    <!-- responsive CSS
		============================================ -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/responsive.css">
    <!-- modernizr JS
		============================================ -->
    <script src="<?php echo base_url(); ?>assets/admin/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
    <!--[if lt IE 8]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->
    <div class="error-pagewrap">
        <div class="error-page-int">
            <div class="text-center m-b-md custom-login">
                <h3>WELCOME</h3>
                <p>Information Academic Islamic Centre</p>
            </div>
            <div class="content-error">
                <div class="hpanel">
                    <div class="panel-body">
                        <form action="<?php echo base_url('c_login/staffLogin');?>" id="loginForm" method="post">
                            <div class="form-group">
                                <label class="control-label" for="username">Uname</label>
                                <input type="text" name="username" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="password">Password</label>
                                <input type="password" name="password" class="form-control">
                            </div>
                            <button class="btn btn-success btn-block loginbtn" type="submit">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- jquery
		============================================ -->
    <script src="<?php echo base_url(); ?>assets/admin/js/vendor/jquery-1.12.4.min.js"></script>
    <!-- bootstrap JS
		============================================ -->
    <script src="<?php echo base_url(); ?>assets/admin/js/bootstrap.min.js"></script>
    <!-- wow JS
		============================================ -->
    <script src="<?php echo base_url(); ?>assets/admin/js/wow.min.js"></script>
    <!-- price-slider JS
		============================================ -->
    <script src="<?php echo base_url(); ?>assets/admin/js/jquery-price-slider.js"></script>
    <!-- meanmenu JS
		============================================ -->
    <script src="<?php echo base_url(); ?>assets/admin/js/jquery.meanmenu.js"></script>
    <!-- owl.carousel JS
		============================================ -->
    <script src="<?php echo base_url(); ?>assets/admin/js/owl.carousel.min.js"></script>
    <!-- sticky JS
		============================================ -->
    <script src="<?php echo base_url(); ?>assets/admin/js/jquery.sticky.js"></script>
    <!-- scrollUp JS
		============================================ -->
    <script src="<?php echo base_url(); ?>assets/admin/js/jquery.scrollUp.min.js"></script>
    <!-- mCustomScrollbar JS
		============================================ -->
    <script src="<?php echo base_url(); ?>assets/admin/js/scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/admin/js/scrollbar/mCustomScrollbar-active.js"></script>
    <!-- metisMenu JS
		============================================ -->
    <script src="<?php echo base_url(); ?>assets/admin/js/metisMenu/metisMenu.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/admin/js/metisMenu/metisMenu-active.js"></script>
    <!-- tab JS
		============================================ -->
    <script src="<?php echo base_url(); ?>assets/admin/js/tab.js"></script>
    <!-- icheck JS
		============================================ -->
    <script src="<?php echo base_url(); ?>assets/admin/js/icheck/icheck.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/admin/js/icheck/icheck-active.js"></script>
    <!-- plugins JS
		============================================ -->
    <script src="<?php echo base_url(); ?>assets/admin/js/plugins.js"></script>
    <!-- main JS
		============================================ -->
    <script src="<?php echo base_url(); ?>assets/admin/js/main.js"></script>
    <!-- tawk chat JS
		============================================ 
    <script src="<?php echo base_url(); ?>assets/admin/js/tawk-chat.js"></script> -->
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>