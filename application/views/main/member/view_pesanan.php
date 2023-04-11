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
              Berikut Pesanan Anda
            </h6>
          </div>
          <div class="detail-box">
          <table id="" class="table table-bordered table-striped example" style="width:96%;margin: 20px">
                <thead>
                  <tr>
                    <th style='width:30px'>No</th>
                    <th>No Transaksi</th>
                    <th>No Antrian</th>
                    <th>Jumlah Bayar</th>
                    <th>Jadwal Treatment</th>
                    <th>Proses</th>
                    <th style='width:70px'>#</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $no = 1;
                    foreach ($record->result_array() as $row) {
                      if ($row['status']=='0'){ 
                        $status = '<span class="badge-secondary">Menunggu Pembayaran</span>'; 
                        $icon = 'star-empty';
                      }elseif ($row['status']=='1'){
                        $status = '<span class="badge-pill badge-warning">Menunggu Konfirmasi</span>'; 
                        $detail = 'Konfirmasi Pembayaran'; $icon = 'star text-yellow'; 
                        $ubah = 2; 
                      }elseif ($row['status']=='2'){
                        $status = '<span class="badge-pill badge-info">Menunggu Antrian</span>'; 
                        $detail = 'Layani Pesanan'; $icon = 'star text-yellow'; 
                        $ubah = 3; 
                      }elseif ($row['status']=='3'){
                          $status = '<span class="badge-pill badge-primary">Sedang Dilayani</span>'; 
                          $detail = 'Pesanan Selesai'; $icon = 'star'; 
                          $ubah = 4; 
                      }elseif ($row['status']=='4'){
                        $status = '<span class="badge-pill badge-success">Pesanan Selesai</span>'; 
                        $icon = 'star text-green';
                      }
  
                      if ($row['c_order']=='0'){ 
                        $c_order = '<span class="badge-secondary">Pelanggan belum tiba</span>'; 
                      }elseif ($row['c_order']=='1'){
                        $c_order = '<span class="badge badge-success">Pelanggan tiba tepat waktu</span>';
                      }elseif ($row['c_order']=='2'){
                        $c_order = '<span class="badge badge-danger">Pesanan Dibatalkan</span>';
                      }elseif ($row['c_order']=='2'){
                        $status = '<span class="badge bg-gray">Menunggu Pembayaran Admin</span>'; 
                        $c_order = '<span class="badge badge-danger">Pesanan Dibatalkan</span>';
                      }elseif ($row['c_order']=='3'){
                        $status = '<span class="badge-pill badge-success">Refund Berhasil</span>'; 
                        $c_order = '<span class="badge badge-danger">Pesanan Dibatalkan</span>';
                      }

                      if ($row['no_antrian'] == null) {
                        $no_antrian = "<i class='text-danger' style='font-size:12px'>Belum memiliki No. Antrian.</i>";
                      }else {
                        $no_antrian = $row['no_antrian'];
                      }

                      if ($row['tanggal_treatment'] == null) {
                        $tgl_treatment = "<i class='text-danger' style='font-size:12px'>Menunggu konfirmasi admin.</i>";
                      }else {
                        $tgl_treatment = tgl_treatment($row['tanggal_treatment']);
                        // Mengambil nilai tanggal dan waktu
                        $time = $this->db->query("SELECT YEAR(tanggal_treatment) as tahun, MONTH(tanggal_treatment) as bulan, DAY(tanggal_treatment) as tanggal, HOUR(tanggal_treatment) as jam, MINUTE(tanggal_treatment) as menit, SECOND(tanggal_treatment) as detik FROM pemesanan WHERE id_pemesanan = $row[id_pemesanan]")->row_array();
                        // Selisih waktu
                        date_default_timezone_set("Asia/Jayapura");
    
                        $tanggal = $time['tanggal'];
                        $bulan = $time['bulan'];
                        $tahun = $time['tahun'];
                        $jam = $time['jam'];
                        $menit = $time['menit'];
                        $detik = $time['detik'];
                        
                        $days    =(int)((mktime ($jam,$menit,$detik,$bulan,$tanggal,$tahun) - time())/60);
    
                        if ($days > 0 && $days <= 20) {
                          $selisih = "<i class='text-danger' style='font-size:12px'><b>Waktu kedatangan konsumen " . $days . " menit lagi.</b</i>";
                        } elseif ($days <= 0) {
                          $selisih = "<i class='text-danger' style='font-size:12px'>Waktu anda telah habis.</i>";
                        }
                      }
                      $total = $this->db->query("SELECT sum(a.harga_pesan) as total FROM `detil_pemesanan` a where a.id_pemesanan='$row[id_pemesanan]'")->row_array();
                  ?>
                    <tr>
                        <td><?=$no++?></td>
                        <td><?=$row['no_transaksi']?></td>
                        <td><?=$no_antrian?></td>
                        <td>Rp. <?=rupiah($total['total'])?><br><i class="text-danger" style="font-size:12px">Refund : Rp. <?=rupiah($row['kembali'])?></i></td>
                        <td><?=$tgl_treatment?><br>
                          <?php if($row['c_order'] == 0) { echo $selisih; } ?>
                        </td>
                        <td><?=$status?><br><?=$c_order?></td>
                        <td>
                          <center>
                            <?php
                            if ($row['status']=='0' && $row['c_order'] < 2){
                              echo "<a style='margin-right:3px' class='btn btn-secondary btn-xs' title='Konfirmasi Pembayaran' href='".base_url()."konfirmasi?kode=$row[no_transaksi]'><span class='fa fa-check-square-o'></span></a>";
                            }
                            ?>
                            <a class="btn btn-success" title="Detail Data" href="<?=base_url()?>members/detail_pemesanan/<?=$row['id_pemesanan']?>"><span class='fa fa-search'></span></a>
                          </center>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th style='width:40px'>No</th>
                    <th>No Transaksi</th>
                    <th>No Antrian</th>
                    <th>Jumlah Bayar</th>
                    <th>Jadwal Treatment</th>
                    <th>Proses</th>
                    <th style='width:100px'>#</th>
                  </tr>
                </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>
</section>