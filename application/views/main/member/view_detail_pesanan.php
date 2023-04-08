<?php
if ($rows['no_antrian'] == null) {
  $no_antrian = "<i class='text-danger' style='font-size:12px'>Belum memiliki No. Antrian.</i>";
}else {
  $no_antrian = $rows['no_antrian'];
}

if ($rows['tanggal_treatment'] == null) {
  $tgl_treatment = "<i class='text-danger' style='font-size:12px'>Menunggu konfirmasi admin.</i>";
}else {
  $tgl_treatment = tgl_treatment($rows['tanggal_treatment']);
}
?>

<section class="price_section layout_padding">
    <div class="container">
      <div class="heading_container">
        <h2>
          <?=$title?>
        </h2>
      </div>
      <div class="price_container">
        <div class="box-cart">
          <div class="name">
            <h6>
              Berikut Detail Pesanan Anda
            </h6>
          </div>
          <div class="detail-box">
            <table class='table table-condensed table-bordered' style="width: 100%;">
                <tbody>
                    <tr>
                        <th>Nomor Transaksi</th>
                        <td><?php echo "$rows[no_transaksi]"; ?></td>
                        <th>Bukti Bayar</th>
                        <?php 
                        if ($bf['bukti_transfer'] == ''){ $bukti_bayar ='blank.png'; }else{ $bukti_bayar = $bf['bukti_transfer']; } ?>
                        <td rowspan="4"><a href="<?=base_url()?>asset/files/<?=$bukti_bayar?>" target="_blank"><img src="<?=base_url()?>asset/files/<?=$bukti_bayar?>" width="100px"></a></td>
                    </tr>
                    <tr>
                        <th>Nomor Antrian</th>
                        <td><?php echo $no_antrian; ?></td>
                    </tr>
                    <tr><th scope='row'>Nama Pelanggan</th>                 <td><?php echo "$rows[nama]"; ?></td></tr>
                    <tr><th scope='row'>Jadwal Treatment</th>               <td><?php echo $tgl_treatment; ?></td></tr>
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
                          $c_order = '<span class="badge-secondary">Pelanggan belum tiba</span>'; 
                        }elseif ($rows['c_order']=='1'){
                          $c_order = '<span class="badge badge-success">Pelanggan tiba tepat waktu</span>';
                        }elseif ($rows['c_order']=='2'){
                          $c_order = '<span class="badge badge-danger">Pesanan Dibatalkan</span>';
                        }
                        echo "$status <br> $c_order"; 
                        ?>
                      </td>
                      <th width='140px' scope='row'>Terapis</th>
                      <td>
                          <?php if ($rows['id_terapis'] == 0) { ?>
                            <input type="text" value="Menunggu Konfirmasi Admin" class="form-control" disabled>
                          <?php } else {
                          $ter = $this->model_app->view_where('terapis',array('id_terapis'=>$rows['id_terapis']))->row_array();
                          ?>
                            <input type="text" value="<?=$ter['nama_terapis']?>" class="form-control" disabled>
                          <?php } ?>
                      </td>
                    </tr>
                </tbody>
            </table>
          </div>
          <hr>
          <div class="detail-box">
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
            <hr>
            <a class='btn btn-success btn-sm' style="margin-left: 20px;" href='<?=base_url()?>members/pesanan'>Kembali</a>
          </div>
        </div>
      </div>
      <!-- <div class="d-flex justify-content-center">
        <a href="" class="price_btn">
          See More
        </a>
      </div> -->
    </div>
</section>