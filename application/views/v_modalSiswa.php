<!-- modal -->
<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="bs-example-modal-sm<?php echo $nomorInduk; ?>">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Data Siswa</h4>
      </div>
      <div class="modal-body">
          <table width="100%" class="table table-striped dt-responsive nowrap">
              <tr>
                  <th colspan="2">Informasi Pribadi</th>
                  <th colspan="2">Foto Profil</th>
              </tr>
              <tr>
                  <td>Nama Lengkap</td>
                  <td><?php echo $namaUser ?></td>
                  <td rowspan="3"><img src="<?php echo base_url(); ?>assets/inter/images/<?php echo $gambar ?>" alt=""></td>
              </tr>
              <tr>
                  <td>Tanggal Lahir</td>
                  <td><?php echo $ttlUser ?></td>
              </tr>
              <tr>
                  <td>Jenis Kelamin</td>
                  <?php
          if ($jenisKelamin == 1) {?>
            <td><?php echo "Laki-Laki";?></td> 
          <?php } else { ?>
            <td><?php echo "Perempuan";?></td> 
            <?php }
          ?>
              </tr>
              <tr>
                  <td>Email</td>
                  <td><?php echo $emailUser ?></td>
                  <th colspan="2">Informasi Sekolah</th>
              </tr>
              <tr>
                  <td>Nomor Telepon</td>
                  <td><?php echo $noTelp ?></td>
                  <td>Kelas</td>
                  <td><?php echo $ketKelas?> <?php echo $jurusanKelas?></td>
              </tr>
              <tr>
                  <td>Alamat</td>
                  <td><?php echo $alamatUser ?></td>
                  <td>Tahun Ajaran</td>
                  <td><?php echo $tahunAjaran ?></td>
              </tr>
          </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>