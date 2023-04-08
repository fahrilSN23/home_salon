<!-- contact section -->

<section class="contact_section layout_padding">
    <div class="design-box">
      <img src="images/design-2.png" alt="">
    </div>
    <div class="container ">
      <div class="">
        <h2 class="">
          <?=$title?>
        </h2>
      </div>

    </div>
    <div class="container">
        <form action="<?php echo base_url(); ?>members/edit_profile" method="POST">
            <div class="row">
                <div class="col-md-6">
                    <div>
                    <label>Nama Lengkap :</label>
                    <input type="text" name="a" value="<?=$row['nama']?>" placeholder="Nama Lengkap"/>
                    </div>
                    <div>
                    <label>E-mail :</label>
                    <input type="email" name="b" value="<?=$row['email']?>" placeholder="Email"/>
                    </div>
                    <div>
                    <label>Password :</label>
                    <input type="password" name="c" placeholder="Password"/>
                    </div>
                    <div>
                    <label>Alamat :</label>
                    <input type="text" name="d" value="<?=$row['alamat']?>" placeholder="Alamat"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div>
                    <label>No Telp :</label>
                    <input type="text" name="e" value="<?=$row['no_telp']?>" placeholder="Contoh : 62812xxxxxxxx"/>
                    </div>
                    <div>
                    <label>No Rekening :</label>
                    <input type="text" name="f" value="<?=$row['no_rek']?>" placeholder="No Rekening"/>
                    </div>
                    <div>
                    <label>Nama Bank :</label>
                    <input type="text" name="g" value="<?=$row['bank']?>" placeholder="Nama Bank"/>
                    </div>
                    <div>
                    <label>Atas Nama :</label>
                    <input type="text" name="h" value="<?=$row['atas_nama']?>" placeholder="Atas Nama"/>
                    </div>
                </div>
                <div>
                    <input type="submit" name="submit" class="price_btn" value="Simpan"/>
                </div>
            </div>
        </form>
    </div>
  </section>

  <!-- end contact section -->