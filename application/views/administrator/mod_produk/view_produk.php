<div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Daftar Semua Produk</h3>
                  <a class='pull-right btn btn-primary btn-sm' href='<?php echo base_url(); ?>administrator/tambah_produk'>Tambahkan Data</a>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style='width:20px'>No</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Deskripsi</th>
                        <th>Waktu</th>
                        <th>Stok</th>
                        <th>Gambar</th>
                        <th style='width:120px'>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $no = 1;
                    foreach ($record as $row){
                    // Menit
                    if ($row['menit'] == null) {
                      $menit = '0';
                    }else{
                      $menit = $row['menit'];
                    }
                    // Gambar
                    if ($row['gambar'] == null) {
                      $gambar = 'no-image.jpg';
                    }else{
                      $gambar = $row['gambar'];
                    }
                    echo "<tr><td>$no</td>
                              <td>$row[nama]</td>
                              <td>Rp. " . rupiah($row['harga']) . "</td>
                              <td>$row[deskripsi]</td>
                              <td>$menit Menit</td>
                              <td>$row[stok]</td>
                              <td><img src='" . base_url() . "/asset/foto_produk/$gambar' width='100px'></td>
                              <td><center>
                                <a class='btn btn-warning btn-xs' title='Edit Data' href='".base_url()."administrator/edit_produk/$row[id_produk]'><span class='glyphicon glyphicon-edit'></span></a>
                                <a class='btn btn-danger btn-xs' title='Delete Data' href='".base_url()."administrator/delete_produk/$row[id_produk]' onclick=\"return confirm('Apa anda yakin untuk hapus Data ini?')\"><span class='glyphicon glyphicon-remove'></span></a>
                              </center></td>
                          </tr>";
                      $no++;
                    }
                  ?>
                  </tbody>
                </table>
              </div>