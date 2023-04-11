<div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Transaksi Pemesanan + History Proses eksekusi</h3>
                  <!-- <a class='pull-right btn btn-primary btn-sm' href='<?php echo base_url(); ?>administrator/tambah_pemesanan'>Tambah Pemesanan</a> -->
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style='width:40px'>No</th>
                        <th>No Transaksi</th>
                        <th>No Antrian</th>
                        <th>Nama Pelanggan</th>
                        <th>Jumlah Bayar</th>
                        <!-- <th>Tanggal Pemesanan</th> -->
                        <th>Jadwal Treatment</th>
                        <th>Proses / Keterangan</th>
                        <th style='width:130px'>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                  $no = 1;
                  foreach ($record as $row){
                    if ($row['status']=='0'){ 
                      $status = '<span class="badge bg-gray">Menunggu Pembayaran</span>'; 
                      $icon = 'star-empty';
                    }elseif ($row['status']=='1'){
                      $status = '<span class="badge bg-yellow">Menunggu Konfirmasi Admin</span>'; 
                      $detail = 'Konfirmasi Pembayaran'; $icon = 'star text-yellow'; 
                      $ubah = 2; 
                    }elseif ($row['status']=='2'){
                      $status = '<span class="badge bg-aqua">Menunggu Antrian</span>'; 
                      $detail = 'Layani Pesanan'; $icon = 'star text-yellow'; 
                      $ubah = 3; 
                    }elseif ($row['status']=='3'){
                        $status = '<span class="badge bg-blue">Sedang Dilayani</span>'; 
                        $detail = 'Pesanan Selesai'; $icon = 'star'; 
                        $ubah = 4; 
                    }elseif ($row['status']=='4'){
                      $status = '<span class="badge bg-green">Pesanan Selesai</span>'; 
                      $icon = 'star text-green';
                    }

                    if ($row['c_order']=='0'){ 
                      $link = "accept";
                      $c_order = '<span class="badge bg-gray">Pelanggan belum tiba</span>'; 
                    }elseif ($row['c_order']=='1'){
                      $link = "accept";
                      $c_order = '<span class="badge bg-green">Pelanggan tiba tepat waktu</span>';
                    }elseif ($row['c_order']=='2'){
                      $link = "reject";
                      $status = '<span class="badge bg-gray">Menunggu Pembayaran Admin</span>'; 
                      $icon = 'star-empty';
                      $c_order = '<span class="badge bg-red">Pesanan Dibatalkan</span>';
                    }elseif ($row['c_order']=='3'){
                      $link = "reject";
                      $status = '<span class="badge bg-green">Refund Berhasil</span>'; 
                      $icon = 'star-empty';
                      $c_order = '<span class="badge bg-red">Pesanan Dibatalkan</span>';
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
                        $selisih = "<i class='text-danger'><b>Waktu kedatangan konsumen " . $days . " menit lagi.</b</i>";
                      } elseif ($days <= 0) {
                        $selisih = "<i class='text-danger'><b>Waktu kedatangan konsumen telah habis, silahkan batalkan transaksi / lanjutkan ke antrian berikutnya.</b</i>";
                      }
                    }
                
                  $total = $this->db->query("SELECT sum(a.harga_pesan) as total FROM `detil_pemesanan` a where a.id_pemesanan='$row[id_pemesanan]'")->row_array();
                    echo "<tr><td>$no</td>
                              <td>$row[no_transaksi]</td>
                              <td>$no_antrian</td>
                              <td>$row[nama]</td>
                              <td>Rp ".rupiah($total['total'])."<br><i class='text-danger'>Refund : Rp ".rupiah($row['kembali'])."</i></td>
                              
                              <td>$tgl_treatment<br>";
                              if($row['c_order'] == 0) { echo $selisih; }
                              echo "</td>
                             <td>$status <br> $c_order</td>
                             
                              <td><center>
                                <a class='btn btn-success btn-xs' title='Detail Data' href='".base_url()."administrator/detail_pemesanan/$row[id_pemesanan]/$link'><span class='glyphicon glyphicon-search'></span> Detail</a> ";
                                if ($row['status'] >= '1' AND $row['status'] <= '3' AND $row['c_order'] <= 1){
                                  echo "<a style='margin:0px 3px' class='btn btn-primary btn-xs' title='$detail' href='".base_url()."administrator/proses_pemesanan/$row[id_pemesanan]/$ubah' onclick=\"return confirm('Apa anda yakin untuk ubah status jadi $detail pada pesanan ini?')\"><span class='glyphicon glyphicon-$icon'></span></a> ";
                                }
                                if ($days > 0 AND $row['c_order'] != 1 AND $row['status'] <= 3) {
                                  echo "<a class='btn btn-info btn-xs' title='Tiba Tepat Waktu' href='".base_url()."administrator/cek_pemesanan/$row[id_pemesanan]/1' onclick=\"return confirm('Apa anda yakin pelanggan sudah tiba?')\"><span class='glyphicon glyphicon-check'></span></a> ";
                                } elseif ($days < 0 AND $row['c_order'] <= 1 AND $row['status'] <= 2) {
                                  echo "<a class='btn btn-danger btn-xs' title='Pesanan Dibatalkan' href='".base_url()."administrator/cek_pemesanan/$row[id_pemesanan]/2' onclick=\"return confirm('Apa anda yakin untuk membatalkan pesanan ini?')\"><span class='glyphicon glyphicon-remove'></span></a> ";
                                }
                                if ($days > 0 && $days <= 20) {
                                  $phone = $row['no_telp'];
                                  $name = $row['nama'];

                                  echo "<a class='btn btn-warning btn-xs' title='Ingatkan Pelanggan' href='".base_url()."administrator/kirimnotif/$phone/$name/$days'><span class='glyphicon glyphicon-bell'></span></a>";
                                }
                                echo "</center></td>
                          </tr>";
                      $no++;
                    }
                  ?>
                  </tbody>
                </table>
              </div>
              </div>
              </div>
              