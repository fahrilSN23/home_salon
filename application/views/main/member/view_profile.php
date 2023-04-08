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
      <div class="row">
        <div class="col-md-6">
            <div>
              <label>Nama Lengkap :</label>
              <input type="text" name="a" value="<?=$row['nama']?>" placeholder="Email" disabled/>
            </div>
            <div>
              <label>E-mail :</label>
              <input type="text" name="a" value="<?=$row['email']?>" placeholder="Email" disabled/>
            </div>
            <div>
              <label>Alamat :</label>
              <input type="text" name="a" value="<?=$row['alamat']?>" placeholder="Email" disabled/>
            </div>
            <div>
              <label>No Telp :</label>
              <input type="text" name="a" value="<?=$row['no_telp']?>" placeholder="Email" disabled/>
            </div>
        </div>
        <div class="col-md-6">
            <div>
              <label>No Rekening :</label>
              <input type="text" name="a" value="<?=$row['no_rek']?>" placeholder="Email" disabled/>
            </div>
            <div>
              <label>Nama Bank :</label>
              <input type="text" name="a" value="<?=$row['bank']?>" placeholder="Email" disabled/>
            </div>
            <div>
              <label>Atas Nama :</label>
              <input type="text" name="a" value="<?=$row['atas_nama']?>" placeholder="Email" disabled/>
            </div>
            <div>
                <a href="<?=base_url()?>members/edit_profile" class="price_btn">Edit Profile</a>
            </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end contact section -->