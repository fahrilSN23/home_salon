<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Edit Data Produk</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart('administrator/edit_produk',$attributes); 
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value='$rows[id_produk]'>
                    <tr><th width='130px' scope='row'>Nama Produk</th>  <td colspan='3'><input class='form-control' type='text' name='a' value='$rows[nama]'></td></tr>
                    <tr><th scope='row'>Harga</th>                    <td colspan='3'><input class='form-control' type='number' name='b' value='$rows[harga]'></td></tr>
                    <tr><th scope='row'>Deskripsi</th>               <td colspan='3'><textarea class='form-control' name='c'>$rows[deskripsi]</textarea></td></tr>
                    <tr>
                        <th scope='row'>Menit</th>
                        <td><input class='form-control' type='number' name='e' value='$rows[menit]'></td>
                    </tr>
                    <tr><th scope='row'>Stok</th>                   <td><input class='form-control' type='number' name='f' value='$rows[stok]' min='1'> </tr>
                    <tr><th scope='row'>Ganti Gambar</th>                     <td><input type='file' class='form-control' name='gambar'><hr style='margin:5px'>";
                                                                                 if ($rows['gambar'] != ''){ echo "<i style='color:red'>Gambar Saat ini : </i><a target='_BLANK' href='".base_url()."asset/foto_produk/$rows[gambar]'>$rows[gambar]</a>"; } echo "</td></tr></td></tr>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Edit</button>
                    <a href='".base_url()."administrator/produkperawatan'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
            </div>";
 