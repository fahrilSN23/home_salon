<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Edit Data Terapis</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart('administrator/edit_terapis',$attributes); 
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' value='$rows[id_terapis]' name='id'>
                    <tr><th width='130px' scope='row'>Nama terapis</th>  <td><input class='form-control' type='text' name='a' value='$rows[nama_terapis]'></td></tr>
                    <tr><th scope='row'>No Telpon</th>                    <td><input class='form-control' type='number' name='b' value='$rows[telp_terapis]'></td></tr>
                    <tr><th scope='row'>Alamat Lengkap</th>               <td><textarea class='form-control' name='c'>$rows[alamat_terapis]</textarea></td></tr>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Update</button>
                    <a href='".base_url()."administrator/terapis'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
            </div>";
