<!-- modal -->
<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="bs-example-modal-sm<?php echo $idJadwal; ?>">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Jadwal Kelas <?php echo $ketKelas ?> <?php echo $jurusanKelas ?> <?php echo $nomorKelas ?></h4>
      </div>
      <div class="modal-body">
        <table width="100%" class="table table-striped dt-responsive nowrap">
          <tr>
            <td>Hari: <?php echo $hari ?></td>  
            <td>Mata Pelajaran: <?php echo $namaMapel ?></td>
          </tr>
          <tr>
            <td>Jam: <?php echo $jamMulai ?> - <?php echo $jamSelesai ?></td>
            <td>Guru: <?php echo $namaUser ?></td>
          </tr>
          <tr>
            <td>Durasi: </td>
            <td>Tahun Ajaran: <?php echo $tahunAjaran ?></td>
          </tr>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>