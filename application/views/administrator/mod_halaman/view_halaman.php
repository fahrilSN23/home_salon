<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Tentang Kami</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart($this->uri->segment(1).'/tentangkami',$attributes); 
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <tr><th width='120px' scope='row'>Judul</th>   <td><input type='text' class='form-control' name='a' value='$rows[judul]'></td></tr>
                    <tr><th scope='row'>Isi Halaman</th>           <td><textarea class='ckeditor form-control' name='b' style='height:260px'>$rows[isi]</textarea></td></tr>
                    <tr><th scope='row'>Ganti Gambar</th>          <td><input type='file' class='form-control' name='c'><hr style='margin:5px'>";
                                                                   if ($rows['gambar']!=''){ echo " Gambar Saat ini : <a target='_BLANK' href='".base_url()."asset/foto_statis/$rows[gambar]'>$rows[gambar]</a>"; } echo "</td></tr>
                  </tbody>
                  </table>
                </div>
              
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Update</button>
                    
                  </div>
            </div></div></div>";
            echo form_close();