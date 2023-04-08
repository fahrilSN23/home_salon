<div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Manajemen Users</h3>
                  <a class='pull-right btn btn-primary btn-sm' href='<?php echo base_url().$this->uri->segment(1); ?>/tambah_manajemenuser'>Tambahkan Data</a>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style='width:20px'>No</th>
                        <th>Username</th>
                        <th>Nama Lengkap</th>
                        <th>Tipe</th>
                        <th>Alamat</th>
                        <th>Telp</th>
                        <th>Email</th>
                        <th>Foto</th>
                        <th style='width:70px'>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $no = 1;
                    foreach ($record as $row){
                    if ($row['foto'] == ''){ $foto ='blank.png'; }else{ $foto = $row['foto']; }
                    echo "<tr><td>$no</td>
                              <td>$row[username]</td>
                              <td>$row[nama_lengkap]</td>
                              <td>$row[tipe]</td>
                              <td>$row[alamat_user]</td>
                              <td>$row[telp_user]</td>
                              <td>$row[email_user]</td>
                              <td><img style='border:1px solid #cecece' width='40px' class='img-circle' src='".base_url()."asset/foto_user/$foto'></td>
                              <td><center>
                                <a class='btn btn-success btn-xs' title='Edit Data' href='".base_url().$this->uri->segment(1)."/edit_manajemenuser/$row[id_user]'><span class='glyphicon glyphicon-edit'></span></a>
                                <a class='btn btn-danger btn-xs' title='Delete Data' href='".base_url().$this->uri->segment(1)."/delete_manajemenuser/$row[id_user]' onclick=\"return confirm('Apa anda yakin untuk hapus Data ini?')\"><span class='glyphicon glyphicon-remove'></span></a>
                              </center></td>
                          </tr>";
                      $no++;
                    }
                  ?>
                  </tbody>
                </table>
              </div>