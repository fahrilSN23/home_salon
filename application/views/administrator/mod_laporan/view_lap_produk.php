<div class='col-md-12'>
    <div class='box box-info'>
        <div class='box-header with-border'>
            <h3 class='box-title'>Cetak Laporan Produk Perawatan</h3>
        </div>
        <?php echo form_open(base_url('administrator/cetak_produk')) ?>
        <div class='box-body'>
            <div class='col-md-12'>
                <table class='table table-condensed table-bordered'>
                  <tbody>
                    <tr>
                        <th scope='row'>Jenis Perawatan</th>
                        <td>
                            <select name='a' class='form-control'>
                                <option value='' selected>- Semua Jenis Perawatan -</option>
                                <?php foreach ($record as $row){
                                    echo "<option value='$row[id_jenis]'>$row[jenis_perawatan]</option>";
                                } ?>
                            </select>
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