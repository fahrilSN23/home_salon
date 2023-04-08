<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Edit Jam Operasional</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart('administrator/edit_jam',$attributes); 
          echo "<div class='col-md-6'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                  <input class='form-control' type='hidden' name='id' value='$rows[id_jam]'>
                    <tr>
                        <th width='130px' scope='row'>Hari</th>
                        <td>
                            <select class='form-control' name='a'>
                                <option value='Senin'"; if ($rows['hari'] == 'Senin') { echo "selected"; } echo ">Senin</option>
                                <option value='Selasa'"; if ($rows['hari'] == 'Selasa') { echo "selected"; } echo ">Selasa</option>
                                <option value='Rabu'"; if ($rows['hari'] == 'Rabu') { echo "selected"; } echo ">Rabu</option>
                                <option value='Kamis'"; if ($rows['hari'] == 'Kamis') { echo "selected"; } echo ">Kamis</option>
                                <option value='Jumat'"; if ($rows['hari'] == 'Jumat') { echo "selected"; } echo ">Jumat</option>
                                <option value='Sabtu'"; if ($rows['hari'] == 'Sabtu') { echo "selected"; } echo ">Sabtu</option>
                                <option value='Minggu'"; if ($rows['hari'] == 'Minggu') { echo "selected"; } echo ">Minggu</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th scope='row'>Buka</th>
                        <td><input class='form-control' type='time' name='b' value='$rows[buka]'></td>
                    </tr>
                    <tr>
                        <th scope='row'>Tutup</th>
                        <td><input class='form-control' type='time' name='c' value='$rows[tutup]'></td>
                    </tr>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Update</button>
                    <a href='".base_url()."administrator/jamoperasional'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
            </div>";
 