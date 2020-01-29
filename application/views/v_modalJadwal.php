<!-- modal -->
<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="bs-example-modal-sm<?php echo $idJadwal; ?>">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"><b>Jadwal Kelas <?= $ketKelas?> <?= $jurusanKelas?> <?= $nomorKelas?></b></h4>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <table width="100%" class="table table-striped dt-responsive nowrap">
          <tr>
            <th>Hari</th>
            <td><?php echo $hari ?></td>
            <th>Mata Pelajaran</th>
            <td><?= $namaMapel?></td>
          </tr>
          <tr>
            <th>Jam</th>
            <?php $mulai = date('H:i', strtotime($jamMulai));
            $selesai = date('H:i', strtotime($jamSelesai));?>
            <td><?php echo $mulai ?> - <?= $selesai?></td>
            <th>Guru</th>
            <td><?= $namaUser?></td>
          </tr>
          <tr>
            <th>Durasi</th>
            <?php 
            $awal = strtotime($jamMulai);
            $akhir = strtotime($jamSelesai);
            $diff = $akhir - $awal;
            $jam = floor($diff/(60*60));
            $menit = $diff - $jam*(60*60);?>
            <td><?= $jam ?> Jam <?= floor($menit/60)?> Menit</td>
            <th>Tahun Ajaran</th>
            <td><?= $tahunAjaran?></td>
          </tr>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>