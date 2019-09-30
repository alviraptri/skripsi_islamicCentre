<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!doctype html>
<html class="no-js" lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Information Academic Islamic Centre | Login</title>

  <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>assets/admin/img/favicon.ico">

  <!-- Font Icon -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/login/fonts/material-icon/css/material-design-iconic-font.min.css">

  <!-- Main css -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/login/css/style.css">
</head>

<body>

  <div class="main">

    <!-- Sign up form -->
    <section class="signup">
      <div class="container">
        <div class="signup-content">
          <div class="signup-form">
            <h2 class="form-title">Welcome,<br> Information Academic Islamic Centre</h2>
            <form method="post" class="register-form" action="<?php echo base_url('c_login/login');?>">
              <div class="form-group">
                <label for="uname"><i class="zmdi zmdi-account material-icons-name"></i></label>
                <input type="text" name="uname" placeholder="Uname" />
              </div>
              <div class="form-group">
                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                <input type="password" name="pass" placeholder="Password" />
              </div>
              <div class="form-group form-button">
                <button type="submit" class="form-submit"> Login</button>
              </div>
            </form>
          </div>
          <div class="signup-image">
            <figure><img src="<?php echo base_url(); ?>assets/login/images/logo.jpg" alt="sing up image"></figure>
            <a href="<?php echo base_url('c_login/admin');?>" class="signup-image-link">login as admin</a>
          </div>
        </div>
      </div>
    </section>

  </div>

  <!-- JS -->
  <script src="<?php echo base_url(); ?>assets/login/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/login/js/main.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>