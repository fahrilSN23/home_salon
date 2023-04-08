<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Tambah Jam Operasional</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart('administrator/tambah_jam',$attributes); 
          echo "<div class='col-md-6'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <tr>
                        <th width='130px' scope='row'>Hari</th>
                        <td>
                            <select class='form-control' name='a'>
                                <option value='Senin'>Senin</option>
                                <option value='Selasa'>Selasa</option>
                                <option value='Rabu'>Rabu</option>
                                <option value='Kamis'>Kamis</option>
                                <option value='Jumat'>Jumat</option>
                                <option value='Sabtu'>Sabtu</option>
                                <option value='Minggu'>Minggu</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th scope='row'>Buka</th>
                        <td><input class='form-control' type='time' name='b'></td>
                    </tr>
                    <tr>
                        <th scope='row'>Tutup</th>
                        <td><input class='form-control' type='time' name='c'></td>
                    </tr>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Tambah</button>
                    <a href='".base_url()."administrator/jamoperasional'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
            </div>";
 