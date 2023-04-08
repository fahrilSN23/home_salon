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
        <form action="<?php echo base_url(); ?>auth/register" method="POST">
            <div class="row">
                <div class="col-md-6">
                    <div>
                    <label>Nama Lengkap :</label>
                    <input type="text" name="a" placeholder="Nama Lengkap"/>
                    </div>
                    <div>
                    <label>E-mail :</label>
                    <input type="email" name="b" placeholder="Email"/>
                    </div>
                    <div>
                    <label>Password :</label>
                    <input type="password" name="c" placeholder="Password"/>
                    </div>
                    <div>
                    <label>Alamat :</label>
                    <input type="text" name="d" placeholder="Alamat"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div>
                    <label>No Telp :</label>
                    <input type="text" name="e" placeholder="No Telp"/>
                    </div>
                    <div>
                    <label>No Rekening :</label>
                    <input type="text" name="f" placeholder="No Rekening"/>
                    </div>
                    <div>
                    <label>Nama Bank :</label>
                    <input type="text" name="g" placeholder="Nama Bank"/>
                    </div>
                    <div>
                    <label>Atas Nama :</label>
                    <input type="text" name="h" placeholder="Atas Nama"/>
                    </div>
                </div>
                <div>
                    <input type="submit" name="submit1" class="price_btn" value="Daftar"/>
                </div>
            </div>
        </form>
    </div>
  </section>

  <!-- end contact section -->