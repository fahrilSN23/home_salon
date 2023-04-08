<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Tambah Data User</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart($this->uri->segment(1).'/tambah_manajemenuser',$attributes); 
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <tr><th width='120px' scope='row'>Username</th>   <td><input type='text' class='form-control' name='username' onkeyup=\"nospaces(this)\" required></td></tr>
                    <tr><th scope='row'>Nama Lengkap</th>             <td><input type='text' class='form-control' name='nama_lengkap' required></td></tr>
                    <tr><th scope='row'>Password</th>                 <td><input type='password' class='form-control' name='password' onkeyup=\"nospaces(this)\" required></td></tr>
                    <tr><th scope='row'>Tipe</th>                   <td><input type='radio' name='tipe' value='Pimpinan' checked> Pimpinan &nbsp; <input type='radio' name='tipe' value='Administrator'> Administrator</td></tr>
                    <tr><th scope='row'>Alamat</th>             <td><textarea class='form-control' name='alamat_user'></textarea></td></tr>
                    <tr><th scope='row'>No Telepon</th>               <td><input type='number' class='form-control' name='telp_user' required></td></tr>
                    <tr><th scope='row'>Email</th>             <td><input type='email' class='form-control' name='email_user'></td></tr>
                    <tr><th scope='row'>Upload Foto</th>              <td><input type='file' class='form-control' name='foto'></td></tr>
                  </tbody>
                  </table></div>
              
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Tambahkan</button>
                    <a href='".base_url().$this->uri->segment(1)."/manajemenuser'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
            </div></div></div>";
            echo form_close();