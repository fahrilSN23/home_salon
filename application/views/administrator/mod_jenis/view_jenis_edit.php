<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Edit Data Jenis Perawatan</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart('administrator/edit_jenis',$attributes); 
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input class='form-control' type='hidden' name='id' value='$rows[id_jenis]'>
                    <tr><th width='170px' scope='row'>Jenis Perawatan</th>  <td colspan='2'><input class='form-control' type='text' name='a' value='$rows[jenis_perawatan]'></td></tr>
                    <tr><th scope='row'>Produk Tersimpan</th>          <td><div class='checkbox-scroll'>";
                                                                               foreach ($akses as $ro){
                                                                                 echo "<span style='display:block'><a class='text-danger' href='".base_url()."administrator/delete_pjperawatan/$ro[id_jenistoproduk]/".$this->uri->segment(3)."'><span class='glyphicon glyphicon-remove'></span></a> $ro[nama]</span> ";
                                                                               }
                      echo "</div></td></tr>
                    <tr><th scope='row'>Produk Perawatan</th>                    <td colspan='2'><div class='checkbox-scroll'>";
                                                                             foreach ($record as $row){
                                                                               echo "<span style='display:block'><input name='produk[]' type='checkbox' value='$row[id_produk]' /> $row[nama]</span> ";
                                                                             }
                    echo "</div></td></tr>
                    <tr><th scope='row'>Deskripsi</th> <td colspan='2'><textarea class='form-control' name='c'>$rows[deskripsi]</textarea></td></tr>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Update</button>
                    <a href='".base_url()."administrator/jenisperawatan'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
            </div>";
