<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Tambah Data Jenis Perawatan</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart('administrator/tambah_jenis',$attributes); 
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <tr><th width='170px' scope='row'>Jenis Perawatan</th>  <td colspan='2'><input class='form-control' type='text' name='a'></td></tr>
                    <tr><th scope='row'>Produk Perawatan</th>                    <td colspan='2'><div class='checkbox-scroll'>";
                                                                             foreach ($record as $row){
                                                                               echo "<span style='display:block'><input name='produk[]' type='checkbox' value='$row[id_produk]' /> $row[nama]</span> ";
                                                                             }
                    echo "</div></td></tr>
                    <tr><th scope='row'>Deskripsi</th> <td colspan='2'><textarea class='form-control' name='c'></textarea></td></tr>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Tambah</button>
                    <a href='".base_url()."administrator/jenisperawatan'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
            </div>";
