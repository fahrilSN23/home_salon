<div class="col-xs-12">  
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Data Detail Pemesanan</h3>
            <a class='pull-right btn btn-default btn-sm' href='<?php echo base_url(); ?>administrator/pemesanan'>Kembali</a>
        </div><!-- /.box-header -->
    <div class="box-body">
        <table class='table table-condensed table-bordered'>
            <tbody>
                <tr>
                    <th width='140px' scope='row'>Nomor Transaksi</th>
                    <td><?php echo "$rows[no_transaksi]"; ?></td>
                    <th width='140px'>Bukti Bayar</th>
                    <?php if ($bf['bukti_transfer'] == ''){ $bukti_bayar ='blank.png'; }else{ $bukti_bayar = $bf['bukti_transfer']; } ?>
                    <td rowspan="4"><a href="<?=base_url()?>asset/files/<?=$bukti_bayar?>" target="_blank"><img src="<?=base_url()?>asset/files/<?=$bukti_bayar?>" width="100px"></a></td>
                </tr>
                <tr>
                    <th width='140px' scope='row'>Nomor Antrian</th>
                    <td><?php echo "$rows[no_antrian]"; ?></td>
                </tr>
                <tr><th scope='row'>Nama Pelanggan</th>                 <td><?php echo "$rows[nama]"; ?></td></tr>
                <form action="<?=base_url()?>administrator/add_terapis/<?=$this->uri->segment(3)?>" method="post">
                <tr>
                    <th scope='row'>Tanggal Treatment</th>
                    <td>
                        <div class="form-group">
                            <?php if ($rows['status'] != 4) { ?>
                            <div class='input-group date' id='datetimepicker1'>
                                <input type='text' class="form-control" value="<?=$rows['tanggal_treatment']?>" data-date-format="YYYY-MM-DD H:m" name="tanggal_treatment" required />
                                <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                            <?php } else { ?>
                                <input type='text' class="form-control" value="<?=tgl_treatment($rows['tanggal_treatment'])?>" disabled />
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th scope='row'>Proses</th>
                    <td>
                        <?php
                        if ($rows['status']=='0'){ 
                            $status = '<i class="text-danger">Menunggu Pembayaran</i>'; 
                        }elseif ($rows['status']=='1'){
                            $status = '<i class="text-warning">Menunggu Konfirmasi Admin</i>'; 
                        }elseif ($rows['status']=='2'){
                            $status = '<i class="text-info">Menunggu Antrian</i>';
                        }elseif ($rows['status']=='3'){
                            $status = '<i class="text-primary">Sedang Dilayani</i>'; 
                        }elseif ($rows['status']=='4'){
                            $status = '<i class="text-success">Pesanan Selesai</i>'; 
                        }
                        if ($rows['c_order']=='0'){ 
                            $c_order = '<span class="badge bg-gray">Pelanggan belum tiba</span>'; 
                        }elseif ($rows['c_order']=='1'){
                            $c_order = '<span class="badge bg-green">Pelanggan tiba tepat waktu</span>';
                        }elseif ($rows['c_order']=='2'){
                            $c_order = '<span class="badge bg-red">Pesanan Dibatalkan</span>';
                        }
                        echo "$status <br> $c_order"; 
                        ?>
                    </td>
                    <th width='140px' scope='row'>Terapis</th>
                    <td>
                        <?php if ($rows['status'] != 4) { ?>
                        <select name="id_terapis" class="form-control" required>
                            <option value="">Pilih Terapis</option>
                            <?php foreach ($terapis as $t) { ?>
                            <option value="<?=$t['id_terapis']?>" <?= $t['id_terapis'] == $rows['id_terapis'] ? "selected" : null ?>><?=$t['nama_terapis']?></option>
                            <?php } ?>
                        </select>
                        <?php } else {
                        $ter = $this->model_app->view_where('terapis',array('id_terapis'=>$rows['id_terapis']))->row_array();?>
                            <input type='text' class="form-control" value="<?=$ter['nama_terapis']?>" disabled />
                        <?php } ?>
                    </td>
                </tr>
                <?php if ($rows['status'] != 4) { ?>
                <tr>
                    <td><button type='submit' name='submit' class='btn btn-success' style="margin-top: 5px;">Simpan</button></td>
                </tr>
                <?php } ?>
                </form>
            </tbody>
        </table>
        <hr>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                <th style='width:40px'>No</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Deskripsi</th>
                <th>Lama Perawatan</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no = 1;
                foreach ($record as $row){
                echo "<tr><td>$no</td>
                            <td>$row[nama]</td>
                            <td>$row[deskripsi]</td>
                            <td>$row[jam] Jam $row[menit] Menit</td>
                            <td>Rp ".rupiah($row['harga'])."</td>
                        </tr>";
                    $no++;
                }
                $total_harga = $this->db->query("SELECT sum(a.harga_pesan) as total FROM `detil_pemesanan` a where a.id_pemesanan='".$this->uri->segment(3)."'")->row_array();
                echo "<tr class='success'>
                        <td colspan='4'><b>Total</b></td>
                        <td><b>Rp ".rupiah($total_harga['total'])."</b></td>
                        </tr>";
                ?>
            </tbody>
        </table>
    </div>

    <script src='<?php echo base_url(); ?>asset/dist/rome.js'></script>
    <script src='<?php echo base_url(); ?>asset/example/example.js'></script>