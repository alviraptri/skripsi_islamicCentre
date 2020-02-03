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

  <?php
  if ($this->session->userRole == 'Wali Kelas') { ?>
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
      <div class="menu_section">
        <ul class="nav side-menu">
          <li><a href="<?php echo base_url('c_admin/index'); ?>"><i class="fa fa-home"></i> Beranda</a></li>
          <li><a><i class="fa fa-graduation-cap"></i> Siswa <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="<?php echo base_url('c_admin/siswa'); ?>">Data Siswa</a></li>
              <li><a href="<?php echo base_url('c_admin/waliMurid'); ?>">Data Wali Murid</a></li>
            </ul>
          </li>
          <li><a><i class="fa fa-calendar"></i> Jadwal <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="<?php echo base_url('c_admin/jadwal'); ?>">Data Jadwal</a></li>
            </ul>
          </li>
          <li><a><i class="fa fa-check-square-o"></i> Absensi <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="<?php echo base_url('c_admin/absensi'); ?>">Data Absensi</a></li>
              <li><a href="<?php echo base_url('c_admin/tambahAbsensi'); ?>">Tambah Absensi</a></li>
            </ul>
          </li>
          <li><a><i class="fa fa-calendar-o"></i> Jadwal Ujian <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="<?php echo base_url('c_admin/jadwalUjianSiswa'); ?>">Jadwal Ujian Siswa</a></li>
              <li><a href="<?php echo base_url('c_admin/jadwalNgawas'); ?>">Jadwal Mengawas Guru</a></li>
            </ul>
          </li>
          <li><a><i class="fa fa-book"></i> Buku Nilai Guru<span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="<?php echo base_url('c_admin/dataBukuNilai'); ?>">Data Buku Nilai</a></li>
              <li><a href="<?php echo base_url('c_admin/tambahBukuNilai'); ?>">Tambah Nilai</a></li>
            </ul>
          </li>
          <li><a><i class="fa fa-file-text"></i> Pengembangan Diri<span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="<?php echo base_url('c_admin/dataPengembanganDiri'); ?>">Data Pengembangan Diri</a></li>
              <li><a href="<?php echo base_url('c_admin/catatanWaliKelas'); ?>">Catatan Wali Kelas</a></li>
              <li><a href="<?php echo base_url('c_admin/ekstrak'); ?>">Ekstrakurikuler</a></li>
              <li><a href="<?php echo base_url('c_admin/tambahPengembanganDiri'); ?>">Tambah Pengembangan Diri</a></li>
            </ul>
          </li>
          <li><a><i class="fa fa-bar-chart"></i> Rekomendasi <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="#">Data Rekomendasi Siswa</a></li>
              <li><a href="#">Data Rekomendasi Jurusan Kuliah</a></li>
            </ul>
          </li>
          <li><a><i class="fa fa-clipboard"></i> Rapor <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="<?php echo base_url('c_admin/dataRapor'); ?>">Data Rapor</a></li>
              <li><a href="<?php echo base_url('c_admin/templateRapor'); ?>">Template Rapor</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  <?php } elseif ($this->session->userRole == 'Guru') { ?>
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
      <div class="menu_section">
        <ul class="nav side-menu">
          <li><a href="<?php echo base_url('c_admin/index'); ?>"><i class="fa fa-home"></i> Beranda</a></li>
          <li><a><i class="fa fa-graduation-cap"></i> Siswa <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="<?php echo base_url('c_admin/siswa'); ?>">Data Siswa</a></li>
              <li><a href="<?php echo base_url('c_admin/waliMurid'); ?>">Data Wali Murid</a></li>
            </ul>
          </li>
          <li><a><i class="fa fa-calendar"></i> Jadwal <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="<?php echo base_url('c_admin/jadwal'); ?>">Data Jadwal</a></li>
            </ul>
          </li>
          <li><a><i class="fa fa-check-square-o"></i> Absensi <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="<?php echo base_url('c_admin/absensi'); ?>">Data Absensi</a></li>
              <li><a href="<?php echo base_url('c_admin/tambahAbsensi'); ?>">Tambah Absensi</a></li>
            </ul>
          </li>
          <li><a><i class="fa fa-calendar-o"></i> Jadwal Ujian <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="<?php echo base_url('c_admin/jadwalUjianSiswa'); ?>">Jadwal Ujian Siswa</a></li>
              <li><a href="<?php echo base_url('c_admin/jadwalNgawas'); ?>">Jadwal Mengawas Guru</a></li>
            </ul>
          </li>
          <li><a><i class="fa fa-book"></i> Buku Nilai Guru<span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="<?php echo base_url('c_admin/dataBukuNilai'); ?>">Data Buku Nilai</a></li>
              <li><a href="<?php echo base_url('c_admin/tambahBukuNilai'); ?>">Tambah Nilai</a></li>
            </ul>
          </li>
          <li><a><i class="fa fa-bar-chart"></i> Rekomendasi <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="#">Data Rekomendasi Siswa</a></li>
              <li><a href="#">Data Rekomendasi Jurusan Kuliah</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  <?php } elseif ($this->session->userRole == 'Siswa') { ?>
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
      <div class="menu_section">
        <ul class="nav side-menu">
          <li><a href="<?php echo base_url('c_admin/index'); ?>"><i class="fa fa-home"></i> Beranda</a></li>
          <li><a><i class="fa fa-calendar"></i> Jadwal <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="<?php echo base_url('c_admin/jadwal'); ?>">Data Jadwal</a></li>
            </ul>
          </li>
          <li><a><i class="fa fa-calendar-o"></i> Jadwal Ujian <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="<?php echo base_url('c_admin/jadwalUjianSiswa'); ?>">Jadwal Ujian Siswa</a></li>
              <li><a href="<?php echo base_url('c_admin/jadwalNgawas'); ?>">Jadwal Mengawas Guru</a></li>
            </ul>
          </li>
          <li><a><i class="fa fa-bar-chart"></i> Rekomendasi <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="#">Data Rekomendasi Siswa</a></li>
              <li><a href="#">Data Rekomendasi Jurusan Kuliah</a></li>
            </ul>
          </li>
          <li><a><i class="fa fa-clipboard"></i> Rapor <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="<?php echo base_url('c_admin/dataRapor'); ?>">Data Rapor</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  <?php } elseif ($this->session->userRole == 'Wali Murid') { ?>
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
      <div class="menu_section">
        <ul class="nav side-menu">
          <li><a href="<?php echo base_url('c_admin/index'); ?>"><i class="fa fa-home"></i> Beranda</a></li>
          <li><a><i class="fa fa-calendar"></i> Jadwal <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="<?php echo base_url('c_admin/jadwal'); ?>">Data Jadwal</a></li>
            </ul>
          </li>
          <li><a><i class="fa fa-calendar-o"></i> Jadwal Ujian <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="<?php echo base_url('c_admin/jadwalUjianSiswa'); ?>">Jadwal Ujian Siswa</a></li>
              <li><a href="<?php echo base_url('c_admin/jadwalNgawas'); ?>">Jadwal Mengawas Guru</a></li>
            </ul>
          </li>
          <li><a><i class="fa fa-bar-chart"></i> Rekomendasi <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="#">Data Rekomendasi Siswa</a></li>
              <li><a href="#">Data Rekomendasi Jurusan Kuliah</a></li>
            </ul>
          </li>
          <li><a><i class="fa fa-clipboard"></i> Rapor <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="<?php echo base_url('c_admin/dataRapor'); ?>">Data Rapor</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  <?php } else { ?>
    <!-- sidebar menu -->
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
      <div class="menu_section">
        <ul class="nav side-menu">
          <li><a href="<?php echo base_url('c_admin/index'); ?>"><i class="fa fa-home"></i> Beranda</a></li>
          <li><a><i class="fa fa-user"></i> Pegawai <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="<?php echo base_url('c_admin/admin'); ?>">Data Admin</a></li>
              <li><a href="<?php echo base_url('c_admin/guru'); ?>">Data Guru</a></li>
              <li><a href="<?php echo base_url('c_admin/waliKelas'); ?>">Data Wali Kelas</a></li>
              <li><a href="<?php echo base_url('c_admin/tugasGuru'); ?>">Tugas Guru</a></li>
              <li><a href="<?php echo base_url('c_admin/tambahPegawai'); ?>">Tambah Pegawai</a></li>
            </ul>
          </li>
          <li><a><i class="fa fa-graduation-cap"></i> Siswa <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="<?php echo base_url('c_admin/siswa'); ?>">Data Siswa</a></li>
              <!-- <li><a href="<?php echo base_url('c_admin/waliMurid'); ?>">Data Wali Murid</a></li> -->
              <li><a href="<?php echo base_url('c_admin/tambahSiswa'); ?>">Tambah Siswa</a></li>
            </ul>
          </li>
          <li><a><i class="fa fa-list-alt"></i> Tahun Ajaran <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="<?php echo base_url('c_admin/tahunAjaran'); ?>">Data Tahun Ajaran</a></li>
              <li><a href="<?php echo base_url('c_admin/tambahThnAjaran'); ?>">Tambah Tahun Ajaran</a></li>
            </ul>
          </li>
          <li><a><i class="fa fa-institution"></i> Kelas <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="<?php echo base_url('c_admin/kelas'); ?>">Data Kelas</a></li>
              <li><a href="<?php echo base_url('c_admin/tambahKelas'); ?>">Tambah Kelas</a></li>
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
              <li><a href="<?php echo base_url('c_admin/lihatJadwal'); ?>">Lihat Jadwal Siswa</a></li>
              <li><a href="<?php echo base_url('c_admin/tambahJadwal'); ?>">Tambah Jadwal</a></li>
            </ul>
          </li>
          <li><a><i class="fa fa-info-circle"></i> Informasi SPP <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="<?php echo base_url('c_admin/info'); ?>">Data Informasi</a></li>
              <li><a href="<?php echo base_url('c_admin/tambahInfo'); ?>">Tambah Informasi</a></li>
            </ul>
          </li>
          <li><a><i class="fa fa-columns"></i> Keterangan Nilai <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="<?php echo base_url('c_admin/ketNilai'); ?>">Data Keterangan Nilai</a></li>
              <li><a href="<?php echo base_url('c_admin/tambahKetNilai'); ?>">Tambah Keterangan Nilai</a></li>
            </ul>
          </li>
          <li><a><i class="fa fa-check-square-o"></i> Absensi <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="<?php echo base_url('c_admin/absensi'); ?>">Data Absensi</a></li>
              <li><a href="<?php echo base_url('c_admin/tambahAbsensi'); ?>">Tambah Absensi</a></li>
            </ul>
          </li>
          <li><a><i class="fa fa-calendar-o"></i> Jadwal Ujian <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <!-- <li><a href="<?php echo base_url('c_admin/jadwalUjianSiswa'); ?>">Jadwal Ujian Siswa</a></li> -->
              <li><a href="<?php echo base_url('c_admin/jadwalNgawas'); ?>">Jadwal Mengawas Guru</a></li>
              <li><a href="<?php echo base_url('c_admin/jadwalUjian'); ?>">Data Jadwal Ujian</a></li>
              <li><a href="<?php echo base_url('c_admin/tambahJadwalUjian'); ?>">Tambah Jadwal Ujian</a></li>
            </ul>
          </li>
          <li><a><i class="fa fa-book"></i> Buku Nilai Guru<span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="<?php echo base_url('c_admin/dataBukuNilai'); ?>">Data Buku Nilai</a></li>
              <li><a href="<?php echo base_url('c_admin/tambahBukuNilai'); ?>">Tambah Nilai</a></li>
            </ul>
          </li>
          <li><a><i class="fa fa-file-text"></i> Pengembangan Diri<span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="<?php echo base_url('c_admin/dataPengembanganDiri'); ?>">Data Pengembangan Diri</a></li>
              <li><a href="<?php echo base_url('c_admin/catatanWaliKelas'); ?>">Catatan Wali Kelas</a></li>
              <li><a href="<?php echo base_url('c_admin/ekstrak'); ?>">Ekstrakurikuler</a></li>
              <li><a href="<?php echo base_url('c_admin/tambahPengembanganDiri'); ?>">Tambah Pengembangan Diri</a></li>
            </ul>
          </li>
          <li><a><i class="fa fa-bar-chart"></i> Rekomendasi <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="<?php echo base_url('c_rekomendasi/index'); ?>">Penjelasan</a></li>
              <li><a href="<?php echo base_url('c_rekomendasi/kriteria'); ?>">Kriteria</a></li>
              <li><a href="<?php echo base_url('c_rekomendasi/alternatif'); ?>">Alternatif</a></li>
              <li><a href="<?php echo base_url('c_rekomendasi/lihatSiswa'); ?>">Nama Siswa</a></li>
              <li><a href="<?php echo base_url('c_rekomendasi/hasilAkhir/').$this->session->userdata('siswa'); ?>">Hasil Akhir</a></li>
            </ul>
          </li>
          <li><a><i class="fa fa-clipboard"></i> Rapor <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="<?php echo base_url('c_admin/dataRapor'); ?>">Data Rapor</a></li>
              <li><a href="<?php echo base_url('c_admin/templateRapor'); ?>">Template Rapor</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
    <!-- /sidebar menu -->

  <?php }
  ?>


</div>