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
        <?php 
                echo $this->session->flashdata('message'); 
                $this->session->unset_userdata('message');
            ?>
          <form method="post" action="<?php echo base_url(); ?>auth/login">
            <div>
              <input type="email" name="a" placeholder="Email" required/>
            </div>
            <div>
              <input type="password" name="b" placeholder="Password" required/>
            </div>
            <div class="d-flex ">
                <input name='login' type="submit" class="btn btn-primary" value="Login">
            </div>
          </form>
          <br>
          <p>Belum memiliki akun? Daftar <a href="<?=base_url()?>auth/register">Disini</a></p>
        </div>
      </div>
    </div>
  </section>

  <!-- end contact section -->