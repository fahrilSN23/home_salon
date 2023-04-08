<div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Daftar Semua Jenis Perawatan</h3>
                  <a class='pull-right btn btn-primary btn-sm' href='<?php echo base_url(); ?>administrator/tambah_jenis'>Tambahkan Data</a>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style='width:20px'>No</th>
                        <th>Jenis Perawatan</th>
                        <th>Produk Perawatan</th>
                        <th>Deskripsi</th>
                        <th style='width:120px'>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $no = 1;
                    foreach ($record as $row){
                    $produk = $this->model_app->view_join_where('jenis_to_produk','produk','id_produk',array('id_jenis'=>$row['id_jenis']),'id_jenistoproduk','ASC');
                    

                    echo "<tr><td>$no</td>
                              <td>$row[jenis_perawatan]</td>
                              <td>
                                <ul>";
                                foreach ($produk as $p) {
                                    echo "<li> $p[nama] (Rp. ".rupiah($p['harga']).")</li>";
                                }
                                echo "</ul>
                              </td>
                              <td>$row[deskripsi]</td>
                              <td><center>
                                <a class='btn btn-warning btn-xs' title='Edit Data' href='".base_url()."administrator/edit_jenis/$row[id_jenis]'><span class='glyphicon glyphicon-edit'></span></a>
                                <a class='btn btn-danger btn-xs' title='Delete Data' href='".base_url()."administrator/delete_jenis/$row[id_jenis]' onclick=\"return confirm('Apa anda yakin untuk hapus Data ini?')\"><span class='glyphicon glyphicon-remove'></span></a>
                              </center></td>
                          </tr>";
                      $no++;
                    }
                  ?>
                  </tbody>
                </table>
              </div>