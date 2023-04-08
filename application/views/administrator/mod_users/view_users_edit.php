<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Edit Data $rows[tipe]</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart($this->uri->segment(1).'/edit_manajemenuser',$attributes); 
              if ($rows['foto']==''){ $foto = 'users.gif'; }else{ $foto = $rows['foto']; }
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value='$rows[id_user]'>
                    <tr><th width='120px' scope='row'>Username</th>   <td><input type='text' class='form-control' name='username' value='$rows[username]' readonly='on'></td></tr>
                    <tr><th scope='row'>Nama Lengkap</th>             <td><input type='text' class='form-control' name='nama_lengkap' value='$rows[nama_lengkap]'></td></tr>
                    <tr><th scope='row'>Password</th>                 <td><input type='password' class='form-control' name='password' onkeyup=\"nospaces(this)\"></td></tr>";
                    if ($this->session->tipe == 'Kasir'){
                        echo "<tr><th scope='row'>Tipe</th>                   <td>"; if ($rows['tipe']=='Pimpinan'){ echo "<input type='radio' name='tipe' value='Pimpinan' checked> Pimpinan &nbsp; <input type='radio' name='tipe' value='Kasir'> Kasir"; }else{ echo "<input type='radio' name='tipe' value='Pimpinan'> Pimpinan &nbsp; <input type='radio' name='tipe' value='Kasir' checked> Kasir"; } echo "</td></tr>";
                      }
                    echo "<tr><th scope='row'>Alamat</th>                    <td><textarea class='form-control' name='alamat_user'>$rows[alamat_user]</textarea></td></tr>
                    <tr><th scope='row'>No Telepon</th>                  <td><input type='number' class='form-control' name='telp_user' value='$rows[telp_user]'></td></tr>
                    <tr><th scope='row'>Email</th>                    <td><input type='email' class='form-control' name='email_user' value='$rows[email_user]'></td></tr>
                    <tr><th scope='row'>Ganti Foto</th>                     <td><input type='file' class='form-control' name='foto'><hr style='margin:5px'>";
                                                                                 if ($rows['foto'] != ''){ echo "<i style='color:red'>Foto Saat ini : </i><a target='_BLANK' href='".base_url()."asset/foto_user/$rows[foto]'>$rows[foto]</a>"; } echo "</td></tr></td></tr>
                    </tbody>
                  </table></div>
              
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Update</button>
                    <a href='".base_url().$this->uri->segment(1)."/manajemenuser'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
            </div></div></div>";
            echo form_close();