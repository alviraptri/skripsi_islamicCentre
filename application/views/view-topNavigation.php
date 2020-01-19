<html>
<div class="top_nav">
          <div class="nav_menu">
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>
              <nav class="nav navbar-nav">
              <ul class=" navbar-right">
                <li class="nav-item dropdown open" style="padding-left: 15px;">
                  <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                  <?php $rows = $this->db->query('SELECT * FROM user where nomorInduk="'.$this->session->nomorInduk.'"')->row_array(); ?>
                    <img src="<?php echo base_url(); ?>assets/inter/images/profil/<?php echo $rows['gambar'] ?>" alt=""><?php echo $this->session->namaUser; ?>
                  </a>
                  <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item"  href="<?php echo base_url('c_admin/profil'); ?>"> Profil Saya</a>
                    <a class="dropdown-item"  href="<?php echo base_url('c_admin/gantiPass'); ?>"> Ubah Kata Sandi</a>
                    <a class="dropdown-item"  href="<?php echo base_url('c_login/keluarAdmin'); ?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                  </div>
                </li>
              </ul>
            </nav>
          </div>
        </div>

</html>