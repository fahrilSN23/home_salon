<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Edit Data Pelanggan</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart($this->uri->segment(1).'/edit_pelanggan',$attributes); 
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value='$rows[id_pelanggan]'>
                    <tr><th scope='row'>Nama Lengkap</th>             <td><input type='text' class='form-control' name='nama' value='$rows[nama]' required></td></tr>
                    <tr><th scope='row'>Email</th>             <td><input type='email' class='form-control' name='email' value='$rows[email]' ></td></tr>
                    <tr><th scope='row'>Password</th>                 <td><input type='password' class='form-control' name='password' onkeyup=\"nospaces(this)\"></td></tr>
                    <tr><th scope='row'>Alamat</th>             <td><textarea class='form-control' name='alamat'>$rows[alamat]</textarea></td></tr>
                    <tr><th scope='row'>No Telepon</th>               <td><input type='number' class='form-control' name='no_telp' value='$rows[no_telp]'  required></td></tr>
                    <tr><th scope='row'>No Rekening</th>               <td><input type='number' class='form-control' name='no_rek' value='$rows[no_rek]'  required></td></tr>
                    <tr><th scope='row'>Nama Bank</th>               <td><input type='text' class='form-control' name='bank' value='$rows[bank]' required></td></tr>
                    <tr><th scope='row'>Atas Nama</th>               <td><input type='text' class='form-control' name='atas_nama' value='$rows[atas_nama]'  required></td></tr>
                  </tbody>
                  </table></div>
              
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Update</button>
                    <a href='".base_url().$this->uri->segment(1)."/pelanggan'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
            </div></div></div>";
            echo form_close();