<div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Jam Operasional</h3>
                  <a class='pull-right btn btn-primary btn-sm' href='<?php echo base_url(); ?>administrator/tambah_jam'>Tambahkan Data</a>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style='width:20px'>No</th>
                        <th>Hari</th>
                        <th>Buka</th>
                        <th>Tutup</th>
                        <th style='width:120px'>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $no = 1;
                    foreach ($record as $row){
                    echo "<tr><td>$no</td>
                              <td>$row[hari]</td>
                              <td>$row[buka]</td>
                              <td>$row[tutup]</td>
                              <td><center>
                                <a class='btn btn-warning btn-xs' title='Edit Data' href='".base_url()."administrator/edit_jam/$row[id_jam]'><span class='glyphicon glyphicon-edit'></span></a>
                                <a class='btn btn-danger btn-xs' title='Delete Data' href='".base_url()."administrator/delete_jam/$row[id_jam]' onclick=\"return confirm('Apa anda yakin untuk hapus Data ini?')\"><span class='glyphicon glyphicon-remove'></span></a>
                              </center></td>
                          </tr>";
                      $no++;
                    }
                  ?>
                  </tbody>
                </table>
              </div>