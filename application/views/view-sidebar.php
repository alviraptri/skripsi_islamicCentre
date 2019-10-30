<html>
<div class="left_col scroll-view">
  <div class="navbar nav_title" style="border: 0;">
    <a href="<?php echo base_url('c_admin/index'); ?>" class="site_title"><span style="font-size:18px">SMA ISLAMIC CENTRE</span></a>
  </div>

  <div class="clearfix"></div>

  <!-- menu profile quick info -->
  <div class="profile clearfix">
    <div class="profile_pic">
      <?php $rows = $this->db->query("SELECT * FROM user where nomorInduk='" . $this->session->nomorInduk . "'")->row_array(); ?>
      <img src="<?php echo base_url(); ?>assets/inter/images/profil/<?php echo $rows['gambar'] ?>" alt="..." class="img-circle profile_img">
    </div>
    <div class="profile_info">
      <span>Selamat Datang,</span>
      <h2><?php echo $this->session->namaUser; ?></h2>
    </div>
  </div>
  <!-- /menu profile quick info -->

  <br />

  <!-- sidebar menu -->
  <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
      <ul class="nav side-menu">
        <li><a href="<?php echo base_url('c_admin/index'); ?>"><i class="fa fa-home"></i> Beranda</a></li>
        <li><a><i class="fa fa-user"></i> Guru <span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            <li><a href="<?php echo base_url('c_admin/guru'); ?>">Data Guru</a></li>
            <li><a href="<?php echo base_url('c_admin/tambahGuru'); ?>">Tambah Guru</a></li>
          </ul>
        </li>
        <li><a><i class="fa fa-graduation-cap"></i> Siswa <span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            <li><a href="<?php echo base_url('c_admin/siswa'); ?>">Data Siswa</a></li>
            <li><a href="<?php echo base_url('c_admin/tambahSiswa'); ?>">Tambah Siswa</a></li>
          </ul>
        </li>
        <li><a><i class=" fa fa-bookmark-o"></i> Mata Pelajaran <span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            <li><a href="<?php echo base_url('c_admin/mapel'); ?>">Data Mata Pelajaran</a></li>
            <li><a href="<?php echo base_url('c_admin/tambahMapel'); ?>">Tambah Mata Pelajaran</a></li>
          </ul>
        </li>
        <li><a><i class="fa fa-calendar"></i> Jadwal <span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            <li><a href="<?php echo base_url('c_admin/jadwal'); ?>">Data Jadwal</a></li>
            <li><a href="<?php echo base_url('c_admin/tambahJadwal'); ?>">Tambah Jadwal</a></li>
          </ul>
        </li>
        <li><a><i class="fa fa-list-alt"></i> Tahun Ajaran <span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            <li><a href="<a href="">Data Tahun Ajaran</a></li>
            <li><a href=" <a href="">Tambah Tahun Ajaran</a></li>
          </ul>
        </li>
        <li><a><i class="fa fa-institution"></i> Kelas <span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            <li><a href="<?php echo base_url('c_admin/kelas'); ?>">Data Kelas</a></li>
            <li><a href="<?php echo base_url('c_admin/tambahKelas'); ?>">Tambah Kelas</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
  <!-- /sidebar menu -->
</div>

</html>