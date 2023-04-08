<div class='col-md-12'>
    <div class='box box-info'>
        <div class='box-header with-border'>
            <h3 class='box-title'>Cetak Laporan Pemesanan</h3>
        </div>
        <?php echo form_open(base_url('administrator/cetak_pemesanan')) ?>
        <div class='box-body'>
            <div class='col-md-12'>
                <table class='table table-condensed table-bordered'>
                  <tbody>
                    <tr>
                        <!-- Tanggal Mulai -->
                        <th scope='row'>Tanggal Mulai</th>
                        <td>
                            <input class='datepicker form-control' type='text' name='tgl_mulai' value="<?=date('Y-m-d')?>" data-date-format='yyyy-mm-dd'>
                        </td>
                        <!-- Jarak -->
                        <td></td>
                        <!-- Tanggal Selesai -->
                        <th scope='row'>Tanggal Selesai</th>
                        <td>
                            <input class='datepicker form-control' type='text' name='tgl_selesai' value="<?=date('Y-m-d')?>" data-date-format='yyyy-mm-dd'>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class='box-footer'>
            <button type='submit' name='submit' class='btn btn-primary'><i class="fa fa-print"></i> Cetak Laporan</button>
        </div>
        <?php echo form_close() ?>
        </div>
</div>