<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Tambah Data Produk</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart('administrator/tambah_produk',$attributes); 
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <tr><th width='130px' scope='row'>Nama Produk</th>  <td colspan='3'><input class='form-control' type='text' name='a'></td></tr>
                    <tr><th scope='row'>Harga</th>                    <td colspan='3'><input class='form-control' type='number' name='b'></td></tr>
                    <tr><th scope='row'>Deskripsi</th>               <td colspan='3'><textarea class='form-control' name='c'></textarea></td></tr>
                    <tr>
                        <th scope='row'>Menit</th>
                        <td><input class='form-control' type='number' name='e'></td>
                    </tr>
                    <tr><th scope='row'>Stok</th>                   <td><input class='form-control' type='number' name='f' value='1' min='1'> </tr>
                    <tr><th scope='row'>Upload Gambar</th>              <td><input type='file' class='form-control' name='gambar'></td></tr>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Tambah</button>
                    <a href='".base_url()."administrator/produkperawatan'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
            </div>";
 