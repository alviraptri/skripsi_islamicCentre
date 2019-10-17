<?php
foreach($detailSiswa as $detail){?>
    <table class="table">
        <tr>
            <td>Nomor Induk</td>
            <td><?php echo $detail->nomorInduk ?></td>
        </tr>
    </table>
<?php }
?>